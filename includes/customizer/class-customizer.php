<?php
/***
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Beetle Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'Beetle_Pro_Customizer' ) ) :

class Beetle_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	*/
	static function setup() {
		
		// Return early if Beetle Theme is not active
		if ( ! current_theme_supports( 'beetle-pro'  ) ) {
			return;
		}
		
		// Enqueue scripts and styles in the Customizer
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );
		
		// Remove Upgrade section
		remove_action( 'customize_register', 'beetle_customize_register_upgrade_settings' );
	}
	
	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {
		
		// Merge Theme Options Array from Database with Default Options Array
		$theme_options = wp_parse_args( 
			
			// Get saved theme options from WP database
			get_option( 'beetle_theme_options', array() ), 
			
			// Merge with Default Options if setting was not saved yet
			self::get_default_options() 
			
		);

		// Return theme options
		return $theme_options;
		
	}


	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'logo_spacing'						=> 0,
			'header_spacing'					=> 20,
			'footer_text'						=> '',
			'credit_link' 						=> true,
			'top_navi_color'					=> '#cc77bb',
			'navi_primary_color'				=> '#cc77bb',
			'navi_secondary_color'				=> '#353535',
			'content_primary_color'				=> '#cc77bb',
			'content_secondary_color'			=> '#353535',
			'slider_color'						=> '#cc77bb',
			'footer_area_color'					=> '#353535',
			'footer_navi_color'					=> '#cc77bb',
			'text_font' 						=> 'Open Sans',
			'title_font' 						=> 'Open Sans',
			'navi_font' 						=> 'Open Sans',
			'widget_title_font' 				=> 'Open Sans',
			'available_fonts'					=> 'favorites'
		);
		
		return $default_options;
		
	}
	
	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {
		
		wp_enqueue_script( 'beetle-pro-customizer-js', BEETLE_PRO_PLUGIN_URL . 'assets/js/customizer.js', array( 'customize-preview' ), BEETLE_PRO_VERSION, true );
	
	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {
		
		wp_enqueue_style( 'beetle-pro-customizer-css', BEETLE_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), BEETLE_PRO_VERSION );
	
	}

}

// Run Class
add_action( 'init', array( 'Beetle_Pro_Customizer', 'setup' ) );

endif;