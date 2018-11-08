<?php
/**
 * Theme Customizer.
 *
 * @package Education_Mind
 */

/**
 * Add Customizer options.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_mind_customize_register( $wp_customize ) {

	// Load custom controls.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/control.php';

	// Load custom controls and sections.
	$wp_customize->register_control_type( 'Education_Mind_Heading_Control' );
	$wp_customize->register_control_type( 'Education_Mind_Message_Control' );
	$wp_customize->register_control_type( 'Education_Mind_Dropdown_Taxonomies_Control' );
	$wp_customize->register_control_type( 'Education_Mind_Dropdown_Sidebars_Control' );
	$wp_customize->register_control_type( 'Education_Mind_Radio_Image_Control' );
	$wp_customize->register_section_type( 'Education_Mind_Upsell_Section' );

	// Upsell section.
	$wp_customize->add_section(
		new Education_Mind_Upsell_Section( $wp_customize, 'custom_theme_upsell',
			array(
				'title'    => esc_html__( 'Education Mind Pro', 'education-mind' ),
				'pro_text' => esc_html__( 'Buy Pro', 'education-mind' ),
				'pro_url'  => 'https://axlethemes.com/downloads/education-mind-pro/',
				'priority' => 1,
			)
		)
	);

	// Load helpers.
	require_once trailingslashit( get_template_directory() ) . 'includes/helpers.php';

	// Load customize sanitize.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/sanitize.php';

	// Load customize callback.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/callback.php';

	// Load customize option.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/option.php';

	// Load slider customize option.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/slider.php';
}

add_action( 'customize_register', 'education_mind_customize_register' );

/**
 * Register Customizer partials.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_mind_customizer_partials( WP_Customize_Manager $wp_customize ) {

	// Bail if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
		return;
	}

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Register partial for blogname.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.site-title a',
		'container_inclusive' => false,
		'render_callback'     => 'education_mind_customize_partial_blogname',
	) );

	// Register partial for blogdescription.
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'            => '.site-description',
		'container_inclusive' => false,
		'render_callback'     => 'education_mind_customize_partial_blogdescription',
	) );

}

add_action( 'customize_register', 'education_mind_customizer_partials', 99 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 */
function education_mind_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 */
function education_mind_customize_partial_blogdescription() {

	bloginfo( 'description' );

}

/**
 * Register customizer controls scripts.
 *
 * @since 1.0.0
 */
function education_mind_customize_controls_register_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'education-mind-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css', array(), '1.0.0' );
	wp_enqueue_script( 'education-mind-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'jquery', 'customize-controls' ), '1.0.0', true );
}

add_action( 'customize_controls_enqueue_scripts', 'education_mind_customize_controls_register_scripts', 0 );
