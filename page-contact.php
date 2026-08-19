<?php
/**
 * Template Name: Contact
 * Assign this template to a Page (slug "contact").
 *
 * The form below is presentation only. To make it send, drop a form-plugin
 * shortcode where noted (WPForms, Fluent Forms, Contact Form 7), or point the
 * <form action> at your handler. Account/billing questions route to Whop.
 *
 * @package Sharpside
 */
get_header();
?>

<section class="dark" style="padding:64px 0 0">
	<div class="wrap">
		<span class="kicker" style="color:var(--volt)">Contact</span>
		<h1 class="pagehead" style="padding:12px 0 0">Get at us.</h1>
		<p class="lead" style="color:var(--smoke);margin-top:18px">Questions, press, partnerships, or feedback. Drop a note and we'll get back to you. Members: for billing or access, your Whop dashboard is fastest.</p>
	</div>
</section>

<section class="dark pad" style="padding-top:44px">
	<div class="wrap">
		<div class="contact-grid">
			<div class="reveal">
				<?php
				/*
				 * REPLACE THIS FORM with your form-plugin shortcode to make it send, e.g.:
				 *   echo do_shortcode('[wpforms id="123"]');
				 * The markup below is styled to match the theme if you prefer to keep it.
				 */
				?>
				<form action="#" method="post" novalidate>
					<div class="field">
						<label for="c-name">Name</label>
						<input id="c-name" name="name" type="text" autocomplete="name" required>
					</div>
					<div class="field">
						<label for="c-email">Email</label>
						<input id="c-email" name="email" type="email" autocomplete="email" required>
					</div>
					<div class="field">
						<label for="c-topic">Topic</label>
						<select id="c-topic" name="topic">
							<option>General question</option>
							<option>Membership / access</option>
							<option>Press</option>
							<option>Partnership / affiliate</option>
							<option>Feedback</option>
						</select>
					</div>
					<div class="field">
						<label for="c-msg">Message</label>
						<textarea id="c-msg" name="message" required></textarea>
					</div>
					<button class="btn btn--volt" type="submit">Send it</button>
				</form>
			</div>

			<div class="reveal">
				<a class="cmethod" href="mailto:hello@sharpsidebet.com">
					<div class="ct">Email</div>
					<div class="cv">hello@sharpsidebet.com</div>
				</a>
				<a class="cmethod" href="https://www.instagram.com/sharpsidepicks/" rel="noopener">
					<div class="ct">Instagram</div>
					<div class="cv">@sharpsidepicks</div>
				</a>
				<div class="cmethod">
					<div class="ct">Members Discord</div>
					<div class="cv">In your Whop dashboard</div>
				</div>
				<p class="cnote">We read everything and reply within a couple of business days. For billing, plan changes, or cancellations, manage it yourself in Whop for an instant fix. 21+ only. If gambling is a problem, call 1-800-GAMBLER.</p>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
