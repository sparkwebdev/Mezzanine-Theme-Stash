<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<a href="<?php echo esc_url( wc_get_checkout_url() ) ;?>" class="checkout-button button alt wc-forward">
	<?php echo __( 'Proceed to Checkout', 'woocommerce' ); ?>
</a>

<p class="payment-icons"><a href="http://www.mastercard.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_ECMC.gif" alt="MasterCard"></a>&nbsp;<a href="http://www.jcbusa.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_JCB.gif" alt="JCB"></a>&nbsp;<a href="http://www.maestrocard.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_MAESTRO.gif" alt="Maestro"></a>&nbsp;<a href="http://www.visa.com" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/WP_VISA_DELTA.gif" alt="Visa Debit"></a><br /><a href="http://www.worldpay.com/support/index.php?CMP=BA22713" target="_blank"><img src="https://secure.worldpay.com/jsp/shopper/icons/../pictures/poweredByWorldPay.gif" alt="Powered by WorldPay"></a></p>