<?php
/**
Plugin Name: SeniorNet JavaScript
Description: Lägg till JavaScript globalt på alla klubbsidor.
Author: Carolina Nymark
Author URI: https://themesbycarolina.com/
Version: 1.0
Text Domain: seniornet-javascript
Requires at least: 5.0
Requires PHP: 5.6
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Aktivera
 */
function seniornet_javascript_activate( $network_wide ) {

	if ( is_multisite() ) {
		if ( $network_wide ) {
			$site_ids = get_sites( array( 'fields' => 'ids', 'network_id' => get_current_network_id() ) );
			foreach ( $site_ids as $site_id ) {
				switch_to_blog( $site_id );
				seniornet_javascript_install();
				restore_current_blog();
			}
		} else {
			seniornet_javascript_install();
		}
	}

}
register_activation_hook( __FILE__, 'seniornet_javascript_activate' );

/**
 * Lägg till vårt JavaScript
 */
function seniornet_javascript_install() {
	wp_enqueue_script( 'seniornet-javascript', plugins_url( 'seniornet-javascript.js', __FILE__ ), array(), '20200304', true );
}
add_action( 'wp_enqueue_scripts', 'seniornet_javascript_install' );
