<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aperitive
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header class="entry-header">
		<?php

		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<div>By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author();?></a></div>
				<?php aperitive_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif;
		?>

	</header><!-- .entry-header -->

	<div class="columns-2">
		<div class="image">
			<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('about-profile');
			} 
			else {
				echo "&nbsp;";
			}
 ?>
		</div>

		<div class="entry-content">
			<?php
				the_excerpt();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aperitive' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>

	<footer class="entry-footer">
		<?php aperitive_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
