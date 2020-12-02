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

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<?php aperitive_posted_on(); ?>
				<div>By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author();?></a></div>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

	</header><!-- .entry-header -->

	<?php

		if ( 'gallery' == get_post_format() || 'video' == get_post_format() ) :
			aperitive_featured_media();
		endif;

	?>

	<div class="entry-content">
		<?php

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'aperitive' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aperitive' ),
				'after'  => '</div>',
			) );

		?>

		<footer class="entry-footer">
			<?php aperitive_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<?php
			if ( 'nova_menu_item' != get_post_type() ) {
				aperitive_author_box();
			}

			// Display related posts
			aperitive_related_posts();

		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
