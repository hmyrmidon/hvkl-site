<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Education_Mind
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<?php
		$args = array(
			'class' => 'education-mind-post-thumb aligncenter',
		);
		the_post_thumbnail( 'large', $args );
		?>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php education_mind_posted_on(); ?>
		</div>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php $archive_layout = education_mind_get_option( 'archive_layout' ); ?>

		<?php if ( 'full' === $archive_layout ) : ?>
			<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'education-mind' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'education-mind' ),
				'after'  => '</div>',
			) );
			?>
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php education_mind_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
