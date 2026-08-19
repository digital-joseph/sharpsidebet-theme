<?php
/**
 * Front page (home) — STREET SHARP.
 *
 * @package Sharpside
 */
get_header();
$img = get_template_directory_uri() . '/assets/img/hero-stadium.jpg';
?>

<section class="hero dark">
	<div class="hero__bg"><img src="<?php echo esc_url( $img ); ?>" alt="" aria-hidden="true" fetchpriority="high"></div>
	<div class="wrap hero__grid">
		<div>
			<span class="kicker">No locks · No hype · Just +EV</span>
			<h1>Play the<br><span class="volt">Sharp</span> <span class="out">Side</span></h1>
			<p class="lede">Disciplined, positive-EV analysis on every card. We price the game, size the bet, and <strong style="color:var(--paper)">log every play with its closing line value.</strong> Receipts, not hype.</p>
			<div class="hero__cta">
				<a class="btn btn--volt" href="<?php echo esc_url( home_url( '/free-play/' ) ); ?>">Get the free daily play</a>
				<a class="btn btn--out" href="<?php echo esc_url( home_url( '/track-record/' ) ); ?>">See the receipts</a>
			</div>
			<div class="stickers">
				<span class="sticker">+EV or No Bet</span>
				<span class="sticker">CLV Published</span>
				<span class="sticker">Disciplined Units</span>
			</div>
		</div>

		<div class="drop">
			<div class="drop__inner">
				<span class="drop__tag">Today's Drop</span>
				<div class="drop__head"><span>Sharpside · Daily Card</span><span class="live"><i></i> Live</span></div>
				<div class="pl"><div class="m">MLB · Jays @ Phillies</div><div class="o">&minus;156</div><div class="p">Phillies ML</div><div class="e">+5.0%</div></div>
				<div class="pl"><div class="m">MLB · Angels @ Marlins</div><div class="o">+142</div><div class="p">Angels ML</div><div class="e">+6.5%</div></div>
				<div class="pl"><div class="m">MLB · Angels @ Marlins</div><div class="o">&minus;110</div><div class="p">Under 8.0</div><div class="e">+5.0%</div></div>
				<div class="pl pass"><div class="m">MLB · Athletics @ Red Sox</div><div class="o">&mdash;</div><div class="p">No Bet</div><div class="e">no edge</div></div>
				<div class="drop__foot"><span>3 Plays · 1 Pass</span><span>Sample</span></div>
			</div>
		</div>
	</div>
</section>

<div class="marq">
	<div class="marq__t" id="marq">
		<span><b>Sharp Side</b> <em class="star">✦</em> No Locks <em class="star">✦</em> Just The Math <em class="star">✦</em> +EV <em class="star">✦</em> CLV Published <em class="star">✦</em> Bet Responsibly <em class="star">✦</em></span>
	</div>
</div>

<section class="bone pad" id="receipts">
	<div class="wrap">
		<div class="reveal sec-head">
			<span class="kicker">The Receipts</span>
			<h2 class="h2">We show the<br>losses too.</h2>
			<p class="lead">Everybody posts winners. We log <strong>every</strong> play, wins, losses, and passes, then publish the number that actually proves an edge: closing line value.</p>
		</div>
		<div class="receipts reveal">
			<div class="rc"><div class="n pos">+4.8%</div><div class="l">ROI on units</div><div class="s">across 312 plays</div></div>
			<div class="rc"><div class="n pos">+2.1%</div><div class="l">Avg CLV</div><div class="s">beating the close</div></div>
			<div class="rc"><div class="n">182&ndash;130</div><div class="l">Record W&ndash;L</div><div class="s">58.3% graded</div></div>
			<div class="rc"><div class="n">312</div><div class="l">Plays logged</div><div class="s">all public</div></div>
		</div>
		<span class="samp">Sample data · live public ledger goes here at launch</span>
	</div>
</section>

<section class="dark pad" id="playbook" style="border-top:2px solid var(--line)">
	<div class="wrap">
		<div class="reveal sec-head">
			<span class="kicker">The Playbook</span>
			<h2 class="h2">Five steps.<br>No gut calls.</h2>
			<p class="lead">The same disciplined process runs on every game before a play ever reaches you.</p>
		</div>
		<div class="play5 reveal">
			<div class="p5"><div class="no">01</div><h4>True Prob</h4><p>Model each side's real win chance from matchup data, not a hunch.</p></div>
			<div class="p5"><div class="no">02</div><h4>No-Vig</h4><p>Strip the book's juice to find the market's honest price.</p></div>
			<div class="p5"><div class="no">03</div><h4>Find EV</h4><p>Compare the two. No positive edge, no play. We pass, loud.</p></div>
			<div class="p5"><div class="no">04</div><h4>Size It</h4><p>Stake in units, sized to the edge and your bankroll.</p></div>
			<div class="p5"><div class="no">05</div><h4>Log It</h4><p>Every play recorded, price vs. close. CLV never lies.</p></div>
		</div>
	</div>
</section>

<div class="marq dark">
	<div class="marq__t" id="marq2">
		<span>Discipline &gt; Volume <em class="star">✦</em> Receipts Not Hype <em class="star">✦</em> The Sharp Side <em class="star">✦</em> +EV <em class="star">✦</em> </span>
	</div>
</div>

<section class="bone pad on-bone" id="plans">
	<div class="wrap">
		<div class="reveal sec-head">
			<span class="kicker">Pick Your Play</span>
			<h2 class="h2">Pull up.</h2>
			<p class="lead">Start free. Upgrade when the record earns it. Cancel anytime, no lock-in, no hard sell.</p>
		</div>
		<div class="plans reveal">
			<div class="plan">
				<div class="nm">Rundown</div><div class="tg">Free forever</div>
				<div class="pr">$0</div>
				<ul><li>1–2 public plays a week</li><li>Daily results recaps</li><li>Betting education</li><li>Discord (read-only)</li></ul>
				<a class="btn btn--out" href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>">Join free</a>
			</div>
			<div class="plan hot">
				<div class="nm">Members</div><div class="tg">The core package</div>
				<div class="pr">$49<small>/mo</small></div>
				<ul><li>Every play, every day</li><li>Full write-ups + sizing</li><li>Members Discord + Q&amp;A</li><li>The live tracking sheet</li></ul>
				<a class="btn btn--volt" href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>">Start Members</a>
			</div>
			<div class="plan">
				<div class="nm">Sharp</div><div class="tg">Serious bankrolls</div>
				<div class="pr">$149<small>/mo</small></div>
				<ul><li>Everything in Members</li><li>CLV &amp; ROI dashboard</li><li>Line-move alerts</li><li>Higher-conviction card</li></ul>
				<a class="btn btn--out" href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>">Go Sharp</a>
			</div>
		</div>
		<p class="securenote">Checkout &amp; member access powered by Whop · Cancel anytime · 21+</p>
	</div>
</section>

<section class="cta" id="free">
	<div class="cta__bg"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cta-crowd.jpg' ); ?>" alt="" aria-hidden="true" loading="lazy"></div>
	<div class="wrap">
		<span class="kicker">Free Daily Play</span>
		<h2 class="h2">One +EV play.<br>Every day. <span class="volt">Free.</span></h2>
		<p>No spam, no locks, no "guaranteed" nonsense. One disciplined play and the math behind it, straight to your inbox.</p>
		<form action="#" method="post" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
			<input type="email" name="email" placeholder="you@email.com" aria-label="Email" required style="background:rgba(11,11,12,.65);color:var(--paper);border:2px solid var(--paper);padding:15px 16px;font-family:var(--mono);font-size:14px;min-width:250px">
			<button class="btn btn--volt" type="submit">Send it</button>
		</form>
	</div>
</section>

<?php get_footer(); ?>
