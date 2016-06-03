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
 * Remove / Re-Declare WooCommerce content wrappers
 *
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
	echo '<div id="primary" class="site-content"><main id="main" class="site-main" role="main">';
}

function my_theme_wrapper_end() {
	echo '</main></div>';
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
	if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page()) { // this adds the styles back on woocommerce pages. If you're using a custom script, you could remove these and enter in the path to your own CSS file (if different from your basic style.css file)
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

// Remove quantity box site-wide (set all products to be sold individually)
/*function wc_remove_all_quantity_fields( $return, $product ) {
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );*/

// Products Archive - Remove results count
function woocommerce_result_count() {
    return;
}

// Products Archive - Remove sorting drop-down
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Products Archive - Add variations to archive pages
add_action('woocommerce_after_shop_loop_item','woocommerce_add_variation_images', 10);
function woocommerce_add_variation_images() {
	global $product;
	if ($product->product_type == "variable" && (is_product_category() || is_product_tag() || is_product())) {
		$variations = $product->get_available_variations();
		$variationImgs = [];
		$image_title = "";
		foreach ( $variations as $variation ) {
			if ($variation['image_link']) {
				global $wpdb;
				$image_url = $variation['image_link'];
				$image_title = $variation['attributes']['attribute_colour'];
				$attachmentID = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
				$variationImgs[] = array(wp_get_attachment_thumb_url($attachmentID[0]), $image_title);
			}
		}
		if ($variationImgs) {
			echo '<ul class="product-variation-thumbs">';
			foreach ($variationImgs as $img) {
				echo '<li><img src="'.$img[0].'" alt="'.$img[1].'" width="38" height="38" /></li>';
			}
			echo '</ul>';
		}
	}
}

// Products Archive, Single Product - Remove price badge
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Single Product - Remove Add to Cart Buttons
function remove_loop_button(){
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_loop_button');

// Single Product - Change number of thumbnails per row in product galleries
add_filter ( 'woocommerce_product_thumbnails_columns', 'set_thumbnails_columns' );
function set_thumbnails_columns() {
	return 6; // .last class applied to every 6th thumbnail
}

// Single Product - Move excerpt to below Add to Cart
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35 );

// Single Product - move product 'Description', 'Additional Information' tabs
function woocommerce_template_product_description() {
	woocommerce_get_template( 'single-product/tabs/description.php' );
	woocommerce_get_template( 'single-product/tabs/additional-information.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 20 );

// Single Product - remove product 'Description' title
add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
	return '';
}

// Single Product - remove product 'Additional Information' title
add_filter( 'woocommerce_product_additional_information_heading', 'remove_product_additional_information_heading' );
	function remove_product_additional_information_heading() {
	return '';
}

// Single Product - Removes tabs from their original loaction 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Single Product - Remove Tabs
/*add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}*/

// Single Product - Inserts tabs under the main right product content 
//add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 25 );

// Single Product - Hide SKUs on WooCommerce Product Pages
function shop_remove_product_page_skus( $enabled ) {
    if ( ! is_admin() && is_product() ) {
        return false;
    }
    return $enabled;
}
add_filter( 'wc_product_sku_enabled', 'shop_remove_product_page_skus' );

// Single Product - Change 'Add to Cart' text
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
function woo_custom_cart_button_text() {
    return __( 'Add to Bag', 'woocommerce' );
}

// Cart - Basket Text
function wpa_change_my_basket_text( $translated_text, $text, $domain ){
    if( $translated_text == 'Cart' )
        $translated_text = 'Bag';
    return $translated_text;
}
add_filter( 'gettext', 'wpa_change_my_basket_text2', 10, 3 );
// Cart - Basket Text
function wpa_change_my_basket_text2( $translated_text, $text, $domain ){
    if( $translated_text == 'cart' )
        $translated_text = 'bag';
    return $translated_text;
}
add_filter( 'gettext', 'wpa_change_my_basket_text', 10, 3 );

// Single Product - Remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// Cart - Limit cross-sell products to 3
add_filter( 'woocommerce_cross_sells_total', 'woocommerce_limit_cross_sells_total' );
function woocommerce_limit_cross_sells_total() {
	return 3;
}
// Cart - Set cross-sell columns to 3
add_filter( 'woocommerce_cross_sells_columns', 'woocommerce_cross_sells_columns' );
function woocommerce_cross_sells_columns() {
	return 3;
}


// Cart - Output paymment icons 
function woocommerce_after_cart_totals_append() {
    echo '<p class="payment-icons"><a href="http://www.mastercard.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_ECMC.gif" alt="MasterCard"></a>&nbsp;<a href="http://www.jcbusa.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_JCB.gif" alt="JCB"></a>&nbsp;<a href="http://www.maestrocard.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_MAESTRO.gif" alt="Maestro"></a>&nbsp;<a href="http://www.visa.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_VISA_DELTA.gif" alt="Visa Debit"></a><br /><a href="http://www.worldpay.com/support/index.php?CMP=BA22713" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/../pictures/poweredByWorldPay.gif" alt="Powered by WorldPay"></a></p>';
}
add_action('woocommerce_after_cart_totals', 'woocommerce_after_cart_totals_append', 10, 0);

// Checkout - Output paymment icons 
function woocommerce_review_order_after_submit_append(  ) { 
    echo '<p class="payment-icons"><a href="http://www.mastercard.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_ECMC.gif" alt="MasterCard"></a>&nbsp;<a href="http://www.jcbusa.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_JCB.gif" alt="JCB"></a>&nbsp;<a href="http://www.maestrocard.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_MAESTRO.gif" alt="Maestro"></a>&nbsp;<a href="http://www.visa.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_VISA_DELTA.gif" alt="Visa Debit"></a><br /><a href="http://www.worldpay.com/support/index.php?CMP=BA22713" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/../pictures/poweredByWorldPay.gif" alt="Powered by WorldPay"></a></p>';
};
add_action( 'woocommerce_review_order_after_submit', 'woocommerce_review_order_after_submit_append', 10, 0 );