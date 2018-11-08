<?php
/**
 * Helper functions.
 *
 * @package Education_Mind
 */

if ( ! function_exists( 'education_mind_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_mind_get_global_layout_options() {
		$choices = array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'education-mind' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'education-mind' ),
			'three-columns' => esc_html__( 'Three Columns', 'education-mind' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'education-mind' ),
		);
		return $choices;
	}

endif;

if ( ! function_exists( 'education_mind_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_mind_get_archive_layout_options() {
		$choices = array(
			'full'    => esc_html__( 'Full Post', 'education-mind' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'education-mind' ),
		);
		return $choices;
	}

endif;

if ( ! function_exists( 'education_mind_get_menus_options' ) ) :

	/**
	 * Returns menus options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_mind_get_menus_options() {
		$choices = array(
			'' => esc_html__( '&mdash; Select &mdash;', 'education-mind' ),
		);

		$menus = education_mind_get_all_menus();

		if ( ! empty( $menus ) ) {
			$choices = $choices + $menus;
		}

		return $choices;
	}

endif;

if ( ! function_exists( 'education_mind_get_all_menus' ) ) :

	/**
	 * Returns all menus.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_mind_get_all_menus() {
		$choices = array();
		$terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $t ) {
				$choices[ $t->term_id ] = $t->name;
			}
		}
		return $choices;
	}

endif;

if ( ! function_exists( 'education_mind_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable    True for adding No Image option.
	 * @param array $allowed        Allowed image size options.
	 * @param bool  $show_dimension True for showing dimension.
	 * @return array Image size options.
	 */
	function education_mind_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;

		$choices = array();

		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'education-mind' );
		}

		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'education-mind' );
		$choices['medium']    = esc_html__( 'Medium', 'education-mind' );
		$choices['large']     = esc_html__( 'Large', 'education-mind' );
		$choices['full']      = esc_html__( 'Full (original)', 'education-mind' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ) {
					$choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed, true ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;

if ( ! function_exists( 'education_mind_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_mind_get_image_alignment_options() {
		$choices = array(
			'none'   => esc_html_x( 'None', 'alignment', 'education-mind' ),
			'left'   => esc_html_x( 'Left', 'alignment', 'education-mind' ),
			'center' => esc_html_x( 'Center', 'alignment', 'education-mind' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'education-mind' ),
		);
		return $choices;
	}

endif;

if ( ! function_exists( 'education_mind_get_featured_slider_transition_effects' ) ) :

	/**
	 * Returns the featured slider transition effects.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_mind_get_featured_slider_transition_effects() {
		$choices = array(
			'fade'       => esc_html_x( 'fade', 'transition effect', 'education-mind' ),
			'fadeout'    => esc_html_x( 'fadeout', 'transition effect', 'education-mind' ),
			'none'       => esc_html_x( 'none', 'transition effect', 'education-mind' ),
			'scrollHorz' => esc_html_x( 'scrollHorz', 'transition effect', 'education-mind' ),
		);
		ksort( $choices );
		return $choices;
	}

endif;

if ( ! function_exists( 'education_mind_get_featured_slider_content_options' ) ) :

	/**
	 * Returns the featured slider content options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_mind_get_featured_slider_content_options() {
		$choices = array(
			'home-page' => esc_html__( 'Static Front Page', 'education-mind' ),
			'disabled'  => esc_html__( 'Disabled', 'education-mind' ),
		);
		return $choices;
	}

endif;

if ( ! function_exists( 'education_mind_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function education_mind_get_featured_slider_type() {
		$choices = array(
			'featured-page' => esc_html__( 'Featured Pages', 'education-mind' ),
		);
		return $choices;
	}

endif;
