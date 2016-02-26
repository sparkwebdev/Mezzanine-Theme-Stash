<?php
/**
 * Custom shortcodes for this theme.
 *
 * @package Corner Gallery
 */

// Output Facebook Feed
function corner_gallery_fb_feed($atts) {
	$facebookURL = "";
	// Check for Advanced Custom Fields plugin function
	if( function_exists('get_field') ) {
		// Get the Facebook page URL
		$facebookURL = get_field('facebook_address', 'option');
	}
	if ($facebookURL == "") {
		$facebookURL = "https://www.facebook.com/The-Corner-Gallery-1657874937830616/";
	}
	return '<div class="facebook-feed cols"><div class="col col-1-1 col-tight"><h3>Facebook</h3></div><div class="col col-1-2 col-tight fb-page" data-href="'.$facebookURL.'" data-height="500" data-width="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="'.$facebookURL.'"><a href="'.$facebookURL.'" class="fb-page-fallback-link">The Corner Gallery</a></blockquote></div></div></div></div>';
}
add_shortcode('facebook-feed', 'corner_gallery_fb_feed');


// Output Email Link
function corner_gallery_email_link($atts) {
	$email = "";
	// Check for Advanced Custom Fields plugin function
	if( function_exists('get_field') ) {
		// Get the email address
		$email = get_field('site_email', 'option');
	}
	if ($email == "") {
		$email = "fiona@thecornergallery.co.uk";
	}
	return '<div class="email-link cols"><div class="col col-1-1 col-tight"><h3>Email</h3></div><div class="col col-1-2 col-tight"><a href="mailto:'.$email.'">'.$email.'</a></div></div>';
}
add_shortcode('email-link', 'corner_gallery_email_link');

