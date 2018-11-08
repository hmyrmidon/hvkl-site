<?php
/**
 * Template functions.
 *
 * @package Education_Mind
 */

if ( ! function_exists( 'education_mind_get_the_excerpt' ) ) :

	/**
	 * Fetch excerpt from the post.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length      Excerpt length.
	 * @param WP_Post $post_object WP_Post instance.
	 * @return string Excerpt content.
	 */
	function education_mind_get_the_excerpt( $length, $post_object = null ) {

		global $post;

		if ( is_null( $post_object ) ) {
			$post_object = $post;
		}

		$length = absint( $length );

		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_object->post_content;

		if ( ! empty( $post_object->post_excerpt ) ) {
			$source_content = $post_object->post_excerpt;
		}

		$source_content = strip_shortcodes( $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );

		return $trimmed_content;
	}

endif;

if ( ! function_exists( 'education_mind_breadcrumb' ) ) :

	/**
	 * Breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function education_mind_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once trailingslashit( get_template_directory() ) . 'vendors/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);

		breadcrumb_trail( $breadcrumb_args );

	}

endif;

if ( ! function_exists( 'education_mind_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 1.0.0
	 * @return string Font URL.
	 */
	function education_mind_fonts_url() {

		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'education-mind' ) ) {
			$fonts[] = 'Roboto:400italic,700italic,300,400,500,600,700';
		}

		/* translators: If there are characters in your language that are not supported by Signika, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Signika font: on or off', 'education-mind' ) ) {
			$fonts[] = 'Signika:400italic,700italic,300,400,500,600,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;

	}

endif;

if ( ! function_exists( 'education_mind_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function education_mind_primary_navigation_fallback() {
		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'education-mind' ) . '</a></li>';
		wp_list_pages( array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 5,
		) );
		echo '</ul>';
	}

endif;

if ( ! function_exists( 'education_mind_the_custom_logo' ) ) :

	/**
	 * Render logo.
	 *
	 * @since 2.0
	 */
	function education_mind_the_custom_logo() {

		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

	}

endif;

if ( ! function_exists( 'education_mind_render_select_dropdown' ) ) :

	/**
	 * Render select dropdown.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $main_args Main arguments.
	 * @param string $callback Callback method.
	 * @param array  $callback_args Callback arguments.
	 * @return string Rendered markup.
	 */
	function education_mind_render_select_dropdown( $main_args, $callback, $callback_args = array() ) {

		$defaults = array(
			'id'          => '',
			'name'        => '',
			'selected'    => 0,
			'echo'        => true,
			'add_default' => false,
		);

		$r = wp_parse_args( $main_args, $defaults );
		$output = '';
		$choices = array();

		if ( is_callable( $callback ) ) {
			$choices = call_user_func_array( $callback, $callback_args );
		}

		if ( ! empty( $choices ) || true === $r['add_default'] ) {

			$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
			if ( true === $r['add_default'] ) {
				$output .= '<option value="">' . esc_html__( 'Default', 'education-mind' ) . '</option>\n';
			}
			if ( ! empty( $choices ) ) {
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
			}
			$output .= "</select>\n";
		}

		if ( $r['echo'] ) {
			echo $output;
		}

		return $output;
	}

endif;

if ( ! function_exists( 'education_mind_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $min    Min.
	 * @param int    $max    Max.
	 * @param string $prefix Prefix.
	 * @param string $suffix Suffix.
	 * @return array Options array.
	 */
	function education_mind_get_numbers_dropdown_options( $min = 1, $max = 4, $prefix = '', $suffix = '' ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$string = $prefix . $i . $suffix;
				$output[ $i ] = $string;
			}
		}

		return $output;

	}

endif;

if ( ! function_exists( 'education_mind_message_front_page_widget_area' ) ) :

	/**
	 * Show default message in front page widget area.
	 *
	 * @since 1.0.0
	 */
	function education_mind_message_front_page_widget_area() {

		// Latest news.
		$args = array(
			'title'    => esc_html__( 'Latest News', 'education-mind' ),
			'subtitle' => esc_html__( 'Our recent activities.', 'education-mind' ),
		);

		$widget_args = array(
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			'before_widget' => '<aside class="widget education_mind_widget_latest_news"><div class="container">',
			'after_widget'  => '</div></aside>',
		);

		the_widget( 'Education_Mind_Latest_News_Widget', $args, $widget_args );
	}

endif;

if ( ! function_exists( 'education_mind_render_quick_contact' ) ) :

	/**
	 * Render quick contact.
	 *
	 * @since 1.0.0
	 */
	function education_mind_render_quick_contact() {

		$contact_number_title  = education_mind_get_option( 'contact_number_title' );
		$contact_number        = education_mind_get_option( 'contact_number' );
		$contact_email_title   = education_mind_get_option( 'contact_email_title' );
		$contact_email         = education_mind_get_option( 'contact_email' );
		$contact_address_title = education_mind_get_option( 'contact_address_title' );
		$contact_address       = education_mind_get_option( 'contact_address' );
		?>
		<div id="quick-contact">
			<ul class="quick-contact-list">
				<?php if ( ! empty( $contact_number ) ) : ?>
					<li class="quick-call">
						<?php if ( ! empty( $contact_number_title ) ) : ?>
							<strong><?php echo esc_html( $contact_number_title ); ?></strong>
						<?php endif; ?>
						<a href="<?php echo esc_url( 'tel:' . preg_replace( '/\D+/', '', $contact_number ) ); ?>"><?php echo esc_html( $contact_number ); ?></a>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $contact_email ) ) : ?>
					<li class="quick-email">
						<?php if ( ! empty( $contact_email_title ) ) : ?>
							<strong><?php echo esc_html( $contact_email_title ); ?></strong>
						<?php endif; ?>
						<a href="<?php echo esc_url( 'mailto:' . $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $contact_address ) ) : ?>
					<li class="quick-address">
						<?php if ( ! empty( $contact_address_title ) ) : ?>
							<strong><?php echo esc_html( $contact_address_title ); ?></strong>
						<?php endif; ?>
						<?php echo esc_html( $contact_address ); ?>
					</li>
				<?php endif; ?>
			</ul><!-- .quick-contact-list -->
		</div><!--  .quick-contact -->
		<?php
	}

endif;
