<?php
/**
 * Created by IntelliJ IDEA.
 * User: tdoe
 * Date: 2013/10/27
 * Time: 18:06
 *
Plugin Name: wp-lwf
Plugin URI:
Description:
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
