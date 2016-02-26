<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Corner Gallery
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (get_the_content()) { ?>
		<?php if (!is_front_page()) { ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php } ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cornergallery' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	<?php } ?>
		
	<?php if( have_rows('content_block') ) {
		echo '<div class="content-blocks">';
	    while ( have_rows('content_block') ) {
			the_row();
			echo '<div class="content-block cols clear">';
				$left_column_width = get_sub_field('left_column_width');
				if ($left_column_width === "Large") {
					$left_column_class = 'col col-1-2';
					$right_column_class = 'col col-1-1';
				} else if ($left_column_width === "Small") {
					$left_column_class = 'col col-1-1';
					$right_column_class = 'col col-1-2';
				} else {
					$left_column_class = 'col';
					$right_column_class = 'col';
				}
				$left_content_type = get_sub_field('left_column_content_type');
				$right_content_type = get_sub_field('right_column_content_type');
				if ($left_content_type === "General Content") {
					echo '<div class="'.$left_column_class.'">';
					the_sub_field('left_column_general_content');
					echo '</div>';
				} elseif ($left_content_type === "Image (with link)") {
					if( have_rows('left_column_image_with_link') ) {
					    while ( have_rows('left_column_image_with_link') ) {
							the_row();
							if (get_sub_field('left_column_image_with_link_link')) {
								$imgClass = ' bg-img img-link';
							} else {
								$imgClass = ' bg-img';
							}
							if (get_sub_field('left_column_image_with_link_image')) {
								$bgImg = get_sub_field('left_column_image_with_link_image');
								echo '<div class="'.$left_column_class.' col-tight'.$imgClass.'" style="background-image: url('.$bgImg.')">';
							}
							if (get_sub_field('left_column_image_with_link_link')) {
								$linkURL = get_sub_field('left_column_image_with_link_link');
								$linkTitle = get_sub_field('left_column_image_with_link_title');
								if ($linkURL) {
									echo '<a href="'.$linkURL.'" class="item-link">';
								} else {
									echo '<div class="item-link">';
								}
								if ($linkTitle) {
									echo '<p>'.$linkTitle.'</p>';
								} else {
									echo '<p>Read more...</p>';
								}
								if ($linkURL) {
									echo '</a>';
								} else {
									echo '</div>';
								}
							}
							if (get_sub_field('left_column_image_with_link_image')) {
								echo '</div>';
							}
						}
					}
				} elseif ($left_content_type === "Slideshow") {
					echo '<div class="'.$left_column_class.' col-tight">';
					if( have_rows('left_column_slideshow') ):
						echo '<ul class="bxslider bxslider-fader">';
					    while ( have_rows('left_column_slideshow') ) : the_row();
						$image = get_sub_field('left_column_slideshow_image');
						$linkTitle = get_sub_field('left_column_slideshow_title');
						$linkURL = get_sub_field('left_column_slideshow_link');
						if ($title !== "") {
							$class =  ' class="with-title"';
						} else {
							$imgClass = '';
						}
					    echo '<li style="background-image: url('.$image["sizes"]["large"].')"'.$class.'>';
						if ($linkURL) {
							echo '<a href="'.$linkURL.'" class="item-link">';
						} else {
							echo '<div class="item-link">';
						}
						if (is_front_page()) {
							echo '<h3>Recently In</h3>';
						}
						if ($linkTitle) {
							echo '<p>'.$linkTitle.'</p>';
						} else {
							echo '<p>Read more...</p>';
						}
						if ($linkURL) {
							echo '</a>';
						} else {
							echo '</div>';
						}
					    echo '</li>';
					    endwhile;
						echo '</ul>';
					endif;
					echo '</div>';
				}
				if ($right_content_type === "General Content") {
					echo '<div class="'.$right_column_class.'">';
					the_sub_field('right_column_general_content');
					echo '</div>';
				} elseif ($right_content_type === "Image (with link)") {
					if( have_rows('right_column_image_with_link') ) {
					    while ( have_rows('right_column_image_with_link') ) {
							the_row();
							if (get_sub_field('right_column_image_with_link_link')) {
								$imgClass = ' bg-img img-link';
							} else {
								$imgClass = ' bg-img';
							}
							if (get_sub_field('right_column_image_with_link_image')) {
								$bgImg = get_sub_field('right_column_image_with_link_image');
								echo '<div class="'.$right_column_class.' col-tight'.$imgClass.'" style="background-image: url('.$bgImg.')">';
							}
							if (get_sub_field('right_column_image_with_link_link')) {
								$linkURL = get_sub_field('right_column_image_with_link_link');
								$linkTitle = get_sub_field('right_column_image_with_link_title');
								if ($linkURL) {
									echo '<a href="'.$linkURL.'" class="item-link">';
								} else {
									echo '<div class="item-link">';
								}
								if ($linkTitle) {
									echo '<p>'.$linkTitle.'</p>';
								} else {
									echo '<p>Read more...</p>';
								}
								if ($linkURL) {
									echo '</a>';
								} else {
									echo '</div>';
								}
							}
							if (get_sub_field('right_column_image_with_link_image')) {
								echo '</div>';
							}
						}
					}
				} elseif ($right_content_type === "Slideshow") {
					echo '<div class="'.$right_column_class.' col-tight">';
					if( have_rows('right_column_slideshow') ):
						echo '<ul class="bxslider bxslider-fader">';
					    while ( have_rows('right_column_slideshow') ) : the_row();
						$image = get_sub_field('right_column_slideshow_image');
						$linkTitle = get_sub_field('right_column_slideshow_title');
						$linkURL = get_sub_field('right_column_slideshow_link');
						if ($title !== "") {
							$class =  ' class="with-title"';
						} else {
							$imgClass = '';
						}
					    echo '<li style="background-image: url('.$image["sizes"]["large"].')"'.$class.'>';
						if ($linkURL) {
							echo '<a href="'.$linkURL.'" class="item-link">';
						} else {
							echo '<div class="item-link">';
						}
						if ($linkTitle) {
							echo '<p>'.$linkTitle.'</p>';
						} else {
							echo '<p>Read more...</p>';
						}
						if ($linkURL) {
							echo '</a>';
						} else {
							echo '</div>';
						}
					    echo '</li>';
					    endwhile;
						echo '</ul>';
					endif;
					echo '</div>';
				}
			echo '</div>';
		}
		echo '</div>';
	} ?>

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'cornergallery' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

