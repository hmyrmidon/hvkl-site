<?php
/**
 * About configuration
 *
 * @package Education_Mind
 */

$config = array(
	'menu_name' => esc_html__( 'About Education Mind', 'education-mind' ),
	'page_name' => esc_html__( 'About Education Mind', 'education-mind' ),

	/* translators: theme version */
	'welcome_title' => sprintf( esc_html__( 'Welcome to %s - v', 'education-mind' ), 'Education Mind' ),

	/* translators: 1: theme name */
	'welcome_content' => sprintf( esc_html__( '%1$s is now installed and ready to use! We want to make sure you have the best experience using %1$s and that is why we gathered here all the necessary information for you. We hope you will enjoy using %1$s.', 'education-mind' ), 'Education Mind' ),

	// Quick links.
	'quick_links' => array(
		'theme_url' => array(
			'text' => esc_html__( 'Theme Details','education-mind' ),
			'url'  => 'https://axlethemes.com/downloads/education-mind/',
			),
		'demo_url' => array(
			'text' => esc_html__( 'View Demo','education-mind' ),
			'url'  => 'https://axlethemes.com/theme-demo/?demo=education-mind',
			),
		'documentation_url' => array(
			'text'   => esc_html__( 'View Documentation','education-mind' ),
			'url'    => 'https://axlethemes.com/documentation/education-mind/',
			'button' => 'primary',
			),
		'rate_url' => array(
			'text' => esc_html__( 'Rate This Theme','education-mind' ),
			'url'  => 'https://wordpress.org/support/theme/education-mind/reviews/',
			),
		),

	// Tabs.
	'tabs' => array(
		'getting_started'     => esc_html__( 'Getting Started', 'education-mind' ),
		'recommended_actions' => esc_html__( 'Recommended Actions', 'education-mind' ),
		'demo_content'        => esc_html__( 'Demo Content', 'education-mind' ),
		'useful_plugins'      => esc_html__( 'Useful Plugins', 'education-mind' ),
		'support'             => esc_html__( 'Support', 'education-mind' ),
		'upgrade_to_pro'      => esc_html__( 'Upgrade to Pro', 'education-mind' ),
	),

	// Getting started.
	'getting_started' => array(
		array(
			'title'               => esc_html__( 'Theme Documentation', 'education-mind' ),
			'text'                => esc_html__( 'Even if you are a long-time WordPress user, we still believe you should give our documentation a very quick read.', 'education-mind' ),
			'button_label'        => esc_html__( 'View Documentation', 'education-mind' ),
			'button_link'         => 'https://axlethemes.com/documentation/education-mind/',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Recommended Actions', 'education-mind' ),
			'text'                => esc_html__( 'We have compiled a list of steps for you, to take make sure the experience you will have using one of our products is very easy to follow.', 'education-mind' ),
			'button_label'        => esc_html__( 'Check Recommended Actions', 'education-mind' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=education-mind-about&tab=recommended_actions' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'Theme Demo Content', 'education-mind' ),
			'text'                => esc_html__( 'You can easily import demo content as we have bundled demo content file within the theme folder. Importer plugin is needed.', 'education-mind' ),
			'button_label'        => esc_html__( 'Demo Content', 'education-mind' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=education-mind-about&tab=demo_content' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'Customize Everything', 'education-mind' ),
			'text'                => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'education-mind' ),
			'button_label'        => esc_html__( 'Go to Customizer', 'education-mind' ),
			'button_link'         => esc_url( wp_customize_url() ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'View Theme Demo', 'education-mind' ),
			'text'                => esc_html__( 'To get quick glance of the theme, please visit theme demo.', 'education-mind' ),
			'button_label'        => esc_html__( 'View Demo', 'education-mind' ),
			'button_link'         => 'https://axlethemes.com/theme-demo/?demo=education-mind',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Child Theme', 'education-mind' ),
			'text'                => esc_html__( 'If you want to customize theme file, you should use child theme rather than modifying theme file itself.', 'education-mind' ),
			'button_label'        => esc_html__( 'About Child Theme', 'education-mind' ),
			'button_link'         => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
	),

	// Recommended actions.
	'recommended_actions' => array(
		'content' => array(
			'front-page' => array(
				'title'       => esc_html__( 'Setting Static Front Page','education-mind' ),
				'description' => esc_html__( 'Select A static page then Front page and Posts page to display front page specific sections. Note: Static page will be set automatically when you import demo content.', 'education-mind' ),
				'id'          => 'front-page',
				'check'       => ( 'page' === get_option( 'show_on_front' ) ) ? true : false,
				'help'        => '<a href="' . esc_url( wp_customize_url() ) . '?autofocus[section]=static_front_page" class="button button-secondary">' . esc_html__( 'Static Front Page', 'education-mind' ) . '</a>',
			),
			'one-click-demo-import' => array(
				'title'       => esc_html__( 'One Click Demo Import', 'education-mind' ),
				'description' => esc_html__( 'Please install the One Click Demo Import plugin to import the demo content.', 'education-mind' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'one-click-demo-import',
				'id'          => 'one-click-demo-import',
			),
		),
	),

	// Demo content.
	'demo_content' => array(
		'description' => sprintf( esc_html__( 'Demo content files are bundled within this theme. %1$s plugin is needed to import demo content. Please make sure plugin is installed and activated. If you have not installed the plugin, please go to Installed Plugins page under Appearance. After plugin activation, go to Import Demo Data menu under Appearance.', 'education-mind' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'education-mind' ) . '</a>' ),
		),

	// Useful plugins.
	'useful_plugins' => array(
		'description'        => esc_html__( 'This theme supports some helpful WordPress plugins to enhance your website.', 'education-mind' ),
		'plugins_list_title' => esc_html__( 'Useful Plugins List:', 'education-mind' ),
	),

	// Support.
	'support_content' => array(
		'first' => array(
			'title'        => esc_html__( 'Contact Support', 'education-mind' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'Got theme support question or found bug? Best place to ask your query is our dedicated Support forum.', 'education-mind' ),
			'button_label' => esc_html__( 'Contact Support', 'education-mind' ),
			'button_link'  => esc_url( 'https://axlethemes.com/support-forum/forum/education-mind/' ),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'Theme Documentation', 'education-mind' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Please check our theme documentation for detailed information on how to setup and use theme.', 'education-mind' ),
			'button_label' => esc_html__( 'View Documentation', 'education-mind' ),
			'button_link'  => 'https://axlethemes.com/documentation/education-mind/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'third' => array(
			'title'        => esc_html__( 'Pro Version', 'education-mind' ),
			'icon'         => 'dashicons dashicons-products',
			'icon'         => 'dashicons dashicons-star-filled',
			'text'         => esc_html__( 'Upgrade to pro version for more exciting features and additional theme options.', 'education-mind' ),
			'button_label' => esc_html__( 'View Pro Version', 'education-mind' ),
			'button_link'  => 'https://axlethemes.com/downloads/education-mind-pro/',
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'fourth' => array(
			'title'        => esc_html__( 'Pre-sale Queries', 'education-mind' ),
			'icon'         => 'dashicons dashicons-cart',
			'text'         => esc_html__( 'Have any query before purchase, you are more than welcome to ask.', 'education-mind' ),
			'button_label' => esc_html__( 'Pre-sale question?', 'education-mind' ),
			'button_link'  => 'https://axlethemes.com/pre-sale-question/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'fifth' => array(
			'title'        => esc_html__( 'Customization Request', 'education-mind' ),
			'icon'         => 'dashicons dashicons-admin-tools',
			'text'         => esc_html__( 'Needed any customization for the theme, you can request from here.', 'education-mind' ),
			'button_label' => esc_html__( 'Customization Request', 'education-mind' ),
			'button_link'  => 'https://axlethemes.com/customization-request/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'sixth' => array(
			'title'        => esc_html__( 'Child Theme', 'education-mind' ),
			'icon'         => 'dashicons dashicons-admin-customizer',
			'text'         => esc_html__( 'If you want to customize theme file, you should use child theme rather than modifying theme file itself.', 'education-mind' ),
			'button_label' => esc_html__( 'About Child Theme', 'education-mind' ),
			'button_link'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
	),

	// Upgrade.
	'upgrade_to_pro' => array(
		'description'  => esc_html__( 'Upgrade to pro version for more exciting features and additional theme options.', 'education-mind' ),
		'button_label' => esc_html__( 'Upgrade to Pro', 'education-mind' ),
		'button_link'  => 'https://axlethemes.com/downloads/education-mind-pro/',
		'is_new_tab'   => true,
	),

);

Education_Mind_About::init( apply_filters( 'education_mind_about_filter', $config ) );
