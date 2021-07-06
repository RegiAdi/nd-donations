<?php


$nd_donations_info_donation_enable = get_option('nd_donations_info_donation_enable');
if ( $nd_donations_info_donation_enable == 1 and get_option('nicdark_theme_author') == 1 ) {



//add info on single cause
function nd_donations_add_info_donation_on_single_cause(){

	$nd_donations_info_cause = '';	
	$nd_donations_section_class = '';

	//section class
	if ( nd_donations_get_container() == 1) { $nd_donations_section_class = 'nd_donations_padding_5_20'; }



	//START
	if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {



		$nd_donations_info_cause .= '

			<div id="nd_donations_single_cause_info_bar" class="nd_donations_section nd_donations_bg_greydark nd_donations_box_sizing_border_box '.$nd_donations_section_class.' ">';

			    //add conteiner
				if ( nd_donations_get_container() != 1) { $nd_donations_info_cause .= '<div class="nd_donations_container nd_donations_clearfix">'; }

			    
			    $nd_donations_info_cause .= '

			    	<div class="nd_donations_width_50_percentage nd_donations_width_100_percentage_responsive nd_donations_padding_bottom_0_responsive nd_donations_float_left nd_donations_padding_15 nd_donations_box_sizing_border_box">

			            <div id="nd_donations_single_cause_info_bar_goal_btn" class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_20_0">
			                <a class="nd_donations_width_100_percentage nd_donations_box_sizing_border_box nd_donations_text_align_center nd_donations_display_inline_block nd_donations_color_white_important nd_donations_bg_red nd_options_first_font nd_donations_padding_15_20 " href="#">'.__('GOAL CAUSE','nd-donations').' <strong class="nd_donations_border_bottom_2_solid_white">'.nd_donations_get_cause_price(get_the_ID()).'</strong><strong> '.nd_donations_get_currency().'</strong></a>
			            </div>
			            <div id="nd_donations_single_cause_info_bar_achieved_btn" class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_20_0">
			                <a class="nd_donations_width_100_percentage nd_donations_box_sizing_border_box nd_donations_text_align_center nd_donations_display_inline_block nd_donations_color_white_important nd_donations_bg_white_alpha_10 nd_options_first_font nd_donations_padding_15_20 " href="#">'.__('ACHIEVED','nd-donations').' <strong class="nd_donations_border_bottom_2_solid_white">'.nd_donations_get_total_donations_value(get_the_ID()).'</strong><strong> '.nd_donations_get_currency().'</strong></a>
			            </div>
			            
			        </div>


			        <div class="nd_donations_width_50_percentage nd_donations_width_100_percentage_responsive nd_donations_padding_top_0_responsive nd_donations_margin_bottom_20_responsive nd_donations_float_left nd_donations_padding_15 nd_donations_box_sizing_border_box">

			             <div id="nd_donations_single_cause_info_bar_goal" class="nd_donations_width_33_percentage nd_donations_width_100_percentage_all_iphone nd_donations_float_left nd_donations_text_align_center">
			                <div class="nd_donations_section nd_donations_height_20"></div>
			                <h1 class="nd_donations_color_white_important nd_donations_font_size_35"><strong>'.nd_donations_get_total_donations_percentage(get_the_ID()).' %</strong></h1>
			                <div class="nd_donations_section nd_donations_height_5"></div>
			                <h5 class="nd_donations_letter_spacing nd_options_color_grey">'.__('OF OUR GOAL','nd-donations').'</h5>
			            </div>

			            <div id="nd_donations_single_cause_info_bar_donations" class="nd_donations_width_33_percentage nd_donations_width_100_percentage_all_iphone nd_donations_float_left nd_donations_text_align_center">
			                <div class="nd_donations_section nd_donations_height_20"></div>
			                <h1 class="nd_donations_color_white_important nd_donations_font_size_35"><strong>'.nd_donations_get_qnt_donations(get_the_ID()).'</strong></h1>
			                <div class="nd_donations_section nd_donations_height_5"></div>
			                <h5 class="nd_donations_letter_spacing nd_options_color_grey">'.__('DONATIONS','nd-donations').'</h5>
			            </div>

			            <div id="nd_donations_single_cause_info_bar_donate_btn" class="nd_donations_width_33_percentage nd_donations_width_100_percentage_all_iphone nd_donations_float_left nd_donations_text_align_right nd_donations_text_align_center_responsive">
			                <div class="nd_donations_section nd_donations_height_25"></div>';


			            //check if donation is completed
			           if ( nd_donations_get_total_missing_money_to_goal(get_the_ID()) == 0 AND nd_donations_get_cause_price(get_the_ID()) != 0  ) {
			            	$nd_donations_info_cause .= '<a style="background-color:'.nd_donations_get_cause_color(get_the_ID()).';" class="nd_donations_border_radius_30 nd_donations_display_inline_block nd_donations_box_sizing_border_box nd_donations_color_white_important nd_options_first_font nd_donations_padding_10_25 " href="#nd_donations_single_cause_goal_achieved">'.__('COMPLETED','nd-donations').'</a>';	
			            }else{
			            	$nd_donations_info_cause .= '<a style="background-color:'.nd_donations_get_cause_color(get_the_ID()).';" class="nd_donations_border_radius_30 nd_donations_display_inline_block nd_donations_box_sizing_border_box nd_donations_color_white_important nd_options_first_font nd_donations_padding_10_25 " href="#nd_donations_single_cause_form_section">'.__('DONATE NOW','nd-donations').'</a>';
			            }
			               	
			        

			        $nd_donations_info_cause .= '</div>
			           
			            
			        </div>';


			    //add conteiner
				if ( nd_donations_get_container() != 1) { $nd_donations_info_cause .= '</div>'; }

			
			$nd_donations_info_cause .= '
			</div>';

	}
	//END


	echo $nd_donations_info_cause;

}
add_action('nd_donations_single_cause_start_content','nd_donations_add_info_donation_on_single_cause');




//add info on cause preview
function nd_donations_add_info_donation_on_archive_causes_preview(){

	$nd_donations_info_donation = '';

	if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

		$nd_donations_info_donation .= '

			<div class="nd_donations_section nd_donations_height_10"></div>
			<div class="nd_donations_section nd_donations_archive_causes_single_cause_info_donation">
			    <div class="nd_donations_display_table nd_donations_float_left">
			        <img alt="" class="nd_donations_margin_right_10 nd_donations_display_table_cell nd_donations_vertical_align_middle nd_donations_display_none_iphone_port" width="15" src="'.esc_url(plugins_url('icon-graphic-greydark.svg', __FILE__ )).'">
			        <p class="nd_donations_display_table_cell nd_donations_vertical_align_middle nd_donations_font_size_13 nd_options_color_greydark nd_donations_display_block_iphone_port nd_donations_display_margin_top_10_iphone_port">'.__('GOAL','nd-donations').' : <span class="nd_donations_margin_right_10 nd_options_color_grey">'.nd_donations_get_cause_price(get_the_ID()).' '.nd_donations_get_currency().'</span></p>
			        <p class="nd_donations_display_table_cell nd_donations_vertical_align_middle nd_donations_font_size_13 nd_options_color_greydark nd_donations_display_block_iphone_port nd_donations_display_margin_top_10_iphone_port">'.__('RAISED','nd-donations').' : <span class="nd_options_color_grey">'.nd_donations_get_total_donations_value(get_the_ID()).' '.nd_donations_get_currency().'</span></p>
			    </div>
			</div>

		';

	}


	echo $nd_donations_info_donation;

}
add_action('nd_donations_archive_causes_preview_below_title','nd_donations_add_info_donation_on_archive_causes_preview');

}