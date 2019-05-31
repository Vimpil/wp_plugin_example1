<?php 

/**
* Trigger this file on plugin uninstall
*
* @package wp_plugin_example1
*/

if ( ! defined( 'WP_ININSTALL_PLUGIN' ) ){
	die;
}

// Clear Database stored data
$books = get_posts( array( 'post_type' => 'example_post1', 'numberposts' => -1 ) );

foreach ( $books as $book ) {
	wp_delete_post( $book->ID, true );
}