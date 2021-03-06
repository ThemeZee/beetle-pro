/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Beetle Pro
 */

( function( $ ) {

	/* Top Navigation Color Option */
	wp.customize( 'beetle_theme_options[top_navi_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.header-bar-wrap, .top-navigation-menu ul' )
				.css( 'background', newval );
		} );
	} );

	/* Slider Color Option */
	wp.customize( 'beetle_theme_options[slider_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.post-slider-controls .zeeflex-direction-nav a' )
				.css( 'background', newval );
			$( '.post-slider .zeeslide .slide-post' )
				.css( 'border-color', newval );
		} );
	} );

	/* Footer Color Option */
	wp.customize( 'beetle_theme_options[footer_area_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-wrap, .footer-widgets-background' )
				.css( 'background', newval );
		} );
	} );

	/* Footer Navi Color Option */
	wp.customize( 'beetle_theme_options[footer_navi_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-navigation' )
				.css( 'background', newval );
		} );
	} );

	/* Theme Fonts */
	wp.customize( 'beetle_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='beetle-pro-custom-text-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#beetle-pro-custom-text-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#beetle-pro-custom-text-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( 'body, button, input, select, textarea' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'beetle_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='beetle-pro-custom-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#beetle-pro-custom-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#beetle-pro-custom-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.site-title, .page-title, .entry-title' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'beetle_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='beetle-pro-custom-navi-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#beetle-pro-custom-navi-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#beetle-pro-custom-navi-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.top-navigation-menu a, .main-navigation-menu a, .footer-navigation-menu a, .footer-navigation .today' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'beetle_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='beetle-pro-custom-widget-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#beetle-pro-custom-widget-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#beetle-pro-custom-widget-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.page-header .archive-title, .comments-header .comments-title, .comment-reply-title span,.widget-title' )
				.css( 'font-family', newFont );

		} );
	} );

} )( jQuery );
