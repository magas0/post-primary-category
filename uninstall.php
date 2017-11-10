<?php
/*
  Plugin Name: Primary Category (10up)
  Plugin URI:
  Description: a plugin to allow publishers designate a primary category for posts.
  Version: 0.1
  Author: Magas
  Author URI:
  License: GPL2
*/

// if uninstall.php is not called by WordPress, die
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

// Loop over all posts and delete the meta data we have added
$query = new WP_Query( array( 'post_type' => 'post' ) );
$posts = $query->posts;

foreach( $posts as $post ) {
    delete_post_meta( $post->ID, 'tenup_primary_category' );
}

?>
