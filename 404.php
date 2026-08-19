<?php
/**
 * 404.
 *
 * @package Sharpside
 */
get_header(); ?>
<div class="wrap centerpage">
	<span class="eyebrow">No Bet</span>
	<h1>404</h1>
	<p>This page passed. No edge found here. Let's get you back to a live play.</p>
	<div style="display:flex;gap:12px;flex-wrap:wrap;justify-content:center">
		<a class="btn btn--brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back home</a>
		<a class="btn btn--ghost" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Read the blog</a>
	</div>
</div>
<?php get_footer();
