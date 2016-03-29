<?php
/***
 * Beetle Pro Settings Page Class
 *
 * Adds a new tab on the themezee plugins page and displays the settings page.
 *
 * @package Beetle Pro
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists('Beetle_Pro_Settings_Page') ) :

class Beetle_Pro_Settings_Page {

	/**
	 * Setup the Settings Page class
	 *
	 * @return void
	*/
	static function setup() {
		
		// Add settings page to appearance menu
		add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ), 12 );
		
	}
	
	/**
	 * Add Settings Page to Admin menu
	 *
	 * @return void
	*/
	static function add_settings_page() {
	
		// Return early if Beetle Theme is not active
		if ( ! current_theme_supports( 'beetle-pro'  ) ) {
			return;
		}
			
		add_theme_page(
			esc_html__( 'Pro Version', 'beetle-pro' ),
			esc_html__( 'Pro Version', 'beetle-pro' ),
			'manage_options',
			'beetle-pro',
			array( __CLASS__, 'display_settings_page' )
		);
		
	}
	
	/**
	 * Display settings page
	 *
	 * @return void
	*/
	static function display_settings_page() { 
	
		ob_start();
	?>

		<div id="beetle-pro-settings" class="beetle-pro-settings-wrap wrap">
			
			<h1><?php esc_html_e( 'Beetle Pro', 'beetle-pro' ); ?></h1>
			<?php settings_errors(); ?>
			
			<form class="beetle-pro-settings-form" method="post" action="options.php">
				<?php
					settings_fields( 'beetle_pro_settings' );
					do_settings_sections( 'beetle_pro_settings' );
					submit_button();
				?>
			</form>
			
		</div>
<?php
		echo ob_get_clean();
	}
	
}

// Run Beetle Pro Settings Page Class
Beetle_Pro_Settings_Page::setup();

endif;