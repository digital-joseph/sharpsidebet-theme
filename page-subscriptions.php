<?php
/**
 * Template Name: Subscriptions
 * Assign this template to a Page (slug "subscriptions").
 *
 * @package Sharpside
 */
get_header();
?>

<section class="phero dark">
	<div class="wrap">
		<span class="kicker" style="color:var(--volt)">Membership</span>
		<h1>Pick your <span class="volt">play.</span></h1>
		<p>Start free and watch the numbers. Upgrade when the record earns your trust. Cancel any time, no lock-in, no hard sell.</p>
		<div class="toggle" role="tablist" aria-label="Billing period">
			<button class="on" id="tMonthly" aria-pressed="true">Monthly</button>
			<button id="tAnnual" aria-pressed="false">Annual <span class="save">Save 20%</span></button>
		</div>
	</div>
</section>

<section class="dark" style="padding:44px 0 0" id="plans">
	<div class="wrap">
		<div class="plans reveal" style="margin-top:0">
			<div class="plan">
				<div class="nm">Rundown</div><div class="tg">Free forever</div>
				<div class="pr">$0</div><div class="annual"></div>
				<ul><li>1–2 public plays a week</li><li>Daily results recaps</li><li>Betting education drops</li><li>Discord (read-only)</li><li class="off">The full daily card</li><li class="off">Live CLV &amp; ROI dashboard</li></ul>
				<a class="btn btn--out" href="#" data-whop="rundown">Join free</a>
			</div>
			<div class="plan hot">
				<div class="nm">Members</div><div class="tg">The core package</div>
				<div class="pr" data-m="49" data-a="39">$<span class="amt">49</span><small>/mo</small></div>
				<div class="annual" data-annual="Billed $470/yr, 2 months free">&nbsp;</div>
				<ul><li>Every play, every day</li><li>Full write-ups + unit sizing</li><li>Members-only Discord + Q&amp;A</li><li>The live tracking sheet</li><li>Line-shopping guidance</li><li class="off">Higher-conviction Sharp card</li></ul>
				<a class="btn btn--volt" href="#" data-whop="members">Start Members</a>
			</div>
			<div class="plan">
				<div class="nm">Sharp</div><div class="tg">Serious bankrolls</div>
				<div class="pr" data-m="149" data-a="119">$<span class="amt">149</span><small>/mo</small></div>
				<div class="annual" data-annual="Billed $1,430/yr, 2 months free">&nbsp;</div>
				<ul><li>Everything in Members</li><li>Live CLV &amp; ROI dashboard</li><li>Real-time line-move alerts</li><li>Higher-conviction Sharp card</li><li>Priority Discord channel</li><li>Monthly strategy call</li></ul>
				<a class="btn btn--out" href="#" data-whop="sharp">Go Sharp</a>
			</div>
		</div>
		<p class="securenote">Secure checkout &amp; member access powered by Whop · Cancel anytime · 21+</p>
	</div>
</section>

<section class="bone pad on-bone">
	<div class="wrap">
		<div class="reveal sec-head"><span class="kicker">Compare</span><h2 class="h2">Side by side.</h2><p class="lead">No hidden gates. Here's exactly what each tier includes.</p></div>
		<div class="tablewrap reveal">
			<table class="cmp">
				<thead><tr><th>Feature</th><th>Rundown</th><th class="feat">Members</th><th>Sharp</th></tr></thead>
				<tbody>
					<tr><td>Public plays / week</td><td class="cell-mono">1–2</td><td class="cell-mono">All</td><td class="cell-mono">All</td></tr>
					<tr><td>Full daily card</td><td class="no">–</td><td class="yes">✓</td><td class="yes">✓</td></tr>
					<tr><td>Written analysis + sizing</td><td class="no">–</td><td class="yes">✓</td><td class="yes">✓</td></tr>
					<tr><td>Members Discord</td><td class="cell-mono">Read-only</td><td class="yes">✓</td><td class="yes">✓</td></tr>
					<tr><td>Live tracking sheet</td><td class="no">–</td><td class="yes">✓</td><td class="yes">✓</td></tr>
					<tr><td>CLV &amp; ROI dashboard</td><td class="no">–</td><td class="no">–</td><td class="yes">✓</td></tr>
					<tr><td>Line-move alerts</td><td class="no">–</td><td class="no">–</td><td class="yes">✓</td></tr>
					<tr><td>Higher-conviction card</td><td class="no">–</td><td class="no">–</td><td class="yes">✓</td></tr>
					<tr><td>Monthly strategy call</td><td class="no">–</td><td class="no">–</td><td class="yes">✓</td></tr>
					<tr><td>Price</td><td class="cell-mono">$0</td><td class="cell-mono">$49/mo</td><td class="cell-mono">$149/mo</td></tr>
				</tbody>
			</table>
		</div>

		<div class="reveal sec-head" style="margin-top:80px"><span class="kicker">Straight Talk</span><h2 class="h2">The honest part.</h2><p class="lead">The honesty is the product. Anyone selling you certainty is selling you a story.</p></div>
		<div class="promise reveal">
			<div class="pcard yes-c">
				<h4>What you get</h4>
				<ul><li>Disciplined, positive-EV analysis on every play</li><li>Every pick logged publicly: wins, losses, and passes</li><li>Closing line value tracked and published</li><li>Transparent unit sizing off a real bankroll framework</li><li>Cancel anytime, right from your dashboard</li></ul>
			</div>
			<div class="pcard no-c no">
				<h4>What we'll never do</h4>
				<ul><li>Guarantee wins or sell "locks"</li><li>Hide losing bets or crop losing slips</li><li>Promise you'll get rich or quit your job</li><li>Chase last night's result with a "bounce-back lock"</li><li>Tell you to bet more than you can afford to lose</li></ul>
			</div>
		</div>

		<div class="reveal sec-head" style="margin-top:80px"><span class="kicker">Billing &amp; Access</span><h2 class="h2">Questions.</h2></div>
		<div class="faq reveal">
			<div class="qa"><h4>How do I get the picks?</h4><p>Checkout runs through Whop. The moment you join, you're pulled into the members' Discord and get access to the daily card and tracking sheet, usually within a minute.</p></div>
			<div class="qa"><h4>Can I cancel anytime?</h4><p>Yes. Manage or cancel your plan yourself from your Whop dashboard. No emails, no retention hoops.</p></div>
			<div class="qa"><h4>Do you offer refunds?</h4><p>Because access is delivered instantly, subscriptions aren't refundable mid-cycle, but you can cancel before your next renewal and keep access through the period you paid for.</p></div>
			<div class="qa"><h4>What bankroll do I need?</h4><p>None to start. The free tier costs nothing. When you do bet, we publish plays in <em>units</em>, so it scales to any bankroll. A unit is typically 1 to 2% of your roll.</p></div>
			<div class="qa"><h4>Who can join?</h4><p>Sharpside sells information and analysis, not wagers. Members must be 21+ and only bet where it's legal in their jurisdiction.</p></div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
