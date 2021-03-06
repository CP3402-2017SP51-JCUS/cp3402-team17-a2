<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Module Name: Box
 * Description: Display box content
 */
class TB_Box_Module extends Themify_Builder_Module {
	function __construct() {
		parent::__construct(array(
			'name' => __('Box', 'themify'),
			'slug' => 'box'
		));
	}

	public function get_title( $module ) {
		$text = isset( $module['mod_settings']['content_box'] ) ? $module['mod_settings']['content_box'] : '';
		$return = wp_trim_words( $text, 100 );
		return $return;
	}

	private function get_heading_margin_multi_field( $h_level = 'h1', $margin_side = 'top' ) {
		$h_level = strtolower( trim($h_level) );
		$margin_side = strtolower( trim($margin_side) );

		switch ($margin_side) {
			case 'bottom':
				$translated_description = __('bottom', 'themify'); break;
			case 'left':
				$translated_description = __('left', 'themify'); break;
			case 'right':
				$translated_description = __('right', 'themify'); break;
			case 'top':
				$translated_description = __('top', 'themify'); break;
			default:
				$translated_description = $margin_side;
		}

		return array(
			'id' => 'multi_' . $h_level . '_margin_' . $margin_side,
			'type' => 'multi',
			'label' => ('top'===$margin_side ? __('Margin', 'themify') : ''),
			'fields' => array(
				array(
					'id' => $h_level . '_margin_' . $margin_side,
					'type' => 'text',
					'class' => 'style_margin style_field xsmall',
					'prop' => 'margin-' . $margin_side,
					'selector' => '.module-box ' . $h_level,
				),
				array(
					'id' => $h_level . '_margin_' . $margin_side . '_unit',
					'type' => 'select',
					'description' => $translated_description,
					'meta' => array(
						array('value' => 'px', 'name' => __('px', 'themify')),
						array('value' => 'em', 'name' => __('em', 'themify')),
						array('value' => '%', 'name' => __('%', 'themify'))
					)
				),
			)
		);
	}

	public function get_options() {
		$options = array(
			array(
				'id' => 'mod_title_box',
				'type' => 'text',
				'label' => __('Module Title', 'themify'),
				'class' => 'large',
				'render_callback' => array(
					'binding' => 'live'
				)
			),
			array(
				'id' => 'content_box',
				'type' => 'wp_editor',
				'class' => 'fullwidth',
				'render_callback' => array(
					'binding' => 'live'
				)
			),
			array(
				'id' => 'color_box',
				'type' => 'layout',
				'label' => __('Box Color', 'themify'),
				'options' => array(
					array('img' => 'color-default.png', 'value' => 'default', 'label' => __('default', 'themify')),
					array('img' => 'color-black.png', 'value' => 'black', 'label' => __('black', 'themify')),
					array('img' => 'color-grey.png', 'value' => 'gray', 'label' => __('gray', 'themify')),
					array('img' => 'color-blue.png', 'value' => 'blue', 'label' => __('blue', 'themify')),
					array('img' => 'color-light-blue.png', 'value' => 'light-blue', 'label' => __('light-blue', 'themify')),
					array('img' => 'color-green.png', 'value' => 'green', 'label' => __('green', 'themify')),
					array('img' => 'color-light-green.png', 'value' => 'light-green', 'label' => __('light-green', 'themify')),
					array('img' => 'color-purple.png', 'value' => 'purple', 'label' => __('purple', 'themify')),
					array('img' => 'color-light-purple.png', 'value' => 'light-purple', 'label' => __('light-purple', 'themify')),
					array('img' => 'color-brown.png', 'value' => 'brown', 'label' => __('brown', 'themify')),
					array('img' => 'color-orange.png', 'value' => 'orange', 'label' => __('orange', 'themify')),
					array('img' => 'color-yellow.png', 'value' => 'yellow', 'label' => __('yellow', 'themify')),
					array('img' => 'color-red.png', 'value' => 'red', 'label' => __('red', 'themify')),
					array('img' => 'color-pink.png', 'value' => 'pink', 'label' => __('pink', 'themify'))
				),
				'bottom' => true,
				'render_callback' => array(
					'binding' => 'live'
				)
			),
			array(
				'id' => 'appearance_box',
				'type' => 'checkbox',
				'label' => __('Appearance', 'themify'),
				'options' => array(
					array( 'name' => 'rounded', 'value' => __('Rounded', 'themify')),
					array( 'name' => 'gradient', 'value' => __('Gradient', 'themify')),
					array( 'name' => 'glossy', 'value' => __('Glossy', 'themify')),
					array( 'name' => 'embossed', 'value' => __('Embossed', 'themify')),
					array( 'name' => 'shadow', 'value' => __('Shadow', 'themify'))
				),
				'render_callback' => array(
					'binding' => 'live'
				)
			),
			// Additional CSS
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<hr/>')
			),
			array(
				'id' => 'add_css_box',
				'type' => 'text',
				'label' => __('Additional CSS Class', 'themify'),
				'help' => sprintf( '<br/><small>%s</small>', __('Add additional CSS class(es) for custom styling', 'themify') ),
				'class' => 'large exclude-from-reset-field',
				'render_callback' => array(
					'binding' => 'live'
				)
			)
		);
		return $options;
	}

	public function get_default_settings() {
		$settings = array(
			'content_box' => esc_html__( 'Box content', 'themify' )
		);
		return $settings;
	}

	public function get_animation() {
		$animation = array(
			array(
				'type' => 'separator',
				'meta' => array( 'html' => '<h4>' . esc_html__( 'Appearance Animation', 'themify' ) . '</h4>')
			),
			array(
				'id' => 'multi_Animation Effect',
				'type' => 'multi',
				'label' => __('Effect', 'themify'),
				'fields' => array(
					array(
						'id' => 'animation_effect',
						'type' => 'animation_select',
						'label' => __( 'Effect', 'themify' )
					),
					array(
						'id' => 'animation_effect_delay',
						'type' => 'text',
						'label' => __( 'Delay', 'themify' ),
						'class' => 'xsmall',
						'description' => __( 'Delay (s)', 'themify' ),
					),
					array(
						'id' => 'animation_effect_repeat',
						'type' => 'text',
						'label' => __( 'Repeat', 'themify' ),
						'class' => 'xsmall',
						'description' => __( 'Repeat (x)', 'themify' ),
					),
				)
			)
		);

		return $animation;
	}

	public function get_styling() {
		$general = array(
			// Background
			array(
				'id' => 'separator_image_background',
				'title' => '',
				'description' => '',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Background', 'themify').'</h4>'),
			),
			array(
				'id' => 'background_image',
				'type' => 'image_and_gradient',
				'label' => __('Background Image', 'themify'),
				'class' => 'xlarge',
				'prop' => 'background-image',
				'selector' => '.module-box .module-box-content',
                                'option_js' => true
			),
			array(
				'id' => 'background_color',
				'type' => 'color',
				'label' => __('Background Color', 'themify'),
				'class' => 'small',
				'prop' => 'background-color',
				'selector' => '.module-box .module-box-content',
			),
			// Background repeat
			array(
				'id' 		=> 'background_repeat',
				'label'		=> __('Background Repeat', 'themify'),
				'type' 		=> 'select',
				'default'	=> '',
				'meta'		=> array(
					array('value' => 'repeat', 'name' => __('Repeat All', 'themify')),
					array('value' => 'repeat-x', 'name' => __('Repeat Horizontally', 'themify')),
					array('value' => 'repeat-y', 'name' => __('Repeat Vertically', 'themify')),
					array('value' => 'no-repeat', 'name' => __('Do not repeat', 'themify')),
					array('value' => 'fullcover', 'name' => __('Fullcover', 'themify'))
				),
				'prop' => 'background-repeat',
				'selector' => '.module-box .module-box-content',
                                'wrap_with_class' => 'tf-group-element tf-group-element-image',
			),
			// Font
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Font', 'themify').'</h4>'),
			),
			array(
				'id' => 'font_family',
				'type' => 'font_select',
				'label' => __('Font Family', 'themify'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => array('.module-box','.module-box h1','.module-box h2','.module-box h3:not(.module-title)','.module-box h4','.module-box h5','.module-box h6')
			),
			array(
				'id' => 'font_color',
				'type' => 'color',
				'label' => __('Font Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' =>array('.module-box .module-box-content','.module-box h1','.module-box h2','.module-box h3:not(.module-title)','.module-box h4','.module-box h5','.module-box h6')
			),
			array(
				'id' => 'multi_font_size',
				'type' => 'multi',
				'label' => __('Font Size', 'themify'),
				'fields' => array(
					array(
						'id' => 'font_size',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-box'
					),
					array(
						'id' => 'font_size_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height',
				'type' => 'multi',
				'label' => __('Line Height', 'themify'),
				'fields' => array(
					array(
						'id' => 'line_height',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-box'
					),
					array(
						'id' => 'line_height_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'text_align',
				'label' => __( 'Text Align', 'themify' ),
				'type' => 'radio',
				'meta' => array(
					array( 'value' => '', 'name' => __( 'Default', 'themify' ), 'selected' => true ),
					array( 'value' => 'left', 'name' => __( 'Left', 'themify' ) ),
					array( 'value' => 'center', 'name' => __( 'Center', 'themify' ) ),
					array( 'value' => 'right', 'name' => __( 'Right', 'themify' ) ),
					array( 'value' => 'justify', 'name' => __( 'Justify', 'themify' ) )
				),
				'prop' => 'text-align',
				'selector' => '.module-box'
			),
			// Link
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_link',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Link', 'themify').'</h4>'),
			),
			array(
				'id' => 'link_color',
				'type' => 'color',
				'label' => __('Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module-box a'
			),
			array(
				'id' => 'link_color_hover',
				'type' => 'color',
				'label' => __('Color Hover', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module-box a:hover'
			),
			array(
				'id' => 'text_decoration',
				'type' => 'select',
				'label' => __( 'Text Decoration', 'themify' ),
				'meta'	=> array(
					array('value' => '',   'name' => '', 'selected' => true),
					array('value' => 'underline',   'name' => __('Underline', 'themify')),
					array('value' => 'overline', 'name' => __('Overline', 'themify')),
					array('value' => 'line-through',  'name' => __('Line through', 'themify')),
					array('value' => 'none',  'name' => __('None', 'themify'))
				),
				'prop' => 'text-decoration',
				'selector' => '.module-box a'
			),
			// Multi columns
			array(
				'id' => 'separator_multi_columns',
				'type' => 'separator',
				'meta' => array('html'=>'<hr><h4>' . __( 'Multi-columns', 'themify' ) . '</h4>'),
			),
			array(
				'id' => 'column_count',
				'type' => 'select',
				'label' =>__('Column Count', 'themify'),
				'meta' => array(
					array( 'value' => 1, 'name' => 1 ),
					array( 'value' => 2, 'name' => 2 ),
					array( 'value' => 3, 'name' => 3 ),
					array( 'value' => 4, 'name' => 4 ),
					array( 'value' => 5, 'name' => 5 ),
					array( 'value' => 6, 'name' => 6 ),
				),
				'prop' => 'column-count',
				'selector' => ' .module-box-content'
			),
			array(
				'id' => 'column_gap',
				'type' => 'text',
				'label' => __('Column Gap', 'themify'),
				'class' => 'style_field_px xsmall',
				'prop' => 'column-gap',
				'selector' => ' .module-box-content'
			),
			array(
				'id' => 'column_divider',
				'type' => 'multi',
				'label' => __('Column Divider', 'themify'),
				'fields' => array(
					array(
						'id' => 'column_divider_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'column-rule-color',
						'selector' => ' .module-box-content',
					),
					array(
						'id' => 'column_divider_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_field_px xsmall',
						'prop' => 'column-rule-width',
						'selector' => ' .module-box-content',
					),
					array(
						'id' => 'column_divider_style',
						'type' => 'select',
						'meta' => Themify_Builder_model::get_border_styles(),
						'class' => 'style_field_select',
						'prop' => 'column-rule-style',
						'selector' => ' .module-box-content',
					)
				)
			),
			// Padding
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_padding',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Padding', 'themify').'</h4>'),
			),
			array(
				'id' => 'multi_padding_top',
				'type' => 'multi',
				'label' => __('Padding', 'themify'),
				'fields' => array(
					array(
						'id' => 'padding_top',
						'type' => 'text',
						'class' => 'style_padding style_field xsmall',
						'prop' => 'padding-top',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'padding_top_unit',
						'type' => 'select',
						'description' => __('top', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
                                                        array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_right',
						'type' => 'text',
						'class' => 'style_padding style_field xsmall',
						'prop' => 'padding-right',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'padding_right_unit',
						'type' => 'select',
						'description' => __('right', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
                                                        array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_bottom',
						'type' => 'text',
						'class' => 'style_padding style_field xsmall',
						'prop' => 'padding-bottom',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'padding_bottom_unit',
						'type' => 'select',
						'description' => __('bottom', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
                                                        array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_padding_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'padding_left',
						'type' => 'text',
						'class' => 'style_padding style_field xsmall',
						'prop' => 'padding-left',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'padding_left_unit',
						'type' => 'select',
						'description' => __('left', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
                                                        array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			// "Apply all" // apply all padding
			array(
				'id' => 'checkbox_padding_apply_all',
				'class' => 'style_apply_all style_apply_all_padding',
				'type' => 'checkbox',
				'label' => false,
				'options' => array(
					array( 'name' => 'padding', 'value' => __( 'Apply to all padding', 'themify' ) )
				)
			),
			// Margin
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_margin',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Margin', 'themify').'</h4>'),
			),
			array(
				'id' => 'multi_margin_top',
				'type' => 'multi',
				'label' => __('Margin', 'themify'),
				'fields' => array(
					array(
						'id' => 'margin_top',
						'type' => 'text',
						'class' => 'style_margin style_field xsmall',
						'prop' => 'margin-top',
						'selector' => '.module-box'
					),
					array(
						'id' => 'margin_top_unit',
						'type' => 'select',
						'description' => __('top', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
                                                        array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_right',
						'type' => 'text',
						'class' => 'style_margin style_field xsmall',
						'prop' => 'margin-right',
						'selector' => '.module-box'
					),
					array(
						'id' => 'margin_right_unit',
						'type' => 'select',
						'description' => __('right', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
                                                        array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_bottom',
						'type' => 'text',
						'class' => 'style_margin style_field xsmall',
						'prop' => 'margin-bottom',
						'selector' => '.module-box'
					),
					array(
						'id' => 'margin_bottom_unit',
						'type' => 'select',
						'description' => __('bottom', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
                                                        array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			array(
				'id' => 'multi_margin_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'margin_left',
						'type' => 'text',
						'class' => 'style_margin style_field xsmall',
						'prop' => 'margin-left',
						'selector' => '.module-box'
					),
					array(
						'id' => 'margin_left_unit',
						'type' => 'select',
						'description' => __('left', 'themify'),
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
                                                        array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify'))
						)
					),
				)
			),
			// "Apply all" // apply all margin
			array(
				'id' => 'checkbox_margin_apply_all',
				'class' => 'style_apply_all style_apply_all_margin',
				'type' => 'checkbox',
				'label' => false,
				'options' => array(
					array( 'name' => 'margin', 'value' => __( 'Apply to all margin', 'themify' ) )
				)
			),
			// Border
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_border',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Border', 'themify').'</h4>'),
			),
			array(
				'id' => 'multi_border_top',
				'type' => 'multi',
				'label' => __('Border', 'themify'),
				'fields' => array(
					array(
						'id' => 'border_top_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-top-color',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'border_top_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-top-width',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'border_top_style',
						'type' => 'select',
						'description' => __('top', 'themify'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-top-style',
						'selector' => '.module-box .module-box-content'
					)
				)
			),
			array(
				'id' => 'multi_border_right',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_right_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-right-color',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'border_right_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-right-width',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'border_right_style',
						'type' => 'select',
						'description' => __('right', 'themify'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-right-style',
						'selector' => '.module-box .module-box-content'
					)
				)
			),
			array(
				'id' => 'multi_border_bottom',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_bottom_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-bottom-color',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'border_bottom_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-bottom-width',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'border_bottom_style',
						'type' => 'select',
						'description' => __('bottom', 'themify'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-bottom-style',
						'selector' => '.module-box .module-box-content'
					)
				)
			),
			array(
				'id' => 'multi_border_left',
				'type' => 'multi',
				'label' => '',
				'fields' => array(
					array(
						'id' => 'border_left_color',
						'type' => 'color',
						'class' => 'small',
						'prop' => 'border-left-color',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'border_left_width',
						'type' => 'text',
						'description' => 'px',
						'class' => 'style_border style_field xsmall',
						'prop' => 'border-left-width',
						'selector' => '.module-box .module-box-content'
					),
					array(
						'id' => 'border_left_style',
						'type' => 'select',
						'description' => __('left', 'themify'),
						'meta' => Themify_Builder_model::get_border_styles(),
						'prop' => 'border-left-style',
						'selector' => '.module-box .module-box-content'
					)
				)
			),
			// "Apply all" // apply all border
			array(
				'id' => 'checkbox_border_apply_all',
				'class' => 'style_apply_all style_apply_all_border',
				'type' => 'checkbox',
				'label' => false,
				'options' => array(
					array( 'name' => 'border', 'value' => __( 'Apply to all border', 'themify' ) )
				)
			)
		);

		$heading = array(
			// Font H1
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Heading 1 Font', 'themify').'</h4>'),
			),
			array(
				'id' => 'font_family_h1',
				'type' => 'font_select',
				'label' => __('Font Family', 'themify'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => '.module.module-box h1'
			),
			array(
				'id' => 'font_color_h1',
				'type' => 'color',
				'label' => __('Font Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module.module-box h1'
			),
			array(
				'id' => 'multi_font_size_h1',
				'type' => 'multi',
				'label' => __('Font Size', 'themify'),
				'fields' => array(
					array(
						'id' => 'font_size_h1',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-box h1'
					),
					array(
						'id' => 'font_size_h1_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height_h1',
				'type' => 'multi',
				'label' => __('Line Height', 'themify'),
				'fields' => array(
					array(
						'id' => 'line_height_h1',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-box h1'
					),
					array(
						'id' => 'line_height_h1_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			// Heading 1 Margin
			$this->get_heading_margin_multi_field( 'h1', 'top' ),
			$this->get_heading_margin_multi_field( 'h1', 'bottom' ),
			// Font H2
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Heading 2 Font', 'themify').'</h4>'),
			),
			array(
				'id' => 'font_family_h2',
				'type' => 'font_select',
				'label' => __('Font Family', 'themify'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => '.module.module-box h2'
			),
			array(
				'id' => 'font_color_h2',
				'type' => 'color',
				'label' => __('Font Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module.module-box h2'
			),
			array(
				'id' => 'multi_font_size_h2',
				'type' => 'multi',
				'label' => __('Font Size', 'themify'),
				'fields' => array(
					array(
						'id' => 'font_size_h2',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-box h2'
					),
					array(
						'id' => 'font_size_h2_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height_h2',
				'type' => 'multi',
				'label' => __('Line Height', 'themify'),
				'fields' => array(
					array(
						'id' => 'line_height_h2',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-box h2'
					),
					array(
						'id' => 'line_height_h2_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			// Heading 2 Margin
			$this->get_heading_margin_multi_field( 'h2', 'top' ),
			$this->get_heading_margin_multi_field( 'h2', 'bottom' ),
			// Font H3
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Heading 3 Font', 'themify').'</h4>'),
			),
			array(
				'id' => 'font_family_h3',
				'type' => 'font_select',
				'label' => __('Font Family', 'themify'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => '.module.module-box h3'
			),
			array(
				'id' => 'font_color_h3',
				'type' => 'color',
				'label' => __('Font Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module.module-box h3'
			),
			array(
				'id' => 'multi_font_size_h3',
				'type' => 'multi',
				'label' => __('Font Size', 'themify'),
				'fields' => array(
					array(
						'id' => 'font_size_h3',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-box h3'
					),
					array(
						'id' => 'font_size_h3_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height_h3',
				'type' => 'multi',
				'label' => __('Line Height', 'themify'),
				'fields' => array(
					array(
						'id' => 'line_height_h3',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-box h3'
					),
					array(
						'id' => 'line_height_h3_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			// Heading 3 Margin
			$this->get_heading_margin_multi_field( 'h3', 'top' ),
			$this->get_heading_margin_multi_field( 'h3', 'bottom' ),
			// Font H4
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Heading 4 Font', 'themify').'</h4>'),
			),
			array(
				'id' => 'font_family_h4',
				'type' => 'font_select',
				'label' => __('Font Family', 'themify'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => '.module.module-box h4'
			),
			array(
				'id' => 'font_color_h4',
				'type' => 'color',
				'label' => __('Font Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module.module-box h4'
			),
			array(
				'id' => 'multi_font_size_h4',
				'type' => 'multi',
				'label' => __('Font Size', 'themify'),
				'fields' => array(
					array(
						'id' => 'font_size_h4',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-box h4'
					),
					array(
						'id' => 'font_size_h4_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height_h4',
				'type' => 'multi',
				'label' => __('Line Height', 'themify'),
				'fields' => array(
					array(
						'id' => 'line_height_h4',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-box h4'
					),
					array(
						'id' => 'line_height_h4_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			// Heading 4 Margin
			$this->get_heading_margin_multi_field( 'h4', 'top' ),
			$this->get_heading_margin_multi_field( 'h4', 'bottom' ),
			// Font H5
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Heading 5 Font', 'themify').'</h4>'),
			),
			array(
				'id' => 'font_family_h5',
				'type' => 'font_select',
				'label' => __('Font Family', 'themify'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => '.module.module-box h5'
			),
			array(
				'id' => 'font_color_h5',
				'type' => 'color',
				'label' => __('Font Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module.module-box h5'
			),
			array(
				'id' => 'multi_font_size_h5',
				'type' => 'multi',
				'label' => __('Font Size', 'themify'),
				'fields' => array(
					array(
						'id' => 'font_size_h5',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-box h5'
					),
					array(
						'id' => 'font_size_h5_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height_h5',
				'type' => 'multi',
				'label' => __('Line Height', 'themify'),
				'fields' => array(
					array(
						'id' => 'line_height_h5',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-box h5'
					),
					array(
						'id' => 'line_height_h5_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			// Heading 5 Margin
			$this->get_heading_margin_multi_field( 'h5', 'top' ),
			$this->get_heading_margin_multi_field( 'h5', 'bottom' ),
			// Font H6
			array(
				'type' => 'separator',
				'meta' => array('html'=>'<hr />')
			),
			array(
				'id' => 'separator_font',
				'type' => 'separator',
				'meta' => array('html'=>'<h4>'.__('Heading 6 Font', 'themify').'</h4>'),
			),
			array(
				'id' => 'font_family_h6',
				'type' => 'font_select',
				'label' => __('Font Family', 'themify'),
				'class' => 'font-family-select',
				'prop' => 'font-family',
				'selector' => '.module.module-box h6'
			),
			array(
				'id' => 'font_color_h6',
				'type' => 'color',
				'label' => __('Font Color', 'themify'),
				'class' => 'small',
				'prop' => 'color',
				'selector' => '.module.module-box h6'
			),
			array(
				'id' => 'multi_font_size_h6',
				'type' => 'multi',
				'label' => __('Font Size', 'themify'),
				'fields' => array(
					array(
						'id' => 'font_size_h6',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'font-size',
						'selector' => '.module-box h6'
					),
					array(
						'id' => 'font_size_h6_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			array(
				'id' => 'multi_line_height_h6',
				'type' => 'multi',
				'label' => __('Line Height', 'themify'),
				'fields' => array(
					array(
						'id' => 'line_height_h6',
						'type' => 'text',
						'class' => 'xsmall',
						'prop' => 'line-height',
						'selector' => '.module-box h6'
					),
					array(
						'id' => 'line_height_h6_unit',
						'type' => 'select',
						'meta' => array(
							array('value' => 'px', 'name' => __('px', 'themify')),
							array('value' => 'em', 'name' => __('em', 'themify')),
							array('value' => '%', 'name' => __('%', 'themify')),
						)
					)
				)
			),
			// Heading 6 Margin
			$this->get_heading_margin_multi_field( 'h6', 'top' ),
			$this->get_heading_margin_multi_field( 'h6', 'bottom' ),
		);

		return array(
			array(
				'type' => 'tabs',
				'id' => 'module-styling',
				'tabs' => array(
					'general' => array(
		        	'label' => __('General', 'themify'),
					'fields' => $general
					),
					'heading' => array(
						'label' => __('Heading', 'themify'),
						'fields' => $heading
					)
				)
			),
		);

	}

	protected function _visual_template() { 
		$module_args = $this->get_module_args(); ?>
		<div class="module module-<?php echo esc_attr( $this->slug ); ?>">
			<# if ( data.mod_title_box ) { #>
			<?php echo $module_args['before_title']; ?>{{{ data.mod_title_box }}}<?php echo $module_args['after_title']; ?>
			<# } #>
			
			<div class="ui module-<?php echo esc_attr( $this->slug ); ?>-content {{ data.color_box }} {{ data.add_css_box }} {{ data.background_repeat }} <# ! _.isUndefined( data.appearance_box ) ? print( data.appearance_box.split('|').join(' ') ) : ''; #>">
				{{{ data.content_box }}}
			</div>
		</div>
	<?php
	}
}

///////////////////////////////////////
// Module Options
///////////////////////////////////////
Themify_Builder_Model::register_module( 'TB_Box_Module' );
