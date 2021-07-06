<?php


$nd_donations_urgent_enable = get_option('nd_donations_urgent_enable');
if ( $nd_donations_urgent_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


//START create metabox function
add_action( 'add_meta_boxes', 'nd_donations_metabox_urgent_label' );
function nd_donations_metabox_urgent_label() {
    add_meta_box( 'nd-donations-meta-box-urgent-id', __('ND Donations - Urgent','nd-donations'), 'nd_donations_metabox_urgent', 'causes', 'normal', 'high' );
}


//START adding metabox
function nd_donations_metabox_urgent()
{

    //values
    global $post;
    $nd_donations_values = get_post_custom( $post->ID );

    $nd_donations_meta_box_urgent = get_post_meta( get_the_ID(), 'nd_donations_meta_box_urgent', true ); 

    ?>


   	<!--******************************URGENT******************************-->
    <p><strong><?php _e('Urgent','nd-donations'); ?></strong></p>
   	<p><input id="nd_donations_meta_box_urgent" type="checkbox" <?php if( $nd_donations_meta_box_urgent == 1 ) { echo 'checked="checked"'; }  ?> name="nd_donations_meta_box_urgent" value="0"/></p>
   	<p class="description"><?php _e('Check if you want to add urgent label on your cause','nd-donations'); ?></p>


    <?php    
}



//START create save metabox
add_action( 'save_post', 'nd_donations_meta_box_urgent_save' );
function nd_donations_meta_box_urgent_save( $post_id )
{

    //save urgent
	$nd_donations_meta_box_urgent = sanitize_meta('nd_donations_meta_box_urgent',$_POST['nd_donations_meta_box_urgent'],'post');
    if( isset( $_POST['nd_donations_meta_box_urgent'] ) ){ update_post_meta( $post_id, 'nd_donations_meta_box_urgent', 1 );
    }else{ update_post_meta( $post_id, 'nd_donations_meta_box_urgent', 0 ); }

         
}



//add urgent donation label on archive causes preview
function nd_donations_add_urgent_donation_label_on_archive_causes_preview($nd_donations_urgent_position_top,$nd_donations_urgent_position_left){


	$nd_donations_urgent_donation = '';


	if ( has_post_thumbnail() ) { 

		$nd_donations_meta_box_urgent = get_post_meta( get_the_ID(), 'nd_donations_meta_box_urgent', true ); 

		if ( $nd_donations_meta_box_urgent == 1 ) {

			$nd_donations_urgent_donation .= '

			<div style="top:'.$nd_donations_urgent_position_top.'px;left:'.$nd_donations_urgent_position_left.'px;" class="nd_donations_position_absolute nd_donations_urgent_label">
	                                        
	            <div class="nd_donations_bg_red nd_donations_padding_10 nd_donations_float_left">
	                <p class="nd_donations_margin_0 nd_donations_color_white_important nd_donations_font_size_13 nd_donations_float_left nd_donations_margin_right_5">'.__('URGENT','nd-donations').'</p>
	                <img alt="" class="nd_donations_float_left" width="12" src="'.esc_url(plugins_url('icon-thunder-white.svg', __FILE__ )).'">
	            </div>

	        </div>

		';

		}


	}


	echo $nd_donations_urgent_donation;

}
add_action('nd_donations_archive_causes_preview_below_title','nd_donations_add_urgent_donation_label_on_archive_causes_preview',10,2);
add_action('nd_donations_single_cause_below_image','nd_donations_add_urgent_donation_label_on_archive_causes_preview',10,2);


}

