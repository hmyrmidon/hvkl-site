<?php
/**
 * Core functions.
 *
 * @package Education_Mind
 */

if ( ! function_exists( 'education_mind_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function education_mind_get_option( $key ) {

		$education_mind_default_options = education_mind_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$default = ( isset( $education_mind_default_options[ $key ] ) ) ? $education_mind_default_options[ $key ] : '';
		$theme_options = get_theme_mod( 'theme_options', $education_mind_default_options );
		$theme_options = array_merge( $education_mind_default_options, $theme_options );
		$value = '';

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;

if ( ! function_exists( 'education_mind_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function education_mind_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']            = true;
		$defaults['show_tagline']          = true;
		$defaults['contact_number_title']  = esc_html__( 'Phone', 'education-mind' );
		$defaults['contact_number']        = '';
		$defaults['contact_email_title']   = esc_html__( 'Email', 'education-mind' );
		$defaults['contact_email']         = '';
		$defaults['contact_address_title'] = esc_html__( 'Address', 'education-mind' );
		$defaults['contact_address']       = '';
		$defaults['show_social_in_header'] = false;
		$defaults['show_search_in_header'] = true;
		$defaults['enable_apply_button']   = false;
		$defaults['apply_button_link']     = '';
		$defaults['apply_button_text']     = esc_html__( 'Apply Now', 'education-mind' );

		// Layout.
		$defaults['global_layout']  = 'right-sidebar';
		$defaults['archive_layout'] = 'excerpt';

		// Footer.
		$defaults['copyright_text'] = esc_html__( 'Copyright &copy; All rights reserved.', 'education-mind' );

		// Blog.
		$defaults['excerpt_length']     = 40;
		$defaults['read_more_text']     = esc_html__( 'Read More', 'education-mind' );
		$defaults['exclude_categories'] = '';

		// Slider Options.
		$defaults['featured_slider_status']              = 'disabled';
		$defaults['featured_slider_transition_effect']   = 'fadeout';
		$defaults['featured_slider_transition_delay']    = 3;
		$defaults['featured_slider_transition_duration'] = 1;
		$defaults['featured_slider_enable_caption']      = true;
		$defaults['featured_slider_enable_arrow']        = true;
		$defaults['featured_slider_enable_pager']        = true;
		$defaults['featured_slider_enable_autoplay']     = true;
		$defaults['featured_slider_enable_overlay']      = true;
		$defaults['featured_slider_type']                = 'featured-page';
		$defaults['featured_slider_number']              = 3;
		$defaults['featured_slider_read_more_text']      = esc_html__( 'Read More', 'education-mind' );

		return apply_filters( 'education_mind_filter_default_theme_options', $defaults );
	}

endif;
