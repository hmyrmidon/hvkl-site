<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Education_Mind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Hook - education_mind_single_image.
	 *
	 * @hooked education_mind_add_image_in_single_display - 10
	 */
	do_action( 'education_mind_single_image' );
	?>
	<header class="entry-header">
		<div class="entry-meta">
			<?php education_mind_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'education-mind' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php education_mind_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

