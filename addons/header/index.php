<?php


$nd_donations_header_img_enable = get_option('nd_donations_header_img_enable');
if ( $nd_donations_header_img_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


/*******************************HEADER IMG******************************/
add_action( 'add_meta_boxes', 'nd_donations_metabox_causes_header_img' );
function nd_donations_metabox_causes_header_img() {
    add_meta_box( 'nd-donations-meta-box-cause-header-img-id', __('ND Donations - Header Image','nd-donations'), 'nd_donations_metabox_cause_header_img', 'causes', 'normal', 'high' );
}

function nd_donations_metabox_cause_header_img()
{

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_donations_values = get_post_custom( $post->ID );
     
    $nd_donations_meta_box_cause_header_img = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_header_img', true );
    $nd_donations_meta_box_cause_header_img_position = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_header_img_position', true );
    $nd_donations_meta_box_cause_header_img_margin_top = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_header_img_margin_top', true );
    $nd_donations_meta_box_cause_header_img_margin_bottom = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_header_img_margin_bottom', true );

    ?>


    <!--******************************IMAGE******************************-->
    <p><strong><?php _e('Header Image','nd-donations'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_donations_meta_box_cause_header_img" id="nd_donations_meta_box_cause_header_img" value="<?php echo $nd_donations_meta_box_cause_header_img; ?>" /></p>
    <p>
      <input class="button nd_donations_meta_box_cause_header_img_button" type="button" name="nd_donations_meta_box_cause_header_img_button" id="nd_donations_meta_box_cause_header_img_button" value="<?php _e('Upload','nd-donations'); ?>" />
    </p>

    <!--******************************POSITION******************************-->
    <p><strong><?php _e('Image Position','nd-donations'); ?></strong></p>
    <p>
      <select name="nd_donations_meta_box_cause_header_img_position" id="nd_donations_meta_box_cause_header_img_position">
        
        <option <?php if( $nd_donations_meta_box_cause_header_img_position == 'nd_donations_background_position_center_top' ) { echo 'selected="selected"'; } ?> value="nd_donations_background_position_center_top">Position Top</option>
        <option <?php if( $nd_donations_meta_box_cause_header_img_position == 'nd_donations_background_position_center_bottom' ) { echo 'selected="selected"'; } ?> value="nd_donations_background_position_center_bottom">Position Bottom</option>
        <option <?php if( $nd_donations_meta_box_cause_header_img_position == 'nd_donations_background_position_center' ) { echo 'selected="selected"'; } ?> value="nd_donations_background_position_center">Position Center</option>
         
      </select>
    </p>

    <!--******************************MARGIN TOP******************************-->
    <p><strong><?php _e('Margin Top','nd-donations'); ?></strong></p>
    <p><input id="nd_donations_meta_box_cause_header_img_margin_top" type="text" name="nd_donations_meta_box_cause_header_img_margin_top" id="nd_donations_meta_box_cause_header_img_margin_top" value="<?php echo $nd_donations_meta_box_cause_header_img_margin_top; ?>" /></p>
    <p class="description"><?php _e('Insert the margin top for the title ( only numbner, eg: 200 )','nd-donations'); ?></p>

    <!--******************************MARGIN BOTTOM******************************-->
    <p><strong><?php _e('Margin Bottom','nd-donations'); ?></strong></p>
    <p><input id="nd_donations_meta_box_cause_header_img_margin_bottom" type="text" name="nd_donations_meta_box_cause_header_img_margin_bottom" id="nd_donations_meta_box_cause_header_img_margin_bottom" value="<?php echo $nd_donations_meta_box_cause_header_img_margin_bottom; ?>" /></p>
    <p class="description"><?php _e('Insert the margin bottom for the title ( only numbner, eg: 200 )','nd-donations'); ?></p>




    <script type="text/javascript">
      //<![CDATA[
      
    jQuery(document).ready(function() {

      jQuery( function ( $ ) {

        var file_frame = [],
        $button = $( '.nd_donations_meta_box_cause_header_img_button' );


        $('#nd_donations_meta_box_cause_header_img_button').click( function () {


          var $this = $( this ),
            id = $this.attr( 'id' );

          // If the media frame already exists, reopen it.
          if ( file_frame[ id ] ) {
            file_frame[ id ].open();

            return;
          }

          // Create the media frame.
          file_frame[ id ] = wp.media.frames.file_frame = wp.media( {
            title    : $this.data( 'uploader_title' ),
            button   : {
              text : $this.data( 'uploader_button_text' )
            },
            multiple : false  // Set to true to allow multiple files to be selected
          } );

          // When an image is selected, run a callback.
          file_frame[ id ].on( 'select', function() {

            // We set multiple to false so only get one image from the uploader
            var attachment = file_frame[ id ].state().get( 'selection' ).first().toJSON();

            $('#nd_donations_meta_box_cause_header_img').val(attachment.url);

          } );

          // Finally, open the modal
          file_frame[ id ].open();


        } );

      });

    });

      //]]>
    </script>


    <?php    
}

add_action( 'save_post', 'nd_donations_meta_box_cause_header_img_save' );
function nd_donations_meta_box_cause_header_img_save( $post_id )
{

    $nd_donations_meta_box_cause_header_img = esc_url_raw( $_POST['nd_donations_meta_box_cause_header_img'] );
    if ( isset( $nd_donations_meta_box_cause_header_img ) ) { 

      if ( $nd_donations_meta_box_cause_header_img != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_cause_header_img' , $nd_donations_meta_box_cause_header_img );
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_cause_header_img');
      }
 
    }

    $nd_donations_meta_box_cause_header_img_position = sanitize_option( 'nd_donations_meta_box_cause_header_img_position', $_POST['nd_donations_meta_box_cause_header_img_position'] );
    if ( isset( $nd_donations_meta_box_cause_header_img_position ) ) { 

      if ( $nd_donations_meta_box_cause_header_img_position != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_cause_header_img_position' , $nd_donations_meta_box_cause_header_img_position ); 
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_cause_header_img_position');
      }

    }

    $nd_donations_meta_box_cause_header_img_margin_top = sanitize_meta('nd_donations_meta_box_cause_header_img_margin_top',$_POST['nd_donations_meta_box_cause_header_img_margin_top'],'post');
    if ( isset( $nd_donations_meta_box_cause_header_img_margin_top ) ) { 

      if ( $nd_donations_meta_box_cause_header_img_margin_top != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_cause_header_img_margin_top' , $nd_donations_meta_box_cause_header_img_margin_top );
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_cause_header_img_margin_top');
      }

    }

    $nd_donations_meta_box_cause_header_img_margin_bottom = sanitize_meta('nd_donations_meta_box_cause_header_img_margin_bottom',$_POST['nd_donations_meta_box_cause_header_img_margin_bottom'],'post');
    if ( isset( $nd_donations_meta_box_cause_header_img_margin_bottom ) ) { 

      if ( $nd_donations_meta_box_cause_header_img_margin_bottom != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_cause_header_img_margin_bottom' , $nd_donations_meta_box_cause_header_img_margin_bottom ); 
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_cause_header_img_margin_bottom');
      }

    }
         
}





//add header section on single cause
function nd_donations_single_cause_add_header(){


	//get datas
	$nd_donations_meta_box_cause_header_img = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_header_img', true );
	$nd_donations_meta_box_cause_header_img_position = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_header_img_position', true );
	$nd_donations_meta_box_cause_header_img_margin_top = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_header_img_margin_top', true );
	$nd_donations_meta_box_cause_header_img_margin_bottom = get_post_meta( get_the_ID(), 'nd_donations_meta_box_cause_header_img_margin_bottom', true );


	//default
	if ( $nd_donations_meta_box_cause_header_img_margin_top == '' ) { $nd_donations_meta_box_cause_header_img_margin_top = 100; }
	if ( $nd_donations_meta_box_cause_header_img_margin_bottom == '' ) { $nd_donations_meta_box_cause_header_img_margin_bottom = 100; }
	if ( $nd_donations_meta_box_cause_header_img_position == '' ) { $nd_donations_meta_box_cause_header_img_position = 'nd_donations_background_position_center'; }


	$nd_donations_single_cause_header = '';

	$nd_donations_single_cause_header .= '


		<div id="nd_donations_single_cause_header_img" class="nd_donations_section nd_donations_background_size_cover '.$nd_donations_meta_box_cause_header_img_position.' " style="background-image:url('.$nd_donations_meta_box_cause_header_img.');">

		    <div id="nd_donations_single_cause_header_img_filter" class="nd_donations_section nd_donations_bg_greydark_alpha_3">';

		    	//if header img not set
		    	if ( $nd_donations_meta_box_cause_header_img == '' ) {
					$nd_donations_single_cause_header .= '<div style="background-color:'.nd_donations_get_cause_color(get_the_ID()).';" class="nd_donations_section">';
				}

			    //add conteiner
				if ( nd_donations_get_container() != 1) { $nd_donations_single_cause_header .= '<div class="nd_donations_container nd_donations_clearfix">'; }

					
					$nd_donations_single_cause_header .= '
		            <div id="nd_donations_single_cause_header_img_spacer_top" style="height:'.$nd_donations_meta_box_cause_header_img_margin_top.'px;" class="nd_donations_section"></div>


		            <div id="nd_donations_single_cause_header_img_title_content" class="nd_donations_width_50_percentage nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_width_100_percentage_all_iphone nd_donations_float_left">

		                <h1 id="nd_donations_single_cause_header_img_title" class="nd_donations_color_white_important nd_donations_font_size_40 nd_options_first_font">'.get_the_title().'</h1>
		                
		            </div>

		            <div id="nd_donations_single_cause_header_img_title_content_2" class="nd_donations_width_50_percentage nd_donations_padding_15 nd_donations_float_left"></div>


		            <div id="nd_donations_single_cause_header_img_spacer_bottom" style="height:'.$nd_donations_meta_box_cause_header_img_margin_bottom.'px;"  class="nd_donations_section"></div>';


		        //close conteiner
				if ( nd_donations_get_container() != 1) { $nd_donations_single_cause_header .= '</div>'; }


				//close div if header img not set
		    	if ( $nd_donations_meta_box_cause_header_img == '' ) {
					$nd_donations_single_cause_header .= '</div>';
				}

		    $nd_donations_single_cause_header .= '
		    </div>

		</div>


	';


	echo $nd_donations_single_cause_header;

}
add_action('nd_donations_single_cause_below_header','nd_donations_single_cause_add_header');


}
