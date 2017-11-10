<?php

// Get out if the user has accessed this file directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
  Plugin Name: Post Primary Category (10up)
  Plugin URI: https://github.com/magas0/primary-category-10up
  Description: A plugin to allow publishers to designate a primary category for posts.
  Version: 0.1
  Author: SM
  Author URI: https://github.com/magas0/
  License: GPL2
*/

// Define constant for plugin path
define( 'PC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// include files containing meta box and shortcode
include PC_PLUGIN_PATH . 'classes/class-tenup-post-primary-category.php';

$meta_box = new Tenup_Post_Primary_Category();
?>
