<?php
/*
Plugin Name: Block Referer Spam
Plugin URI: https://wordpress.org/plugins/block-referer-spam/
Description: Prevents referer spam from accessing your site and cleans up your Google Analytics in the process.
Author: codestic
Version: 1.0.4
Author URI: http://codestic.com
Text Domain: ref-spam-blocker
Domain Path: /languages
*/

if (defined('ABSPATH') && !class_exists('RefSpamBlocker')) {
    if (!defined('REFSPAMBLOCKER_VERSION')) {
        define('REFSPAMBLOCKER_VERSION', '1.0.4');
    }

    if (!defined('REFSPAMBLOCKER_TEXTDOMAIN')) {
        define('REFSPAMBLOCKER_TEXTDOMAIN', 'ref-spam-blocker');
    }

    if (!defined('REFSPAMBLOCKER_DIRNAME')) {
        define('REFSPAMBLOCKER_DIRNAME', dirname(plugin_basename(__FILE__)));
    }

    if (!defined('REFSPAMBLOCKER_PATH')) {
        define('REFSPAMBLOCKER_PATH', trailingslashit(dirname(__FILE__)));
    }

    if (!defined('REFSPAMBLOCKER_URL')) {
        define('REFSPAMBLOCKER_URL', trailingslashit(plugins_url('', __FILE__)));
    }

    define('REFSPAMBLOCKER_PLUGIN_URL', 'https://wordpress.org/plugins/block-referer-spam/');
    define('REFSPAMBLOCKER_LIST_URL', 'http://refspam.codestic.com/list/');
}

require_once REFSPAMBLOCKER_PATH . 'lib/RefSpamBlocker.php';

$rsb = new RefSpamBlocker(__FILE__);