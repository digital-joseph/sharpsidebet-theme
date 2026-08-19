<?php
/**
 * Header.
 *
 * @package Sharpside
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'sharpside' ); ?></a>

<header class="site-header">
	<div class="wrap nav__in">
		<?php if ( has_custom_logo() ) : ?>
			<div class="brand"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="brand-logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/sharpside-logo.png' ); ?>" width="796" height="160" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			</a>
		<?php endif; ?>

		<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'sharpside' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'nav__links',
					'menu_id'        => 'primary-menu',
					'depth'          => 1,
				) );
			} else {
				sharpside_fallback_menu();
			}
			?>
		</nav>

		<div class="nav__cta">
			<a class="btn btn--out" href="<?php echo esc_url( home_url( '/login/' ) ); ?>" style="padding:11px 18px"><?php esc_html_e( 'Sign in', 'sharpside' ); ?></a>
			<a class="btn btn--volt" href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>" style="padding:11px 20px"><?php esc_html_e( 'Join', 'sharpside' ); ?></a>
			<button class="hamb" id="hamb" aria-label="<?php esc_attr_e( 'Menu', 'sharpside' ); ?>" aria-controls="mmenu" aria-expanded="false"><span></span><span></span><span></span></button>
		</div>
	</div>
</header>

<?php
if ( has_nav_menu( 'primary' ) ) {
	wp_nav_menu( array(
		'theme_location'  => 'primary',
		'container'       => 'nav',
		'container_class' => 'mmenu',
		'container_id'    => 'mmenu',
		'menu_class'      => 'mmenu-list',
		'items_wrap'      => '%3$s',
		'depth'           => 1,
	) );
} else {
	echo '<nav class="mmenu" id="mmenu"><a href="' . esc_url( home_url( '/track-record/' ) ) . '">Track Record</a><a href="' . esc_url( home_url( '/subscriptions/' ) ) . '">Subscriptions</a><a href="' . esc_url( home_url( '/blog/' ) ) . '">Blog</a></nav>';
}
?>

<main id="content">
