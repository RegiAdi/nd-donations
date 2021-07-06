<?php


//START urgent label
$nd_donations_urgent_donation = '';
if ( has_post_thumbnail() ) { 

  $nd_donations_meta_box_urgent = get_post_meta( get_the_ID(), 'nd_donations_meta_box_urgent', true ); 

  if ( $nd_donations_meta_box_urgent == 1 ) {

    $nd_donations_urgent_donation .= '
    <div class="nd_donations_position_absolute nd_donations_top_30 nd_donations_left_30">
        <a style="background-color:#2d2d2d;" class="nd_donations_height_33 nd_donations_padding_8_10 nd_donations_float_left" href="'.$nd_donations_permalink.'#nd_donations_single_cause_form_section">
          <img alt="" class="nd_donations_float_left" width="11" src="'.esc_url(plugins_url('../img/fire-icon.png', __FILE__ )).'">
        </a>
    </div>';

  }

}
//END Urgent


//image
$nd_donations_image_id = get_post_thumbnail_id( $nd_donations_id );
$nd_donations_image_attributes = wp_get_attachment_image_src( $nd_donations_image_id,$causes_image_size);
if ( $nd_donations_image_attributes[0] == '' ) { $nd_donations_output_image = ''; }else{
  
  $nd_donations_output_image = '
    <div class="nd_donations_section nd_donations_position_relative">

    	<div class="nd_donations_bg_greydark_alpha_gradient_5 nd_donations_position_absolute nd_donations_left_0 nd_donations_top_0 nd_donations_height_100_percentage nd_donations_width_100_percentage "></div>

    	'.$nd_donations_urgent_donation.'

		<img alt="" class="nd_donations_section nd_donations_postgrid_causes_single_cause_img" src="'.$nd_donations_image_attributes[0].'">

		<div class="nd_donations_position_absolute nd_donations_bottom_0 nd_donations_padding_30 nd_donations_box_sizing_border_box nd_donations_left_0 nd_donations_width_100_percentage">
			
			<a class="nd_donations_section" href="'.$nd_donations_permalink.'">
	          <h4 class="nd_donations_color_white_important nd_donations_word_break_break_word nd_donations_margin_0_important nd_donations_letter_spacing_1"><strong>'.$nd_donations_title.'</strong></h4>
	        </a>
	        
	        <div class="nd_donations_section nd_donations_height_10"></div>

	        <div class="nd_donations_section">
	            <p class="nd_donations_color_white_important nd_donations_font_size_11 nd_donations_line_height_11 nd_donations_letter_spacing_1 nd_donations_font_weight_500">
	            	'.__('GOAL','nd-donations').' : 
	            	<span class="nd_donations_margin_right_10 nd_donations_color_white_important">
	            		'.nd_donations_get_cause_price(get_the_ID()).' '.nd_donations_get_currency().'
	            	</span>
	           	</p>
	        </div>
		  
		</div>


    </div>';

}
//end image


/*START preview*/
$nd_donations_result .= '
  <div class=" '.$causes_width.' nd_donations_causes_widget_l3 nd_donations_width_100_percentage_responsive nd_donations_float_left nd_donations_masonry_item nd_donations_padding_15 nd_donations_box_sizing_border_box">

    <div class="nd_donations_section nd_donations_background_color_fff nd_donations_box_shadow_0_0_15_0_0001">

      '.$nd_donations_output_image.'

  </div>
    
</div>';
/*END preview*/ 