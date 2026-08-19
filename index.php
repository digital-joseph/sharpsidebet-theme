<?php
/**
 * Main fallback template (blog index / catch-all).
 *
 * @package Sharpside
 */
get_header(); ?>

<div class="wrap pagehead">
	<h1><?php echo esc_html( ( is_home() && get_option( 'page_for_posts' ) ) ? get_the_title( get_option( 'page_for_posts' ) ) : get_bloginfo( 'name' ) ); ?></h1>
</div>

<div class="wrap">
	<?php if ( have_posts() ) : ?>
		<div class="post-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'post-card' ); ?>>
					<a class="thumb" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'sharpside_card', array( 'loading' => 'lazy' ) ); } ?>
					</a>
					<div class="body">
						<?php $cats = get_the_category(); if ( ! empty( $cats ) ) : ?><span class="cat"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
						<span class="date"><?php echo esc_html( get_the_date() ); ?></span>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="pagination"><?php echo wp_kses_post( paginate_links( array( 'mid_size' => 1, 'prev_text' => '&larr; Prev', 'next_text' => 'Next &rarr;' ) ) ); ?></div>
	<?php else : ?>
		<div class="prose"><p>Nothing here yet.</p></div>
	<?php endif; ?>
</div>

<?php get_footer();
