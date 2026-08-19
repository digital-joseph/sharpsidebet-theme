<?php
/**
 * Template Name: Track Record
 * Assign this template to a Page (slug "track-record").
 *
 * Reads live plays from the connected tracker CSV (Customize > Sharpside:
 * Track Record). Falls back to built-in sample data until one is connected.
 *
 * @package Sharpside
 */
get_header();

$all       = sharpside_get_plays();
$is_sample = sharpside_is_sample();
$recent    = array_slice( $all, 0, 15 );
$stats     = $is_sample ? sharpside_sample_stats() : sharpside_compute_stats( $all );
?>

<section class="dark" style="padding:64px 0 0">
	<div class="wrap">
		<span class="kicker" style="color:var(--volt)">Track Record</span>
		<h1 class="pagehead" style="padding:12px 0 0">The receipts.</h1>
		<p class="lead" style="color:var(--smoke);margin-top:18px">Everybody posts winners. We log every play, then publish closing line value, the one number that actually proves a long-term edge. Wins, losses, and passes. All of it.</p>
		<?php if ( $is_sample ) : ?>
			<span class="sample-tag">● Sample data · connect your tracker in Customize &rsaquo; Sharpside: Track Record</span>
		<?php else : ?>
			<span class="sample-tag" style="color:var(--volt);border-color:var(--volt-dk)">● Live · pulled from the tracking sheet</span>
		<?php endif; ?>
	</div>
</section>

<section class="dark pad" style="padding-top:44px">
	<div class="wrap">
		<?php sharpside_render_stats( $stats ); ?>

		<div class="trk-chart reveal">
			<div class="top"><h3>Cumulative Units</h3><span class="sample-tag" style="margin-top:0">Illustrative</span></div>
			<canvas id="equity" height="260" aria-label="Cumulative units over time"></canvas>
			<div class="foot"><span>Drawdown-aware</span><span>Updated as plays settle</span></div>
		</div>
	</div>
</section>

<section class="dark pad" style="padding-top:0">
	<div class="wrap">
		<div class="reveal sec-head"><span class="kicker" style="color:var(--volt)">Every Play</span><h2 class="h2">The log.</h2><p class="lead" style="color:var(--smoke)">The price we got, the closing line, and the CLV on every single play. Filter it however you want.</p></div>

		<div class="filterbar reveal" role="group" aria-label="Filter plays">
			<button class="on" data-filter="all">All</button>
			<button data-filter="win">Wins</button>
			<button data-filter="loss">Losses</button>
			<button data-filter="push">Pushes</button>
		</div>

		<div class="trk-log reveal">
			<table class="log">
				<thead>
					<tr><th>Date</th><th>Matchup</th><th>Play</th><th class="num">Odds</th><th class="num">Close</th><th class="num">CLV</th><th>Result</th><th class="num">Units</th></tr>
				</thead>
				<tbody>
					<?php sharpside_render_log( $recent ); ?>
				</tbody>
			</table>
		</div>
		<?php if ( $is_sample ) : ?>
			<p class="mono" style="font-size:11px;color:var(--faint);margin-top:14px;letter-spacing:.04em">Showing recent sample plays for layout. Connect your tracker and the live log renders here.</p>
		<?php else : ?>
			<p class="mono" style="font-size:11px;color:var(--faint);margin-top:14px;letter-spacing:.04em">Showing the <?php echo (int) count( $recent ); ?> most recent plays.</p>
		<?php endif; ?>
	</div>
</section>

<section class="bone pad on-bone">
	<div class="wrap">
		<div class="reveal sec-head"><span class="kicker">By Month</span><h2 class="h2">Month over month.</h2><p class="lead">No cherry-picking a hot week. The whole run, broken out.</p></div>
		<div class="trk-months reveal">
			<table class="months">
				<thead><tr><th>Month</th><th>Plays</th><th>W-L</th><th>Units</th><th>ROI</th><th>Avg CLV</th></tr></thead>
				<tbody>
					<?php if ( $is_sample ) : ?>
						<tr><td class="mlabel">May</td><td>58</td><td>34-24</td><td class="pos">+6.2</td><td class="pos">+3.8%</td><td class="pos">+1.9%</td></tr>
						<tr><td class="mlabel">Jun</td><td>71</td><td>42-29</td><td class="pos">+9.1</td><td class="pos">+4.4%</td><td class="pos">+2.3%</td></tr>
						<tr><td class="mlabel">Jul</td><td>88</td><td>50-38</td><td class="pos">+8.7</td><td class="pos">+3.4%</td><td class="pos">+2.0%</td></tr>
						<tr><td class="mlabel">Aug</td><td>95</td><td>56-39</td><td class="pos">+12.4</td><td class="pos">+6.9%</td><td class="pos">+2.4%</td></tr>
					<?php else : ?>
						<?php sharpside_render_months( $all ); ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<?php if ( $is_sample ) : ?>
			<p class="mono" style="font-size:11px;color:#7a7565;margin-top:14px;letter-spacing:.04em">Sample data. Totals reconcile to the record above (312 plays, 182-130, +36.4 units).</p>
		<?php endif; ?>
	</div>
</section>

<section class="cta" id="join">
	<div class="cta__bg"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cta-crowd.jpg' ); ?>" alt="" aria-hidden="true" loading="lazy"></div>
	<div class="wrap">
		<span class="kicker">Numbers, not noise</span>
		<h2 class="h2">Bet the <span class="volt">record.</span></h2>
		<p>This is what you get access to: a disciplined card, graded in the open. Start on the free tier and watch it for yourself.</p>
		<a class="btn btn--volt" href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>">See the plans</a>
	</div>
</section>

<?php get_footer(); ?>
