<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Corner Gallery
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php /*<nav id="site-navigation-footer" class="main-navigation clear" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'primary-menu-footer' ) ); ?>
		</nav><!-- #site-navigation-footer -->*/ ?>
		<div class="site-info">
			<?php
			// Check for Advanced Custom Fields plugin function
			if( function_exists('get_field') ) {
				// Get the address
				$address = get_field('site_address', 'option');
				// Get the telephone number
				$telephone = get_field('site_telephone', 'option');
				// Get the email address
				$email = get_field('site_email', 'option');
				// Get the Facebook page URL
				$facebook = get_field('facebook_address', 'option');
				// Get the Twitter page URL
				$twitter = get_field('twitter_address', 'option');
				// Check for, output social links
				if ($facebook || $twitter) {
					echo '<p class="social-buttons">';
					if ($facebook) {
						echo '<a href="'.$facebook.'" class="social-button social-button-facebook" title="Visit The Corner Gallery Facebook page" target="_blank">fb</a>';
					}
					if ($twitter) {
						echo '<a href="'.$twitter.'" class="social-button social-button-twitter" title="Visit The Corner Gallery Twitter page" target="_blank">tw</a>';
					}
					echo '</p>';
				}
				// Check for, output fields
				if ($telephone || $email) {
					echo '<p><strong>Contact:</strong>';
					if ($telephone) {
						echo ' <span>tel&nbsp;'.$telephone.'</span>';
					}
					if ($email) {
						echo ' <span>email&nbsp;<a href="mailto:'.$email.'" title="Email The Corner Gallery">'.$email.'</a></span>';
					}
					echo '</p>';
				}
				// Check for, output address
				if ($address) {
					echo '<p><strong>Address:</strong> '.$address.'</p>';
				}
			}
			?>
			<p><a href="<?php echo get_permalink(13); ?>" title="Visit The Corner Gallery">Come & visit</a> our shop in Moffat or Kirkcudbright</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

	<script>
	jQuery( document ).ready(function() {
		
		function is_touch_device() {
			return !!('ontouchstart' in window);
		}
		
		/* If mobile browser, prevent click on parent nav item from redirecting to URL */
		jQuery('#primary-menu li').has('.sub-menu-wrapper').each(function (index, elem) {
			var subNav = jQuery(this).find('.sub-menu-wrapper');
			var subLink = jQuery(this).find('> a');
			var subLinkTitle = subLink.text();
			var subLinkUrl = subLink.attr('href');
			subNav.find('.sub-menu').prepend('<li class="menu-item menu-item-parent"><a href="'+subLinkUrl+'">View all '+subLinkTitle+'</a></li>');
			subLink.addClass('sub-menu-dropdown');
		
			if(is_touch_device()) {
				subLink.on('click', function(event){
			        jQuery(this).next('.sub-menu-wrapper').toggle();
			        event.preventDefault();
				});
			}
		});
		
		// BX Slider plugin
		jQuery('.bxslider-fader').bxSlider({
			auto: true,
			pager: false,
			controls: false,
			mode: 'fade'
		});
		
		<?php if (is_product()) { ?>
			jQuery('.woocommerce-page div.product div.thumbnails a').show();
			jQuery('.woocommerce-page div.product div.thumbnails a:first-of-type img').addClass('current_p_thumb');
			function resetColourChoice() {
				jQuery('.woocommerce-page div.product div.thumbnails a').filter(':hidden').children().removeClass('current_p_thumb');
				jQuery('.woocommerce-page div.product div.thumbnails a').show();
			}
			jQuery('.variations #colour').change(function() {
				if (jQuery('.variations #colour')[0].selectedIndex == 0) {
					resetColourChoice();
				} else {
					if (jQuery('.variations #pa_size')[0].selectedIndex == 0) {
						jQuery('.variations #pa_size :nth-child(3)').prop('selected', true);
					}
				}
			});
			jQuery('.variations .reset_variations').change(function() {
				resetColourChoice();
			});
		<?php } ?>
	});
	</script>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>
