<?php

//script
wp_enqueue_script('masonry');
wp_enqueue_script('jquery-ui-dialog');
wp_enqueue_script('jquery-effects-fade');
wp_enqueue_style( 'jquery-ui-dialog-css', esc_url(plugins_url('jquery-ui-dialog.css', __FILE__ )) );



$str .= '

	<script type="text/javascript">
    //<![CDATA[
    
    jQuery(document).ready(function() {

      //START masonry
      jQuery(function ($) {
        
        //Masonry
    		var $nd_donations_masonry_content = $(".nd_donations_masonry_content").imagesLoaded( function() {
    		  // init Masonry after all images have loaded
    		  $nd_donations_masonry_content.masonry({
    		    itemSelector: ".nd_donations_masonry_item"
    		  });
    		});

      });
      //END masonry

    });

    //]]>
  </script>


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

';


$str .= '<div class="nd_donations_section nd_donations_masonry_content '.$nd_donations_class.' ">';

while ( $the_query->have_posts() ) : $the_query->the_post();

  
  //info document
  $nd_donations_document_id = get_the_ID();
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

    </div>';

  }else{
    $nd_donations_document_image .= ''; 
  }
  //end image



  //start visibility
  $nd_donations_document_visibility = '';
  if ( $nd_donations_meta_box_document_visibility == 'nd_donations_meta_box_document_visibility_private' AND !is_user_logged_in() ) {

    $nd_donations_document_visibility .= '<a style="background-color:'.$nd_donations_meta_box_document_color.';" class="nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8 nd_donations_cursor_no_drop  nd_donations_font_size_13">'.__('PRIVATE','nd-donations').'</a>';

  }else{

    $nd_donations_document_visibility .= '<a id="nd_donations_postgrid_dialog_open_'.$nd_donations_document_id.'" style="background-color:'.$nd_donations_meta_box_document_color.';" class="nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8 nd_donations_cursor_pointer  nd_donations_font_size_13">'.__('PREVIEW','nd-donations').'</a>';

  }
  //end visibility


    
  //start content
  $str .= '

    <!--START-->
    <div id="nd_donations_postgrid_documents_single_doc_'.$nd_donations_id.'" class="nd_donations_postgrid_documents_single_doc '.$nd_donations_width.' nd_donations_box_sizing_border_box nd_donations_masonry_item nd_donations_width_100_percentage_responsive">
      <div class="nd_donations_section nd_donations_border_top_1_solid_grey nd_donations_padding_15 nd_donations_box_sizing_border_box">
        
        <div class="nd_donations_width_20_percentage nd_donations_width_100_percentage_responsive nd_donations_float_left">
          <table>
            <tbody>
              <tr>
                <td><img class="nd_donations_float_left" alt="" width="25" src="'.$nd_donations_meta_box_document_icon.'"></td>
                <td><span class="nd_options_color_greydark nd_donations_float_left nd_options_first_font nd_donations_font_size_15 nd_donations_margin_left_10"><strong>'.$nd_donations_meta_box_document_subtitle.'</strong></span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="nd_donations_width_70_percentage nd_donations_width_100_percentage_responsive nd_donations_float_left">
          <h5 class="nd_donations_padding_7 nd_options_color_grey nd_options_second_font">'.$nd_donations_document_name.'</h5>
        </div>
        
        <div class="nd_donations_width_10_percentage nd_donations_width_100_percentage_responsive nd_donations_float_left nd_donations_text_align_right nd_donations_text_align_left_responsive nd_donations_margin_top_5_responsive">
          '.$nd_donations_document_visibility.'
        </div>

      </div>
    </div>
    <!--END-->

  ';
  //END content



  //START popup
  if ( $nd_donations_meta_box_document_visibility == 'nd_donations_meta_box_document_visibility_private' AND !is_user_logged_in() ) {

    $str .= '';

  }else{

    $str .= '

      <!--START POPOUP-->
      <div id="nd_donations_dialog_'.$nd_donations_document_id.'">

        <div class="nd_donations_bg_white nd_donations_border_radius_3 nd_donations_position_relative nd_donations_section nd_donations_box_sizing_border_box">

          <div style="background-color:'.$nd_donations_meta_box_document_color.';" class="nd_donations_position_relative nd_donations_section nd_donations_box_sizing_border_box nd_donations_padding_20 nd_donations_border_radius_top_3">
            <h3 class="nd_donations_color_white_important"><strong>'.$nd_donations_document_name.'</strong></h3>
            <a style="background-image:url('.esc_url(plugins_url('icon-close-white.svg', __FILE__ )).');" id="nd_donations_postgrid_dialog_btn_close_'.$nd_donations_document_id.'" class="nd_donations_width_60 nd_donations_height_100_percentage nd_donations_right_0 nd_donations_top_0 nd_donations_position_absolute nd_donations_background_position_center nd_donations_background_size_25 nd_donations_background_repeat_no_repeat nd_donations_cursor_pointer nd_donations_display_inline_block nd_donations_border_radius_3"></a>
          </div>

          '.$nd_donations_document_image.'

          <div class="nd_donations_section nd_donations_box_sizing_border_box nd_donations_padding_30">
            '.do_shortcode($nd_donations_document_content).'  
          </div>

        </div>

      </div>
      <!--END POPOUP-->



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
       
          jQuery( "#nd_donations_postgrid_dialog_open_'.$nd_donations_document_id.'" ).click(function() {
            jQuery( "#nd_donations_dialog_'.$nd_donations_document_id.'" ).dialog( "open" );
            jQuery( ".nd_donations_dialog" ).addClass( "nd_donations_dialog_filter_bg" );
          });

          jQuery( "#nd_donations_postgrid_dialog_btn_close_'.$nd_donations_document_id.'" ).click(function() {
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
      </style>';

  }
  //END popup


endwhile;

$str .= '</div>';




