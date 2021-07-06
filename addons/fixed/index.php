<?php


$nd_donations_fixed_donation_enable = get_option('nd_donations_fixed_donation_enable');
if ( $nd_donations_fixed_donation_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


function nd_donations_add_fixed_values_donation_on_single_cause_form(){

	$nd_donations_fixed_values = '';

	$nd_donations_fixed_values .= '


		<div class="nd_donations_section">
			<div class="nd_donations_width_25_percentage nd_donations_float_left nd_donations_padding_0_responsive nd_donations_padding_bottom_20_important_responsive nd_donations_padding_right_15 nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
				<input class="nd_donations_cursor_pointer nd_donations_section nd_donations_fixed_value_donation nd_donations_single_cause_form_donation_value" type="text" readonly value="50">	
			</div>
			<div class="nd_donations_width_25_percentage nd_donations_float_left nd_donations_padding_0_responsive nd_donations_padding_bottom_20_important_responsive nd_donations_padding_left_15 nd_donations_padding_right_15 nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
				<input class="nd_donations_cursor_pointer nd_donations_section nd_donations_fixed_value_donation nd_donations_single_cause_form_donation_value" type="text" readonly value="100">	
			</div>
			<div class="nd_donations_width_25_percentage nd_donations_float_left nd_donations_padding_0_responsive nd_donations_padding_bottom_20_important_responsive nd_donations_padding_right_15 nd_donations_padding_left_15 nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
				<input class="nd_donations_cursor_pointer nd_donations_section nd_donations_fixed_value_donation nd_donations_single_cause_form_donation_value" type="text" readonly value="150">	
			</div>
			<div class="nd_donations_width_25_percentage nd_donations_float_left nd_donations_padding_0_responsive nd_donations_padding_left_15 nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
				<input class="nd_donations_cursor_pointer nd_donations_section nd_donations_fixed_value_donation nd_donations_single_cause_form_donation_value" type="text" readonly value="200">	
			</div>
		</div>
		

		<div class="nd_donations_section nd_donations_height_20"></div>

	';

	echo $nd_donations_fixed_values;

}
add_action('nd_donations_start_values_single_cause_form','nd_donations_add_fixed_values_donation_on_single_cause_form');


}