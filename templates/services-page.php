<?php
/**
 * Template Name: Services Page
 * The template for displaying the Services pages.
 *
 * @package Aperitive
 */
get_header();
?>

	<ul class="menu-cats">

		<?php
			wp_nav_menu(
				array( 
					'theme_location' => 'services-page-menu',
					'items_wrap' => '%3$s' 
				)
			);

		?>

	</ul>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'templates/template-parts/content', 'page' );
				endwhile; // end of the normal loop.

				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
			?>


		</main><!-- .site-main -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>
