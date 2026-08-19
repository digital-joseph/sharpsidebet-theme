<?php
/**
 * Template Name: About
 * Assign this template to a Page (slug "about").
 *
 * @package Sharpside
 */
get_header();
?>

<section class="dark" style="padding:64px 0 0">
	<div class="wrap">
		<span class="kicker" style="color:var(--volt)">About</span>
		<h1 class="pagehead" style="padding:12px 0 0">We're not touts.</h1>
		<p class="lead" style="color:var(--smoke);margin-top:18px">Sharpside exists because the handicapping industry runs on hype, and hype is easy to sell and impossible to trust. We do the opposite. We show the math, log every play, and let the numbers make the case.</p>
	</div>
</section>

<section class="bone pad on-bone">
	<div class="wrap">
		<span class="kicker">The Problem</span>
		<div class="pullquote">Everyone's <span class="volt">"up."</span> Nobody shows the losses.</div>
		<div class="storytext">
			<p>Open any betting page and it's the same playbook: cropped winning slips, "locks of the day," fake "as seen on" logos, and a record that only ever goes up. It's marketing dressed as analysis, and it preys on people who want to believe.</p>
			<p>The truth is simpler and less exciting. Winning at sports betting is about <strong>small, repeatable edges</strong> and the discipline to bet them the same way every day, through the losing stretches that are mathematically guaranteed to happen.</p>
			<p>That's a harder thing to sell. It's also the only thing that's real.</p>
		</div>
	</div>
</section>

<section class="dark pad">
	<div class="wrap">
		<span class="kicker" style="color:var(--volt)">What We Actually Do</span>
		<h2 class="h2">Disciplined, and out in the open.</h2>
		<div class="grid3 reveal">
			<div class="vcard"><div class="vn">01</div><h4>Price every game</h4><p>We estimate a real win probability, strip the vig from the market, and only play when there's a positive-EV edge.</p></div>
			<div class="vcard"><div class="vn">02</div><h4>Size in units</h4><p>Every play is staked as a unit off a disciplined bankroll framework, so bet size matches the edge, never emotion.</p></div>
			<div class="vcard"><div class="vn">03</div><h4>Log everything</h4><p>Wins, losses, and passes all go on the public record. A track record that's all green is a track record nobody should believe.</p></div>
			<div class="vcard"><div class="vn">04</div><h4>Publish CLV</h4><p>We track the price we got against the closing line. Closing line value is the most honest proof that an edge is real.</p></div>
			<div class="vcard"><div class="vn">05</div><h4>Pass, loudly</h4><p>No edge, no play. Some days the best bet is no bet, and we say so instead of forcing a pick to fill a slate.</p></div>
			<div class="vcard"><div class="vn">06</div><h4>Never guarantee</h4><p>Anyone promising you locks or guaranteed profit is selling a story. We sell analysis and discipline. That's it.</p></div>
		</div>
	</div>
</section>

<section class="bone pad on-bone">
	<div class="wrap">
		<span class="kicker">Straight Up</span>
		<div class="pullquote" style="max-width:22ch">The honesty <span class="volt">is</span> the product.</div>
		<div class="storytext">
			<p>Sharpside is built for bettors who are tired of being sold to and want the actual work: the number, the reasoning, the price to beat, and a receipt afterward.</p>
			<p>Bet responsibly, only what you can afford to lose, and only where it's legal. We're an analytics service, not a sportsbook, and never a sure thing.</p>
		</div>
	</div>
</section>

<section class="cta">
	<div class="cta__bg"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cta-crowd.jpg' ); ?>" alt="" aria-hidden="true" loading="lazy"></div>
	<div class="wrap">
		<span class="kicker">See for yourself</span>
		<h2 class="h2">Read the <span class="volt">record.</span></h2>
		<p>Don't take our word for it. The whole log is public, losses and all. Start free and watch it.</p>
		<div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
			<a class="btn btn--volt" href="<?php echo esc_url( home_url( '/track-record/' ) ); ?>">See the track record</a>
			<a class="btn btn--out" href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>" style="color:var(--paper);border-color:var(--paper)">View plans</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
