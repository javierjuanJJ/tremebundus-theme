<?php
/**
 * Theme functions
 * ------------------------------------------------------------
 * Theme setup, enqueues, and navigation menus
 */

// Make theme available for widgets.
register_sidebar( [ 'name' => 'Sidebar', 'id' => 'sidebar-1' ] );

/**
 * Display post date and author.
 */
function tremebundus_posted_on() {
	printf( '<span class="posted-on"><a href="%1$s" rel="bookmark"><span class="screen-reader-text">%2$s</span> %3$s</a></span>',
		esc_url( get_permalink() ),
		esc_html__( 'Published', 'tremebundus' ),
		get_the_date()
	);
}

// Add theme support features.
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
register_nav_menus( [
	'primary' => esc_html__( 'Primary Menu', 'tremebundus' ),
] );

// Enqueue styles and scripts.
function tremebundus_enqueue_assets() {
	// Core stylesheet.
	wp_enqueue_style(
		'tremebundus-style',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme()->get( 'Version' )
	);

	// Google Fonts: Cormorant Garamond + Inter.
	wp_enqueue_style(
		'tremebundus-fonts',
		'//fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Inter:wght@400;500;600&display=swap',
		[],
		null
	);

	// Skip-link focus fix for admin.
	if ( is_admin() ) {
		return;
	}

	// Accessible menus script for focus-visible.
	wp_enqueue_script(
		'tremebundus-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		[],
		null,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'tremebundus_enqueue_assets' );