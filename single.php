<?php
/**
 * Single post — SEO article layout.
 *
 * @package Sharpside
 */
get_header();
while ( have_posts() ) : the_post(); ?>
	<article <?php post_class(); ?>>
		<div class="wrap pagehead">
			<?php sharpside_breadcrumbs(); ?>
			<h1><?php the_title(); ?></h1>
			<div class="post-meta">
				<?php
				$cats = get_the_category_list( ', ' );
				if ( $cats ) { echo '<span class="cat">' . wp_kses_post( $cats ) . '</span>'; }
				?>
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				<span><?php echo esc_html( get_the_author() ); ?></span>
				<span><?php echo esc_html( sharpside_reading_time() ); ?></span>
			</div>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="wrap"><div class="featured"><?php the_post_thumbnail( 'large', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?></div></div>
		<?php endif; ?>

		<div class="wrap">
			<div class="prose entry-content">
				<?php the_content(); wp_link_pages(); ?>
			</div>
		</div>
	</article>

	<?php
	if ( comments_open() || get_comments_number() ) {
		echo '<div class="wrap" style="max-width:70ch">';
		comments_template();
		echo '</div>';
	}
	?>
<?php endwhile;
get_footer();
