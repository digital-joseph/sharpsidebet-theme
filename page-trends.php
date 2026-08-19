<?php
/**
 * Template Name: Trends
 * Assign this template to a Page (slug "trends").
 *
 * MVP with sample cards. To go live, feed the .trend-grid from a data source
 * (see the "Trends data" section in the README). Card markup:
 *   data-type = team | totals | props
 *   .priced   = edge | in | fade
 *
 * @package Sharpside
 */
get_header();
?>

<section class="dark" style="padding:64px 0 0">
	<div class="wrap">
		<span class="kicker" style="color:var(--volt)">Free Tool · MLB</span>
		<h1 class="pagehead" style="padding:12px 0 0">Trends, priced.</h1>
		<p class="lead" style="color:var(--smoke);margin-top:18px">Every tool shows you streaks. We show you the streak <strong style="color:var(--paper)">and</strong> whether the market has already adjusted for it, so you can tell a real edge from noise. A trend is not a bet until the price is wrong.</p>
	</div>
</section>

<section class="dark pad" style="padding-top:36px">
	<div class="wrap">
		<div class="trend-toolbar" role="group" aria-label="Filter trends">
			<button class="on" data-type="all">All</button>
			<button data-type="team">Team</button>
			<button data-type="totals">Totals</button>
			<button data-type="props">Player Props</button>
		</div>
		<p class="mono" style="font-size:11px;color:var(--faint);letter-spacing:.04em;margin-top:6px">Badges: <span style="color:var(--volt)">EDGE</span> = line hasn't caught up · <span style="color:var(--smoke)">PRICED IN</span> = market adjusted · <span style="color:var(--flare)">FADE</span> = public trend, value's the other way. Sample data.</p>

		<div class="trend-grid reveal">
			<div class="tcard" data-type="team">
				<div class="thead"><div><div class="league">MLB · Run Line</div><div class="subj">Braves -1.5</div></div><span class="priced edge">Edge</span></div>
				<div class="stmt">Braves have covered <b>-1.5</b> in 7 of their last 9 games as home favorites.</div>
				<div class="hitrate"><div class="pct pos">78%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i><i></i></div></div>
				<div class="tfoot"><span>Sample 9</span><span class="odds">-1.5 (+120)</span></div>
			</div>
			<div class="tcard" data-type="props">
				<div class="thead"><div><div class="league">MLB · Total Bases</div><div class="subj">Aaron Judge</div></div><span class="priced edge">Edge</span></div>
				<div class="stmt">Judge has cleared <b>1.5 total bases</b> in 9 of his last 12 games vs right-handers.</div>
				<div class="hitrate"><div class="pct pos">75%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i><i></i><i></i></div></div>
				<div class="tfoot"><span>Sample 12</span><span class="odds">o1.5 TB (-140)</span></div>
			</div>
			<div class="tcard" data-type="totals">
				<div class="thead"><div><div class="league">MLB · Total</div><div class="subj">Yankees Over</div></div><span class="priced in">Priced In</span></div>
				<div class="stmt">The <b>OVER</b> has hit in 8 of the Yankees' last 10 home games.</div>
				<div class="hitrate"><div class="pct mid">80%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i><i></i></div></div>
				<div class="tfoot"><span>Sample 10</span><span class="odds">O 9.5 (-115)</span></div>
			</div>
			<div class="tcard" data-type="team">
				<div class="thead"><div><div class="league">MLB · Moneyline</div><div class="subj">Dodgers Day</div></div><span class="priced fade">Fade</span></div>
				<div class="stmt">Dodgers are 8-2 in their last 10 <b>day games</b>, but they're priced like it.</div>
				<div class="hitrate"><div class="pct mid">80%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i><i></i></div></div>
				<div class="tfoot"><span>Sample 10</span><span class="odds">ML -160</span></div>
			</div>
			<div class="tcard" data-type="props">
				<div class="thead"><div><div class="league">MLB · Runs</div><div class="subj">Mookie Betts</div></div><span class="priced edge">Edge</span></div>
				<div class="stmt">Betts has scored a run in <b>8 of 10</b> games hitting leadoff.</div>
				<div class="hitrate"><div class="pct pos">80%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i><i></i></div></div>
				<div class="tfoot"><span>Sample 10</span><span class="odds">o0.5 Runs (-125)</span></div>
			</div>
			<div class="tcard" data-type="totals">
				<div class="thead"><div><div class="league">MLB · Team Total</div><div class="subj">Astros Road U</div></div><span class="priced in">Priced In</span></div>
				<div class="stmt">The <b>UNDER</b> has hit in 6 of 8 Astros road games this month.</div>
				<div class="hitrate"><div class="pct mid">75%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i><i></i></div></div>
				<div class="tfoot"><span>Sample 8</span><span class="odds">U 8.5 (-105)</span></div>
			</div>
			<div class="tcard" data-type="props">
				<div class="thead"><div><div class="league">MLB · Stolen Bases</div><div class="subj">Corbin Carroll</div></div><span class="priced edge">Edge</span></div>
				<div class="stmt">Carroll has gone <b>over 0.5 stolen bases</b> in 7 of his last 10.</div>
				<div class="hitrate"><div class="pct pos">70%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i><i></i><i></i></div></div>
				<div class="tfoot"><span>Sample 10</span><span class="odds">o0.5 SB (+130)</span></div>
			</div>
			<div class="tcard" data-type="team">
				<div class="thead"><div><div class="league">MLB · Moneyline</div><div class="subj">Phillies Spot</div></div><span class="priced fade">Fade</span></div>
				<div class="stmt">Phillies are 9-1 in their last 10 vs sub-.500 teams. The public knows.</div>
				<div class="hitrate"><div class="pct mid">90%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i></div></div>
				<div class="tfoot"><span>Sample 10</span><span class="odds">ML -175</span></div>
			</div>
			<div class="tcard" data-type="totals">
				<div class="thead"><div><div class="league">MLB · First 5</div><div class="subj">Padres F5 U</div></div><span class="priced edge">Edge</span></div>
				<div class="stmt">The <b>First 5 UNDER</b> has hit in 7 of 10 Padres starts this month.</div>
				<div class="hitrate"><div class="pct pos">70%</div><div class="dots" aria-hidden="true"><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i class="hit"></i><i></i><i></i><i></i></div></div>
				<div class="tfoot"><span>Sample 10</span><span class="odds">F5 U 4.5 (-115)</span></div>
			</div>
		</div>
	</div>
</section>

<section class="bone pad on-bone">
	<div class="wrap">
		<span class="kicker">Read This First</span>
		<div class="pullquote" style="max-width:24ch">A trend is <span class="volt">not</span> an edge.</div>
		<div class="storytext">
			<p>Streaks feel like signal. Most of them are noise the market has already accounted for. That's why every card here is tagged: a hot trend that's fully <strong>priced in</strong> is not a bet, and a "can't lose" public trend is often a <strong>fade</strong>.</p>
			<p>The green <strong>EDGE</strong> tags are the ones worth a look, where the number hasn't caught up to the pattern yet. Our paid card takes it the rest of the way: true probability, expected value, and a logged result.</p>
		</div>
	</div>
</section>

<section class="cta">
	<div class="cta__bg"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cta-crowd.jpg' ); ?>" alt="" aria-hidden="true" loading="lazy"></div>
	<div class="wrap">
		<span class="kicker">From trend to bet</span>
		<h2 class="h2">Want the <span class="volt">edge</span> ones?</h2>
		<p>Trends tell you what happened. Our daily card tells you what's actually worth betting, priced and logged.</p>
		<a class="btn btn--volt" href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>">See the plans</a>
	</div>
</section>

<?php get_footer(); ?>
