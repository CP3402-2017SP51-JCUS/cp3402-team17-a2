<?php
/*
Plugin Name: Themify Builder Lite
Plugin URI: http://themify.me/
Description: Build responsive layouts that work for desktop, tablets, and mobile using intuitive &quot;what you see is what you get&quot; drag &amp; drop framework with live edits and previews.
Version: 2.0.3
Author: Themify
Author URI: http://themify.me
Text Domain:  themify
Domain Path:  /languages
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Hook loaded
add_action( 'after_setup_theme', 'themify_builder_themify_dependencies' );
add_action( 'after_setup_theme', 'themify_builder_plugin_init' );
register_activation_hook(__FILE__, 'themify_builder_activate');
if(!function_exists('themify_builder_activate')){
	function themify_builder_activate(){
		set_transient('themify_builder_welcome_page', true, 30);
	}
}

require_once( plugin_dir_path( __FILE__ ) . 'themify/themify-metabox/themify-metabox.php' );

if(!function_exists('themify_builder_themify_dependencies')){
	/**
	 * Load themify functions
	 */
	function themify_builder_themify_dependencies(){
		if ( class_exists( 'Themify_Builder' ) ) return;

		if ( ! defined( 'THEMIFY_DIR' ) ) {
			define( 'THEMIFY_VERSION', themify_builder_get_plugin_version() );
			define( 'THEMIFY_DIR', plugin_dir_path( __FILE__ ) . 'themify' );
			define( 'THEMIFY_URI', plugin_dir_url( __FILE__ ) . 'themify' );
			require_once( THEMIFY_DIR . '/themify-database.php' );
			require_once( THEMIFY_DIR . '/themify-utils.php' );
			require_once( THEMIFY_DIR . '/themify-utils.php' );
			require_once( THEMIFY_DIR . '/themify-hooks.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'theme-options.php' );
			if( is_admin() ) {
				require_once( THEMIFY_DIR . '/themify-wpajax.php' );
			}
		}
		require_once( THEMIFY_DIR . '/google-fonts/functions.php' );
		if( ! function_exists( 'themify_get_featured_image_link' ) ) {
			require_once( THEMIFY_DIR . '/themify-template-tags.php' );
		}
		add_action( 'wp_head', 'themify_html_js_class', 0 );

		if( ! class_exists( 'Themify_Icon_Picker' ) ) {
			require_once( THEMIFY_DIR . '/themify-icon-picker/themify-icon-picker.php' );
			Themify_Icon_Picker::get_instance( trailingslashit( THEMIFY_URI ) . 'themify-icon-picker' );
		}
		Themify_Icon_Picker::get_instance()->register( 'Themify_Icon_Picker_FontAwesome' );
		Themify_Icon_Picker::get_instance()->register( 'Themify_Icon_Picker_Themify' );
	}
}

// register additional field types used by Builder
add_action( 'themify_metabox/field/page_builder', 'themify_meta_field_page_builder', 10, 1 );
add_action( 'themify_metabox/field/fontawesome', 'themify_meta_field_fontawesome', 10, 1 );
add_action( 'themify_metabox/field/query_category', 'themify_meta_field_query_category', 10, 1 );
add_action( 'themify_metabox/field/featimgdropdown', 'themify_meta_field_featimgdropdown', 10, 1 );

if(!function_exists('themify_builder_plugin_init')){
	/**
	 * Init Plugin
	 * called after theme to avoid redeclare function error
	 */
function themify_builder_plugin_init() {
	if ( class_exists('Themify_Builder') ) return;

		global $ThemifyBuilder, $Themify_Builder_Options, $Themify_Builder_Layouts;

		/**
		 * Define builder constant
		 */
		define( 'THEMIFY_BUILDER_VERSION', themify_builder_get_plugin_version() );
		define( 'THEMIFY_BUILDER_VERSION_KEY', 'themify_builder_version' );
		define( 'THEMIFY_BUILDER_NAME', trim( dirname( plugin_basename( __FILE__) ), '/' ) );
		define( 'THEMIFY_BUILDER_SLUG', trim( plugin_basename( __FILE__), '/' ) );

		/**
		 * Layouts Constant
		 */
		define( 'THEMIFY_BUILDER_LAYOUTS_VERSION', '1.1.1' );

		// File Path
		define( 'THEMIFY_BUILDER_DIR', dirname(__FILE__) );
		define( 'THEMIFY_BUILDER_MODULES_DIR', THEMIFY_BUILDER_DIR . '/modules' );
		define( 'THEMIFY_BUILDER_TEMPLATES_DIR', THEMIFY_BUILDER_DIR . '/templates' );
		define( 'THEMIFY_BUILDER_CLASSES_DIR', THEMIFY_BUILDER_DIR . '/classes' );
		define( 'THEMIFY_BUILDER_INCLUDES_DIR', THEMIFY_BUILDER_DIR . '/includes' );
		define( 'THEMIFY_BUILDER_LIBRARIES_DIR', THEMIFY_BUILDER_INCLUDES_DIR . '/libraries' );

		// URI Constant
		define( 'THEMIFY_BUILDER_URI', plugins_url( '' , __FILE__ ) );

		// Include files
		require_once( THEMIFY_BUILDER_CLASSES_DIR . '/class-themify-builder-model.php' );
		require_once( THEMIFY_BUILDER_CLASSES_DIR . '/premium/class-themify-builder-include.php');
		if(Themify_Builder_Model::is_premium() && file_exists(THEMIFY_BUILDER_CLASSES_DIR . '/premium/class-themify-builder-layouts.php')){
			require_once( THEMIFY_BUILDER_CLASSES_DIR . '/premium/class-themify-builder-layouts.php' );
		}
		require_once( THEMIFY_BUILDER_CLASSES_DIR . '/class-themify-builder-module.php' );
		require_once( THEMIFY_BUILDER_CLASSES_DIR . '/class-themify-builder.php' );
		require_once( THEMIFY_BUILDER_CLASSES_DIR . '/class-themify-builder-options.php' );
		require_once( THEMIFY_BUILDER_CLASSES_DIR . '/premium/class-themify-access-role.php' );
		require_once( THEMIFY_DIR . '/class-themify-filesystem.php' );

		// Load Localization
		load_plugin_textdomain( 'themify', false, '/languages' );

		if ( Themify_Builder_Model::builder_check() ) {
			// instantiate the plugin class
			if(Themify_Builder_Model::is_premium()){
				$Themify_Builder_Layouts = new Themify_Builder_Layouts();
			}
			$ThemifyBuilder = new Themify_Builder();
			$ThemifyBuilder->init();

			// initiate metabox panel
			themify_build_write_panels(array());
			require_once( THEMIFY_DIR . '/class-themify-cache.php' );
		}

		// register builder options page
		if ( class_exists( 'Themify_Builder_Options' ) ) {
			$ThemifyBuilderOptions = new Themify_Builder_Options();
			// Include Updater
			if (Themify_Builder_Model::is_premium() && is_admin() && current_user_can( 'update_plugins' ) ) {
				require_once( THEMIFY_BUILDER_DIR . '/themify-builder-updater.php' );
				if ( ! function_exists( 'get_plugin_data') )
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

				$plugin_basename = plugin_basename( __FILE__ );
				$plugin_data = get_plugin_data( trailingslashit( plugin_dir_path( __FILE__ ) ) . basename( $plugin_basename ) );
				$themify_builder_updater = new Themify_Builder_Updater( array(
					'name' => trim( dirname( $plugin_basename ), '/' ),
					'nicename' => $plugin_data['Name'],
					'update_type' => 'plugin',
				), THEMIFY_BUILDER_VERSION, THEMIFY_BUILDER_SLUG );
			}
		}

		if( is_admin() ) {
			add_action( 'admin_enqueue_scripts', 'themify_enqueue_scripts' );
		}

		/**
		 * Load class for mobile detection if it doesn't exist yet
		 * @since 1.6.8
		 */
		if ( ! class_exists( 'Themify_Mobile_Detect' ) ) {
			require_once THEMIFY_DIR . '/class-themify-mobile-detect.php';
			global $themify_mobile_detect;
			$themify_mobile_detect = new Themify_Mobile_Detect;
		}

}
}

if ( ! function_exists( 'themify_builder_get_plugin_version' ) ) {
	/**
	 * Return plugin version.
	 *
	 * @since 1.4.2
	 *
	 * @return string
	 */
	function themify_builder_get_plugin_version() {
		static $version;
		if ( ! isset( $version ) ) {
			$data = get_file_data( __FILE__, array( 'Version' ) );
			$version = $data[0];
		}
		return $version;
	}
}

if ( ! function_exists('themify_builder_edit_module_panel') ) {
	/**
	 * Hook edit module frontend panel
	 * @param $mod_name
	 * @param $mod_settings
	 */
	function themify_builder_edit_module_panel( $mod_name, $mod_settings ) {
		do_action( 'themify_builder_edit_module_panel', $mod_name, $mod_settings );
	}
}

if ( ! function_exists( 'themify_builder_grid_lists' ) ) {
	/**
	 * Get Grid menu list
	 */
	function themify_builder_grid_lists( $handle = 'row', $set_gutter = null, $set_column_equal_height = null, $column_alignment_value = '', $row_anchor = '' ) {
		$grid_lists = Themify_Builder_Model::get_grid_settings();
		$gutters = Themify_Builder_Model::get_grid_settings( 'gutter' );
		$column_alignment = Themify_Builder_Model::get_grid_settings( 'column_alignment' );
		$selected_gutter = is_null( $set_gutter ) ? '' : $set_gutter; ?>
		<div class="grid_menu" data-handle="<?php echo esc_attr( $handle ); ?>">
	    	<div class="grid_icon ti-layout-column3"><span class="row-anchor-name"><?php echo esc_attr( $row_anchor ); ?></span></div>
			<div class="themify_builder_grid_list_wrapper">
				<ul class="themify_builder_grid_list clearfix">
					<?php foreach( $grid_lists as $row ): ?>
					<li>
						<ul>
							<?php foreach( $row as $li ): ?>
								<li><a href="#" class="themify_builder_column_select <?php echo esc_attr( 'grid-layout-' . implode( '-', $li['data'] ) ); ?>" data-handle="<?php echo esc_attr( $handle ); ?>" data-grid="<?php echo esc_attr( json_encode( $li['data'] ) ); ?>"><img src="<?php echo esc_url( $li['img'] ); ?>"></a></li>
							<?php endforeach; ?>
						</ul>
					</li>
					<?php endforeach; ?>
				</ul>

				<ul class="themify_builder_column_alignment clearfix" <?php if ( $set_column_equal_height != null ) echo 'style="display:none"' ?>>
					<?php foreach( $column_alignment as $li ): ?>
						<li <?php if ( $column_alignment_value == esc_attr( $li['alignment'] ) || ( $column_alignment_value == '' && esc_attr( $li['alignment'] ) == 'col_align_top' ) ) echo ' class="selected"' ?>><a href="#" class="themify_builder_column_select column-alignment-<?php echo esc_attr( $li['alignment'] ); ?>" data-handle="<?php echo esc_attr( $handle ); ?>" data-alignment="<?php echo esc_attr( $li['alignment'] ); ?>"><img src="<?php echo esc_url( $li['img'] ); ?>"></a></li>
					<?php endforeach; ?>

					<li><?php esc_html_e( 'Column Alignment', 'themify' ) ?></li>
				</ul>

				<div class="themify_builder_equal_column_height">
					<input type="checkbox" class="themify_builder_equal_column_height_checkbox" data-handle="<?php echo esc_attr( $handle ); ?>"
						<?php if ($set_column_equal_height != null) { echo ' checked="checked"'; } ?>>
					<span><?php esc_html_e( 'Equal Column Height', 'themify' ) ?></span>
				</div>

				<select class="gutter_select" data-handle="<?php echo esc_attr( $handle ); ?>">
					<?php foreach( $gutters as $gutter ): ?>
					<option value="<?php echo esc_attr( $gutter['value'] ); ?>"<?php selected( $selected_gutter, $gutter['value'] ); ?>><?php echo esc_html( $gutter['name'] ); ?></option>
					<?php endforeach; ?>
				</select>
				<span><?php esc_html_e('Gutter Spacing', 'themify') ?></span>

			</div>
			<!-- /themify_builder_grid_list_wrapper -->
		</div>
		<!-- /grid_menu -->
		<?php
	}
}
