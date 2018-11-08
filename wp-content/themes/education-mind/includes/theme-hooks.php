<?php
/**
 * Functions hooked to custom hook.
 *
 * @package Education_Mind
 */

if ( ! function_exists( 'education_mind_customize_global_layout' ) ) :

	/**
	 * Customize global layout.
	 *
	 * @since 1.0.0
	 *
	 * @param string $layout Layout.
	 * @return string Modifued layout.
	 */
	function education_mind_customize_global_layout( $layout ) {
		// Check if single template.
		global $post;
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'education_mind_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$layout = $post_options['post_layout'];
			}
		}

		// Check if custom page templates.
		if ( is_page_template( array( 'templates/full-width.php', 'templates/front.php', 'templates/builder.php' ) ) ) {
			$layout = 'no-sidebar';
		}

		return $layout;
	}

endif;

add_filter( 'education_mind_filter_theme_global_layout', 'education_mind_customize_global_layout', 11 );

if ( ! function_exists( 'education_mind_skip_to_content' ) ) :

	/**
	 * Add skip to content.
	 *
	 * @since 1.0.0
	 */
	function education_mind_skip_to_content() {
		?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-mind' ); ?></a><?php
	}
endif;

add_action( 'education_mind_action_before', 'education_mind_skip_to_content', 15 );

if ( ! function_exists( 'education_mind_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function education_mind_site_branding() {
		?>
		<div class="site-branding">

			<?php education_mind_the_custom_logo(); ?>

			<?php $show_title = education_mind_get_option( 'show_title' ); ?>
			<?php $show_tagline = education_mind_get_option( 'show_tagline' ); ?>

			<?php if ( true === $show_title || true === $show_tagline ) : ?>
				<div id="site-identity">
					<?php if ( true === $show_title ) : ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( true === $show_tagline ) : ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				</div><!-- #site-identity -->
			<?php endif; ?>
		</div><!-- .site-branding -->

		<div class="right-head">
			<?php education_mind_render_quick_contact(); ?>

			<?php $enable_apply_button = education_mind_get_option( 'enable_apply_button' ); ?>
			<?php if ( true === $enable_apply_button ) : ?>
				<?php
				$apply_button_link = education_mind_get_option( 'apply_button_link' );
				$apply_button_text = education_mind_get_option( 'apply_button_text' );
				?>
				<a href="<?php echo esc_url( $apply_button_link ); ?>" class="custom-button apply-button"><?php echo esc_html( $apply_button_text ); ?></a>
			<?php endif; ?>

		</div><!-- .right-head -->
	<?php
	}

endif;

add_action( 'education_mind_action_header', 'education_mind_site_branding' );

if ( ! function_exists( 'education_mind_mobile_navigation' ) ) :

	/**
	 * Mobile navigation.
	 *
	 * @since 1.0.0
	 */
	function education_mind_mobile_navigation() {
		?>
		<div class="mobile-nav-wrap">
			<a id="mobile-trigger" href="#mob-menu"><i class="fa fa-list-ul" aria-hidden="true"></i><span><?php esc_html_e( 'Main Menu', 'education-mind' ); ?><span></a>
			<div id="mob-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => '',
					'fallback_cb'    => 'education_mind_primary_navigation_fallback',
				) );
				?>
			</div><!-- #mob-menu -->

			<?php if ( has_nav_menu( 'top' ) ) : ?>
				<a id="mobile-trigger-quick" href="#mob-menu-quick"><span><?php esc_html_e( 'Top Menu', 'education-mind' ); ?></span><i class="fa fa-list-ul" aria-hidden="true"></i></a>
				<div id="mob-menu-quick">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'top',
						'container'      => '',
						'depth'          => 1,
						'fallback_cb'    => false,
					) );
					?>
				</div><!-- #mob-menu-quick -->
			<?php endif; ?>

		</div><!-- .mobile-nav-wrap -->
		<?php
	}

endif;

add_action( 'education_mind_action_before', 'education_mind_mobile_navigation', 20 );

if ( ! function_exists( 'education_mind_add_top_head_content' ) ) :

	/**
	 * Add top head section.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_top_head_content() {
		// Check if top head content is disabled.
		$status = apply_filters( 'education_mind_filter_top_head_status', false, 1 );

		if ( true !== $status ) {
			return;
		}
		?>
		<div id="tophead">
			<div class="container">
				<nav id="header-nav" class="menu-top-menu-container">
					<?php
						wp_nav_menu(
							array(
							'theme_location' => 'top',
							'menu_class'     => 'menu',
							'depth'          => 1,
							'fallback_cb'    => false,
							)
						);
					?>
				</nav>

				<?php if ( true === education_mind_get_option( 'show_social_in_header' ) && has_nav_menu( 'social' ) ) : ?>
					<div id="header-social">
						<?php the_widget( 'Education_Mind_Social_Widget' ); ?>
					</div><!-- .header-social -->
				<?php endif; ?>
			</div><!-- .container -->
		</div><!-- #tophead -->
		<?php
	}

endif;

add_action( 'education_mind_action_before_header', 'education_mind_add_top_head_content', 5 );

if ( ! function_exists( 'education_mind_check_top_head_status' ) ) :

	/**
	 * Top head status.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $status Active status.
	 * @param int  $layout Header layout.
	 * @return bool Modified status.
	 */
	function education_mind_check_top_head_status( $status, $layout ) {

		$top_menu_status = ( has_nav_menu( 'top' ) ) ? true : false;
		$social_status = ( ! ( false === has_nav_menu( 'social' ) || false === education_mind_get_option( 'show_social_in_header' ) ) ) ? true : false;

		if ( true === $top_menu_status || true === $social_status ) {
			$status = true;
		}

		return $status;

	}

endif;

add_filter( 'education_mind_filter_top_head_status', 'education_mind_check_top_head_status', 10, 2 );

if ( ! function_exists( 'education_mind_footer_copyright' ) ) :

	/**
	 * Footer copyright.
	 *
	 * @since 1.0.0
	 */
	function education_mind_footer_copyright() {

		// Check if footer is disabled.
		$footer_status = apply_filters( 'education_mind_filter_footer_status', true );
		if ( true !== $footer_status ) {
			return;
		}

		// Copyright content.
		$copyright_text = education_mind_get_option( 'copyright_text' );
		$copyright_text = apply_filters( 'education_mind_filter_copyright_text', $copyright_text );
		?>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<?php
			$footer_menu_content = wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => 'div',
				'container_id'   => 'footer-navigation',
				'depth'          => 1,
				'fallback_cb'    => false,
			) );
			?>
		<?php endif; ?>
		<?php if ( ! empty( $copyright_text ) ) : ?>
			<div class="copyright">
				<?php echo wp_kses_post( $copyright_text ); ?>
			</div>
		<?php endif; ?>
		<div class="site-info">
			<?php echo esc_html__( 'Education Mind by', 'education-mind' ) . ' <a target="_blank" rel="designer" href="https://axlethemes.com/">Axle Themes</a>'; ?>
		</div>
		<?php
	}

endif;

add_action( 'education_mind_action_footer', 'education_mind_footer_copyright', 10 );

if ( ! function_exists( 'education_mind_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_sidebar() {

		$global_layout = education_mind_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_mind_filter_theme_global_layout', $global_layout );

		// Include primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}

		// Include secondary sidebar.
		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
				break;

			default:
				break;
		}

	}

endif;

add_action( 'education_mind_action_sidebar', 'education_mind_add_sidebar' );

if ( ! function_exists( 'education_mind_custom_posts_navigation' ) ) :

	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
	function education_mind_custom_posts_navigation() {

		the_posts_pagination();

	}
endif;

add_action( 'education_mind_action_posts_navigation', 'education_mind_custom_posts_navigation' );

if ( ! function_exists( 'education_mind_add_image_in_single_display' ) ) :

	/**
	 * Add image in single template.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_image_in_single_display() {

		if ( has_post_thumbnail() ) {
			$args = array(
				'class' => 'education-mind-post-thumb aligncenter',
			);
			the_post_thumbnail( 'large', $args );
		}

	}

endif;

add_action( 'education_mind_single_image', 'education_mind_add_image_in_single_display' );

if ( ! function_exists( 'education_mind_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function education_mind_footer_goto_top() {
		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-angle-up"></i></a>';
	}

endif;

add_action( 'education_mind_action_after', 'education_mind_footer_goto_top', 20 );

if ( ! function_exists( 'education_mind_add_front_page_widget_area' ) ) :

	/**
	 * Add front page widget area.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_front_page_widget_area() {

		if ( is_page_template( 'templates/front.php' ) ) {
			if ( is_active_sidebar( 'sidebar-front-page-widget-area' ) ) {
				echo '<div id="sidebar-front-page-widget-area" class="widget-area">';
				dynamic_sidebar( 'sidebar-front-page-widget-area' );
				echo '</div><!-- #sidebar-front-page-widget-area -->';
			} else {
				if ( current_user_can( 'edit_theme_options' ) ) {
					echo '<div id="sidebar-front-page-widget-area" class="widget-area">';
					education_mind_message_front_page_widget_area();
					echo '</div><!-- #sidebar-front-page-widget-area -->';
				}
			}
		}

	}
endif;

add_action( 'education_mind_action_before_content', 'education_mind_add_front_page_widget_area', 7 );

if ( ! function_exists( 'education_mind_add_footer_widgets' ) ) :

	/**
	 * Add footer widgets.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_footer_widgets() {

		get_template_part( 'template-parts/footer-widgets' );

	}
endif;

add_action( 'education_mind_action_before_footer', 'education_mind_add_footer_widgets', 5 );

if ( ! function_exists( 'education_mind_add_custom_header' ) ) :

	/**
	 * Add custom header.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_custom_header() {

		if ( is_page_template( array( 'templates/front.php', 'templates/builder.php' ) ) ) {
			return;
		}

		if ( is_home() ) {
			return;
		}

		$image = get_header_image();
		$extra_style = '';
		if ( ! empty( $image ) ) {
			$extra_style .= 'style="background-image:url(\'' . esc_url( $image ) . '\');"';
		}
		?>
		<div id="custom-header" <?php echo $extra_style; ?>>
			<div class="container">
				<div class="custom-header-wrapper">
					<?php do_action( 'education_mind_action_custom_header_title' ); ?>
					<?php do_action( 'education_mind_add_breadcrumb' ); ?>
				</div><!-- .custom-header-content -->
			</div><!-- .container -->
		</div><!-- #custom-header -->
		<?php
	}

endif;

add_action( 'education_mind_action_before_content', 'education_mind_add_custom_header', 6 );

if ( ! function_exists( 'education_mind_add_title_in_custom_header' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_title_in_custom_header() {

		echo '<h1 class="page-title">';

		if ( is_home() ) {
			echo esc_html( education_mind_get_option( 'blog_page_title' ) );
		} elseif ( is_singular() ) {
			echo single_post_title( '', false );
		} elseif ( is_archive() ) {
			the_archive_title();
		} elseif ( is_search() ) {
			printf( esc_html__( 'Search Results for: %s', 'education-mind' ),  get_search_query() );
		} elseif ( is_404() ) {
			esc_html_e( '404 Error', 'education-mind' );
		}

		echo '</h1>';

	}

endif;

add_action( 'education_mind_action_custom_header_title', 'education_mind_add_title_in_custom_header' );

if ( ! function_exists( 'education_mind_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_breadcrumb() {

		// Bail if home page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo'<div id="breadcrumb">';
		education_mind_breadcrumb();
		echo '</div>';

	}

endif;

add_action( 'education_mind_add_breadcrumb', 'education_mind_add_breadcrumb', 10 );
