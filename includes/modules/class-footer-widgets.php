<?php
/***
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Beetle theme to display widgets
 *
 * @package Beetle Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Use class to avoid namespace collisions
if ( ! class_exists( 'Beetle_Pro_Footer_Widgets' ) ) :

class Beetle_Pro_Footer_Widgets {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	*/
	static function setup() {

		// Return early if Beetle Theme is not active
		if ( ! current_theme_supports( 'beetle-pro'  ) ) {
			return;
		}
		
		// Display footer widgets
		add_action( 'beetle_before_footer', array( __CLASS__, 'display_widgets' ) );
	
	}
	
	/**
	 * Displays Footer Widgets
	 *
	 * Hooks into the beetle_before_footer action hook in footer area.
	 */
	static function display_widgets() {
		
		// Check if there are footer widgets
		if( is_active_sidebar( 'footer-left' ) 
			or is_active_sidebar( 'footer-center-left' )
			or is_active_sidebar( 'footer-center-right' )
			or is_active_sidebar( 'footer-right' ) ) : ?>
				
			<div id="footer-widgets-bg" class="footer-widgets-background">
			
				<div id="footer-widgets-wrap" class="footer-widgets-wrap container">
				
					<div id="footer-widgets" class="footer-widgets clearfix"  role="complementary">			

						<div class="footer-widget-column widget-area">
							<?php dynamic_sidebar('footer-left'); ?>
						</div>
						
						<div class="footer-widget-column widget-area">
							<?php dynamic_sidebar('footer-center-left'); ?>
						</div>
						

						<div class="footer-widget-column widget-area">
							<?php dynamic_sidebar('footer-center-right'); ?>
						</div>
						
						<div class="footer-widget-column widget-area">
							<?php dynamic_sidebar('footer-right'); ?>
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		<?php endif;
			
	}
	
	/**
	 * Register all Footer Widget areas
	 *
	 * @return void
	*/
	static function register_widgets() {
	
		// Return early if Beetle Theme is not active
		if ( ! current_theme_supports( 'beetle-pro'  ) ) {
			return;
		}
		
		// Register Footer Left widget area
		register_sidebar( array(
			'name' => __( 'Footer Left', 'beetle-pro' ),
			'id' => 'footer-left',
			'description' => __( 'Appears on footer on the left hand side.', 'beetle-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		
		// Register Footer Center Left widget area
		register_sidebar( array(
			'name' => __( 'Footer Center Left', 'beetle-pro' ),
			'id' => 'footer-center-left',
			'description' => __( 'Appears on footer on center left position.', 'beetle-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		
		// Register Footer Center Right widget area
		register_sidebar( array(
			'name' => __( 'Footer Center Right', 'beetle-pro' ),
			'id' => 'footer-center-right',
			'description' => __( 'Appears on footer on center right position.', 'beetle-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		
		// Register Footer Right widget area
		register_sidebar( array(
			'name' => __( 'Footer Right', 'beetle-pro' ),
			'id' => 'footer-right',
			'description' => __( 'Appears on footer on the right hand side.', 'beetle-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		
	}
	
}

// Run Class
add_action( 'init', array( 'Beetle_Pro_Footer_Widgets', 'setup' ) );

// Register widgets in backend
add_action( 'widgets_init', array( 'Beetle_Pro_Footer_Widgets', 'register_widgets' ), 20 );

endif;