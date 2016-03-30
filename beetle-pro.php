<?php
/*
Plugin Name: Beetle Pro
Plugin URI: http://themezee.com/addons/beetle-pro/
Description: Adds additional features like custom colors, google fonts, widget areas and footer copyright to the Beetle theme.
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.0
Text Domain: beetle-pro
Domain Path: /languages/
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Beetle Pro
Copyright(C) 2016, ThemeZee.com - support@themezee.com

*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Use class to avoid namespace collisions
if ( ! class_exists( 'Beetle_Pro' ) ) :


/**
 * Main Beetle_Pro Class
 *
 * @package Beetle Pro
 */
class Beetle_Pro {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses Beetle_Pro::constants() Setup the constants needed
	 * @uses Beetle_Pro::includes() Include the required files
	 * @uses Beetle_Pro::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {
	
		// Setup Constants
		self::constants();
		
		// Setup Translation
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );
	
		// Include Files
		self::includes();
		
		// Setup Action Hooks
		self::setup_actions();
		
	}
	
	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {
		
		// Define Plugin Name
		define( 'BEETLE_PRO_NAME', 'Beetle Pro' );

		// Define Version Number
		define( 'BEETLE_PRO_VERSION', '1.0' );
		
		// Define Plugin Name
		define( 'BEETLE_PRO_PRODUCT_ID', 56518 );

		// Define Update API URL
		define( 'BEETLE_PRO_STORE_API_URL', 'https://themezee.com' ); 

		// Plugin Folder Path
		define( 'BEETLE_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL
		define( 'BEETLE_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File
		define( 'BEETLE_PRO_PLUGIN_FILE', __FILE__ );
		
	}
	
	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'beetle-pro', false, dirname( plugin_basename( BEETLE_PRO_PLUGIN_FILE ) ) . '/languages/' );
		
	}
	
	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {
	
		// Include Admin Classes
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/admin/class-plugin-updater.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/admin/class-settings.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/admin/class-settings-page.php';
		
		// Include Customizer Classes
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/customizer/class-customizer.php';
		
		// Include Pro Features
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/modules/class-custom-colors.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/modules/class-custom-fonts.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/modules/class-footer-line.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/modules/class-footer-widgets.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/modules/class-header-bar.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/modules/class-header-spacing.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/modules/class-post-meta.php';
		
		// Include Magazine Widgets
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-boxed.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-list.php';
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-single.php';
		
		// Include Custom Stylesheet class
		require_once BEETLE_PRO_PLUGIN_DIR . '/includes/class-custom-stylesheet.php';

	}
	
	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {
		
		// Enqueue Frontend Widget Styles
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ), 11 );
		
		// Add Settings link to Plugin actions
		add_filter( 'plugin_action_links_' . plugin_basename( BEETLE_PRO_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );
		
		// Add admin notices
		add_action( 'admin_notices', array( __CLASS__, 'admin_notices' ) );
		
		// Add automatic plugin updater from ThemeZee Store API
		add_action( 'admin_init', array( __CLASS__, 'plugin_updater' ), 0 );
		
	}

	/**
	 * Enqueue Styles
	 *
	 * @return void
	 */
	static function enqueue_styles() {

		// Return early if Beetle Theme is not active
		if ( ! current_theme_supports( 'beetle-pro'  ) ) {
			return;
		}
		
		// Enqueue Plugin Stylesheet
		wp_enqueue_style( 'beetle-pro', BEETLE_PRO_PLUGIN_URL . 'assets/css/beetle-pro.css', array(), BEETLE_PRO_VERSION );
		
	}
	
	/**
	 * Add Settings link to the plugin actions
	 *
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {

		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'themes.php?page=beetle-pro' ), __( 'Settings', 'beetle-pro' ) ) );
		
		return array_merge( $settings_link, $actions );
	}
	
	/**
	 * Add admin notices
	 *
	 * @return void
	 */
	static function admin_notices() { 
	
		global $pagenow;
		
		// Display missing theme notice on themes and plugins page
		if ( ( $pagenow == 'themes.php' && !isset( $_GET['page'] ) ) or $pagenow == 'plugins.php' ) :
	
			// Display notice if Beetle theme is not active
			if ( ! get_theme_support( 'beetle-pro' ) ) : ?>
			
				<div class="notice notice-warning">
					<p>
						<?php printf( __( 'The %1$s add-on needs the %2$s theme activated in order to work. You should deactivate %1$s if you have switched to another theme permanently.', 'beetle-pro' ),
							BEETLE_PRO_NAME,
							'Beetle'
						); ?>
					</p>
				</div>
		
			<?php
			endif;
			
		endif;
	
		// Display missing license key notice on updates and plugins page
		if ( $pagenow == 'update-core.php' or $pagenow == 'plugins.php' ) :
		
			// Get Settings
			$options = Beetle_Pro_Settings::instance();
		
			if( '' == $options->get( 'license_key' ) ) : ?>
				
				<div class="updated">
					<p>
						<?php printf( __( 'Please enter your license key for the %1$s add-on in order to receive updates and support. <a href="%2$s">Enter License Key</a>', 'beetle-pro' ),
							BEETLE_PRO_NAME,
							admin_url( 'themes.php?page=beetle-pro' ) ); 
						?>
					</p>
				</div>
				
			<?php
			endif;
			
		endif;
	
	}
	
	/**
	 * Plugin Updater
	 *
	 * @return void
	 */
	static function plugin_updater() {

		if( ! is_admin() ) :
			return;
		endif;
		
		$options = Beetle_Pro_Settings::instance();

		if( $options->get( 'license_key' ) <> '' ) :
			
			$license_key = $options->get( 'license_key' );
			
			// setup the updater
			$beetle_pro_updater = new Beetle_Pro_Plugin_Updater( BEETLE_PRO_STORE_API_URL, __FILE__, array(
					'version' 	=> BEETLE_PRO_VERSION,
					'license' 	=> $license_key,
					'item_name' => BEETLE_PRO_NAME,
					'item_id'   => BEETLE_PRO_PRODUCT_ID,
					'author' 	=> 'ThemeZee'
				)
			);
			
		endif;
		
	}
	
}

// Run Plugin
Beetle_Pro::setup();

endif;