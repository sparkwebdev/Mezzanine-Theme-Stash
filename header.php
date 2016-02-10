<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Corner Gallery
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/modernizr.custom-min.js"></script>
<script src="https://use.typekit.net/dqo6jzj.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<?php wp_head(); ?>
<!--[if (gte IE 7)&(lte IE 8)]>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/respond.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/selectivizr-min.js"></script>
<![endif]-->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_home_url(); ?>/favicon.ico">
<script>

	jQuery( document ).ready(function() {

		// Nav on mobile
		jQuery('#primary-menu li').has( '.sub-menu' ).on({ 'touchstart' : function(e){
			var submenu = jQuery(this).find('.sub-menu').first();
			if (jQuery(submenu).is(":hidden") ) {
				jQuery(submenu).show();
				e.preventDefault();
			}
		} });

	});

</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cornergallery' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span></a></p>
			<?php endif; ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'cornergallery' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'depth' => '1' ) ); ?>
	</nav><!-- #site-navigation -->

	<div id="content" class="site-content">
