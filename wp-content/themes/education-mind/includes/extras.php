<?php
/**
 * Functions hooked to core hooks.
 *
 * @package Education_Mind
 */

if ( ! function_exists( 'education_mind_customize_search_form' ) ) :

	/**
	 * Customize search form.
	 *
	 * @since 1.0.0
	 *
	 * @return string The search form HTML output.
	 */
	function education_mind_customize_search_form() {

		$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<label>
			<span class="screen-reader-text">' . esc_html_x( 'Search for:', 'label', 'education-mind' ) . '</span>
			<input type="search" class="search-field" placeholder="' . esc_attr__( 'Search&hellip;', 'education-mind' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'education-mind' ) . '" />
			</label>
			<input type="submit" class="search-submit" value="Search" /></form>';

		return $form;

	}

endif;

add_filter( 'get_search_form', 'education_mind_customize_search_form', 15 );

if ( ! function_exists( 'education_mind_add_primary_navigation' ) ) :

	/**
	 * Add primary navigation.
	 *
	 * @since 1.0.0
	 */
	function education_mind_add_primary_navigation() {
		?>
		<div id="main-nav" class="clear-fix">
			<div class="container">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<div class="wrap-menu-content">
						<?php
						wp_nav_menu(
							array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'fallback_cb'    => 'education_mind_primary_navigation_fallback',
							)
						);
						?>
					</div><!-- .wrap-menu-content -->
				</nav><!-- #site-navigation -->
				<?php $show_search_in_header = education_mind_get_option( 'show_search_in_header' ); ?>
				<?php if ( true === $show_search_in_header ) : ?>
					<div class="header-search-box">
						<a href="#" class="search-icon"><i class="fa fa-search"></i></a>
						<div class="search-box-wrap">
							<?php get_search_form(); ?>
						</div>
					</div><!-- .header-search-box -->
				<?php endif; ?>
			</div> <!-- .container -->
		</div><!-- #main-nav -->
		<?php
	}

endif;

add_filter( 'education_mind_action_after_header', 'education_mind_add_primary_navigation', 20 );

if ( ! function_exists( 'education_mind_exclude_category_in_blog_page' ) ) :

	/**
	 * Exclude category in blog page.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Query $query WP_Query instance.
	 * @return WP_Query Modified instance.
	 */
	function education_mind_exclude_category_in_blog_page( $query ) {

		if ( $query->is_home() && $query->is_main_query() ) {
			$exclude_categories = education_mind_get_option( 'exclude_categories' );
			if ( ! empty( $exclude_categories ) ) {
				$categories_raw = explode( ',', $exclude_categories );
				$cats = array();
				if ( ! empty( $categories_raw ) ) {
					foreach ( $categories_raw as $c ) {
						if ( absint( $c ) > 0 ) {
							$cats[] = absint( $c );
						}
					}
					if ( ! empty( $cats ) ) {
						$exclude_text = '';
						$exclude_text = '-' . implode( ',-', $cats );
						$query->set( 'cat', $exclude_text );
					}
				}
			}
		}

		return $query;
	}

endif;

add_filter( 'pre_get_posts', 'education_mind_exclude_category_in_blog_page' );

if ( ! function_exists( 'education_mind_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function education_mind_implement_excerpt_length( $length ) {

		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = education_mind_get_option( 'excerpt_length' );
		$excerpt_length = apply_filters( 'education_mind_filter_excerpt_length', $excerpt_length );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}

		return $length;

	}

endif;

add_filter( 'excerpt_length', 'education_mind_implement_excerpt_length', 999 );

if ( ! function_exists( 'education_mind_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function education_mind_implement_read_more( $more ) {

		if ( is_admin() ) {
			return $more;
		}

		$read_more_text = education_mind_get_option( 'read_more_text' );
		$more_link = '&hellip;&nbsp;<a href="' . esc_url( get_permalink() ) . '" class="more-link">' . esc_html( $read_more_text ) . '</a>';
		return $more_link;

	}

endif;

add_filter( 'excerpt_more', 'education_mind_implement_read_more' );

if ( ! function_exists( 'education_mind_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function education_mind_content_more_link( $more_link, $more_link_text ) {

		$read_more_text = education_mind_get_option( 'read_more_text' );

		if ( ! empty( $read_more_text ) ) {
			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
		}

		return $more_link;

	}

endif;

add_filter( 'the_content_more_link', 'education_mind_content_more_link', 10, 2 );

if ( ! function_exists( 'education_mind_custom_body_class' ) ) :

	/**
	 * Custom body class.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function education_mind_custom_body_class( $input ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		// Header layout.
		$input[] = 'header-layout-1';

		// Global layout.
		$global_layout = education_mind_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_mind_filter_theme_global_layout', $global_layout );

		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
			case 'three-columns':
				$input[] = 'three-columns-enabled';
			break;

			default:
			break;
		}

		return $input;
	}
endif;

add_filter( 'body_class', 'education_mind_custom_body_class' );

if ( ! function_exists( 'education_mind_featured_image_instruction' ) ) :

	/**
	 * Message to show in the Featured Image Meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Admin post thumbnail HTML markup.
	 * @param int    $post_id Post ID.
	 * @return string HTML.
	 */
	function education_mind_featured_image_instruction( $content, $post_id ) {

		if ( in_array( get_post_type( $post_id ), array( 'post', 'page' ), true ) ) {
			$content .= '<strong>' . esc_html__( 'Recommended Image Sizes', 'education-mind' ) . '</strong><br/>';
			$content .= esc_html__( 'Slider Image:', 'education-mind' ) . ' 1900px X 800px';
		}

		return $content;

	}

endif;

add_filter( 'admin_post_thumbnail_html', 'education_mind_featured_image_instruction', 10, 2 );

if ( ! function_exists( 'education_mind_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function education_mind_custom_content_width() {

		global $content_width;

		$global_layout = education_mind_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_mind_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
				$content_width = 570;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}

	}
endif;

add_filter( 'template_redirect', 'education_mind_custom_content_width' );
