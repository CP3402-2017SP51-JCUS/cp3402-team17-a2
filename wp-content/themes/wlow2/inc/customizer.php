<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 */

/* ------------------------------------------------------------------------- *
 *  Theme Options
/* ------------------------------------------------------------------------- */

function wlow_register_theme_customizer( $wp_customize ) {


	/* Start Panel */
	$wp_customize->add_panel('wlow__home',
      array(
          'title' => __('Home Page', 'wlow' ),
          'priority' => 31,
          )
      );
			/* Cover */
      $wp_customize->add_section( 'wlow__home__cover',
          array(
              'title' => __('Cover', 'wlow' ),
              'priority' => 1,
              'panel' => 'wlow__home'
              )
          );

					/* Title */
          $wp_customize->add_setting('wlow__home__cover__title', array('default' => __('The Amazing Parallax Theme', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__cover__title', array(
              'label' => __( 'Title', 'wlow' ),
              'section' => 'wlow__home__cover',
              'type' => 'text',
              )
          );
					/* Subtitle */
          $wp_customize->add_setting('wlow__home__cover__subtitle', array('default' => __('With awesome navigation, Desktop & Mobile', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__cover__subtitle', array(
              'label' => __('Subtitle', 'wlow' ),
              'section' => 'wlow__home__cover',
              'type' => 'text',
              )
          );
					/* Button */
          $wp_customize->add_setting('wlow__home__cover__button-label', array('default' => __('See the features', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__cover__button-label', array(
              'label' => __('Button Label', 'wlow' ),
              'section' => 'wlow__home__cover',
              'type' => 'text',
              )
          );
					/* Link */
          $wp_customize->add_setting('wlow__home__cover__button-link', array('default' => esc_url( home_url( '/' ) ).'#focus', 'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__cover__button-link', array(
              'label' => __('Button Link', 'wlow' ),
              'section' => 'wlow__home__cover',
              'type' => 'text',
              )
          );
					/* Image */
					$wp_customize->add_setting('wlow__home__cover__image', array('default' => get_template_directory_uri() . '/img/demo/city.jpg','sanitize_callback' => 'wlow_sanitize_input'));
					$wp_customize->add_control(
						new WP_Customize_Image_Control(
							$wp_customize,
							'wlow_cover_image',
							array(
							    'label'    => __('Background Image', 'wlow' ),
							    'settings' => 'wlow__home__cover__image',
							    'section'  => 'wlow__home__cover'
							)
						)
					);
					
			/* One Page */
      $wp_customize->add_section( 'wlow__home__onepage',
          array(
              'title' => __('One Page Mode', 'wlow' ),
              'description' => __('<strong>	This mode remove the links and buttons</strong> in Focus, Parallax and Side Panels.', 'wlow' ),
              'priority' => 6,
              'panel' => 'wlow__home'
              )
          );

					/* Hide */
					$wp_customize->add_setting('wlow__home__onepage__on', array( 'default' => false,'sanitize_callback' => 'wlow_sanitize_checkbox'));
					$wp_customize->add_control('wlow__home__onepage__on', array(
							'label'     => __('Activate One Page Mode', 'wlow' ),
							'section'   => 'wlow__home__onepage',
							'type'      => 'checkbox'
						)
					);

			/* Icons */
			$wp_customize->add_section( 'wlow__home__icons',
          array(
              'title' => __('Icons', 'wlow' ),
              'description' => __('Select the icons and links. See http://fontawesome.io/icons/ for full list of supported icons.', 'wlow' ),
              'priority' => 5,
              'panel' => 'wlow__home'
              )
          );
					/* Icon 1 */
          $wp_customize->add_setting('wlow__home__icons_1', array('default' => __('fa-rss', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__icons_1', array(
              'label' => __('Icon 1', 'wlow' ),
              'section' => 'wlow__home__icons',
              'type' => 'text',
              )
          );
          $wp_customize->add_setting('wlow__home__link_1', array('default' => __('#', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__link_1', array(
              'label' => __('Link 1', 'wlow' ),
              'section' => 'wlow__home__icons',
              'type' => 'text',
              )
          );

					/* Icon 2 */
					$wp_customize->add_setting('wlow__home__icons_2', array('default' => __('fa-map-marker', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__icons_2', array(
              'label' => __('Icon 2', 'wlow' ),
              'section' => 'wlow__home__icons',
              'type' => 'text',
              )
          );
          $wp_customize->add_setting('wlow__home__link_2', array('default' => __('#', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__link_2', array(
              'label' => __('Link 2', 'wlow' ),
              'section' => 'wlow__home__icons',
              'type' => 'text',
              )
          );

					/* Icon 3 */
					$wp_customize->add_setting('wlow__home__icons_3', array('default' => __('fa-envelope', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__icons_3', array(
              'label' => __('Icon 3', 'wlow' ),
              'section' => 'wlow__home__icons',
              'type' => 'text',
              )
          );
          $wp_customize->add_setting('wlow__home__link_3', array('default' => __('#', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__link_3', array(
              'label' => __('Link 3', 'wlow' ),
              'section' => 'wlow__home__icons',
              'type' => 'text',
              )
          );

					/* Icon 4 */
					$wp_customize->add_setting('wlow__home__icons_4', array('default' => __('fa-phone', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__icons_4', array(
              'label' => __('Icon 4', 'wlow' ),
              'section' => 'wlow__home__icons',
              'type' => 'text',
              )
          );
          $wp_customize->add_setting('wlow__home__link_4', array('default' => __('#', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__link_4', array(
              'label' => __('Link 4', 'wlow' ),
              'section' => 'wlow__home__icons',
              'type' => 'text',
              )
          );


			/* Latest News */
			$wp_customize->add_section( 'wlow__home__latest-news',
          array(
              'title' => __('Latest News', 'wlow' ),
              'priority' => 5,
              'panel' => 'wlow__home'
              )
          );
          $wp_customize->add_setting('wlow__home__latest-news__title', array('default' => __('News', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__latest-news__title', array(
              'label' => __('Title', 'wlow' ),
              'section' => 'wlow__home__latest-news',
              'type' => 'text',
              )
          );

          $wp_customize->add_setting('wlow__home__latest-news__subtitle', array('default' => __('Our Latest News', 'wlow' ),'sanitize_callback' => 'sanitize_text_field'));
          $wp_customize->add_control('wlow__home__latest-news__subtitle', array(
              'label' => __('Subtitle', 'wlow' ),
              'section' => 'wlow__home__latest-news',
              'type' => 'text',
              )
          );

					$wp_customize->add_setting('wlow__home__latest-news__hide', array( 'default' => false,'sanitize_callback' => 'wlow_sanitize_checkbox'));
					$wp_customize->add_control('wlow__home__latest-news__hide', array(
							'label'     => __('Hide latest news section?', 'wlow' ),
							'section'   => 'wlow__home__latest-news',
							'type'      => 'checkbox'
						)
					);


} // end wlow_register_theme_customizer

add_action( 'customize_register', 'wlow_register_theme_customizer' );


/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param      string    $input    The string to sanitize
 * @return     string              The sanitized string
 * @package    fb
 * @since      0.5.0
 * @version    1.0.2
 */
function wlow_sanitize_input( $input ) {
	return strip_tags( stripslashes( $input ) );
} // end wlow_sanitize_input

function wlow_sanitize_checkbox( $input ){
	return ( isset( $input ) && true == $input ? true : false );
}


/* Customizer script */
function wlow_registers() {

	wp_enqueue_script( 'wlow_customizer_script', get_template_directory_uri() . '/js/wlow-customizer.js', array("jquery"), '20120206', true  );

}
add_action( 'customize_controls_enqueue_scripts', 'wlow_registers' );

?>
