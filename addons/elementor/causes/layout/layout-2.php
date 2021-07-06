<?php

//image
$nd_donations_image_id = get_post_thumbnail_id( $nd_donations_id );
$nd_donations_image_attributes = wp_get_attachment_image_src( $nd_donations_image_id, 'nd_donations_img_200_200' );
if ( $nd_donations_image_attributes[0] == '' ) { $nd_donations_output_image = ''; }else{
  
  $nd_donations_output_image = '<img width="100" alt="" class="nd_donations_position_absolute nd_donations_left_0 nd_donations_top_0 nd_donations_postgrid_causes_single_cause_img" src="'.$nd_donations_image_attributes[0].'">';

}
//end image

//START info bar
$nd_donations_info_donation = '';

if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

  $nd_donations_info_donation .= '

    <div class="nd_donations_section nd_donations_postgrid_causes_single_cause_info_donation">
        <div class="nd_donations_float_left nd_donations_width_50_percentage">
            <p class="nd_donations_font_size_11 nd_options_color_greydark nd_donations_line_height_11 nd_donations_letter_spacing_1 nd_donations_font_weight_500">'.__('GOAL','nd-donations').' : <span class="nd_donations_margin_right_10 nd_options_color_grey">'.nd_donations_get_cause_price(get_the_ID()).' '.nd_donations_get_currency().'</span></p>
        </div>
        <div class="nd_donations_float_left nd_donations_width_50_percentage">
            <p class="nd_donations_font_size_11 nd_donations_text_align_left nd_options_color_greydark nd_donations_line_height_11 nd_donations_letter_spacing_1 nd_donations_font_weight_500">'.__('RAISED','nd-donations').' : <span class="nd_options_color_grey">'.nd_donations_get_total_donations_value(get_the_ID()).' '.nd_donations_get_currency().'</span></p>
        </div>
    </div>

  ';

}
//END info bar


/*START preview*/
$nd_donations_result .= '
  <div class=" '.$causes_width.' nd_donations_causes_widget_l2 nd_donations_width_100_percentage_responsive nd_donations_float_left nd_donations_masonry_item nd_donations_padding_10_0 nd_donations_box_sizing_border_box">

    <div class="nd_donations_section nd_donations_position_relative">

      '.$nd_donations_output_image.'

      <div class="nd_donations_section nd_donations_padding_left_120 nd_donations_box_sizing_border_box">

        <a class="nd_donations_section" href="'.$nd_donations_permalink.'">
          <h4 class="nd_donations_word_break_break_word nd_donations_margin_0_important nd_donations_letter_spacing_1"><strong>'.$nd_donations_title.'</strong></h4>
        </a>
        
        <div class="nd_donations_section nd_donations_height_10"></div>
        
        '.$nd_donations_info_donation.'
        
        <div class="nd_donations_section nd_donations_height_20"></div>
        
        <a style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'" class="nd_donations_font_size_10 nd_donations_line_height_10 nd_donations_color_white_important nd_donations_padding_5_10 nd_donations_letter_spacing_1" href="'.$nd_donations_permalink.'"><strong>'.__('VIEW DETAILS','nd-donations').'</strong></a>

    </div>

  </div>
    
</div>';
/*END preview*/ 