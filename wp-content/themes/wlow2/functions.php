<?php
/**
 * @package wlow
 */


/* ------------------------------------------------------------------------- *
 *  Include Functional File
/* ------------------------------------------------------------------------- */


	require_once('functions/wlow_bootstrap_navwalker.php');   	// script for bootstrap menu

	require get_template_directory() . '/inc/customizer.php';   // customizer additions


/* ------------------------------------------------------------------------- *
 *  Base functionality
/* ------------------------------------------------------------------------- */


	// Content width
	if ( !isset( $content_width ) ) { $content_width = 1400; }


/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'wlow_setup' ) ) {

	function wlow_setup() {

		add_theme_support( "title-tag" );

		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );

		// Enable featured image
		add_theme_support( 'post-thumbnails' );

		// Thumbnail sizes
		add_image_size( 'wlow_single', 800, 9999); //(cropped)
		add_image_size( 'wlow_big', 1400, 928, true ); 	//(cropped)
		add_image_size( 'wlow_square', 400, 400, true ); 	//(cropped)

		// Custom menu areas
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'wlow' ),
			'top-bar' => esc_html__( 'Top Bar', 'wlow' )
		) );

		// Load theme languages
		load_theme_textdomain( 'wlow', get_template_directory().'/languages' );

	}

}
add_action( 'after_setup_theme', 'wlow_setup' );


/* Default top bar menu
/* ------------------------------------ */
function wlow_top_bar_menu_cb() {
		echo '<ul><li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li></ul>';
};


/* Add new Image size in media uploader
/* ------------------------------------ */
function wlow_show_image_sizes($sizes) {

	$addsizes = array(
		"wlow_square" => __( 'Square', 'wlow'),
		"wlow_big" => __( 'Big', 'wlow'),

	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;

}
add_filter('image_size_names_choose', 'wlow_show_image_sizes');


/*  Register sidebars
/* ------------------------------------ */
if ( ! function_exists( 'wlow_sidebars' ) ) {

	function wlow_sidebars()	{
		register_sidebar(array( 'name' => esc_html__( 'Primary', 'wlow' ),'id' => 'primary','description' => esc_html__( 'Normal full width sidebar.', 'wlow' ), 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));

	}

}
add_action( 'widgets_init', 'wlow_sidebars' );


/*  Enqueue javascript
/* ------------------------------------ */
if ( ! function_exists( 'wlow_scripts' ) ) {

	function wlow_scripts() {

		// all script
		wp_enqueue_script( 'wlow-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ),null,true );
		wp_enqueue_script( 'wlow-magnificpopup-js', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ),null,true );
		wp_enqueue_script( 'wlow-jquerymobile', get_template_directory_uri() . '/js/jquery.mobile.touch.min.js', array( 'jquery' ),null,true );
		wp_enqueue_script( 'wlow-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ),'', true );

		// wp path url for the internal page  menu
		$array = array(
			"path_wp" => home_url().'/',
		);
	  wp_localize_script( "wlow-script", "php_vars", $array );



		// HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries
		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/html5/html5shiv.js' );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'respond', get_template_directory_uri() . '/html5/respond.min.js' );
		wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

		if ( is_singular() && get_option( 'thread_comments' ) )	{ wp_enqueue_script( 'comment-reply' ); }
	}

}
add_action( 'wp_enqueue_scripts', 'wlow_scripts' );


/*  Enqueue css
/* ------------------------------------ */
if ( ! function_exists( 'wlow_styles' ) ) {

	function wlow_styles() {
		wp_enqueue_style( 'wlow-bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css');
		wp_enqueue_style( 'wlow-fontawesome', get_template_directory_uri().'/css/font-awesome.css');
		wp_enqueue_style( 'wlow-magnificpopup-css', get_template_directory_uri().'/css/magnific-popup.css');

		if ( ! function_exists( 'wlowpro_enqueue_styles' ) ) {

			wp_enqueue_style( 'wlow-montserrat','//fonts.googleapis.com/css?family=Montserrat');

		}

		wp_enqueue_style( 'wlow', get_template_directory_uri().'/style.css');

	}

}
add_action( 'wp_enqueue_scripts', 'wlow_styles' );

/* ------------------------------------------------------------------------- *
 *  General
/* ------------------------------------------------------------------------- */

	/*  Disable Gallery Inline Style
	/* ------------------------------------ */
	add_filter( 'use_default_gallery_style', '__return_false' );

	/*  Oembed Responsive
	/* ------------------------------------ */
	add_filter( 'embed_oembed_html', 'wlow_oembed_filter', 10, 4 ) ;

	function wlow_oembed_filter($html, $url, $attr, $post_ID) {
		$return = '<figure class="video-container">'.$html.'</figure>';
		return $return;
	}

	/*  Enable hr button tiny MCE
	/* ------------------------------------ */
	function wlow_enable_more_buttons($buttons) {
	  $buttons[] = 'hr';
	  return $buttons;
	}
	add_filter("mce_buttons", "wlow_enable_more_buttons");


	/*  Remove P in description output
	/* ------------------------------------ */
	remove_filter('term_description','wpautop');


	/*  Add Excerpt on Pages for Seo description
	/* ------------------------------------ */
	add_action( 'init', 'wlow_add_excerpts_to_pages' );
	function wlow_add_excerpts_to_pages() {
	     add_post_type_support( 'page', 'excerpt' );
	}

	/* Add images to RSS Feed
	/* ------------------------------------ */
	function wlow_rss_post_thumbnail($content) {

		global $post;

		if(has_post_thumbnail($post->ID)) {

			$content = '<p>' . get_the_post_thumbnail($post->ID, 'single') . '</p>' . get_the_content();
			$content = preg_replace("/\[caption.*\[\/caption\]/", '',$content);

		}

		return $content;
	}
	add_filter('the_excerpt_rss', 'wlow_rss_post_thumbnail');
	add_filter('the_content_feed', 'wlow_rss_post_thumbnail');
