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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content();
		if( have_rows('content_block') ) {
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
									echo '<h3><a href="'.$linkURL.'">'.$linkTitle.'</a></h3>';
								}
								if (get_sub_field('left_column_image_with_link_image')) {
									echo '</div>';
								}
							}
						}
					} elseif ($left_content_type === "Slideshow") {
						echo '<div class="'.$left_column_class.' col-tight">';
						if( have_rows('left_column_slideshow') ):
							echo '<ul class="gallery-slideshow">';
						    while ( have_rows('left_column_slideshow') ) : the_row();
							$image = get_sub_field('left_column_slideshow_image');
							$title = get_sub_field('left_column_slideshow_title');
							$link = get_sub_field('left_column_slideshow_link');
							if ($title !== "") {
								$class =  ' class="with-title"';
							} else {
								$imgClass = '';
							}
						    echo '<li style="background-image: url('.$image["sizes"]["medium-wide-cropped"].')"'.$class.'>';
						    if ($link && $title) {echo '<h3><a href="'.$link.'">'.$title.'</a></h3>';}
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
									echo '<h3><a href="'.$linkURL.'">'.$linkTitle.'</a></h3>';
								}
								if (get_sub_field('right_column_image_with_link_image')) {
									echo '</div>';
								}
							}
						}
					} elseif ($right_content_type === "Slideshow") {
						echo '<div class="'.$right_column_class.' col-tight">';
						if( have_rows('right_column_slideshow') ):
							echo '<ul class="gallery-slideshow">';
						    while ( have_rows('right_column_slideshow') ) : the_row();
							$image = get_sub_field('right_column_slideshow_image');
							$title = get_sub_field('right_column_slideshow_title');
							$link = get_sub_field('right_column_slideshow_link');
							if ($title !== "") {
								$class =  ' class="with-title"';
							} else {
								$imgClass = '';
							}
						    echo '<li style="background-image: url('.$image["sizes"]["medium-wide-cropped"].')"'.$class.'>';
						    if ($link && $title) {echo '<h3><a href="'.$link.'">'.$title.'</a></h3>';}
						    echo '</li>';
						    endwhile;
							echo '</ul>';
						endif;
						echo '</div>';
					}
				echo '</div>';
			}
		} ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cornergallery' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

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

