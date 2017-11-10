<?php
/*
  Plugin Name: Post Primary Category (10up)
  Plugin URI: https://github.com/magas0/primary-category-10up
  Description: a plugin to allow publishers designate a primary category for posts.
  Version: 0.1
  Author: SM
  Author URI: https://github.com/magas0/
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
