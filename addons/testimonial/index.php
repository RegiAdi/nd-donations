<?php


$nd_donations_testimonial_enable = get_option('nd_donations_testimonial_enable');
if ( $nd_donations_testimonial_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


/*******************************TESTIMONIAL******************************/
add_action( 'add_meta_boxes', 'nd_donations_metabox_causes_testimonial' );
function nd_donations_metabox_causes_testimonial() {
    add_meta_box( 'nd-donations-meta-box-cause-testimonial-id', __('ND Donations - Testimonial','nd-donations'), 'nd_donations_metabox_cause_testimonial', 'causes', 'normal', 'high' );
}

function nd_donations_metabox_cause_testimonial()
{

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_donations_values = get_post_custom( $post->ID );
     
    $nd_donations_meta_box_cause_testimonial = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_testimonial', true );
    $nd_donations_meta_box_cause_author = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_author', true );

    ?>

    <!--******************************TESTIMONIAL******************************-->
    <p><strong><?php _e('Testimonial','nd-donations'); ?></strong></p>
    <p><input id="nd_donations_meta_box_cause_testimonial" class="regular-text" type="text" name="nd_donations_meta_box_cause_testimonial" id="nd_donations_meta_box_cause_testimonial" value="<?php echo $nd_donations_meta_box_cause_testimonial; ?>" /></p>
    <p class="description"><?php _e('Insert the testimonial text','nd-donations'); ?></p>

    <!--******************************AUTHOR******************************-->
    <p><strong><?php _e('Author','nd-donations'); ?></strong></p>
    <p><input id="nd_donations_meta_box_cause_author" type="text" name="nd_donations_meta_box_cause_author" id="nd_donations_meta_box_cause_author" value="<?php echo $nd_donations_meta_box_cause_author; ?>" /></p>
    <p class="description"><?php _e('Insert the author','nd-donations'); ?></p>


    <?php    
}

add_action( 'save_post', 'nd_donations_meta_box_cause_testimonial_save' );
function nd_donations_meta_box_cause_testimonial_save( $post_id )
{

    $nd_donations_meta_box_cause_testimonial = sanitize_meta('nd_donations_meta_box_cause_testimonial',$_POST['nd_donations_meta_box_cause_testimonial'],'post');
    if ( isset( $nd_donations_meta_box_cause_testimonial ) ) { 

        if ( $nd_donations_meta_box_cause_testimonial != '' ) {
            update_post_meta( $post_id, 'nd_donations_meta_box_cause_testimonial' , $nd_donations_meta_box_cause_testimonial ); 
        }else{
            delete_post_meta( $post_id,'nd_donations_meta_box_cause_testimonial');
        }

    }

    $nd_donations_meta_box_cause_author = sanitize_meta('nd_donations_meta_box_cause_author',$_POST['nd_donations_meta_box_cause_author'],'post');
    if ( isset( $nd_donations_meta_box_cause_author ) ) { 

        if ( $nd_donations_meta_box_cause_author != '' ) {
            update_post_meta( $post_id, 'nd_donations_meta_box_cause_author' , $nd_donations_meta_box_cause_author );
        }else{
            delete_post_meta( $post_id,'nd_donations_meta_box_cause_author');
        }
 
    }
   
}



//add testimonial on single cause page
function nd_donations_add_testimonial_on_single_causes(){


	//get datas
	$nd_donations_meta_box_cause_testimonial = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_testimonial', true );
	$nd_donations_meta_box_cause_author = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_author', true );


	$nd_donations_testimonial = '';

	if ( $nd_donations_meta_box_cause_testimonial != '' ) {

		$nd_donations_testimonial .= '

			<!--START testimonial-->
			<div id="nd_donations_single_cause_header_testimonial_section" class="nd_donations_width_33_percentage nd_donations_width_100_percentage_all_iphone nd_donations_float_left_all_iphone nd_donations_display_block_all_iphone nd_donations_box_sizing_border_box_all_iphone nd_donations_margin_top_20_all_iphone nd_donations_padding_50 nd_donations_padding_20_responsive nd_donations_text_align_center nd_donations_display_table_cell nd_donations_vertical_align_middle">
				<img alt="" class="nd_donations_width_20_responsive" width="30" src="'.esc_url(plugins_url('icon-quote-white.svg', __FILE__ )).'">
				<div class="nd_donations_section nd_donations_height_20"></div>
				<h2 class="nd_donations_color_white_important nd_donations_font_size_17_responsive nd_donations_line_height_30">'.$nd_donations_meta_box_cause_testimonial.'</h2>
				<div class="nd_donations_section nd_donations_height_20"></div>
				<p class="nd_donations_color_white_important nd_donations_margin_0 nd_donations_font_size_13_responsive"><strong>'.$nd_donations_meta_box_cause_author.'</strong></p>
			</div>
			<!--END testimonial-->

		';

	}

	echo $nd_donations_testimonial;


}
add_action('nd_donations_single_cause_below_image_2','nd_donations_add_testimonial_on_single_causes');


}
