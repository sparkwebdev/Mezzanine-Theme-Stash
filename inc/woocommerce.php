<?php
/**
 * Functions specific to the Woocommerce plugin
 *
 * @package Corner Gallery
 */

/**
 * Declare WooCommerce support
 *
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Enqueue scripts and styles - Woocommerce specific.
 */
// Remove woocommerce scripts on unnecessary pages
function woocommerce_dequeue_script() {
	if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page() ) { // if we're not on a Woocommerce page, dequeue all of these scripts
		wp_dequeue_script('wc-add-to-cart');
		wp_dequeue_script('jquery-blockui');
		wp_dequeue_script('jquery-placeholder');
		wp_dequeue_script('woocommerce');
		wp_dequeue_script('jquery-cookie');
		wp_dequeue_script('wc-cart-fragments');
	}
}
add_action( 'wp_print_scripts', 'woocommerce_dequeue_script', 100 );

// Remove woocommerce styles, then add woo styles back in on woo-related pages
// Add a custom smallscreen stylesheet to tweak media query breakpoint
function woocommerce_manage_woocommerce_css(){
	wp_dequeue_style('woocommerce-smallscreen');
	if (!is_woocommerce()) { // this adds the styles back on woocommerce pages. If you're using a custom script, you could remove these and enter in the path to your own CSS file (if different from your basic style.css file)
		wp_dequeue_style('woocommerce-layout');
		wp_dequeue_style('woocommerce-general');
	} else {
		wp_enqueue_style( 'woocommerce-smallscreen-custom', plugins_url() . '/woocommerce/assets/css/woocommerce-smallscreen.css', array('woocommerce-layout'), $stamp, 'only screen and (max-width: 767px)' );		
	}
}
add_action( 'wp_enqueue_scripts', 'woocommerce_manage_woocommerce_css' );

// Remove WooCommerce Generator Tag
function remove_woo_commerce_generator_tag() {
    remove_action('wp_head','wc_generator_tag');
}
add_action('get_header','remove_woo_commerce_generator_tag');

// Remove Breadcrumbs
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

// Removing Tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}