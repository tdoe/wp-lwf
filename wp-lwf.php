<?php
/**
 * Created by IntelliJ IDEA.
 * User: tdoe
 * Date: 2013/10/27
 * Time: 18:06
 *
Plugin Name: wp-lwf
Plugin URI: https://github.com/tdoe/wp-lwf
Description: LWF rendering plugin
Version: 0.0.1
Author: Tadahiro oe
Author URI:
License: GPLv2 or later
 */

if (!function_exists('add_action') || !function_exists('add_filter')) {
    echo 'I am wordpress plugin.';
    exit;
}

$include_dir = dirname(__FILE__) . '/include/';

// upload setting.
require_once $include_dir . 'upload_setting.php';
add_filter('ext2type', 'addLwfType');
add_filter('upload_mimes', 'addLwfMimeType');

// lwf setting js load.
require_once $include_dir . 'lwf_setting.php';
add_filter('the_content', 'wpLwfSettingParse');

// lwf content load.
require_once $include_dir . 'lwf_content.php';
add_filter('the_content', 'wpLwfParse');

add_action('wp_head', 'addWpLwfHeader');

function addWpLwfHeader()
{

    $lwf_url = WP_PLUGIN_URL . '/wp-lwf/lwf-loader/js/lwf.js';
    $lwf_loader_url = WP_PLUGIN_URL . '/wp-lwf/lwf-loader/js/lwf-loader-all.min.js';

    echo <<<EOT
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.2.1/lodash.min.js"></script>
<script type="text/javascript" src="$lwf_url"></script>
<script type="text/javascript" src="$lwf_loader_url"></script>
EOT;

}