<?php
/***
 * Site Logo
 *
 * Adds logo and spacing settings, replaces site title with logo image and adds spacing CSS
 *
 * @package Beetle Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'Beetle_Pro_Site_Logo' ) ) :

class Beetle_Pro_Site_Logo {

	/**
	 * Site Logo Setup
	 *
	 * @return void
	*/
	static function setup() {
		
		// Return early if Beetle Theme is not active
		if ( ! current_theme_supports( 'beetle-pro'  ) ) {
			return;
		}
		
		// Replace default site title function with new site logo function
		remove_action( 'beetle_site_title', 'beetle_site_title' );
		add_action( 'beetle_site_title', array( __CLASS__, 'display_site_logo' ) );
		
		// Add Custom Spacing CSS code to custom stylesheet output
		add_filter( 'beetle_pro_custom_css_stylesheet', array( __CLASS__, 'custom_spacing_css' ) ); 
		
		// Add Site Logo Settings
		add_action( 'customize_register', array( __CLASS__, 'site_logo_settings' ) );
	}
	
	/**
	 * Display Site Logo if user uploaded a logo image or shows Site Title as default if not
	 * Hooks into the beetle_site_title action hook in the on header area.
	 *
	 */
	static function display_site_logo() { 

		// Get Theme Options from Database
		$theme_options = Beetle_Pro_Customizer::get_theme_options();
		?>

		<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					
		<?php // Display Logo Image or Site Title
			if ( isset($theme_options['header_logo']) and $theme_options['header_logo'] <> '' ) : ?>
				
				<img class="site-logo" src="<?php echo esc_url($theme_options['header_logo']); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" />
		
		<?php else: ?>
				
				<h1 class="site-title"><?php bloginfo('name'); ?></h1>
		
		<?php endif; ?>
		
		</a>

		<?php
	}
	
	/**
	 * Adds custom Margin CSS styling for the logo and navigation spacing
	 *
	 */
	static function custom_spacing_css( $custom_css ) { 
		
		// Get Theme Options from Database
		$theme_options = Beetle_Pro_Customizer::get_theme_options();

		// Set CSS Variable
		$spacing_css = '';
		
		// Set Logo Spacing
		if ( $theme_options['logo_spacing'] <> 10 ) { 
		
			$margin = $theme_options['logo_spacing'] / 10;
		
			$spacing_css .= '
				.site-branding {
					margin: '. $margin .'em 0;
				}
				';
				
		}
		
		// Set Navigation Spacing
		if ( $theme_options['header_spacing'] <> 10 ) { 
		
			$margin = $theme_options['header_spacing'] / 10;
		
			$spacing_css .= '
				@media only screen and (min-width: 60em) {

					.header-main {
						padding-top: '. $margin .'em;
						padding-bottom: '. $margin .'em;
					}
					
				}
				';
				
		}
		
		// Add Spacing CSS to existing CSS code
		$custom_css .= $spacing_css;
		
		return $custom_css;
		
	}
	
	/**
	 * Adds site logo settings
	 *
	 * @param object $wp_customize / Customizer Object
	 */
	static function site_logo_settings( $wp_customize ) {

		// Add Sections for Site Logo
		$wp_customize->add_section( 'beetle_pro_section_logo', array(
			'title'    => __( 'Site Logo', 'beetle-pro' ),
			'priority' => 20,
			'panel' => 'beetle_options_panel' 
			)
		);
		
		// Add Upload logo image setting
		$wp_customize->add_setting( 'beetle_theme_options[header_logo]', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url'
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize, 'beetle_theme_options[header_logo]', array(
				'label'    => __( 'Logo Image (replaces Site Title)', 'beetle-pro' ),
				'section'  => 'beetle_pro_section_logo',
				'settings' => 'beetle_theme_options[header_logo]',
				'priority' => 1,
				)
			)
		);
		
		// Add Logo Spacing setting
		$wp_customize->add_setting( 'beetle_theme_options[logo_spacing]', array(
			'default'           => 10,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( 'beetle_theme_options[logo_spacing]', array(
			'label'    => __( 'Logo Spacing (default: 10)', 'beetle-pro' ),
			'section'  => 'beetle_pro_section_logo',
			'settings' => 'beetle_theme_options[logo_spacing]',
			'type'     => 'text',
			'priority' => 2
			)
		);
		
		// Add Header Spacing setting
		$wp_customize->add_setting( 'beetle_theme_options[header_spacing]', array(
			'default'           => 10,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( 'beetle_theme_options[header_spacing]', array(
			'label'    => __( 'Header Spacing (default: 10)', 'beetle-pro' ),
			'section'  => 'beetle_pro_section_logo',
			'settings' => 'beetle_theme_options[header_spacing]',
			'type'     => 'text',
			'priority' => 3
			)
		);

	}

}

// Run Class
add_action( 'init', array( 'Beetle_Pro_Site_Logo', 'setup' ) );

endif;