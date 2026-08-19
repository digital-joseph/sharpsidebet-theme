<?php
/**
 * Default page template.
 *
 * @package Sharpside
 */
get_header();
while ( have_posts() ) : the_post(); ?>
	<article <?php post_class(); ?>>
		<div class="wrap pagehead">
			<?php sharpside_breadcrumbs(); ?>
			<h1><?php the_title(); ?></h1>
		</div>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="wrap"><div class="featured"><?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?></div></div>
		<?php endif; ?>
		<div class="wrap">
			<div class="prose entry-content">
				<?php the_content(); wp_link_pages(); ?>
			</div>
		</div>
	</article>
<?php endwhile;
get_footer();
