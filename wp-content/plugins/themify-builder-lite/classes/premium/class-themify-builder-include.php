<?php
/**
 * @package    Themify_Builder
 * @subpackage Themify_Builder/classes
 */

class Themify_Builder_Include {

        
	public static $inview_selectors;
	public static $new_selectors;
        

	/**
	 * Constructor.
	 * 
	 * @param object Themify_Builder $builder 
	 */
	public function __construct( Themify_Builder $builder ) {
           
            add_filter('themify_builder_animation_settings_fields',array($this,'animation_fields'),10,2);
            add_action('admin_init', array($this,'welcomce_page'),11);
            add_filter('all_plugins', array($this,'change_plugin_data'),11,1);
            // Parallax Element Scrolling - Module
            add_filter( 'themify_builder_animation_settings_fields', array( $this, 'parallax_elements_fields' ), 10 );

            // Parallax Element Scrolling - Row
            add_filter( 'themify_builder_row_fields_animation', array( $this, 'parallax_elements_fields' ), 10 );
            
            add_filter('themify_builder_row_fields_styling',array($this,'row_styling_fields'),10,1);
            add_filter('themify_builder_row_lightbox_form_settings',array($this,'row_animation'),10,1);
            add_filter('themify_builder_column_fields',array($this,'column_styling_fields'),10,1);
            add_filter('themify_builder_admin_bar_menu_single_page',array($this,'admin_bar_menu'),10,1);
            add_filter('themify_builder_settings_tab_array',array($this,'settings_tabs'),10,1);
          
	}
        
        
	/**
	 * Add module parallax scrolling fields to Styling Tab module settings.
	 * 
	 * @access public
	 * @param array $fields 
	 * @return array
	 */
	public function parallax_elements_fields( $fields ) {
                $is_premium = Themify_Builder_Model::is_premium();
		$new_fields = array(
			array(
				'id' => 'separator_parallax',
				'type' => 'separator',
				'meta' => array('html'=>'<hr><h4>'.__('Parallax Scrolling', 'themify').'</h4>'),
			),
			array(
				'id' => 'custom_parallax_scroll_speed',
				'type' => 'select',
				'label' => __( 'Scroll Speed', 'themify' ),
				'meta'  => array(
					array('value' => '',   'name' => '', 'selected' => true),
					array('value' => 1,   'name' => 1),
					array('value' => 2, 'name' => 2),
					array('value' => 3,  'name' => 3),
					array('value' => 4,  'name' => 4),
					array('value' => 5,   'name' => 5),
					array('value' => 6, 'name' => 6),
					array('value' => 7,  'name' => 7),
					array('value' => 8,  'name' => 8),
					array('value' => 9,  'name' => 9),
					array('value' => 10,  'name' => 10)
				),
				'description' => sprintf( '<small>%s <br>%s</small>', esc_html__( '1 = slow, 10 = very fast', 'themify' ), esc_html__( 'Produce parallax scrolling effect by selecting different scroll speed', 'themify' ) ),
                                'wrap_with_class' => !$is_premium?'themify_builder_lite':''
			),
			array(
				'id' => 'custom_parallax_scroll_reverse',
				'type' => 'checkbox',
				'label' => '',
				'options' => array(
					array( 'name' => 'reverse', 'value' => __('Reverse scrolling', 'themify')),
				),
                                'wrap_with_class' => !$is_premium?'themify_builder_lite':''
			),
			array(
				'id' => 'custom_parallax_scroll_zindex',
				'type' => 'text',
				'label' => __( 'Z-Index', 'themify' ),
				'class' => 'xsmall',
				'description' => sprintf( '%s <br>%s', esc_html__( 'Stack Order', 'themify' ), esc_html__( 'Module with greater stack order is always in front of an module with a lower stack order', 'themify' ) ),
                                'wrap_with_class' => !$is_premium?'themify_builder_lite':''
			),
                        
		);
		return array_merge( $fields, $new_fields );
	}

        
        
        public function row_styling_fields($fields){
            
            // Image size
            $image_size = themify_get_image_sizes_list( true );
            unset( $image_size[ key( $image_size ) ] );
            $is_premium = Themify_Builder_Model::is_premium();
            
            $props = array(
                    // Background
                    array(
                            'id' => 'separator_image_background',
                            'title' => '',
                            'description' => '',
                            'type' => 'separator',
                            'meta' => array('html' => '<h4>' . __('Background', 'themify') . '</h4>'),
                    ),
                    array(
                            'id' => 'background_type',
                            'label' => __('Background Type', 'themify'),
                            'type' => 'radio',
                            'meta' => array(
                                    array('value' => 'image', 'name' => __('Image', 'themify')),
                                    array('value' => 'gradient', 'name' => __('Gradient', 'themify'),'disable'=>!$is_premium),
                                    array('value' => 'video', 'name' => __('Video', 'themify'),'disable'=>!$is_premium),
                                    array('value' => 'slider', 'name' => __('Slider', 'themify'),'disable'=>!$is_premium),
                            ),
                            'option_js' => true,
                            'wrap_with_class' => 'responsive-na'.(!$is_premium?' themify_builder_lite hide_opacity':'')
                    ),
                    // Background Slider
                    array(
                            'id' => 'background_slider',
                            'type' => 'textarea',
                            'label' => __('Background Slider', 'themify'),
                            'class' => 'tf-hide tf-shortcode-input',
                            'wrap_with_class' => 'tf-group-element tf-group-element-slider responsive-na',
                            'description' => sprintf('<a href="#" class="builder_button tf-gallery-btn">%s</a>', __('Insert Gallery', 'themify'))
                    ),
                     // Background Slider Image Size
                    array(
                            'id' => 'background_slider_size',
                            'label' => __('Image Size', 'themify'),
                            'type' => 'select',
                            'default' => '',
                            'meta' => $image_size,
                            'wrap_with_class' => 'tf-group-element tf-group-element-slider responsive-na',
                    ),
                    // Background Slider Mode
                    array(
                            'id' => 'background_slider_mode',
                            'label' => __('Background Slider Mode', 'themify'),
                            'type' => 'select',
                            'default' => '',
                            'meta' => array(
                                    array('value' => 'best-fit', 'name' => __('Best Fit', 'themify')),
                                    array('value' => 'fullcover', 'name' => __('Fullcover', 'themify')),
                            ),
                            'wrap_with_class' => 'tf-group-element tf-group-element-slider responsive-na',
                    ),
                    // Video Background
                    array(
                            'id' => 'background_video',
                            'type' => 'video',
                            'label' => __('Background Video', 'themify'),
                            'description' => __('Insert video URL (mp4, YouTube, or Vimeo). Note: video background does not work on mobile, background image will be used as fallback.', 'themify'),
                            'class' => 'xlarge',
                            'wrap_with_class' => 'tf-group-element tf-group-element-video responsive-na'
                    ),
                    array(
                            'id' => 'background_video_options',
                            'type' => 'checkbox',
                            'label' => '',
                            'default' => array(),
                            'options' => array(
                                    array('name' => 'unloop', 'value' => __('Disable looping <small>(mp4 only)</small>', 'themify')),
                                    array('name' => 'mute', 'value' => __('Disable audio <small>(mp4 only)</small>', 'themify')),
                            ),
                            'wrap_with_class' => 'tf-group-element tf-group-element-video responsive-na',
                    ),
                    // Background Image
                    array(
                            'id' => 'background_image',
                            'type' => 'image',
                            'label' => __('Background Image', 'themify'),
                            'class' => 'xlarge',
                            'wrap_with_class' => 'tf-group-element tf-group-element-image tf-group-element-slider tf-group-element-video',
                    ),
                    array(
                            'id' => 'background_gradient',
                            'type' => 'gradient',
                            'label' => __('Background Gradient', 'themify'),
                            'class' => 'xlarge',
                            'wrap_with_class' => 'tf-group-element tf-group-element-gradient'
                    ),
                    // Background repeat
                    array(
                            'id' => 'background_repeat',
                            'label' =>'',
                            'type' => 'select',
                            'default' => '',
                            'description'=>__('Background Mode', 'themify'),
                            'meta' => array(
                                    array('value' => 'repeat', 'name' => __('Repeat All', 'themify')),
                                    array('value' => 'repeat-x', 'name' => __('Repeat Horizontally', 'themify')),
                                    array('value' => 'repeat-y', 'name' => __('Repeat Vertically', 'themify')),
                                    array('value' => 'repeat-none', 'name' => __('Do not repeat', 'themify')),
                                    array('value' => 'fullcover', 'name' => __('Fullcover', 'themify')),
                                    array('value' => 'best-fit-image', 'name' => __('Best Fit', 'themify')),
                                    array('value' => 'builder-parallax-scrolling', 'name' => __('Parallax Scrolling', 'themify'),'disable'=>'disable')
                            ),
                            'wrap_with_class' => 'tf-group-element tf-group-element-image responsive-na',
                    ),
                    // Background Zoom
                    array(
                            'id' => 'background_zoom',
                            'label' => '',
                            'type' => 'checkbox',
                            'default' => '',
                            'options' => array(
                                    array('value' => __('Zoom background image on hover', 'themify'), 'name' => 'zoom')
                            ),
                            'wrap_with_class' => 'tf-group-element tf-group-element-image responsive-na',
                    ),
                    // Background position
                    array(
                            'id' => 'background_position',
                            'label' => '',
                            'type' => 'select',
                            'default' => '',
                            'description'=>__('Background Position', 'themify'),
                            'meta' => array(
                                    array('value' => 'left-top', 'name' => __('Left Top', 'themify')),
                                    array('value' => 'left-center', 'name' => __('Left Center', 'themify')),
                                    array('value' => 'left-bottom', 'name' => __('Left Bottom', 'themify')),
                                    array('value' => 'right-top', 'name' => __('Right top', 'themify')),
                                    array('value' => 'right-center', 'name' => __('Right Center', 'themify')),
                                    array('value' => 'right-bottom', 'name' => __('Right Bottom', 'themify')),
                                    array('value' => 'center-top', 'name' => __('Center Top', 'themify')),
                                    array('value' => 'center-center', 'name' => __('Center Center', 'themify')),
                                    array('value' => 'center-bottom', 'name' => __('Center Bottom', 'themify'))
                            ),
                            'wrap_with_class' => 'tf-group-element tf-group-element-image responsive-na',
                    ),
                    // Background Color
                    array(
                            'id' => 'background_color',
                            'type' => 'color',
                            'label' => __('Background Color', 'themify'),
                            'class' => 'small',
                            'wrap_with_class' => 'tf-group-element tf-group-element-image tf-group-element-video tf-group-element-slider',
                    ),
                    // Overlay Color
                    array(
                            'id' => 'separator_cover',
                            'title' => '',
                            'description' => '',
                            'type' => 'separator',
                            'meta' => array('html' => '<h4 class="responsive-na">' . __('Row Overlay', 'themify') . '</h4>'),
                    ),
                    array(
                            'id' => 'cover_color-type',
                            'label' =>__('Overlay','themify'),
                            'type' => 'radio',
                            'meta' => array(
                                    array('value' => 'color', 'name' => __('Color', 'themify')),
                                    array('value' => 'cover_gradient', 'name' => __('Gradient', 'themify'))
                            ),
                            'default'=>'color',
                            'option_js' => true,
                            'wrap_with_class' => 'responsive-na tf-overlay-element'.(!$is_premium?' themify_builder_lite':'')
                    ),
                    array(
                            'id' => 'cover_color',
                            'type' => 'color',
                            'label' =>'',
                            'class' => 'small',
                            'wrap_with_class' => 'responsive-na tf-group-element tf-group-element-color'.(!$is_premium?' themify_builder_lite':'')
                    ),
                    array(
                            'id' => 'cover_gradient',
                            'type' => 'gradient',
                            'label' =>'',
                            'wrap_with_class' => 'responsive-na tf-group-element tf-group-element-cover_gradient'.(!$is_premium?' themify_builder_lite':'')
                    ),
                    array(
                            'id' => 'cover_color_hover-type',
                            'label' =>__('Overlay Hover', 'themify'),
                            'type' => 'radio',
                            'meta' => array(
                                    array('value' => 'hover_color', 'name' => __('Color', 'themify')),
                                    array('value' => 'hover_gradient', 'name' => __('Gradient', 'themify'))
                            ),
                            'default'=>'hover_color',
                            'option_js' => true,
                            'wrap_with_class' => 'responsive-na tf-overlay-element'.(!$is_premium?' themify_builder_lite':'')
                    ),
                    array(
                            'id' => 'cover_color_hover',
                            'type' => 'color',
                            'label' => '',
                            'class' => 'small',
                            'wrap_with_class' => 'responsive-na tf-group-element tf-group-element-hover_color'.(!$is_premium?' themify_builder_lite':'')
                    ),
                    array(
                            'id' => 'cover_gradient_hover',
                            'type' => 'gradient',
                            'label' =>'',
                            'wrap_with_class' => 'responsive-na tf-group-element tf-group-element-hover_gradient'.(!$is_premium?' themify_builder_lite':'')
                    ),
                    array(
                            'type' => 'separator',
                            'meta' => array('html' => '<hr />')
                    ),
            );
            $props = array_reverse($props);
            foreach($props as $p){
                array_unshift($fields, $p);
            }
            
            return $fields;
        }
        
        public function row_animation($settings){
            $row_fields_animation = apply_filters('themify_builder_row_fields_animation', array(
                    array(
                            'type' => 'separator',
                            'meta' => array( 'html' => '<h4>' . esc_html__( 'Appearance Animation', 'themify' ) . '</h4>')
                    ),
                    // Animation
                    array(
                            'id' => 'multi_Animation Effect',
                            'type' => 'multi',
                            'label' => __('Effect', 'themify'),
                            'fields' => array(
                                    array(
                                            'id' => 'animation_effect',
                                            'type' => 'animation_select',
                                            'label' => __('Effect', 'themify')
                                    ),
                                    array(
                                            'id' => 'animation_effect_delay',
                                            'type' => 'text',
                                            'label' => __('Delay', 'themify'),
                                            'class' => 'xsmall',
                                            'description' => __('Delay (s)', 'themify'),
                                    ),
                                    array(
                                            'id' => 'animation_effect_repeat',
                                            'type' => 'text',
                                            'label' => __('Repeat', 'themify'),
                                            'class' => 'xsmall',
                                            'description' => __('Repeat (x)', 'themify'),
                                    ),
                            ),
                            'wrap_with_class' => !Themify_Builder_Model::is_premium()?'themify_builder_lite':''
                    )
            ));
            $settings['animation'] = array(
                    'name' => esc_html__( 'Animation', 'themify' ),
                    'options' => $row_fields_animation
            );
            return $settings;
        }
        
        public function column_styling_fields($fields){
            $is_premium = Themify_Builder_Model::is_premium();
            // Image size
            $image_size = themify_get_image_sizes_list( true );
            unset( $image_size[ key( $image_size ) ] );

            $props = array(
                // Background
                array(
                        'id' => 'separator_image_background',
                        'title' => '',
                        'description' => '',
                        'type' => 'separator',
                        'meta' => array('html' => '<h4>' . __('Background', 'themify') . '</h4>'),
                ),
                array(
                        'id' => 'background_type',
                        'label' => __('Background Type', 'themify'),
                        'type' => 'radio',
                        'meta' => array(
                                array('value' => 'image', 'name' => __('Image', 'themify')),
                                array('value' => 'gradient', 'name' => __('Gradient', 'themify'),'disable'=>!$is_premium),
                                array('value' => 'video', 'name' => __('Video', 'themify'),'disable'=>!$is_premium),
                                array('value' => 'slider', 'name' => __('Slider', 'themify'),'disable'=>!$is_premium),
                        ),
                        'option_js' => true,
                        'wrap_with_class' => 'responsive-na'.(!$is_premium?' themify_builder_lite hide_opacity':'')
                ),
                // Background Slider
                array(
                        'id' => 'background_slider',
                        'type' => 'textarea',
                        'label' => __('Background Slider', 'themify'),
                        'class' => 'tf-hide tf-shortcode-input',
                        'wrap_with_class' => 'tf-group-element tf-group-element-slider responsive-na',
                        'description' => sprintf('<a href="#" class="builder_button tf-gallery-btn">%s</a>', __('Insert Gallery', 'themify'))
                ),
                // Background Slider Image Size
                array(
                        'id' => 'background_slider_size',
                        'label' => __('Image Size', 'themify'),
                        'type' => 'select',
                        'default' => '',
                        'meta' => $image_size,
                        'wrap_with_class' => 'tf-group-element tf-group-element-slider responsive-na',
                ),
                // Background Slider Mode
                array(
                        'id' => 'background_slider_mode',
                        'label' => __('Background Slider Mode', 'themify'),
                        'type' => 'select',
                        'default' => '',
                        'meta' => array(
                                array('value' => 'best-fit', 'name' => __('Best Fit', 'themify')),
                                array('value' => 'fullcover', 'name' => __('Fullcover', 'themify')),
                        ),
                        'wrap_with_class' => 'tf-group-element tf-group-element-slider responsive-na',
                ),
                // Video Background
                array(
                        'id' => 'background_video',
                        'type' => 'video',
                        'label' => __('Background Video', 'themify'),
                        'description' => __('Video format: mp4. Note: video background does not play on mobile, background image will be used as fallback.', 'themify'),
                        'class' => 'xlarge',
                        'wrap_with_class' => 'tf-group-element tf-group-element-video responsive-na'
                ),
                array(
                        'id' => 'background_video_options',
                        'type' => 'checkbox',
                        'label' => '',
                        'default' => array(),
                        'options' => array(
                                array('name' => 'unloop', 'value' => __('Disable looping', 'themify')),
                                array('name' => 'mute', 'value' => __('Disable audio', 'themify')),
                        ),
                        'wrap_with_class' => 'tf-group-element tf-group-element-video responsive-na',
                ),
                // Background Image
                array(
                        'id' => 'background_image',
                        'type' => 'image',
                        'label' => __('Background Image', 'themify'),
                        'class' => 'xlarge',
                        'wrap_with_class' => 'tf-group-element tf-group-element-image tf-group-element-video',
                ),
                array(
                        'id' => 'background_gradient',
                        'type' => 'gradient',
                        'label' => __('Background Gradient', 'themify'),
                        'class' => 'xlarge',
                        'wrap_with_class' => 'tf-group-element tf-group-element-gradient'
                ),
                // Background repeat
                array(
                        'id' => 'background_repeat',
                        'label' => '',
                        'type' => 'select',
                        'default' => '',
                        'description'=>__('Background Mode', 'themify'),
                        'meta' => array(
                                array('value' => 'repeat', 'name' => __('Repeat All', 'themify')),
                                array('value' => 'repeat-x', 'name' => __('Repeat Horizontally', 'themify')),
                                array('value' => 'repeat-y', 'name' => __('Repeat Vertically', 'themify')),
                                array('value' => 'repeat-none', 'name' => __('Do not repeat', 'themify')),
                                array('value' => 'fullcover', 'name' => __('Fullcover', 'themify')),
                                array('value' => 'builder-parallax-scrolling', 'name' => __('Parallax Scrolling', 'themify'),'disable'=>'disable')
                        ),
                        'wrap_with_class' => 'tf-group-element tf-group-element-image responsive-na',
                ),
                // Background Zoom
                array(
                        'id' => 'background_zoom',
                        'label' => '',
                        'type' => 'checkbox',
                        'default' => '',
                        'options' => array(
                                array('value' => __('Zoom background image on hover', 'themify'), 'name' => 'zoom')
                        ),
                        'wrap_with_class' => 'tf-group-element tf-group-element-image responsive-na',
                ),
                // Background position
                array(
                        'id' => 'background_position',
                        'label' => '',
                        'type' => 'select',
                        'default' => '',
                         'description'=>__('Background Position', 'themify'),
                        'meta' => array(
                                array('value' => 'left-top', 'name' => __('Left Top', 'themify')),
                                array('value' => 'left-center', 'name' => __('Left Center', 'themify')),
                                array('value' => 'left-bottom', 'name' => __('Left Bottom', 'themify')),
                                array('value' => 'right-top', 'name' => __('Right top', 'themify')),
                                array('value' => 'right-center', 'name' => __('Right Center', 'themify')),
                                array('value' => 'right-bottom', 'name' => __('Right Bottom', 'themify')),
                                array('value' => 'center-top', 'name' => __('Center Top', 'themify')),
                                array('value' => 'center-center', 'name' => __('Center Center', 'themify')),
                                array('value' => 'center-bottom', 'name' => __('Center Bottom', 'themify'))
                        ),
                        'wrap_with_class' => 'tf-group-element tf-group-element-image responsive-na',
                ),
                // Background Color
                array(
                        'id' => 'background_color',
                        'type' => 'color',
                        'label' => __('Background Color', 'themify'),
                        'class' => 'small',
                        'wrap_with_class' => 'tf-group-element tf-group-element-image tf-group-element-slider tf-group-element-video',
                ),
                // Overlay Color
                array(
                        'id' => 'separator_cover',
                        'title' => '',
                        'description' => '',
                        'type' => 'separator',
                        'meta' => array('html' => '<h4 class="responsive-na">' . __('Column Overlay', 'themify') . '</h4>'),
                ),
                array(
                        'id' => 'cover_color-type',
                        'label' => __('Overlay', 'themify'),
                        'type' => 'radio',
                        'meta' => array(
                                array('value' => 'color', 'name' => __('Color', 'themify')),
                                array('value' => 'cover_gradient', 'name' => __('Gradient', 'themify'))
                        ),
                        'default'=>'color',
                        'option_js' => true,
                        'wrap_with_class' => 'responsive-na tf-overlay-element'.(!$is_premium?' themify_builder_lite':'')
                ),
                array(
                        'id' => 'cover_color',
                        'type' => 'color',
                        'label' => '',
                        'class' => 'small',
                        'wrap_with_class' => 'responsive-na tf-group-element tf-group-element-color'.(!$is_premium?' themify_builder_lite':'')
                ),
                array(
                        'id' => 'cover_gradient',
                        'type' => 'gradient',
                        'label' =>'',
                        'wrap_with_class' => 'responsive-na tf-group-element tf-group-element-cover_gradient'.(!$is_premium?' themify_builder_lite':'')
                ),
                array(
                        'id' => 'cover_color_hover-type',
                        'label' => __('Overlay Hover', 'themify'),
                        'type' => 'radio',
                        'meta' => array(
                                array('value' => 'hover_color', 'name' => __('Color', 'themify')),
                                array('value' => 'hover_gradient', 'name' => __('Gradient', 'themify'))
                        ),
                        'default'=>'hover_color',
                        'option_js' => true,
                        'wrap_with_class' => 'responsive-na tf-overlay-element'.(!$is_premium?' themify_builder_lite':'')
                ),
                array(
                        'id' => 'cover_color_hover',
                        'type' => 'color',
                        'label' => '',
                        'class' => 'small',
                        'wrap_with_class' => 'responsive-na tf-group-element tf-group-element-hover_color'.(!$is_premium?' themify_builder_lite':'')
                ),
                array(
                        'id' => 'cover_gradient_hover',
                        'type' => 'gradient',
                        'label' =>'',
                        'wrap_with_class' => 'responsive-na tf-group-element tf-group-element-hover_gradient'.(!$is_premium?' themify_builder_lite':'')
                ),
                array(
                        'type' => 'separator',
                        'meta' => array('html' => '<hr />')
                ),
            );
            $props = array_reverse($props);
            foreach($props as $p){
                array_unshift($fields, $p);
            }
            
            return $fields;
        }
        
        public function admin_bar_menu($menu){
            $layouts = array( 
                        array(
                                'id' => 'layout_themify_builder',
                                'parent' => 'themify_builder',
                                'title' => __('Layouts', 'themify'),
                                'href' => '#',
                                'meta' => array('class' => 'themify_builder_lite')
                        ),
                        // Sub Menu
                        array(
                                'id' => 'load_layout_themify_builder',
                                'parent' => 'layout_themify_builder',
                                'title' => __('Load Layout', 'themify'),
                                'href' => '#',
                                'meta' => array('class' => 'themify_builder_load_layout themify_builder_lite')
                        ),
                        array(
                                'id' => 'save_layout_themify_builder',
                                'parent' => 'layout_themify_builder',
                                'title' => __('Save as Layout', 'themify'),
                                'href' => '#',
                                'meta' => array('class' => 'themify_builder_save_layout themify_builder_lite')
                        ),
                );
            
            return array_merge($menu, $layouts);
        }
        
        
        
        public  function animation_fields($animation,$module){
            foreach($animation as &$an){
                $an['wrap_with_class'] = 'themify_builder_lite';
            }
            return $animation;
        }
        
        public static function upgrade(){
            
        }
        
        public function welcomce_page(){
            
            if (!get_transient('themify_builder_welcome_page')) {
                return;
            }
            delete_transient('themify_builder_welcome_page');

            if (!is_network_admin() && !isset($_GET['activate-multi'])) {
                wp_safe_redirect(add_query_arg(array('page' => 'themify-builder','tab'=>'builder_upgrade'), admin_url('admin.php')));
            }
        }
		
        public function settings_tabs($tabs){
                $tabs['builder_upgrade'] = __('About','themify');
                unset($tabs['builder_settings']);
                return $tabs;
        }
        
        public function change_plugin_data($plugins){
            $screen = get_current_screen();
            if($screen->id==='plugins' && !empty($plugins[THEMIFY_BUILDER_SLUG])){
                $plugins[THEMIFY_BUILDER_SLUG]['Title'] = $plugins[THEMIFY_BUILDER_SLUG]['Name'] = __('Themify Builder Lite','wpf');
                $plugins[THEMIFY_BUILDER_SLUG]['Description'] = __('Free/lite version of Themify Builder plugin. Build responsive layouts that work for desktop, tablets, and mobile using intuitive "what you see is what you get" drag & drop framework with live edits and previews.','wpf');
            }
            return $plugins;
        }
    }