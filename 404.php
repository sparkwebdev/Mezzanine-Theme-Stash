<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Corner Gallery
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="entry-header">
					<h1 class="page-title"><?php esc_html_e( 'That page can&rsquo;t be found.', 'cornergallery' ); ?></h1>
				</header><!-- .page-header -->

				<div class="entry-content">
					<p><?php esc_html_e( 'Sorry, nothing was found at this location.', 'cornergallery' ); ?></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
