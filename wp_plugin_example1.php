<?php
/*
 * Plugin Name: wp_plugin_example1
 */
 
defined('ABSPATH') or die('no wordpress path found');

class wp_plugin_example1
{


    function __construct(){
        add_action( 'init', array ( $this, 'custom_post_type' ));
    }

    function register() {
        // add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );   
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );   
    }

    // function __construct($string){
    //     echo $string;
    // }

    function activate(){
        flush_rewrite_rules();
        $this->custom_post_type();
    }

    function deactivate(){
        flush_rewrite_rules();
    }


    protected function custom_post_type() {
        register_post_type( 'example_post1', ['public' => true, 'label' => 'Books'] );
    }

    function enqueue() {
        wp_enqueue_style( 'wp_plugin_example1', plugins_url('/assets/mystyle.css', __FILE__));
        wp_enqueue_script( 'wp_plugin_example1', plugins_url('/assets/myscript.js', __FILE__));
    }


}

if ( class_exists( 'wp_plugin_example1' ) ) {
    $wp_plugin_example1 = new Wp_plugin_example1();
    $wp_plugin_example1->register();
}

// activation
register_activation_hook ( __FILE__, array( $wp_plugin_example1, 'activate') );

// deactivation
register_deactivation_hook ( __FILE__, array( $wp_plugin_example1, 'deactivate') );

// uninstall
