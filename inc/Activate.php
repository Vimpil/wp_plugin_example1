<?php
/**
 * @package wp_plugin_example1
 */
namespace Inc;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();
    }
}
