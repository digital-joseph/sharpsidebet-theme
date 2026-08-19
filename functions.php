<?php
/**
 * Sharpside theme functions.
 *
 * @package Sharpside
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'SHARPSIDE_VERSION', '1.1.0' );

// Live track-record ingestion (CSV/Google Sheet) + render helpers.
require get_template_directory() . '/inc/tracker.php';

/**
 * Fallback favicon (bundled) if the user has not set a Site Icon in Customizer.
 */
function sharpside_favicon() {
	if ( function_exists( 'has_site_icon' ) && has_site_icon() ) { return; }
	$fav = get_template_directory_uri() . '/assets/img/favicon.png';
	echo '<link rel="icon" href="' . esc_url( $fav ) . '" sizes="any">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( $fav ) . '">' . "\n";
}
add_action( 'wp_head', 'sharpside_favicon', 2 );

/* -----------------------------------------------------------------
 * Theme setup
 * ----------------------------------------------------------------- */
function sharpside_setup() {
	load_theme_textdomain( 'sharpside', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );               // lets WP/SEO plugins manage <title>
	add_theme_support( 'post-thumbnails' );         // featured images (OG + cards)
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'custom-logo', array( 'height' => 40, 'width' => 200, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'align-wide' );

	// Featured image size for post cards / OG.
	add_image_size( 'sharpside_card', 800, 450, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sharpside' ),
		'footer'  => __( 'Footer Menu', 'sharpside' ),
	) );
}
add_action( 'after_setup_theme', 'sharpside_setup' );

/* -----------------------------------------------------------------
 * Assets — CSS + deferred JS, with font preconnect
 * ----------------------------------------------------------------- */
function sharpside_assets() {
	// Google Fonts (swap for self-hosted later for max performance).
	wp_enqueue_style(
		'sharpside-fonts',
		'https://fonts.googleapis.com/css2?family=Anton&family=Archivo:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'sharpside-main', get_template_directory_uri() . '/assets/css/main.css', array(), SHARPSIDE_VERSION );
	// Keep style.css loaded for child-theme / plugin expectations.
	wp_enqueue_style( 'sharpside-style', get_stylesheet_uri(), array( 'sharpside-main' ), SHARPSIDE_VERSION );

	wp_enqueue_script( 'sharpside-main', get_template_directory_uri() . '/assets/js/main.js', array(), SHARPSIDE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sharpside_assets' );

// Defer the theme script.
function sharpside_defer_script( $tag, $handle ) {
	if ( 'sharpside-main' === $handle ) {
		return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'sharpside_defer_script', 10, 2 );

// Preconnect to font hosts.
function sharpside_resource_hints( $hints, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$hints[] = array( 'href' => 'https://fonts.googleapis.com' );
		$hints[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'sharpside_resource_hints', 10, 2 );

/* -----------------------------------------------------------------
 * Performance — trim WordPress defaults that hurt Core Web Vitals
 * ----------------------------------------------------------------- */
function sharpside_cleanup() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );          // hide WP version
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'sharpside_cleanup' );

/* -----------------------------------------------------------------
 * Excerpts
 * ----------------------------------------------------------------- */
function sharpside_excerpt_length() { return 26; }
add_filter( 'excerpt_length', 'sharpside_excerpt_length' );
function sharpside_excerpt_more() { return '&hellip;'; }
add_filter( 'excerpt_more', 'sharpside_excerpt_more' );

/* -----------------------------------------------------------------
 * SEO — structured data + Open Graph fallbacks.
 * If Rank Math or Yoast is active, they handle OG/Article schema, so we
 * skip ours to avoid duplicates. Organization + WebSite always output.
 * ----------------------------------------------------------------- */
function sharpside_seo_plugin_active() {
	return ( defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || defined( 'RANK_MATH_VERSION' ) );
}

function sharpside_json_ld() {
	$site_name = get_bloginfo( 'name' );
	$site_url  = home_url( '/' );
	$logo_id   = function_exists( 'get_theme_mod' ) ? get_theme_mod( 'custom_logo' ) : 0;
	$logo_url  = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';

	// Organization
	$org = array(
		'@context' => 'https://schema.org',
		'@type'    => 'Organization',
		'name'     => $site_name,
		'url'      => $site_url,
		'sameAs'   => array( 'https://www.instagram.com/sharpsidepicks/' ),
	);
	if ( $logo_url ) { $org['logo'] = $logo_url; }
	echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $org ) . "</script>\n";

	// WebSite (+ search action)
	$website = array(
		'@context' => 'https://schema.org',
		'@type'    => 'WebSite',
		'name'     => $site_name,
		'url'      => $site_url,
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => $site_url . '?s={search_term_string}',
			'query-input' => 'required name=search_term_string',
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $website ) . "</script>\n";

	// Article (single posts) — only if no SEO plugin is handling schema.
	if ( is_single() && ! sharpside_seo_plugin_active() ) {
		$post_id = get_the_ID();
		$article = array(
			'@context'      => 'https://schema.org',
			'@type'         => 'Article',
			'headline'      => get_the_title(),
			'datePublished' => get_the_date( 'c', $post_id ),
			'dateModified'  => get_the_modified_date( 'c', $post_id ),
			'author'        => array( '@type' => 'Person', 'name' => get_the_author() ),
			'publisher'     => array( '@type' => 'Organization', 'name' => $site_name ),
			'mainEntityOfPage' => get_permalink( $post_id ),
		);
		if ( has_post_thumbnail( $post_id ) ) {
			$article['image'] = get_the_post_thumbnail_url( $post_id, 'full' );
		}
		echo '<script type="application/ld+json">' . wp_json_encode( $article ) . "</script>\n";
	}
}
add_action( 'wp_head', 'sharpside_json_ld', 20 );

function sharpside_open_graph() {
	if ( sharpside_seo_plugin_active() ) { return; } // let the plugin own OG tags

	$title = wp_get_document_title();
	$url   = ( is_singular() ) ? get_permalink() : home_url( add_query_arg( array(), $GLOBALS['wp']->request ) );
	$desc  = get_bloginfo( 'description' );
	if ( is_singular() ) {
		$excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 );
		if ( $excerpt ) { $desc = $excerpt; }
	}
	echo "\n<meta property=\"og:site_name\" content=\"" . esc_attr( get_bloginfo( 'name' ) ) . "\">\n";
	echo '<meta property="og:type" content="' . ( is_single() ? 'article' : 'website' ) . "\">\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . "\">\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . "\">\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . "\">\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	if ( is_singular() && has_post_thumbnail() ) {
		echo '<meta property="og:image" content="' . esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) . "\">\n";
	}
}
add_action( 'wp_head', 'sharpside_open_graph', 5 );

/* -----------------------------------------------------------------
 * Simple breadcrumb (used on single/page) — SEO friendly
 * ----------------------------------------------------------------- */
function sharpside_breadcrumbs() {
	if ( is_front_page() ) { return; }
	echo '<nav class="crumbs" aria-label="Breadcrumb">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">Home</a> / ';
	if ( is_single() ) {
		$cats = get_the_category();
		if ( ! empty( $cats ) ) {
			echo '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a> / ';
		}
		echo '<span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_page() ) {
		echo '<span>' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_category() || is_archive() ) {
		echo '<span>' . esc_html( wp_strip_all_tags( get_the_archive_title() ) ) . '</span>';
	} elseif ( is_search() ) {
		echo '<span>Search</span>';
	}
	echo '</nav>';
}

/* -----------------------------------------------------------------
 * Reading time estimate (used in single.php meta)
 * ----------------------------------------------------------------- */
function sharpside_reading_time() {
	$content = get_post_field( 'post_content', get_the_ID() );
	$words   = str_word_count( wp_strip_all_tags( $content ) );
	$minutes = max( 1, (int) ceil( $words / 200 ) );
	/* translators: %d: estimated minutes to read. */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'sharpside' ), $minutes );
}

/* -----------------------------------------------------------------
 * Fallback primary menu when none assigned
 * ----------------------------------------------------------------- */
function sharpside_fallback_menu() {
	echo '<ul id="primary-menu" class="nav__links">';
	echo '<li><a href="' . esc_url( home_url( '/track-record/' ) ) . '">Track Record</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/method/' ) ) . '">Method</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/subscriptions/' ) ) . '">Subscriptions</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/blog/' ) ) . '">Blog</a></li>';
	echo '</ul>';
}
