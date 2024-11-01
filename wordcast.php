<?php
/**
 * Plugin Name:	WordCast
 * Text Domain: wordcast
 * Version: 1.1.4
 * Description: Use WordPress to serve your podcast channels and episodes. You're hosting your posts and pages on your WordPress site so why not your podcasts?
 * Author: Emil Wibe
 * Author URI: 	https://ew.dk/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
**/

load_plugin_textdomain('wordcast', false, dirname(plugin_basename(__FILE__)) . '/languages/');

require_once(plugin_dir_path(__FILE__) . 'tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once(plugin_dir_path(__FILE__) . 'wordcast-custom-post-types.php');
require_once(plugin_dir_path(__FILE__) . 'wordcast-custom-taxonomies.php');
require_once(plugin_dir_path(__FILE__) . 'wordcast-channel-categories.php');
require_once(plugin_dir_path(__FILE__) . 'wordcast-register-templates.php');
require_once(plugin_dir_path(__FILE__) . 'wordcast-functions.php');
require_once(plugin_dir_path(__FILE__) . 'wordcast-admin.php');
require_once(plugin_dir_path(__FILE__) . 'wordcast-add-acf.php');
require_once(plugin_dir_path(__FILE__) . 'wordcast-add-acf-fields.php');



//REWRITE PERMALINKS FOR CUSTOM POST TYPE REGISTRATION
function wordcast_activation(){
	wordcast_custom_pt();
	flush_rewrite_rules();

	@file_get_contents( 'https://wc-stats.ew.dk/statcount.php?siturl=' . get_site_url() . '&install=true' );
}
register_activation_hook(__FILE__, 'wordcast_activation');

function wordcast_deactivation(){
	@file_get_contents( 'https://wc-stats.ew.dk/statcount.php?siturl=' . get_site_url() . '&install=false' );
}
register_deactivation_hook( __FILE__, 'wordcast_deactivation' );

//CHECKING FOR PERMALINK STRUCTURE
if(!get_option('permalink_structure')){
	add_action('admin_notices', function(){
		$class = 'notice notice-error';
		$message = __('Irks! Pretty Permalinks are not activated. For WordCast to work you need to change your pretty permalinks to something else', 'wordcast');

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	});
}