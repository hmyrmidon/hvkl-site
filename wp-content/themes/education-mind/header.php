<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_Mind
 */

?><?php
	/**
	 * Hook - education_mind_action_doctype.
	 *
	 * @hooked education_mind_doctype - 10
	 */
	do_action( 'education_mind_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - education_mind_action_head.
	 *
	 * @hooked education_mind_head - 10
	 */
	do_action( 'education_mind_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/**
	 * Hook - education_mind_action_before.
	 *
	 * @hooked education_mind_page_start - 10
	 * @hooked education_mind_skip_to_content - 15
	 */
	do_action( 'education_mind_action_before' );
	?>

	<?php
	  /**
	   * Hook - education_mind_action_before_header.
	   *
	   * @hooked education_mind_header_start - 10
	   */
	  do_action( 'education_mind_action_before_header' );
	?>
		<?php
		/**
		 * Hook - education_mind_action_header.
		 *
		 * @hooked education_mind_site_branding - 10
		 */
		do_action( 'education_mind_action_header' );
		?>
	<?php
	  /**
	   * Hook - education_mind_action_after_header.
	   *
	   * @hooked education_mind_header_end - 10
	   * @hooked education_mind_add_primary_navigation - 20
	   */
	  do_action( 'education_mind_action_after_header' );
	?>

	<?php
	/**
	 * Hook - education_mind_action_before_content.
	 *
	 * @hooked education_mind_content_start - 10
	 */
	do_action( 'education_mind_action_before_content' );
	?>
	<?php
	  /**
	   * Hook - education_mind_action_content.
	   */
	  do_action( 'education_mind_action_content' );
