<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aperitive
 */

$footer_copyright = get_theme_mod( 'aperitive_footer_copyright', '' );

?>
	</div><!-- #content -->


		<div class="main-content-footer">
			<div class="columns-2 split-40-60">
				<div class="image">
					<?php 
					$size = 'footer-logo';
					$image = get_field('footer_logo', 'option'); 
					if ($image):
						echo wp_get_attachment_image( $image, $size );
					endif;
					?>
				</div>
				<div class="footer-info">
					<?php the_field('footer_text_content', 'option'); ?>
				</div>
			</div>
		</div>

	<footer id="colophon" class="site-footer hero-container" role="contentinfo">
		<!-- Social menu -->
		<?php aperitive_social_menu(); ?>

		<div class="site-info">

			<?php if ( '' == $footer_copyright ) { ?>

				<div class="actions">
					<?php if (get_field('footer_button_1_text', 'option')) : ?>
					<a class="button" id="footer-button-1" href="<?php the_field('footer_button_1_link', 'option');?>" target="<?php echo get_field('footer_button_1_new_window', 'option') ? '_blank' : '_self';?>" <?php the_field('footer_button_1_custom_attributes', 'option');?>><?php the_field('footer_button_1_text', 'option');?></a>
					<?php endif; ?>
					<?php if (get_field('footer_button_2_text', 'option')) : ?>
					<a class="button" id="footer-button-2" href="<?php the_field('footer_button_2_link', 'option');?>" target="<?php echo get_field('footer_button_2_new_window', 'option') ? '_blank' : '_self';?>" <?php the_field('footer_button_2_custom_attributes', 'option');?>><?php the_field('footer_button_2_text', 'option');?></a>
					<?php endif; ?>

				</div>

			<?php } else {

				printf( esc_html__( '%s', 'aperitive' ), $footer_copyright );

			} ?>

		</div><!-- .site-info -->

	</footer><!-- #colophon -->

	<?php the_field('mailchimp_signup_dialog_code_snippet', 'option'); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
