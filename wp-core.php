<?php
/*
Plugin Name: Core WP Plugin
Author: Steven Jones 
Author URI: http://www.stomptheweb.co.uk
Version: 0.1
*/

/**
 * Constants
 */

// Plugin folder url
if(!defined('SJ_PLUGIN_URL')) {
	define('SJ_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
// Plugin folder path
if(!defined('SJ_PLUGIN_DIR')) {
	define('SJ_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
}
// Plugin root file
if(!defined('SJ_PLUGIN_FILE')) {
	define('SJ_PLUGIN_FILE', __FILE__);
}

/**
 * Includes
 */

require_once dirname( __FILE__ ) . '/includes/admin.php';
require_once dirname( __FILE__ ) . '/includes/functions.php';
require_once dirname( __FILE__ ) . '/includes/templating.php';
require_once dirname( __FILE__ ) . '/includes/filters.php';