<?php
/**
 * Template for Page Builder
 *
 * Template name: Page Builder
 *
 * @package Education_Mind
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
endif;

get_footer();
