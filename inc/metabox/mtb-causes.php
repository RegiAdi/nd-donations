<?php

///////////////////////////////////////////////////METABOX ///////////////////////////////////////////////////////////////


add_action( 'add_meta_boxes', 'nd_donations_box_add' );
function nd_donations_box_add() {
    add_meta_box( 'my-meta-box-id', __('ND Donations - Cause Main Settings','nd-donations'), 'nd_donations_meta_box', 'causes', 'normal', 'high' );
}

function nd_donations_meta_box()
{

    //iris color picker
    wp_enqueue_script('iris');

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_donations_values = get_post_custom( $post->ID );
     
    $nd_donations_meta_box_price = get_post_meta( get_the_ID(), 'nd_donations_meta_box_price', true );
    $nd_donations_meta_box_color = get_post_meta( get_the_ID(), 'nd_donations_meta_box_color', true ); 

    ?>


    <p><strong><?php _e('Price','nd-donations'); ?></strong></p>
    <p><input type="text" name="nd_donations_meta_box_price" id="nd_donations_meta_box_price" value="<?php echo $nd_donations_meta_box_price; ?>" /></p>

    <p><strong><?php _e('Color','nd-donations'); ?></strong></p>
    <p><input id="nd_donations_colorpicker" type="text" name="nd_donations_meta_box_color" id="nd_donations_meta_box_color" value="<?php echo $nd_donations_meta_box_color; ?>" /></p>
    
    <script type="text/javascript">
      //<![CDATA[
      
      jQuery(document).ready(function($){
          $('#nd_donations_colorpicker').iris();
      });

      //]]>
    </script>

    <?php   

}


add_action( 'save_post', 'nd_donations_meta_box_save' );
function nd_donations_meta_box_save( $post_id )
{

    $nd_donations_meta_box_price = sanitize_meta('nd_donations_meta_box_price',$_POST['nd_donations_meta_box_price'],'post');
    if ( isset( $nd_donations_meta_box_price ) ) { 

        if ( $nd_donations_meta_box_price != '' ) {
            update_post_meta( $post_id, 'nd_donations_meta_box_price' , $nd_donations_meta_box_price ); 
        }else{
            delete_post_meta( $post_id,'nd_donations_meta_box_price');
        }
        
    }


    $nd_donations_meta_box_color = sanitize_hex_color( $_POST['nd_donations_meta_box_color'] );
    if ( isset( $nd_donations_meta_box_color ) ) { 

        if ( $nd_donations_meta_box_color != '' ) {
            update_post_meta( $post_id, 'nd_donations_meta_box_color' , $nd_donations_meta_box_color );
        }else{
            delete_post_meta( $post_id,'nd_donations_meta_box_color');
        }

    }

}