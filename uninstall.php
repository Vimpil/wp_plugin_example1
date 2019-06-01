<?php 

/**
* Trigger this file on plugin uninstall
*
* @package WpPluginExample1
*/

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ){
	die;
}

// Clear Database stored data

global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'example_post1' " );