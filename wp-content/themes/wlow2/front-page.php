<?php
/**
 * @package wlow
 */
 get_header();


	/* Cover
	-----------------------------*/

  get_template_part( 'sections/home-cover' );

	/* End Cover
	-----------------------------*/


	/* Focus
	-----------------------------*/

	get_template_part( 'sections/home-focus' );

	/* End Focus
	-----------------------------*/


	/* Parallax & Panel
	-----------------------------*/

	$template_pages = new WP_Query( array(
		'post_type'			=> 'page',
		'no_found_rows' 	=> true,
		'post_status'   	=> 'publish',
		'orderby' => 'menu_order',
	  'order' => 'ASC',
        'meta_query' => array(
	        	'relation' => 'OR',
            array(
                'key' => '_wp_page_template',
                'value' => 'page-templates/page-parallax.php',
            ),
            array(
                'key' => '_wp_page_template',
                'value' => 'page-templates/page-panel-right.php',
            ),
            array(
                'key' => '_wp_page_template',
                'value' => 'page-templates/page-panel-left.php',
            )
        )
	) );

	if ($template_pages->have_posts()) : while($template_pages->have_posts()) : $template_pages->the_post();


	  /* template switch
	  ---------------------*/

		$template = get_page_template_slug( get_the_ID() );


			/* parallax */

			if($template == 'page-templates/page-parallax.php'){

				get_template_part( 'sections/home-parallax' );

			/* panel right */

			} else if($template == 'page-templates/page-panel-right.php'){

				get_template_part( 'sections/home-panel-right' );

			/* panel left */

			} else if($template == 'page-templates/page-panel-left.php'){

				get_template_part( 'sections/home-panel-left' );

			}


	endwhile; endif;

	/* End Parallax & Panel
	-----------------------------*/


	/* Latest News
	-----------------------------*/

	$wlow_latest_news_hide = get_theme_mod('wlow__home__latest-news__hide', false);

	if( isset($wlow_latest_news_hide) && $wlow_latest_news_hide!= true ) {

		get_template_part( 'sections/home-latest-news' );

	}

	/* End Latest News
	-----------------------------*/


get_footer(); ?>
