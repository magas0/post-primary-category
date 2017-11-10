<?php

/**
 * Tenup_Post_Primary_Category class
 */
class Tenup_Post_Primary_Category {

  public function __construct() {
    // create these hooks so the meta boxes only appear on post pages
    add_action( 'load-post.php', array( $this, 'tenup_create_hooks' ) );
    add_action( 'load-post-new.php', array( $this, 'tenup_create_hooks' ) );
  }

  /**
  * Load our action hooks to add a meta box and when saving a post
  */
  public function tenup_create_hooks() {
    add_action( 'add_meta_boxes', array( $this, 'tenup_post_add_meta_box' ) );
    add_action( 'save_post', array( $this, 'tenup_post_save_meta_box' ), 10, 2 );
  }

  /**
  * Add the meta box to the top right side of the post admin page
  */
  public function tenup_post_add_meta_box() {
    add_meta_box(
      'tenup-primary-category',
      esc_html__( 'Primary Category' ),
      array( $this, 'tenup_primary_category_meta_box_content' ),
      'post',
      'side',
      'high'
    );
  }

  /**
   * Create the HTML for the meta box
   * @param object $post passing in post object
   * @return string $html string containing the html for the metabox
   */
  public function tenup_primary_category_meta_box_content( $post ) {

    $primary_category = '';
    $category_selected = get_post_meta( $post->ID, 'tenup_primary_category', true );

    if ( $category_selected != '' ) {
      $primary_category = $category_selected;
    }

    $args = array(
      'orderby' => 'term_id',
      'order' => 'ASC',
      'hide_empty' => FALSE,
    );

    // Get the list of categories
    $post_categories = get_categories( $args );    

    // Create the select box with category values to show in the meta box
    $html = '<select name="primary_category" id="primary_category">';

    // Set a default value for the option box
    $html .= '<option value="tenup_default_option_value">' . __( 'Select a primary category' ) . '</option>';

    foreach( $post_categories as $category ) {
      $html .= '<option value="' . $category->name . '" ' . selected( $primary_category, $category->name, false ) . '>' . __( $category->name ) . '</option>';
    }

    $html .= '</select>';

    // Add a nonce field to our form
    $html .= wp_nonce_field( basename( __FILE__ ), 'tenup_post_primary_category_nonce' );

    echo $html;
  }

  /**
   * Save the primary category choosen in the metabox into the post meta table
   * @param object $post passing in post object
   * @param integer $post_id
   */
  public function tenup_post_save_meta_box( $post_id, $post ) {

    // Verify the nonce
    if ( !isset( $_POST['tenup_post_primary_category_nonce'] ) || !wp_verify_nonce( $_POST['tenup_post_primary_category_nonce'], basename( __FILE__ ) ) ) {
      return $post_id;
    }

    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user can edit the post
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
      return $post_id;
    }

    if ( ( isset( $_POST['primary_category'] ) &&  ( $_POST['primary_category'] != 'tenup_default_option_value' ) ) ) {
      $primary_category = sanitize_text_field( $_POST['primary_category'] );
      update_post_meta( $post->ID, 'tenup_primary_category', $primary_category );
    }
  }
}
?>
