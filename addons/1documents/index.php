<?php



$nd_donations_documents_enable = get_option('nd_donations_documents_enable');
if ( $nd_donations_documents_enable == 1 and get_option('nicdark_theme_author') == 1 ) {



///////////////////////////////////////////////////DOCUMENTS CPT///////////////////////////////////////////////////////////////
function nd_donations_create_post_type_documents() {
    register_post_type('nd_donations_docs',
        array(
            'labels' => array(
                'name' => __('Documents', 'nd-donations'),
                'singular_name' => __('Documents', 'nd-donations')
            ),
            'public' => true,
            'has_archive' => false,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'documents'),
            'menu_icon'   => 'dashicons-paperclip',
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
}
add_action('init', 'nd_donations_create_post_type_documents');







///////////////////////////////////////////////////METABOX ON CPT///////////////////////////////////////////////////////////////
add_action( 'add_meta_boxes', 'nd_donations_meta_box_document' );
function nd_donations_meta_box_document() {
    add_meta_box( 'nd-donations-meta-box-documents', __('ND Donations - Document Main Settings','nd-donations'), 'nd_donations_meta_box_documents', 'nd_donations_docs', 'normal', 'high' );
}

function nd_donations_meta_box_documents()
{


    //iris color picker
    wp_enqueue_script('iris');

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_donations_values = get_post_custom( $post->ID );
     
    $nd_donations_meta_box_document_subtitle = get_post_meta( get_the_ID(), 'nd_donations_meta_box_document_subtitle', true ); 
    $nd_donations_meta_box_document_color = get_post_meta( get_the_ID(), 'nd_donations_meta_box_document_color', true );
    $nd_donations_meta_box_document_icon = get_post_meta( get_the_ID(), 'nd_donations_meta_box_document_icon', true );
    $nd_donations_meta_box_document_visibility = get_post_meta( get_the_ID(), 'nd_donations_meta_box_document_visibility', true );
    
    ?>

    <p><strong><?php _e('Sub Title','nd-donations'); ?></strong></p>
    <p><input type="text" name="nd_donations_meta_box_document_subtitle" id="nd_donations_meta_box_document_subtitle" value="<?php echo $nd_donations_meta_box_document_subtitle; ?>" /></p>

    <p><strong><?php _e('Button Color Preview','nd-donations'); ?></strong></p>
    <p><input id="nd_donations_colorpicker" type="text" name="nd_donations_meta_box_document_color" value="<?php echo $nd_donations_meta_box_document_color; ?>" /></p>
    
    <script type="text/javascript">
      //<![CDATA[
      
      jQuery(document).ready(function($){
          $('#nd_donations_colorpicker').iris();
      });

      //]]>
    </script>


    <p><strong><?php _e('Icon Document','nd-donations'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_donations_meta_box_document_icon" id="nd_donations_meta_box_document_icon" value="<?php echo $nd_donations_meta_box_document_icon; ?>" /></p>
    <p>
      <input class="button nd_donations_meta_box_document_icon_button" type="button" name="nd_donations_meta_box_document_icon_button" id="nd_donations_meta_box_document_icon_button" value="<?php _e('Upload','nd-donations'); ?>" />
    </p>


    <script type="text/javascript">
      //<![CDATA[
      
    jQuery(document).ready(function() {

      jQuery( function ( $ ) {

        var file_frame = [],
        $button = $( '.nd_donations_meta_box_document_icon_button' );


        $('#nd_donations_meta_box_document_icon_button').click( function () {


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

            $('#nd_donations_meta_box_document_icon').val(attachment.url);

          } );

          // Finally, open the modal
          file_frame[ id ].open();


        } );

      });

    });

      //]]>
    </script>




    <p><strong><?php _e('Visibility','nd-donations'); ?></strong></p>
    <p>
      <select name="nd_donations_meta_box_document_visibility" id="nd_donations_meta_box_document_visibility">
        
        <option <?php if( $nd_donations_meta_box_document_visibility == 'nd_donations_meta_box_document_visibility_public' ) { echo 'selected="selected"'; } ?> value="nd_donations_meta_box_document_visibility_public"><?php _e('Public Document','nd-donations'); ?></option>
        <option <?php if( $nd_donations_meta_box_document_visibility == 'nd_donations_meta_box_document_visibility_private' ) { echo 'selected="selected"'; } ?> value="nd_donations_meta_box_document_visibility_private"><?php _e('Private Document','nd-donations'); ?></option>
         
      </select>
    </p>


    <?php    
}



add_action( 'save_post', 'nd_donations_meta_box_documents_save' );
function nd_donations_meta_box_documents_save( $post_id )
{

    $nd_donations_meta_box_document_subtitle = sanitize_meta('nd_donations_meta_box_document_subtitle',$_POST['nd_donations_meta_box_document_subtitle'],'post');
    if ( isset( $nd_donations_meta_box_document_subtitle ) ) { 

      if ( $nd_donations_meta_box_document_subtitle != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_document_subtitle' , $nd_donations_meta_box_document_subtitle );
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_document_subtitle');
      }

    }

    $nd_donations_meta_box_document_color = sanitize_hex_color( $_POST['nd_donations_meta_box_document_color'] );
    if ( isset( $nd_donations_meta_box_document_color ) ) { 

      if ( $nd_donations_meta_box_document_color != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_document_color' , $nd_donations_meta_box_document_color ); 
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_document_color');
      }

    }

    $nd_donations_meta_box_document_icon = esc_url_raw( $_POST['nd_donations_meta_box_document_icon'] );
    if ( isset( $nd_donations_meta_box_document_icon ) ) { 

      if ( $nd_donations_meta_box_document_icon != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_document_icon' , $nd_donations_meta_box_document_icon ); 
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_document_icon');
      }

    }

    $nd_donations_meta_box_document_visibility = sanitize_option( 'nd_donations_meta_box_document_visibility', $_POST['nd_donations_meta_box_document_visibility'] );
    if ( isset( $nd_donations_meta_box_document_visibility ) ) { 

      if ( $nd_donations_meta_box_document_visibility != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_document_visibility' , $nd_donations_meta_box_document_visibility );
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_document_visibility');
      }
 
    }
         
}



///////////////////////////////////////////////////METABOX ON CAUSES///////////////////////////////////////////////////////////////
add_action( 'add_meta_boxes', 'nd_donations_add_meta_box_documents_causes' );
function nd_donations_add_meta_box_documents_causes() {
    add_meta_box( 'nd-donations-meta-box-documents-causes', __('ND Donations - Documents Settings','nd-donations'), 'nd_donations_meta_box_documents_causes', 'causes', 'normal', 'default' );
}

function nd_donations_meta_box_documents_causes()
{


    //jquery-ui-autocomplete
    wp_enqueue_script('jquery-ui-autocomplete'); 


    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_donations_values = get_post_custom( $post->ID );
     
    $nd_donations_meta_box_title_tab = get_post_meta( get_the_ID(), 'nd_donations_meta_box_title_tab', true );
    $nd_donations_meta_box_title_tab_content = get_post_meta( get_the_ID(), 'nd_donations_meta_box_title_tab_content', true );
    $nd_donations_meta_box_docs_causes = get_post_meta( get_the_ID(), 'nd_donations_meta_box_docs_causes', true );

    ?>


    <p><strong><?php _e('Title Tab','nd-donations'); ?></strong></p>
    <p><input type="text" name="nd_donations_meta_box_title_tab" id="nd_donations_meta_box_title_tab" value="<?php echo $nd_donations_meta_box_title_tab; ?>" /></p>

    <p><strong><?php _e('Title Tab Content','nd-donations'); ?></strong></p>
    <p><input type="text" name="nd_donations_meta_box_title_tab_content" id="nd_donations_meta_box_title_tab_content" value="<?php echo $nd_donations_meta_box_title_tab_content; ?>" /></p>

    <p><strong><?php _e('Documents','nd-donations'); ?></strong></p>
    <p><input class="regular-text" type="text" name="nd_donations_meta_box_docs_causes" id="nd_donations_meta_box_docs_causes" value="<?php echo $nd_donations_meta_box_docs_causes; ?>" /></p>
    <p class="description"><?php _e('Start writing your document\'s name, this is an intuitive field','nd-donations'); ?></p>

    <script type="text/javascript">
      //<![CDATA[

      jQuery(document).ready(function($){
        var nd_donations_available_documents = [ 

          //start all documents list
          <?php 

            $nd_donations_documents_args = array( 'posts_per_page' => -1, 'post_type'=> 'nd_donations_docs' );
            $nd_donations_documents = get_posts($nd_donations_documents_args); 

            foreach ($nd_donations_documents as $nd_donations_teacher) :
              echo '"'.$nd_donations_teacher->post_name.'",'; 
            endforeach;
            
          ?>
          //end all documents list

        ];
        function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }
     
        $( "#nd_donations_meta_box_docs_causes" )
          // don't navigate away from the field on tab when selecting an item
          .on( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
              event.preventDefault();
            }
          })
          .autocomplete({
            minLength: 0,
            source: function( request, response ) {
              // delegate back to autocomplete, but extract the last term
              response( $.ui.autocomplete.filter(
                nd_donations_available_documents, extractLast( request.term ) ) );
            },
            focus: function() {
              // prevent value inserted on focus
              return false;
            },
            select: function( event, ui ) {
              var terms = split( this.value );
              // remove the current input
              terms.pop();
              // add the selected item
              terms.push( ui.item.value );
              // add placeholder to get the comma-and-space at the end
              terms.push( "" );
              this.value = terms.join( "," );
              return false;
            }
          });
      } );

      //]]>
    </script>


    <?php    
}

add_action( 'save_post', 'nd_donations_meta_box_docs_causes_save' );
function nd_donations_meta_box_docs_causes_save( $post_id )
{

    $nd_donations_meta_box_title_tab = sanitize_meta('nd_donations_meta_box_title_tab',$_POST['nd_donations_meta_box_title_tab'],'post');
    if ( isset( $nd_donations_meta_box_title_tab ) ) { 

      if ( $nd_donations_meta_box_title_tab != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_title_tab' , $nd_donations_meta_box_title_tab );
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_title_tab');
      }

    }

    $nd_donations_meta_box_title_tab_content = sanitize_meta('nd_donations_meta_box_title_tab_content',$_POST['nd_donations_meta_box_title_tab_content'],'post');
    if ( isset( $nd_donations_meta_box_title_tab_content ) ) { 

      if ( $nd_donations_meta_box_title_tab_content != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_title_tab_content' , $nd_donations_meta_box_title_tab_content );
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_title_tab_content');
      }

    }

    $nd_donations_meta_box_docs_causes = sanitize_meta('nd_donations_meta_box_docs_causes',$_POST['nd_donations_meta_box_docs_causes'],'post');
    if ( isset( $nd_donations_meta_box_docs_causes ) ) { 

      if ( $nd_donations_meta_box_docs_causes != '' ) {
        update_post_meta( $post_id, 'nd_donations_meta_box_docs_causes' , $nd_donations_meta_box_docs_causes ); 
      }else{
        delete_post_meta( $post_id,'nd_donations_meta_box_docs_causes');
      }

    }
         
}





///////////////////////////////////////////////////ADD CONTENT IN SINGLE cause PAGE///////////////////////////////////////////////////////////////

add_action('nd_donations_single_cause_tab_list','nd_donations_single_cause_add_documents_list');
function nd_donations_single_cause_add_documents_list(){

	$nd_donations_cause_id = get_the_ID();

	//metabox
	$nd_donations_meta_box_docs_causes = get_post_meta( $nd_donations_cause_id, 'nd_donations_meta_box_docs_causes', true );
	$nd_donations_meta_box_title_tab = get_post_meta( $nd_donations_cause_id, 'nd_donations_meta_box_title_tab', true );


	if ( $nd_donations_meta_box_docs_causes == '' ) {

		$nd_donations_docs_tab = '';

	}else{

		$nd_donations_docs_tab = '';


		$nd_donations_docs_tab .= '
		<li class="nd_donations_display_inline_block nd_donations_margin_right_40">
  		<h4>
  		  <a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_donations_single_cause_tab_documents">
  		    '.$nd_donations_meta_box_title_tab.'
  		  </a>
  		</h4>
		</li>
		';

	}

  
    echo $nd_donations_docs_tab;

}



add_action('nd_donations_single_cause_tab_content','nd_donations_single_cause_add_documents_list_content');
function nd_donations_single_cause_add_documents_list_content() {

	//script
	wp_enqueue_script('jquery-ui-dialog');
	wp_enqueue_script('jquery-effects-fade');
	wp_enqueue_style( 'jquery-ui-dialog-css', esc_url(plugins_url('jquery-ui-dialog.css', __FILE__ )) );

	$nd_donations_cause_id = get_the_ID();

	//metabox
	$nd_donations_meta_box_docs_causes = get_post_meta( $nd_donations_cause_id, 'nd_donations_meta_box_docs_causes', true );
	$nd_donations_meta_box_title_tab_content = get_post_meta( $nd_donations_cause_id, 'nd_donations_meta_box_title_tab_content', true );


	if ( $nd_donations_meta_box_docs_causes == '' ) {

		$nd_donations_docs_tab_content = '';

	}else{

		$nd_donations_docs_tab_content = '';


		$nd_donations_docs_tab_content .= '


			<style>
		    	.nd_donations_dialog_filter_bg:after{
		    		width: 100% !important;
				    height: 100% !important;
				    background-color: rgba(101, 100, 96, 0.9);
				    content: "";
				    position: fixed;
				    top: 0;
				    left: 0;
		    	}
		    </style>


			<div class="nd_donations_section" id="nd_donations_single_cause_tab_documents">
        <div class="nd_donations_section nd_donations_height_10"></div>
      ';
		    	


        //START insert title contant if fiels is present
        if ( $nd_donations_meta_box_title_tab_content != '' ) {

            $nd_donations_docs_tab_content .= '

              <h3><strong>'.$nd_donations_meta_box_title_tab_content.'</strong></h3>
              <div class="nd_donations_section nd_donations_height_30"></div>

            ';
        }
				//END insert title contant if fiels is present


				//explode the string
        		$nd_donations_meta_box_docs_causes_array = explode(',', $nd_donations_meta_box_docs_causes);

        		//START CICLE
        		for ($nd_donations_meta_box_docs_causes_array_i = 0; $nd_donations_meta_box_docs_causes_array_i < count($nd_donations_meta_box_docs_causes_array)-1; $nd_donations_meta_box_docs_causes_array_i++) {
				    
				    $nd_donations_page_by_path = get_page_by_path($nd_donations_meta_box_docs_causes_array[$nd_donations_meta_box_docs_causes_array_i],OBJECT,'nd_donations_docs');
				    
				    //info document
				    $nd_donations_document_id = $nd_donations_page_by_path->ID;
				    $nd_donations_document_name = get_the_title($nd_donations_document_id);
				    $nd_donations_document_content = get_post_field('post_content', $nd_donations_document_id);;
				    $nd_donations_document_permalink = get_permalink($nd_donations_document_id);


				    //metabox doc
				    $nd_donations_meta_box_document_subtitle = get_post_meta( $nd_donations_document_id, 'nd_donations_meta_box_document_subtitle', true );
					if ( $nd_donations_meta_box_document_subtitle == '' ) { $nd_donations_meta_box_document_subtitle = ''; }
					$nd_donations_meta_box_document_color = get_post_meta( $nd_donations_document_id, 'nd_donations_meta_box_document_color', true );
					if ( $nd_donations_meta_box_document_color == '' ) { $nd_donations_meta_box_document_color = '#000'; }
					$nd_donations_meta_box_document_icon = get_post_meta( $nd_donations_document_id, 'nd_donations_meta_box_document_icon', true );
					if ( $nd_donations_meta_box_document_icon == '' ) { $nd_donations_meta_box_document_icon = ''; }
					$nd_donations_meta_box_document_visibility = get_post_meta( $nd_donations_document_id, 'nd_donations_meta_box_document_visibility', true );

					//image
					$nd_donations_document_image = '';
				    if ( has_post_thumbnail() ) {

					  $nd_donations_image_id = get_post_thumbnail_id($nd_donations_document_id);
					  $nd_donations_image_attributes = wp_get_attachment_image_src( $nd_donations_image_id, 'large' );
					  $nd_donations_image_src = $nd_donations_image_attributes[0];

				      $nd_donations_document_image .= '

				      	<div class="nd_donations_section nd_donations_position_relative">
                    
						    <img class="nd_donations_section" alt="" src="'.$nd_donations_image_src.'">

						    <div class="nd_donations_bg_greydark_alpha_gradient_3 nd_donations_position_absolute nd_donations_left_0 nd_donations_height_100_percentage nd_donations_width_100_percentage nd_donations_box_sizing_border_box">
						        
						        <div class="nd_donations_position_absolute nd_donations_bottom_30 nd_donations_width_100_percentage nd_donations_box_sizing_border_box nd_donations_text_align_center">
						            
						        	<h3 class="nd_donations_color_white_important"><strong>'.$nd_donations_meta_box_document_subtitle.'</strong></h3>

						        </div>

						    </div>

						</div>

				      ';

				    }else{
				    	$nd_donations_document_image .= '';	
				    }
				    //end image



				    //start visibility
				    $nd_donations_document_visibility = '';
				    if ( $nd_donations_meta_box_document_visibility == 'nd_donations_meta_box_document_visibility_private' AND !is_user_logged_in() ) {

				    	$nd_donations_document_visibility .= '<a style="background-color:'.$nd_donations_meta_box_document_color.';" class="nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8 nd_donations_cursor_no_drop  nd_donations_font_size_13">'.__('PRIVATE','nd-donations').'</a>';

				    }else{

				    	$nd_donations_document_visibility .= '<a id="nd_donations_dialog_open_'.$nd_donations_document_id.'" style="background-color:'.$nd_donations_meta_box_document_color.';" class="nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8 nd_donations_cursor_pointer  nd_donations_font_size_13">'.__('PREVIEW','nd-donations').'</a>';
	
				    }
				    //end visibility


				    

				    $nd_donations_docs_tab_content .= '

	            	<!--START-->
	                <div class="nd_donations_section nd_donations_border_top_1_solid_grey nd_donations_padding_15 nd_donations_box_sizing_border_box">
					    <div class="nd_donations_width_20_percentage nd_donations_width_100_percentage_responsive nd_donations_float_left">
					        <table>
					            <tbody><tr>
					                <td><img class="nd_donations_float_left" alt="" width="25" src="'.$nd_donations_meta_box_document_icon.'"></td>
					                <td><span class="nd_options_color_greydark nd_donations_float_left nd_options_first_font nd_donations_font_size_15 nd_donations_margin_left_10"><strong>'.$nd_donations_meta_box_document_subtitle.'</strong></span></td>
					            </tr>
					        </tbody></table>
					    </div>
					    <div class="nd_donations_width_70_percentage nd_donations_width_100_percentage_responsive nd_donations_float_left">
					        <h5 class="nd_donations_padding_7 nd_options_color_grey nd_options_second_font">'.$nd_donations_document_name.'</h5>
					    </div>
					    <div class="nd_donations_width_10_percentage nd_donations_width_100_percentage_responsive nd_donations_float_left nd_donations_text_align_right nd_donations_text_align_left_responsive nd_donations_margin_top_5_responsive">
					        '.$nd_donations_document_visibility.'
					    </div>
					</div>
	                <!--END-->';



	                //START popup
				    if ( $nd_donations_meta_box_document_visibility == 'nd_donations_meta_box_document_visibility_private' AND !is_user_logged_in() ) {

				    	$nd_donations_docs_tab_content .= '';

				    }else{



				    	$nd_donations_docs_tab_content .= '

						<div id="nd_donations_dialog_'.$nd_donations_document_id.'">

					      <div class="nd_donations_bg_white nd_donations_border_radius_3 nd_donations_position_relative nd_donations_section nd_donations_box_sizing_border_box">

					      	<div style="background-color:'.$nd_donations_meta_box_document_color.';" class="nd_donations_position_relative nd_donations_section nd_donations_box_sizing_border_box nd_donations_padding_20 nd_donations_border_radius_top_3">
					      		<h3 class="nd_donations_color_white_important"><strong>'.$nd_donations_document_name.'</strong></h3>
					      		<a style="background-image:url('.esc_url(plugins_url('icon-close-white.svg', __FILE__ )).');" id="nd_donations_dialog_btn_close_'.$nd_donations_document_id.'" class="nd_donations_width_60 nd_donations_height_100_percentage nd_donations_right_0 nd_donations_top_0 nd_donations_position_absolute nd_donations_background_position_center nd_donations_background_size_25 nd_donations_background_repeat_no_repeat nd_donations_cursor_pointer nd_donations_display_inline_block nd_donations_border_radius_3"></a>
					      	</div>

					      	'.$nd_donations_document_image.'

					      	<div class="nd_donations_section nd_donations_box_sizing_border_box nd_donations_padding_30">
					      		'.do_shortcode($nd_donations_document_content).'	
					      	</div>

					 
					      </div>

					    </div>


						<script type="text/javascript">
					    //<![CDATA[
					    
					    jQuery(document).ready(function() {

					      jQuery( "#nd_donations_dialog_'.$nd_donations_document_id.'" ).dialog({
					        autoOpen: false,
					        draggable: false,
					        width: 800,
					        modal: false,
					        resizable: false,
					        dialogClass: "nd_donations_dialog",
					        show: {
					          effect: "fade",
					          duration: 800
					        },
					        hide: {
					          effect: "fade",
					          duration: 800
					        }
					      });
					   
					      jQuery( "#nd_donations_dialog_open_'.$nd_donations_document_id.'" ).click(function() {
					        jQuery( "#nd_donations_dialog_'.$nd_donations_document_id.'" ).dialog( "open" );
					        jQuery( ".nd_donations_dialog" ).addClass( "nd_donations_dialog_filter_bg" );
					      });

					      jQuery( "#nd_donations_dialog_btn_close_'.$nd_donations_document_id.'" ).click(function() {
					        jQuery( "#nd_donations_dialog_'.$nd_donations_document_id.'" ).dialog( "close" );
					      });

					    });

					    //]]>
					  </script>




            <style>
              @media only screen and (min-width: 768px) and (max-width: 959px) {
                .nd_donations_dialog_filter_bg { width: 100% !important; }
                #nd_donations_dialog_'.$nd_donations_document_id.' { width:758px !important; margin-left: -379px; left: 50%; }  
              }

              @media only screen and (min-width: 480px) and (max-width: 767px) {
                .nd_donations_dialog_filter_bg { width: 100% !important; }
                #nd_donations_dialog_'.$nd_donations_document_id.' { width:470px !important; margin-left: -235px; left: 50%; }    
              }

              @media only screen and (min-width: 320px) and (max-width: 479px){
                .nd_donations_dialog_filter_bg { width: 100% !important; }
                #nd_donations_dialog_'.$nd_donations_document_id.' { width:310px !important; margin-left: -155px; left: 50%; }   
              }
            </style>


            ';

	
				    }
				    //END popup



				}
				//END CICLE



		   $nd_donations_docs_tab_content .= '</div>';

	}


    echo $nd_donations_docs_tab_content;


}


}
