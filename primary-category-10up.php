<?php

// Get out if the user has accessed this file directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
  Plugin Name: Primary Category (10up)
  Plugin URI: 
  Description: a plugin to allow publishers designate a primary category for posts.
  Version: 0.1
  Author: Magas
  Author URI:
  License: GPL2
*/

// Define constant for plugin path
define( 'PC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// include files containing meta box and shortcode
include PC_PLUGIN_PATH . 'classes/class-tenup-post-primary-category.php';

$meta_box = new Tenup_Post_Primary_Category();
?>
