<?php
/**
 * Custom functions and definitions
 *
 * @package Custom
 */

function custom_theme_setup() {
	
	/* ✅ LOGO SUPPORT */
	add_theme_support('custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	));

	/* Load the primary menu. */
	remove_action( 'omega_before_header', 'omega_get_primary_menu' );	
	add_action( 'omega_header', 'omega_get_primary_menu' );
	add_action( 'omega_header', 'custom_intro');
	add_filter( 'omega_site_description', 'custom_site_description' );

	/* Theme supports */
	add_theme_support( 'omega-footer-widgets', 4 );

	add_theme_support( 'color-palette', array(
		'callback' => 'custom_register_colors'
	));

	/* Custom header */
	add_theme_support(
		'custom-header',
		array(
			'header-text' => false,
			'height' => 380,
			'width' => 904,
			'max-width' => 1000,
			'flex-height' => true,
			'flex-width' => true,
			'uploads' => true,
			'default-image' => get_stylesheet_directory_uri() . '/images/header.jpg'
		)
	);

	/* Custom background */
	add_theme_support( 
		'custom-background',
		array(
			'default-color' => 'f5f5f5'
		)
	);

	/* Load CSS & JS */
	add_action( 'wp_enqueue_scripts', 'custom_scripts_styles' );
}

add_action( 'after_setup_theme', 'custom_theme_setup', 11 );

/* Disable site description */
function custom_site_description($desc) {
	return "";
}

/* Register colors */
function custom_register_colors( $color_palette ) {

	$color_palette->add_color(
		array(
			'id' => 'accent',
			'label' => __( 'Accent Color', 'custom' ),
			'default' => 'f38635'
		)
	);

	$color_palette->add_rule_set(
		'accent',
		array(
			'color' => 'a:hover, .omega-nav-menu a:hover, .entry-title a:hover, a.more-link, .nav-primary ul.sub-menu a:hover',
			'background-color' => '.intro, .tagcloud a, button, input[type="button"], input[type="reset"], input[type="submit"]',
			'border-top-color' => '.site-container',
			'border-left-color' => 'pre'
		)
	);
}

/* Header image */
function custom_intro() {
	echo "<div class='intro'>";

	if(is_front_page()) {					
		if (get_header_image()) {
			echo '<img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="' . get_bloginfo( 'description' ) . '" />';
		}
	} else {		
		$id = get_option('page_for_posts');

		if ( is_day() || is_month() || is_year() || is_tag() || is_category() || is_singular('post' ) || is_home() ) {
			$the_title = get_the_title($id);
		} else {
			$the_title = get_the_title(); 
		}

		if (( 'posts' == get_option( 'show_on_front' )) && (is_day() || is_month() || is_year() || is_tag() || is_category() || is_singular('post' ) || is_home())) {
			echo '<img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="' . $the_title . '" />';	
		} elseif(is_home() || is_singular('post' ) ) {
			if ( has_post_thumbnail($id) ) {
				echo get_the_post_thumbnail( $id, 'full' );
			} elseif (get_header_image()) {
				echo '<img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="' . $the_title . '" />';	
			}
		} elseif ( has_post_thumbnail() && is_singular('page' ) ) {	
			the_post_thumbnail();
		} elseif (get_header_image()) {
			echo '<img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="' . $the_title . '" />';	
		}
	}       

	echo "</div>";	
}

/* ✅ LOAD CSS + GOOGLE FONTS + JS */
function custom_scripts_styles() {

	/* ✅ Google Font */
	wp_enqueue_style(
		'google-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
		false
	);

	/* Main CSS */
	wp_enqueue_style(
		'custom-style',
		get_stylesheet_uri(),
		array(),
		time()
	);

	/* JS */
	wp_enqueue_script(
		'custom-init',
		get_stylesheet_directory_uri() . '/js/init.js',
		array('jquery'),
		null,
		true
	);
}