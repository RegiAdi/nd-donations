<?php

$nd_donations_donors_enable = get_option('nd_donations_donors_enable');
if ( $nd_donations_donors_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


/*******************************DONORS******************************/
//add tab on single cause page
function nd_donations_add_tab_donors_on_single_cause(){

	
    if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

        $nd_donations_tab_donors = '';

    	$nd_donations_tab_donors .= '

    		<li class="nd_donations_display_inline_block nd_donations_margin_right_40">
                <h4>
                  <a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_donations_single_cause_donations">
                    '.__('Donations','nd-donations').'
                  </a>
                  <span style="background-color:'.nd_donations_get_cause_color(get_the_ID()).';" class="nd_donations_color_white_important nd_donations_float_right nd_donations_font_size_10 nd_donations_margin_left_10 nd_donations_margin_top_8 nd_donations_padding_5">'.nd_donations_get_qnt_donations(get_the_ID()).'</span>
                </h4>
          </li>

    	';

    	echo $nd_donations_tab_donors;

    }


}
add_action('nd_donations_single_cause_tab_list','nd_donations_add_tab_donors_on_single_cause');




//add content on tab single cause page
function nd_donations_add_content_donors_on_single_cause() {


    if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

        global $wpdb;

        $nd_donations_result = '';
        $nd_donations_cause_id = get_the_ID();
        $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';

        $nd_donations_action_type = "'Completed'";
        
        //START select for items
        $nd_donations_donations = $wpdb->get_results( "SELECT paypal_email,id,user_first_name,donation_value FROM $nd_donations_table_name WHERE id_cause = $nd_donations_cause_id AND paypal_payment_status = $nd_donations_action_type");

        $nd_donations_result .= '<div class="nd_donations_section" id="nd_donations_single_cause_donations">';


        //title section
        $nd_donations_result .= '
        <div class="nd_donations_section nd_donations_height_10"></div>
        <h3><strong>'.__('CAUSE DONORS','nd-donations').'</strong></h3>
        <div class="nd_donations_section nd_donations_height_30"></div>
        ';

        //no results
        if ( empty($nd_donations_donations) ) { 

          $nd_donations_result .= '<p>'.__('Still no donations','nd-donations').'</p>'; 

        }else{

            $nd_donations_index_cicle = 0;


          foreach ( $nd_donations_donations as $nd_donations_donation ) 
          {
            
            $nd_donations_donations_avatar_url_args = array(
              'size'   => 100
            );
            $nd_donations_donations_avatar_url = get_avatar_url($nd_donations_donation->paypal_email, $nd_donations_donations_avatar_url_args);
            $nd_donations_donation_id = $nd_donations_donation->id;
            $nd_donations_donation_user_first_name = $nd_donations_donation->user_first_name;
            $nd_donations_donation_donation_value = $nd_donations_donation->donation_value;
            

            //decide padding section class
            $nd_donations_padding_class = '';
            if ( $nd_donations_index_cicle & 1 ) {
                $nd_donations_padding_class .= 'nd_donations_padding_left_10';
            }else{
                $nd_donations_padding_class .= 'nd_donations_padding_right_10';   
            }


            $nd_donations_result .= '
                                       

                <div class=" '.$nd_donations_padding_class.' nd_donations_padding_0_all_iphone nd_donations_width_50_percentage nd_donations_width_100_percentage_all_iphone nd_donations_float_left nd_donations_box_sizing_border_box">
                    <div class="nd_donations_section nd_donations_border_top_1_solid_grey nd_donations_padding_20 nd_donations_box_sizing_border_box">
                        <div class="nd_donations_width_50_percentage nd_donations_width_100_percentage_responsive nd_donations_float_left">
                            <table>
                                <tbody><tr>
                                    <td><img class="nd_donations_float_left" alt="" width="50" src="'.$nd_donations_donations_avatar_url.'"></td>
                                    <td><span class="nd_options_color_greydark nd_donations_float_left nd_options_first_font nd_donations_font_size_15 nd_donations_margin_left_20"><strong>'.$nd_donations_donation_user_first_name.'</strong></span></td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="nd_donations_width_50_percentage nd_donations_width_100_percentage_responsive nd_donations_float_left nd_donations_text_align_right nd_donations_text_align_left_responsive">
                            <h5 class="nd_donations_padding_18_0 nd_options_color_grey nd_options_second_font">'.$nd_donations_donation_donation_value.' '.nd_donations_get_currency().'</h5>
                        </div>
                    </div>
                </div>


            ';

            $nd_donations_index_cicle = $nd_donations_index_cicle + 1;

          }

        }

        $nd_donations_result .= '</div>';

        echo $nd_donations_result;
        //END select for items


    }


}
add_action('nd_donations_single_cause_tab_content','nd_donations_add_content_donors_on_single_cause');


}
