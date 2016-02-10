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

<?php if (is_front_page()) { ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>

</body>
</html>
