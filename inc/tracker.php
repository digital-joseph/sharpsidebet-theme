<?php
/**
 * Sharpside — live track record.
 *
 * Reads a published Google Sheet (or any CSV) of graded plays, caches it,
 * computes headline stats, and renders the Track Record page. Falls back to
 * built-in sample data until a sheet is connected.
 *
 * Expected CSV header row (case-insensitive, order-flexible):
 *   Date, Matchup, Play, Odds, Close, CLV, Result, Stake, Units
 *   - Date:   anything strtotime() can read (e.g. 2026-08-16 or 08/16/2026)
 *   - CLV:    percent, with or without % / + (e.g. "+2.1%" or "2.1")
 *   - Result: Win / Loss / Push / Void / No Bet (w, l, p also accepted)
 *   - Stake:  units risked (number)
 *   - Units:  net units won/lost, signed (e.g. "+1.30" or "-2.00")
 *
 * @package Sharpside
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/** The configured CSV URL: PHP constant wins, else Customizer setting. */
function sharpside_tracker_csv_url() {
	if ( defined( 'SHARPSIDE_TRACKER_CSV' ) && SHARPSIDE_TRACKER_CSV ) {
		return SHARPSIDE_TRACKER_CSV;
	}
	return trim( (string) get_theme_mod( 'sharpside_tracker_csv', '' ) );
}

/** True when we are showing built-in sample data (no live sheet resolved). */
function sharpside_is_sample() {
	return (bool) apply_filters( 'sharpside_is_sample', $GLOBALS['sharpside_is_sample'] ?? true );
}

/**
 * Fetch + parse plays. Returns an array of associative rows.
 * Caches the parsed result for 10 minutes via a transient.
 */
function sharpside_get_plays( $limit = 0 ) {
	$url = sharpside_tracker_csv_url();

	if ( ! $url ) {
		$GLOBALS['sharpside_is_sample'] = true;
		$plays = sharpside_sample_plays();
		return $limit ? array_slice( $plays, 0, $limit ) : $plays;
	}

	$cache = get_transient( 'sharpside_plays' );
	if ( false === $cache ) {
		$plays    = array();
		$response = wp_remote_get( $url, array( 'timeout' => 8 ) );
		if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
			$plays = sharpside_parse_csv( wp_remote_retrieve_body( $response ) );
		}
		// Cache even an empty result briefly so a bad URL does not hammer the sheet.
		set_transient( 'sharpside_plays', $plays, 10 * MINUTE_IN_SECONDS );
		$cache = $plays;
	}

	if ( empty( $cache ) ) {
		$GLOBALS['sharpside_is_sample'] = true;
		$plays = sharpside_sample_plays();
		return $limit ? array_slice( $plays, 0, $limit ) : $plays;
	}

	$GLOBALS['sharpside_is_sample'] = false;
	// Newest first.
	usort( $cache, function ( $a, $b ) { return $b['ts'] <=> $a['ts']; } );
	return $limit ? array_slice( $cache, 0, $limit ) : $cache;
}

/** Parse CSV text into normalized play rows. */
function sharpside_parse_csv( $body ) {
	$rows = array_map( 'str_getcsv', preg_split( "/\r\n|\n|\r/", trim( (string) $body ) ) );
	if ( count( $rows ) < 2 ) { return array(); }

	$header = array_map( function ( $h ) { return strtolower( trim( $h ) ); }, array_shift( $rows ) );
	$idx    = array_flip( $header );
	$col    = function ( $names ) use ( $idx ) {
		foreach ( (array) $names as $n ) { if ( isset( $idx[ $n ] ) ) { return $idx[ $n ]; } }
		return null;
	};
	$c = array(
		'date'    => $col( array( 'date' ) ),
		'matchup' => $col( array( 'matchup', 'game' ) ),
		'play'    => $col( array( 'play', 'pick', 'bet' ) ),
		'odds'    => $col( array( 'odds', 'odds taken', 'price' ) ),
		'close'   => $col( array( 'close', 'close odds', 'closing' ) ),
		'clv'     => $col( array( 'clv', 'clv%', 'clv %' ) ),
		'result'  => $col( array( 'result' ) ),
		'stake'   => $col( array( 'stake', 'stake (u)', 'units risked' ) ),
		'units'   => $col( array( 'units', 'units p/l', 'net units', 'p/l' ) ),
	);

	$out = array();
	foreach ( $rows as $r ) {
		if ( ! is_array( $r ) || null === $c['play'] || ! isset( $r[ $c['play'] ] ) ) { continue; }
		$play = trim( (string) $r[ $c['play'] ] );
		if ( '' === $play ) { continue; }

		$raw_result = null !== $c['result'] ? strtolower( trim( (string) ( $r[ $c['result'] ] ?? '' ) ) ) : '';
		$result     = sharpside_norm_result( $raw_result );
		$date_raw   = null !== $c['date'] ? trim( (string) ( $r[ $c['date'] ] ?? '' ) ) : '';

		$out[] = array(
			'date'    => $date_raw,
			'ts'      => $date_raw ? (int) strtotime( $date_raw ) : 0,
			'matchup' => null !== $c['matchup'] ? trim( (string) ( $r[ $c['matchup'] ] ?? '' ) ) : '',
			'play'    => $play,
			'odds'    => null !== $c['odds'] ? trim( (string) ( $r[ $c['odds'] ] ?? '' ) ) : '',
			'close'   => null !== $c['close'] ? trim( (string) ( $r[ $c['close'] ] ?? '' ) ) : '',
			'clv'     => null !== $c['clv'] ? sharpside_num( $r[ $c['clv'] ] ?? '' ) : null,
			'result'  => $result,
			'stake'   => null !== $c['stake'] ? (float) sharpside_num( $r[ $c['stake'] ] ?? '' ) : 0.0,
			'units'   => null !== $c['units'] ? (float) sharpside_num( $r[ $c['units'] ] ?? '' ) : 0.0,
		);
	}
	return $out;
}

/** Strip %, +, commas etc. and return a float (or null if blank). */
function sharpside_num( $v ) {
	$v = trim( (string) $v );
	if ( '' === $v ) { return null; }
	$v = str_replace( array( '%', '+', ',', 'u', 'U' ), '', $v );
	return (float) $v;
}

/** Normalize a result string to win|loss|push|pass. */
function sharpside_norm_result( $r ) {
	if ( in_array( $r, array( 'w', 'win', 'won' ), true ) ) { return 'win'; }
	if ( in_array( $r, array( 'l', 'loss', 'lost', 'lose' ), true ) ) { return 'loss'; }
	if ( in_array( $r, array( 'p', 'push', 'void', 'tie' ), true ) ) { return 'push'; }
	if ( in_array( $r, array( 'no bet', 'nobet', 'pass', 'passed' ), true ) ) { return 'pass'; }
	return $r ? $r : 'pass';
}

/** Compute headline stats from graded plays (ignores passes). */
function sharpside_compute_stats( $plays ) {
	$w = $l = $p = $passes = 0;
	$net = $stake = 0.0; $clv_sum = 0.0; $clv_n = 0;
	foreach ( $plays as $x ) {
		if ( 'pass' === $x['result'] ) { $passes++; continue; }
		if ( 'win' === $x['result'] ) { $w++; }
		elseif ( 'loss' === $x['result'] ) { $l++; }
		elseif ( 'push' === $x['result'] ) { $p++; }
		$net   += (float) $x['units'];
		$stake += (float) $x['stake'];
		if ( null !== $x['clv'] ) { $clv_sum += (float) $x['clv']; $clv_n++; }
	}
	$graded = $w + $l + $p;
	return array(
		'wins'      => $w,
		'losses'    => $l,
		'pushes'    => $p,
		'passes'    => $passes,
		'graded'    => $graded,
		'net_units' => $net,
		'roi'       => $stake > 0 ? ( $net / $stake ) * 100 : 0.0,
		'win_rate'  => ( $w + $l ) > 0 ? ( $w / ( $w + $l ) ) * 100 : 0.0,
		'avg_clv'   => $clv_n > 0 ? ( $clv_sum / $clv_n ) : 0.0,
	);
}

/* ---------------- render helpers (shared by live + sample) ---------------- */

function sharpside_render_stats( $s ) {
	$roi   = sprintf( '%+.1f%%', $s['roi'] );
	$net   = sprintf( '%+.1fu', $s['net_units'] );
	$clv   = sprintf( '%+.1f%%', $s['avg_clv'] );
	$rate  = sprintf( '%.1f%%', $s['win_rate'] );
	$rec   = (int) $s['wins'] . '&ndash;' . (int) $s['losses'];
	echo '<div class="trk-stats reveal">';
	printf( '<div class="st"><div class="n %s">%s</div><div class="l">Return on Investment</div><div class="s">on units risked</div></div>', $s['roi'] >= 0 ? 'pos' : 'neg', esc_html( $roi ) );
	printf( '<div class="st"><div class="n %s">%s</div><div class="l">Net Units</div><div class="s">bankroll growth</div></div>', $s['net_units'] >= 0 ? 'pos' : 'neg', esc_html( $net ) );
	printf( '<div class="st"><div class="n %s">%s</div><div class="l">Avg Closing Line Value</div><div class="s">the real proof</div></div>', $s['avg_clv'] >= 0 ? 'pos' : 'neg', esc_html( $clv ) );
	printf( '<div class="st"><div class="n">%s</div><div class="l">Record (W&ndash;L)</div><div class="s">%s won</div></div>', $rec, esc_html( $rate ) );
	printf( '<div class="st"><div class="n">%s</div><div class="l">Win Rate</div><div class="s">graded plays</div></div>', esc_html( $rate ) );
	printf( '<div class="st"><div class="n">%d</div><div class="l">Plays Logged</div><div class="s">plus %d passes</div></div>', (int) $s['graded'], (int) $s['passes'] );
	echo '</div>';
}

function sharpside_render_log( $plays ) {
	foreach ( $plays as $x ) {
		if ( 'pass' === $x['result'] ) { continue; }
		$clv_class = ( null === $x['clv'] ) ? 'zero' : ( $x['clv'] > 0 ? 'pos' : ( $x['clv'] < 0 ? 'neg' : 'zero' ) );
		$clv_txt   = ( null === $x['clv'] ) ? '&mdash;' : sprintf( '%+.1f%%', $x['clv'] );
		$u_class   = $x['units'] > 0 ? 'pos' : ( $x['units'] < 0 ? 'neg' : 'zero' );
		$u_txt     = sprintf( '%+.2f', $x['units'] );
		$pill      = array( 'win' => 'Win', 'loss' => 'Loss', 'push' => 'Push' );
		$label     = $pill[ $x['result'] ] ?? ucfirst( $x['result'] );
		printf(
			'<tr data-result="%s"><td>%s</td><td class="sub">%s</td><td class="play">%s</td><td class="num">%s</td><td class="num">%s</td><td class="num clv %s">%s</td><td><span class="pill %s">%s</span></td><td class="num u %s">%s</td></tr>',
			esc_attr( $x['result'] ),
			esc_html( $x['date'] ),
			esc_html( $x['matchup'] ),
			esc_html( $x['play'] ),
			esc_html( $x['odds'] ),
			esc_html( $x['close'] ),
			esc_attr( $clv_class ), $clv_txt,
			esc_attr( $x['result'] ), esc_html( $label ),
			esc_attr( $u_class ), esc_html( $u_txt )
		);
	}
}

function sharpside_render_months( $plays ) {
	$months = array();
	foreach ( $plays as $x ) {
		if ( 'pass' === $x['result'] || ! $x['ts'] ) { continue; }
		$key = gmdate( 'Y-m', $x['ts'] );
		if ( ! isset( $months[ $key ] ) ) {
			$months[ $key ] = array( 'label' => gmdate( 'M', $x['ts'] ), 'w' => 0, 'l' => 0, 'net' => 0.0, 'stake' => 0.0, 'clv' => 0.0, 'clv_n' => 0 );
		}
		$m =& $months[ $key ];
		if ( 'win' === $x['result'] ) { $m['w']++; } elseif ( 'loss' === $x['result'] ) { $m['l']++; }
		$m['net']   += (float) $x['units'];
		$m['stake'] += (float) $x['stake'];
		if ( null !== $x['clv'] ) { $m['clv'] += (float) $x['clv']; $m['clv_n']++; }
		unset( $m );
	}
	ksort( $months );
	foreach ( $months as $m ) {
		$plays_ct = $m['w'] + $m['l'];
		$roi      = $m['stake'] > 0 ? ( $m['net'] / $m['stake'] ) * 100 : 0;
		$clv      = $m['clv_n'] > 0 ? $m['clv'] / $m['clv_n'] : 0;
		printf(
			'<tr><td class="mlabel">%s</td><td>%d</td><td>%d-%d</td><td class="%s">%+.1f</td><td class="%s">%+.1f%%</td><td class="%s">%+.1f%%</td></tr>',
			esc_html( $m['label'] ),
			$plays_ct, (int) $m['w'], (int) $m['l'],
			$m['net'] >= 0 ? 'pos' : 'neg', $m['net'],
			$roi >= 0 ? 'pos' : 'neg', $roi,
			$clv >= 0 ? 'pos' : 'neg', $clv
		);
	}
}

/* ---------------- built-in sample data ---------------- */

function sharpside_sample_plays() {
	$rows = array(
		array( '08/16', 'Mariners @ Astros', 'Astros ML', '-125', '-140', 2.4, 'loss', 2.0, -2.00 ),
		array( '08/16', 'Mariners @ Astros', 'Alvarez o1.5 TB', '-115', '-135', 3.1, 'win', 1.5, 1.30 ),
		array( '08/15', 'Twins @ Yankees', 'Under 8.5', '-105', '-115', 1.8, 'win', 1.0, 0.95 ),
		array( '08/15', 'Padres @ Dodgers', 'Padres +1.5', '-140', '-150', 1.2, 'loss', 1.5, -1.50 ),
		array( '08/14', 'Rays @ Mariners', 'Rays ML', '+120', '+108', 2.6, 'win', 1.0, 1.20 ),
		array( '08/14', 'Cubs @ Brewers', 'Under 7.5', '-110', '-108', -0.5, 'win', 1.0, 0.91 ),
		array( '08/13', 'Mets @ Braves', 'Braves ML', '-130', '-145', 2.3, 'win', 1.0, 0.77 ),
		array( '08/13', 'Astros @ Padres', 'Padres ML', '+112', '+104', 1.7, 'win', 1.0, 1.12 ),
		array( '08/12', 'Angels @ Marlins', 'Angels ML', '+142', '+150', -1.4, 'loss', 1.0, -1.00 ),
		array( '08/11', 'Guardians @ Tigers', 'Over 8.0', '-110', '-120', 2.0, 'push', 1.0, 0.00 ),
		array( '08/10', 'Giants @ Rockies', 'Under 11.0', '-105', '-118', 2.7, 'win', 1.5, 1.90 ),
		array( '08/09', 'Astros @ Padres', 'Astros ML', '-140', '-150', 1.1, 'loss', 2.0, -2.00 ),
		array( '08/08', 'Jays @ Phillies', 'Phillies ML', '-156', '-168', 1.9, 'win', 1.0, 0.64 ),
	);
	$out = array();
	foreach ( $rows as $r ) {
		$out[] = array(
			'date' => $r[0], 'ts' => (int) strtotime( $r[0] ), 'matchup' => $r[1], 'play' => $r[2],
			'odds' => $r[3], 'close' => $r[4], 'clv' => $r[5], 'result' => $r[6], 'stake' => $r[7], 'units' => $r[8],
		);
	}
	return $out;
}

/** Sample all-time stats (shown with sample log so the top line looks like a full season). */
function sharpside_sample_stats() {
	return array(
		'wins' => 182, 'losses' => 130, 'pushes' => 9, 'passes' => 44, 'graded' => 312,
		'net_units' => 36.4, 'roi' => 4.8, 'win_rate' => 58.3, 'avg_clv' => 2.1,
	);
}

/* ---------------- Customizer setting for the CSV URL ---------------- */

function sharpside_customize_tracker( $wp_customize ) {
	$wp_customize->add_section( 'sharpside_tracker', array(
		'title'       => __( 'Sharpside: Track Record', 'sharpside' ),
		'priority'    => 160,
	) );
	$wp_customize->add_setting( 'sharpside_tracker_csv', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'sharpside_tracker_csv', array(
		'label'       => __( 'Published tracker CSV URL', 'sharpside' ),
		'description' => __( 'Google Sheets: File > Share > Publish to web > pick your log tab > CSV. Paste that link here. Leave blank to show sample data. Columns: Date, Matchup, Play, Odds, Close, CLV, Result, Stake, Units.', 'sharpside' ),
		'section'     => 'sharpside_tracker',
		'type'        => 'url',
	) );
}
add_action( 'customize_register', 'sharpside_customize_tracker' );

/** Clear the cache when the URL changes. */
function sharpside_flush_tracker_cache() { delete_transient( 'sharpside_plays' ); }
add_action( 'customize_save_after', 'sharpside_flush_tracker_cache' );
