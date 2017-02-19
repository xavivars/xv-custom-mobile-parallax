<?php
/*
Plugin Name: XV Custom Mobile Parallax
Plugin URI:  http://xavi.ivars.me/codi/xv-custom-mobile-parallax/
Description: Custom fixes for Shapely's theme Parallax in mobile
Version:     0.1
Author:      Xavi Ivars
Author URI:  http://xavi.ivars.me/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


define( 'XV_CUSTOM_MOBILE_PARALLAX_VERSION', '0.1');

include (__DIR__ . '/xv-custom-mobile-parallax-admin.php');


if( is_admin() ) {
	$xv_custom_parallax_settings = new XV_Custom_Mobile_Parallax_Settings();
}

$xv_custom_parallax_option = get_option( 'xv_custom_parallax' );

if ( isset ( $xv_custom_parallax_option['custom_parallax_data'] ) ) {
	
	$data = $xv_custom_parallax_option['custom_parallax_data'];
	
	wp_enqueue_script( 'xv-custom-mobile-parallax',  plugin_dir_url( __FILE__ ) . '/xv-custom-mobile-parallax.js', array( 'shapely-parallax' ), XV_CUSTOM_MOBILE_PARALLAX_VERSION, true );

	$translation_array = array( 'data' => $data );
	
	wp_localize_script( 'xv-custom-mobile-parallax', 'xv_parallax', $translation_array );

}
