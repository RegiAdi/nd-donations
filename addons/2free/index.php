<?php



$nd_donations_free_tab_content_enable = get_option('nd_donations_free_tab_content_enable');
if ( $nd_donations_free_tab_content_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


/*******************************FREE CONTENT******************************/
add_action( 'add_meta_boxes', 'nd_donations_metabox_causes_tab_free_content' );
function nd_donations_metabox_causes_tab_free_content() {
    add_meta_box( 'nd-donations-meta-box-cause-free-content-id', __('ND Donations - Tab Free Content','nd-donations'), 'nd_donations_metabox_cause_tab_free_content', 'causes', 'normal', 'high' );
}

function nd_donations_metabox_cause_tab_free_content()
{

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_donations_values = get_post_custom( $post->ID );
     
    $nd_donations_meta_box_cause_tab_free_content_title = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_tab_free_content_title', true );
    $nd_donations_meta_box_cause_tab_free_content_title_content = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_tab_free_content_title_content', true );
    $nd_donations_meta_box_cause_tab_free_content_content = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_tab_free_content_content', true );

    ?>

    <p><strong><?php _e('Title Tab','nd-donations'); ?></strong></p>
    <p><input id="nd_donations_meta_box_cause_tab_free_content_title" class="regular-text" type="text" name="nd_donations_meta_box_cause_tab_free_content_title" id="nd_donations_meta_box_cause_tab_free_content_title" value="<?php echo $nd_donations_meta_box_cause_tab_free_content_title; ?>" /></p>
    <p class="description"><?php _e('Insert the title for your tab','nd-donations'); ?></p>


    <p><strong><?php _e('Title Content','nd-donations'); ?></strong></p>
    <p><input id="nd_donations_meta_box_cause_tab_free_content_title_content" class="regular-text" type="text" name="nd_donations_meta_box_cause_tab_free_content_title_content" id="nd_donations_meta_box_cause_tab_free_content_title_content" value="<?php echo $nd_donations_meta_box_cause_tab_free_content_title_content; ?>" /></p>
    <p class="description"><?php _e('Insert the title for your content','nd-donations'); ?></p>

    <p><strong><?php _e('Content','nd-donations'); ?></strong></p>
    <p><textarea class="nd_donations_height_100 nd_donations_width_100_percentage" rows="1" cols="40" name="nd_donations_meta_box_cause_tab_free_content_content" id="nd_donations_meta_box_cause_tab_free_content_content"><?php echo $nd_donations_meta_box_cause_tab_free_content_content; ?></textarea></p>
    <p class="description"><?php _e('Insert your content','nd-donations'); ?></p>


    <?php    
}

add_action( 'save_post', 'nd_donations_meta_box_cause_tab_free_content_save' );
function nd_donations_meta_box_cause_tab_free_content_save( $post_id )
{

    $nd_donations_meta_box_cause_tab_free_content_title = sanitize_meta('nd_donations_meta_box_cause_tab_free_content_title',$_POST['nd_donations_meta_box_cause_tab_free_content_title'],'post');
    if ( isset( $nd_donations_meta_box_cause_tab_free_content_title ) ) { 

        if ( $nd_donations_meta_box_cause_tab_free_content_title != '' ) {
            update_post_meta( $post_id, 'nd_donations_meta_box_cause_tab_free_content_title' , $nd_donations_meta_box_cause_tab_free_content_title );
        }else{
            delete_post_meta( $post_id,'nd_donations_meta_box_cause_tab_free_content_title');
        }   

    }

    $nd_donations_meta_box_cause_tab_free_content_title_content = sanitize_meta('nd_donations_meta_box_cause_tab_free_content_title_content',$_POST['nd_donations_meta_box_cause_tab_free_content_title_content'],'post');
    if ( isset( $nd_donations_meta_box_cause_tab_free_content_title_content ) ) { 

        if ( $nd_donations_meta_box_cause_tab_free_content_title_content != '' ) {
            update_post_meta( $post_id, 'nd_donations_meta_box_cause_tab_free_content_title_content' , $nd_donations_meta_box_cause_tab_free_content_title_content ); 
        }else{
            delete_post_meta( $post_id,'nd_donations_meta_box_cause_tab_free_content_title_content');
        }
  
    }

    $nd_donations_meta_box_cause_tab_free_content_content = sanitize_meta('nd_donations_meta_box_cause_tab_free_content_content',$_POST['nd_donations_meta_box_cause_tab_free_content_content'],'post');
    if ( isset( $nd_donations_meta_box_cause_tab_free_content_content ) ) { 

        if ( $nd_donations_meta_box_cause_tab_free_content_content != '' ) {
            update_post_meta( $post_id, 'nd_donations_meta_box_cause_tab_free_content_content' , $nd_donations_meta_box_cause_tab_free_content_content );
        }else{
            delete_post_meta( $post_id,'nd_donations_meta_box_cause_tab_free_content_content');
        }

    }
}



//add tab on single cause page
function nd_donations_add_tab_free_content_on_single_cause(){


	//get datas
	$nd_donations_meta_box_cause_tab_free_content_title = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_tab_free_content_title', true );


	$nd_donations_free_tab = '';

	if ( $nd_donations_meta_box_cause_tab_free_content_title != '' ) {

		$nd_donations_free_tab .= '

			<li class="nd_donations_display_inline_block nd_donations_margin_right_40">
                <h4>
                  <a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_donations_single_cause_tab_free_content">
                    '.$nd_donations_meta_box_cause_tab_free_content_title.'
                  </a>
                </h4>
          </li>

		';

	}

	echo $nd_donations_free_tab;


}
add_action('nd_donations_single_cause_tab_list','nd_donations_add_tab_free_content_on_single_cause');




//add content on tab single cause page
function nd_donations_add_content_free_content_on_single_cause() {


    //get datas
    $nd_donations_meta_box_cause_tab_free_content_title = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_tab_free_content_title', true );
    $nd_donations_meta_box_cause_tab_free_content_title_content = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_tab_free_content_title_content', true );
    $nd_donations_meta_box_cause_tab_free_content_content = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_tab_free_content_content', true );


    $nd_donations_free_content = '';

    if ( $nd_donations_meta_box_cause_tab_free_content_title != '' ) {

        $nd_donations_title_content_output = '';

        if ( $nd_donations_meta_box_cause_tab_free_content_title_content != '' ) {
            $nd_donations_title_content_output .= '
                <h3><strong>'.$nd_donations_meta_box_cause_tab_free_content_title_content.'</strong></h3>
                <div class="nd_donations_section nd_donations_height_20"></div>  
            ';
        }

        $nd_donations_free_content .= '

            <div class="nd_donations_section" id="nd_donations_single_cause_tab_free_content">

                <div class="nd_donations_section nd_donations_height_10"></div>

                '.$nd_donations_title_content_output.'
                '.do_shortcode($nd_donations_meta_box_cause_tab_free_content_content).'
            </div>  

        ';

    }

    echo $nd_donations_free_content;

}
add_action('nd_donations_single_cause_tab_content','nd_donations_add_content_free_content_on_single_cause');


}
