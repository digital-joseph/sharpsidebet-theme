<?php
/**
 * Search results.
 *
 * @package Sharpside
 */
get_header(); ?>

<div class="wrap pagehead">
	<?php sharpside_breadcrumbs(); ?>
	<h1><?php printf( esc_html__( 'Search: %s', 'sharpside' ), '<span class="accent">' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
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
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
						<span class="date"><?php echo esc_html( get_the_date() ); ?></span>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="pagination"><?php echo wp_kses_post( paginate_links( array( 'mid_size' => 1 ) ) ); ?></div>
	<?php else : ?>
		<div class="prose"><p>No results for that search. Try another term.</p><?php get_search_form(); ?></div>
	<?php endif; ?>
</div>

<?php get_footer();
