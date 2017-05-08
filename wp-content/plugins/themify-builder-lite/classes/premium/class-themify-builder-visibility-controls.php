<?php
	
	/**
	 * The Builder Visibility Controls class.
	 * This is used to show the visibility controls on all rows and modules.
	 *
	 * @package	Themify_Builder
	 * @subpackage Themify_Builder/classes
	 */
	class Themify_Builder_Visibility_Controls {

		/**
		 * Constructor.
		 * 
		 * @param object Themify_Builder $builder 
		 */
		public function __construct() {
			add_filter( 'themify_builder_module_lightbox_form_settings', array( $this, 'register_module_visibility_controls' ), 10, 2 );
			add_filter( 'themify_builder_row_lightbox_form_settings', array( $this, 'register_row_visibility_controls' ), 10 );
		}

		/**
		 * Register visibility tab control on module settings.
		 * 
		 * @param array $settings 
		 * @param array $module 
		 * @return array
		 */
		public function register_module_visibility_controls( $settings, $module ) {
			$settings['visibility'] = array(
				'name' => esc_html__( 'Visibility', 'themify' ),
				'options' => apply_filters('themify_builder_visibility_settings_fields', $this->add_module_visibility_controls(), $module)
			);
			return $settings;
		}

		/**
		 * Register visibility tab control on row settings.
		 * 
		 * @param array $settings 
		 * @return array
		 */
		public function register_row_visibility_controls( $settings ) {
			$settings['visibility'] = array(
				'name' => esc_html__( 'Visibility', 'themify' ),
				'options' => apply_filters('themify_builder_row_fields_visibility', $this->add_row_visibility_controls())
			);
			return $settings;
		}

		/**
		 * Append visibility controls to rows.
		 * 
		 * @access 	public
		 * @return 	array 
		 */
		public function add_row_visibility_controls() {
                        $disable = Themify_Builder_Model::is_premium();
			$visibility_controls =	array(
				array(
					'id' => 'separator_visibility',
					'title' => '',
					'description' => '',
					'type' => 'separator',
					'meta' => array('html' => '<h4>' . __('Visibility', 'themify') . '</h4>'),
				),
				array(
					'id' => 'visibility_desktop',
					'label' => __('Desktop', 'themify'),
					'type' => 'radio',
					'meta' => array(
						array('value' => 'show', 'name' => __('Show', 'themify'), 'selected' => true),
						array('value' => 'hide', 'name' => __('Hide', 'themify'),'disable'=>!$disable),
					),
                                        'wrap_with_class' => !$disable?'themify_builder_lite':''
				),
				array(
					'id' => 'visibility_tablet',
					'label' => __('Tablet', 'themify'),
					'type' => 'radio',
					'meta' => array(
						array('value' => 'show', 'name' => __('Show', 'themify'), 'selected' => true),
						array('value' => 'hide', 'name' => __('Hide', 'themify'),'disable'=>!$disable),
					),
                                        'wrap_with_class' => !$disable?'themify_builder_lite':''
				),
				array(
					'id' => 'visibility_mobile',
					'label' => __('Mobile', 'themify'),
					'type' => 'radio',
					'meta' => array(
						array('value' => 'show', 'name' => __('Show', 'themify'), 'selected' => true),
						array('value' => 'hide', 'name' => __('Hide', 'themify'),'disable'=>!$disable),
					),
                                        'wrap_with_class' => !$disable?'themify_builder_lite':''
				)
			);

			return $visibility_controls;
		}

		/**
		 * Append visibility controls to modules.
		 * 
		 * @access 	public
		 * @return 	array
		 */
		public function add_module_visibility_controls() {		
                        $disable = Themify_Builder_Model::is_premium();
			$visibility_controls =	array(
				array(
					'id' => 'separator_visibility',
					'title' => '',
					'description' => '',
					'type' => 'separator',
					'meta' => array('html' => '<h4>' . __('Visibility', 'themify') . '</h4>'),
				),
				array(
					'id' => 'visibility_desktop',
					'label' => __('Desktop', 'themify'),
					'type' => 'radio',
					'meta' => array(
						array('value' => 'show', 'name' => __('Show', 'themify'), 'selected' => true),
						array('value' => 'hide', 'name' => __('Hide', 'themify'),'disable'=>!$disable),
					),
                                        'wrap_with_class' => !$disable?'themify_builder_lite':''
				),
				array(
					'id' => 'visibility_tablet',
					'label' => __('Tablet', 'themify'),
					'type' => 'radio',
					'meta' => array(
						array('value' => 'show', 'name' => __('Show', 'themify'), 'selected' => true),
						array('value' => 'hide', 'name' => __('Hide', 'themify'),'disable'=>!$disable),
					),
                                        'wrap_with_class' => !$disable?'themify_builder_lite':''
				),
				array(
					'id' => 'visibility_mobile',
					'label' => __('Mobile', 'themify'),
					'type' => 'radio',
					'meta' => array(
						array('value' => 'show', 'name' => __('Show', 'themify'), 'selected' => true),
						array('value' => 'hide', 'name' => __('Hide', 'themify'),'disable'=>!$disable),
					),
                                        'wrap_with_class' => !$disable?'themify_builder_lite':''
				)
			);
			return $visibility_controls;
		}

		


		/**
		 * Test if is preview mode.
		 * 
		 * @access 	public
		 * @return 	bool
		 */
		public function is_preview() {
			return class_exists( 'Themify_Builder_Model' ) && Themify_Builder_Model::is_frontend_editor_page();
		}
	}