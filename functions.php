<?php
/**
 * Corner Gallery functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Corner Gallery
 */

if ( ! function_exists( 'cornergallery_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cornergallery_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'cornergallery' ),
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'footer' => esc_html__( 'Footer Menu', 'cornergallery' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif; // cornergallery_setup
add_action( 'after_setup_theme', 'cornergallery_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cornergallery_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cornergallery_content_width', 640 );
}
add_action( 'after_setup_theme', 'cornergallery_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function cornergallery_scripts() {
	wp_enqueue_style( 'cornergallery-style', get_stylesheet_uri() );

	wp_enqueue_script( 'cornergallery-tools', get_template_directory_uri() . '/js/min/tools-min.js', array(), '', true );

	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js", false, null);
		wp_enqueue_script('jquery');
	}

	wp_enqueue_script( 'cornergallery-plugins', get_template_directory_uri() . '/js/min/plugins-min.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cornergallery_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Wordpress Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Woocommerce plugin specific functions
 */
if (function_exists( 'is_woocommerce' )) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Add Options Page (Advanced Custom Fields)
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_title'	=> 'Site Settings',
		'menu_slug' 	=> 'site-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

// Add wrapper to main menu sub-menu
class Main_Menu_Sub_Wrap extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth) {
		$queried = get_queried_object();
		$current_parent_cat_id = $queried->parent;
		$current_cat_id = $queried->term_id;
		if ($current_parent_cat_id == 0) {
			$current_parent_cat_id = $current_cat_id;
		}
		$current_cat_title = get_cat_name($current_parent_cat_id);
		$current_cat_link = get_category_link($current_parent_cat_id);
		
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class='sub-menu-wrapper'><nav class='shop-navigation'><div class='content-block cols clear'><div class='col col-1-1'><ul class='sub-menu'>\n";
	}
	function end_lvl(&$output, $depth) {
		global $woocommerce;
		$shop_link = get_permalink(woocommerce_get_page_id('shop'));
		if (is_shop()) {
			$justIn = "<li class='active-menu-item'><a href='".$shop_link."' title='View latest products'>Just In</a></li>";
		} else {
			$justIn = "<li><a href='".$shop_link."' title='View latest products'>Just In</a></li>";
		}
		$shopPages = wp_list_pages( array( 'child_of'  => '7', 'title_li' => '', 'echo' => false ) );
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div><div class=\"col col-1-2\"><ul>".$justIn."</ul><ul>".$shopPages."</ul></div></div></nav></div>\n";
	}
} 
