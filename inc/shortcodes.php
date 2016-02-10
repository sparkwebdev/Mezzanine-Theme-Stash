<?php
/**
 * Custom shortcodes for this theme.
 *
 * @package Corner Gallery
 */

// Wrap content in <div> with tint class
function corner_gallery_fb_feed($atts) {
   return '<div class="faceebook-feed cols"><div class="col col-1-1 col-tight"><h3>Facebook</h3></div><div class="col col-1-2 col-tight fb-page" data-href="https://www.facebook.com/bbcnews" data-height="500" data-width="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/bbcnews"><a href="https://www.facebook.com/bbcnews" class="fb-page-fallback-link">The Corner Gallery</a></blockquote></div></div></div></div>';
}
add_shortcode('facebook-feed', 'corner_gallery_fb_feed');

