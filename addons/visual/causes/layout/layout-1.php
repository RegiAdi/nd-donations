<?php


wp_enqueue_script('masonry');

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

';


$str .= '<div class="nd_donations_section nd_donations_masonry_content '.$nd_donations_class.' ">';

while ( $the_query->have_posts() ) : $the_query->the_post();

//info
$nd_donations_id = get_the_ID(); 
$nd_donations_title = get_the_title();
$nd_donations_excerpt = get_the_excerpt();
$nd_donations_permalink = get_permalink( $nd_donations_id );


//START image
if ( has_post_thumbnail() ) { 
$nd_donations_image_cause = '


  <div class="nd_donations_section nd_donations_position_relative">

      <div class="nd_donations_postgrid_causes_single_cause_filter nd_donations_bg_greydark_alpha_gradient_3 nd_donations_position_absolute nd_donations_left_0 nd_donations_top_0 nd_donations_height_100_percentage nd_donations_width_100_percentage "></div>

      <img alt="" class="nd_donations_section nd_donations_postgrid_causes_single_cause_img" src="'.nd_donations_get_cause_img_src(get_the_ID()).'">';


      if ( nd_donations_get_cause_price(get_the_ID()) != 0 AND nd_donations_get_total_missing_money_to_goal(get_the_ID()) != 0 ) {

        $nd_donations_image_cause .= '

          <!--start donate now link-->
          <div class="nd_donations_position_absolute nd_donations_bottom_40 nd_donations_left_40">
              
              <div class="nd_donations_float_left">
                  <p class="nd_donations_postgrid_causes_single_cause_donate_link nd_donations_margin_0 nd_donations_color_white nd_donations_font_size_13 nd_donations_float_left"><a class="nd_donations_color_white_important" href="'.$nd_donations_permalink.'#nd_donations_single_cause_form_section">'.__('DONATE NOW','nd-donations').' +</a></p>
              </div>

          </div>
          <!--end donate now link-->  

        ';

      }
      
  $nd_donations_image_cause .= '</div>';

}else{ 
  $nd_donations_image_cause = '';
}
//END IMAGE



//START progress bar
if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

  $nd_donations_progress_label_class = '';
  $nd_donations_progress_bar = '';

  if ( nd_donations_get_total_donations_percentage(get_the_ID()) <= 50 ) {
    $nd_donations_progress_label_class = ' top:-20px; right:-40px; ';
  }else{
    $nd_donations_progress_label_class = ' top:-20px; right:0px; '; 
  }

  $nd_donations_progress_bar .= '

    <div class="nd_donations_postgrid_causes_single_cause_slider_donation nd_donations_section nd_donations_bg_greydark nd_donations_box_sizing_border_box">
      <div class="nd_donations_height_3 nd_donations_section nd_donations_bg_greydark">
          <div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; width:'.nd_donations_get_total_donations_percentage(get_the_ID()).'%;" class="nd_donations_height_3 nd_donations_float_left nd_donations_position_relative">
              <p style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; '.$nd_donations_progress_label_class.' " class="nd_donations_line_height_40 nd_donations_width_40 nd_donations_height_40 nd_donations_text_align_center nd_donations_color_white_important nd_donations_font_size_13 nd_donations_border_radius_100_percentage  nd_donations_display_inline_block nd_donations_position_absolute">'.nd_donations_get_total_donations_percentage(get_the_ID()).'%</p>
          </div>
      </div>
    </div>

  ';

}else{
  $nd_donations_progress_bar = ''; 
}
//END progress bar



//START urgent label
$nd_donations_urgent_donation = '';
if ( has_post_thumbnail() ) { 

  $nd_donations_meta_box_urgent = get_post_meta( get_the_ID(), 'nd_donations_meta_box_urgent', true ); 

  if ( $nd_donations_meta_box_urgent == 1 ) {

    $nd_donations_urgent_donation .= '
    <div style="top:35px;left:35px;" class="nd_donations_position_absolute nd_donations_urgent_label">                                
        <div class="nd_donations_bg_red nd_donations_padding_10 nd_donations_float_left">
            <p class="nd_donations_margin_0 nd_donations_color_white_important nd_donations_font_size_13 nd_donations_float_left nd_donations_margin_right_5">'.__('URGENT','nd-donations').'</p>
            <img alt="" class="nd_donations_float_left" width="12" src="'.esc_url(plugins_url('icon-thunder-white.svg', __FILE__ )).'">
        </div>
    </div>';

  }

}
//END Urgent




//START info bar
$nd_donations_info_donation = '';

if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

  $nd_donations_info_donation .= '

    <div class="nd_donations_section nd_donations_height_10"></div>
    <div class="nd_donations_section nd_donations_postgrid_causes_single_cause_info_donation">
        <div class="nd_donations_display_table nd_donations_float_left">
            <img alt="" class="nd_donations_margin_right_10 nd_donations_display_table_cell nd_donations_vertical_align_middle nd_donations_display_none_iphone_port" width="15" src="'.esc_url(plugins_url('icon-graphic-greydark.svg', __FILE__ )).'">
            <p class="nd_donations_display_table_cell nd_donations_vertical_align_middle nd_donations_font_size_13 nd_options_color_greydark nd_donations_display_block_iphone_port nd_donations_display_margin_top_10_iphone_port">'.__('GOAL','nd-donations').' : <span class="nd_donations_margin_right_10 nd_options_color_grey">'.nd_donations_get_cause_price(get_the_ID()).' '.nd_donations_get_currency().'</span></p>
            <p class="nd_donations_display_table_cell nd_donations_vertical_align_middle nd_donations_font_size_13 nd_options_color_greydark nd_donations_display_block_iphone_port nd_donations_display_margin_top_10_iphone_port">'.__('RAISED','nd-donations').' : <span class="nd_options_color_grey">'.nd_donations_get_total_donations_value(get_the_ID()).' '.nd_donations_get_currency().'</span></p>
        </div>
    </div>

  ';

}
//END info bar



$str .= '


  <div id="nd_donations_postgrid_causes_single_cause_'.$nd_donations_id.'" class="nd_donations_postgrid_causes_single_cause '.$nd_donations_width.' nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_masonry_item nd_donations_width_100_percentage_responsive">

    <div class="nd_donations_section">

      <!--start preview-->
      <div class="nd_donations_section nd_donations_border_1_solid_grey">


        '.$nd_donations_image_cause.'

        '.$nd_donations_progress_bar.'


        <!--START content-->
        <div class="nd_donations_section nd_donations_padding_40 nd_donations_box_sizing_border_box nd_donations_bg_white">
          
          <h3 class="nd_donations_postgrid_causes_single_cause_title">'.$nd_donations_title.'</h3>

          '.$nd_donations_urgent_donation.'
          '.$nd_donations_info_donation.'

          <div class="nd_donations_section nd_donations_height_20"></div> 

          <p class="nd_donations_postgrid_causes_single_cause_text nd_donations_margin_0">'.$nd_donations_excerpt.'</p>
        
          <div class="nd_donations_section nd_donations_height_20"></div>
        
          <a style="background-color: '.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_postgrid_causes_single_cause_button nd_donations_border_radius_30 nd_donations_padding_10_20 nd_donations_display_inline_block nd_donations_color_white_important nd_donations_font_size_14" href="'.$nd_donations_permalink.'">'.__('Read More','nd-donations').'</a>

        </div>
        <!--END content-->

    </div>
    <!--end preview-->
    
  </div>

</div>';

endwhile;

$str .= '</div>';