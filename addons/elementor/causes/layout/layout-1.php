<?php

//START urgent label
$nd_donations_urgent_donation = '';
if ( has_post_thumbnail() ) { 

  $nd_donations_meta_box_urgent = get_post_meta( get_the_ID(), 'nd_donations_meta_box_urgent', true ); 

  if ( $nd_donations_meta_box_urgent == 1 ) {

    $nd_donations_urgent_donation .= '
    <div class="nd_donations_float_right">
        <a style="background-color:#2d2d2d;" class="nd_donations_height_33 nd_donations_padding_8_10 nd_donations_float_left" href="'.$nd_donations_permalink.'#nd_donations_single_cause_form_section">
          <img alt="" class="nd_donations_float_left" width="11" src="'.esc_url(plugins_url('../img/fire-icon.png', __FILE__ )).'">
        </a>
    </div>';

  }

}
//END Urgent

//image
$nd_donations_image_id = get_post_thumbnail_id( $nd_donations_id );
$nd_donations_image_attributes = wp_get_attachment_image_src( $nd_donations_image_id, 'large' );
if ( $nd_donations_image_attributes[0] == '' ) { $nd_donations_output_image = ''; }else{
  $nd_donations_output_image = '


    <div class="nd_donations_section nd_donations_position_relative">

      <img alt="" class="nd_donations_section nd_donations_postgrid_causes_single_cause_img" src="'.nd_donations_get_cause_img_src(get_the_ID()).'">';

      if ( nd_donations_get_cause_price(get_the_ID()) != 0 AND nd_donations_get_total_missing_money_to_goal(get_the_ID()) != 0 ) {

        $nd_donations_output_image .= '

          <!--start donate now link-->
          <div class="nd_donations_position_absolute nd_donations_bottom_16_negative nd_donations_right_30">
              
              <div class="nd_donations_float_left">
                  <p style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'" class="nd_donations_postgrid_causes_single_cause_donate_link nd_donations_margin_0 nd_donations_color_white nd_donations_font_size_13 nd_donations_line_height_13 nd_donations_float_left">
                    <a class="nd_donations_color_white_important nd_donations_line_height_33 nd_donations_padding_0_25 nd_donations_font_weight_500" href="'.$nd_donations_permalink.'#nd_donations_single_cause_form_section">'.__('DONATE NOW','nd-donations').'</a>
                  </p>
              </div>

              '.$nd_donations_urgent_donation.'

          </div>
          <!--end donate now link-->  

        ';

      }

    $nd_donations_output_image .= '
    </div>';

}
//end image


//START progress bar
if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

  $nd_donations_progress_label_class = '';
  $nd_donations_progress_bar = '';

  if ( nd_donations_get_total_donations_percentage(get_the_ID()) <= 50 ) {
    $nd_donations_progress_label_class = ' top:-11px; right:-40px; ';
  }else{
    $nd_donations_progress_label_class = ' top:-11px; right:0px; '; 
  }

  $nd_donations_progress_bar .= '

    <div class="nd_donations_postgrid_causes_single_cause_slider_donation nd_donations_section nd_donations_background_color_f1f1f1 nd_donations_box_sizing_border_box">
      <div class="nd_donations_height_3 nd_donations_section nd_donations_background_color_f1f1f1">
          <div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; width:'.nd_donations_get_total_donations_percentage(get_the_ID()).'%;" class="nd_donations_height_3 nd_donations_float_left nd_donations_position_relative">
              <p style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; '.$nd_donations_progress_label_class.' " class="nd_donations_letter_spacing_1 nd_donations_line_height_22 nd_donations_width_40 nd_donations_height_22 nd_donations_text_align_center nd_donations_color_white_important nd_donations_font_size_10 nd_donations_display_inline_block nd_donations_position_absolute nd_donations_font_weight_500">'.nd_donations_get_total_donations_percentage(get_the_ID()).'%</p>
          </div>
      </div>
    </div>

  ';

}else{
  $nd_donations_progress_bar = ''; 
}
//END progress bar


//START info bar
$nd_donations_info_donation = '';

if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

  $nd_donations_info_donation .= '

    <div class="nd_donations_section nd_donations_postgrid_causes_single_cause_info_donation">
        <div class="nd_donations_float_left nd_donations_width_50_percentage">
            <p class="nd_donations_font_size_13 nd_options_color_greydark nd_donations_line_height_13 nd_donations_letter_spacing_1 nd_donations_font_weight_500">'.__('GOAL','nd-donations').' : <span class="nd_donations_margin_right_10 nd_options_color_grey">'.nd_donations_get_cause_price(get_the_ID()).' '.nd_donations_get_currency().'</span></p>
        </div>
        <div class="nd_donations_float_left nd_donations_width_50_percentage">
            <p class="nd_donations_font_size_13 nd_donations_text_align_right nd_options_color_greydark nd_donations_line_height_13 nd_donations_letter_spacing_1 nd_donations_font_weight_500">'.__('RAISED','nd-donations').' : <span class="nd_options_color_grey">'.nd_donations_get_total_donations_value(get_the_ID()).' '.nd_donations_get_currency().'</span></p>
        </div>
    </div>

  ';

}
//END info bar


/*START preview*/
$nd_donations_result .= '
  <div class=" '.$causes_width.' nd_donations_causes_widget_l1 nd_donations_width_100_percentage_responsive nd_donations_float_left nd_donations_masonry_item nd_donations_padding_15 nd_donations_box_sizing_border_box">

    <div class="nd_donations_section nd_donations_background_color_fff nd_donations_box_shadow_0_0_15_0_0001">

      '.$nd_donations_output_image.'

      <div class="nd_donations_section nd_donations_padding_40 nd_donations_padding_20_iphone nd_donations_box_sizing_border_box">

        <a class="nd_donations_section" href="'.$nd_donations_permalink.'">
          <h3 class="nd_donations_font_size_23 nd_donations_word_break_break_word nd_donations_font_size_20_iphone nd_donations_line_height_23 nd_donations_margin_0_important nd_donations_letter_spacing_1"><strong>'.$nd_donations_title.'</strong></h3>
        </a>
        <div class="nd_donations_section nd_donations_height_20"></div>
        <p class="nd_donations_font_size_15 nd_donations_line_height_1_8_em nd_donations_section nd_donations_margin_0_important">'.$nd_donations_excerpt.'</p>
        <div class="nd_donations_section nd_donations_height_30"></div>
        '.$nd_donations_progress_bar.'
        <div class="nd_donations_section nd_donations_height_25"></div>
        '.$nd_donations_info_donation.'
        <div class="nd_donations_section nd_donations_height_30"></div>
        <a style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'" class="nd_donations_font_size_13 nd_donations_line_height_13 nd_donations_color_white_important nd_donations_padding_10_20 nd_donations_letter_spacing_1" href="'.$nd_donations_permalink.'"><strong>'.__('VIEW DETAILS','nd-donations').'</strong></a>

    </div>

  </div>
    
</div>';
/*END preview*/ 