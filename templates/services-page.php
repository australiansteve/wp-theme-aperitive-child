<?php
/**
 * Template Name: Services Page
 * The template for displaying the Services pages.
 *
 * @package Aperitive
 */
get_header();
?>
<!-- 
<ul class="menu-cats">

	<?php
	wp_nav_menu(
		array( 
			'theme_location' => 'services-page-menu',
			'items_wrap' => '%3$s' 
		)
	);

	?>

</ul> -->

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'templates/template-parts/content', 'page' );


			if( have_rows('services') ):
				?>
				<div id="services-list">
					<?php
					while ( have_rows('services') ) : the_row();

						$name = get_sub_field('name');
						$image = get_sub_field('image');
						$size = 'about-profile';
						$about = get_sub_field('about');
						$buttonLink = get_sub_field('button_link');;
						$buttonText = get_sub_field('button_text');

						?>

						<div class="service">
							<div class="name">
								<h4><?php echo $name; ?></h4>
							</div>							
							<div class="columns-2">
								<div class="image">
									<?php 
									if( $image ):
										echo wp_get_attachment_image( $image, $size );
									else:
										echo "&nbsp;";
									endif;

									if ($buttonText && $buttonLink):
										?>
										<div class="button">
											<a class="button" href="<?php echo $buttonLink;?>" target="blank"><?php echo $buttonText; ?></a>
										</div>
										<?php 
									endif;
									?>
								</div>
								<div class="bio">
									<?php echo $about; ?>
								</div>
							</div>

						</div>
						<?php
					endwhile;
					?>
				</div>
				<?php
			endif;
		endwhile;

				// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() )
			comments_template( '', true );
		?>


	</main><!-- .site-main -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>
