<?php
/**
 * Template Name: About Page
 * The template for displaying the About pages.
 *
 * @package Aperitive
 */
get_header();
?>

<ul class="menu-cats">

	<?php
	wp_nav_menu(
		array( 
			'theme_location' => 'about-page-menu',
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

			if( have_rows('profile') ):
				?>
				<div id="about-profiles">
					<?php
					while ( have_rows('profile') ) : the_row();

						?>
						<div class="profile">
							<div class="name">
								<h4><?php the_sub_field('name'); ?></h4>
							</div>
							<div class="title">
								<h6><?php the_sub_field('title'); ?></h6>
							</div>
							<div class="columns-2">
								<div class="image">
									<?php 
									$image = get_sub_field('image');
									$size = 'about-profile'; // (thumbnail, medium, large, full or custom size)
									if( $image ):
										echo wp_get_attachment_image( $image, $size );
									else:
										echo "&nbsp;";
									endif;
									?>
								</div>
								<div class="bio">
									<?php the_sub_field('biography'); ?>
								</div>
							</div>

						</div>
						<?php
					endwhile;
					?>
				</div>
				<?php
			endif;

		endwhile; // end of the normal loop.

				// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() )
			comments_template( '', true );
		?>


	</main><!-- .site-main -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>
