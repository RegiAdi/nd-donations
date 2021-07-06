<?php

$nd_donations_sidebar_enable = get_option('nd_donations_sidebar_enable');
if ( $nd_donations_sidebar_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

  //START create sidebar
  function nd_donations_single_cause_sidebar() {

      // Sidebar Main
      register_sidebar(array(
          'name' =>  esc_html__('ND Donations Sidebar','nd-donations'),
          'id' => 'nd_donations_sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget' => '</div>',
          'before_title' => '<h3>',
          'after_title' => '</h3>',
      ));

  }
  add_action( 'widgets_init', 'nd_donations_single_cause_sidebar' );
  //END create sidebar




  /******************************* METABOX SIDEBAR ******************************/
  //START create metabox function
  add_action( 'add_meta_boxes', 'nd_donations_metabox_cause_sidebar' );
  function nd_donations_metabox_cause_sidebar() {
      add_meta_box( 'nd-options-meta-box-cause-sidebar-id', __('ND Donations - Sidebar','nd-donations'), 'nd_donations_metabox_donations_sidebar', 'causes', 'normal', 'high' );
  }
  //END create metabox function


  //START adding all metabox
  function nd_donations_metabox_donations_sidebar()
  {

      global $post;
      $nd_donations_values = get_post_custom( $post->ID );

      $nd_donations_meta_box_cause_sidebar_position = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_sidebar_position', true );  

      ?>

      <p><strong><?php _e('Sidebar Position','nd-donations'); ?></strong></p>
      <p>
        <select name="nd_donations_meta_box_cause_sidebar_position" id="nd_donations_meta_box_cause_sidebar_position">
          
          <option <?php if( $nd_donations_meta_box_cause_sidebar_position == 'nd_donations_full_width' ) { echo 'selected="selected"'; } ?> value="nd_donations_full_width"><?php _e('Page Full Width','nd-donations'); ?></option>
          <option <?php if( $nd_donations_meta_box_cause_sidebar_position == 'nd_donations_left_sidebar' ) { echo 'selected="selected"'; } ?> value="nd_donations_left_sidebar"><?php _e('Left Sidebar','nd-donations'); ?></option>
          <option <?php if( $nd_donations_meta_box_cause_sidebar_position == 'nd_donations_right_sidebar' ) { echo 'selected="selected"'; } ?> value="nd_donations_right_sidebar"><?php _e('Right Sidebar','nd-donations'); ?></option>
           
        </select>
      </p>
      <p class="description"><?php _e('Please for insert the content of the sidebar go in Appearance -> Widgtes','nd-donations'); ?></p>


      <?php   
  }
  //END adding all metabox



  //START create save metabox
  add_action( 'save_post', 'nd_donations_meta_box_post_sidebar_save' );
  function nd_donations_meta_box_post_sidebar_save( $post_id )
  {

      $nd_donations_meta_box_cause_sidebar_position = sanitize_option( 'nd_donations_meta_box_cause_sidebar_position', $_POST['nd_donations_meta_box_cause_sidebar_position'] );
      if ( isset( $nd_donations_meta_box_cause_sidebar_position ) ) { 

        if ( $nd_donations_meta_box_cause_sidebar_position != '' ) {
          update_post_meta( $post_id, 'nd_donations_meta_box_cause_sidebar_position' , $nd_donations_meta_box_cause_sidebar_position );
        }else{
          delete_post_meta( $post_id,'nd_donations_meta_box_cause_sidebar_position');
        }

      }
           
  }
  //END create save metabox



  //call function
  add_action('nd_donations_single_cause_before_text_content','nd_donations_add_sidebar_left_on_single_cause');
  add_action('nd_donations_single_cause_after_text_content','nd_donations_add_sidebar_right_on_single_cause');

  //insert sidebar LEFT on content
  function nd_donations_add_sidebar_left_on_single_cause(){

    $nd_donations_cause_sidebar = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_sidebar_position', true );
    if ( $nd_donations_cause_sidebar == 'nd_donations_left_sidebar' ) {
      echo '<div class="nd_donations_width_33_percentage nd_donations_sidebar nd_donations_width_100_percentage_responsive nd_donations_float_left nd_donations_padding_15 nd_donations_box_sizing_border_box">';
        dynamic_sidebar('nd_donations_sidebar');
      echo '</div>';
    }

  }

  //insert sidebar RIGHT on content
  function nd_donations_add_sidebar_right_on_single_cause(){

    $nd_donations_cause_sidebar = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_sidebar_position', true );
    if ( $nd_donations_cause_sidebar == 'nd_donations_right_sidebar' ) {
      echo '<div class="nd_donations_width_33_percentage nd_donations_sidebar nd_donations_width_100_percentage_responsive nd_donations_float_left nd_donations_padding_15 nd_donations_box_sizing_border_box">';
        dynamic_sidebar('nd_donations_sidebar');
      echo '</div>';
    }

  }


}
