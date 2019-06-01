<?php
/**
 * @package wp_plugin_example1
 */
namespace Inc;

class Deactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
