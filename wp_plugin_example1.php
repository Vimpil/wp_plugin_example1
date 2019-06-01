<?php
/*
 * Plugin Name: WpPluginExample1
 */

defined('ABSPATH') or die('no wordpress path found');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Inc\Activate;
use Inc\Deactivate;

require_once plugin_dir_path(__FILE__) . 'inc/Admin/AdminPages.php';

if (!class_exists('WpPluginExample1')) {
    class WpPluginExample1
    {

        public function __construct()
        {
            $this->plugin = plugin_basename(__FILE__);
        }

        public function register()
        {
            // add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
            add_action('wp_enqueue_scripts', array($this, 'enqueue'));

            add_action('admin_menu', array($this, 'add_admin_pages'));

            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));

            // add_filter('plugin_action_link_NAME-OF-MY-PLUGIN', array($this, 'settings_link'));

        }

        public function settings_link($links)
        {
            $settings_link = '<a href="admin.php?page=example_plugin">Settings</a>';
            array_push($links, $settings_link);
            return $links;
        }

        public function add_admin_pages()
        {
            add_menu_page('Plugin Example', 'Example1', 'manage_options', 'example_plugin', array($this, 'admin_index'), 'dashicons-admin-tools', 110);
        }

        public function admin_index()
        {
            require_once plugin_dir_path(__FILE__) . 'templates/index.php';
        }

        // function __construct($string){
        //     echo $string;
        // }

        public function activate()
        {
            // require_once plugin_dir_path(__FILE__) . 'inc/WpPluginExample1Activate.php';
            Activate::activate();
        }

        public function deactivate()
        {
            // require_once plugin_dir_path(__FILE__) . 'inc/WpPluginExample1Deactivate.php';
            Deactivate::deactivate();
            flush_rewrite_rules();
        }

        protected function customPostType()
        {
            register_post_type('example_post1', ['public' => true, 'label' => 'Books']);
        }

        public function enqueue()
        {
            wp_enqueue_style('WpPluginExample1', plugins_url('/assets/mystyle.css', __FILE__));
            wp_enqueue_script('WpPluginExample1', plugins_url('/assets/myscript.js', __FILE__));
        }

    }
}

$WpPluginExample1 = new WpPluginExample1();

$WpPluginExample1->register();
// WpPluginExample1::register();

// add files
register_activation_hook(__FILE__, array($WpPluginExample1, 'enqueue'));

// activation

register_activation_hook(__FILE__, array($WpPluginExample1, 'activate'));

// deactivation

register_deactivation_hook(__FILE__, array($WpPluginExample1, 'deactivate'));
