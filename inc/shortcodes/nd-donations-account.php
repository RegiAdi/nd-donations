<?php

//START  nd_donations_account
function nd_donations_shortcode_account() {


	//check if the user is lkogged
	if (is_user_logged_in() == 1){

		$nd_donations_current_user = wp_get_current_user();

		wp_enqueue_script('jquery-ui-tabs');

		?>



		<div class="nd_donations_width_33_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">

	        <div class="nd_donations_section nd_donations_box_sizing_border_box">
	                    
                <!--start preview-->
                <div class="nd_donations_section ">
            
                    <!--image-->
                    <div class="nd_donations_section nd_donations_position_relative">


                    	<?php

                    		$nd_donations_account_avatar_url_args = array(
								'size'   => 600
							);
							$nd_donations_account_avatar_url = get_avatar_url($nd_donations_current_user->user_email, $nd_donations_account_avatar_url_args);

                    	?>
                        
                        <img alt="" class="nd_donations_section" src="<?php echo $nd_donations_account_avatar_url; ?>">

                        <div class="nd_donations_bg_greydark_alpha_gradient nd_donations_position_absolute nd_donations_left_0 nd_donations_height_100_percentage nd_donations_width_100_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box">
                            <div class="nd_donations_position_absolute nd_donations_bottom_20">
                                <h2 class="nd_donations_color_white_important">@<?php echo $nd_donations_current_user->user_login; ?></h2>
                            </div>

                        </div>

                    </div>
                    <!--image-->


                    <div class="nd_donations_section nd_donations_box_sizing_border_box">
                    
                        <div class="nd_donations_section nd_donations_bg_greydark">
                            <table class="nd_donations_section ">
                                <tbody>
                                   
                                   <tr class="">
                                        <td class="nd_donations_padding_30">  
                                            <h5 class="nd_donations_font_size_13 nd_donations_text_transform_uppercase nd_options_color_grey"><?php _e('Name','nd-donations'); ?></h5>
                                            <div class="nd_donations_section nd_donations_height_5"></div>
                                            <p class="nd_donations_color_white_important nd_donations_line_height_16"><?php echo $nd_donations_current_user->user_firstname; ?></p>
                                        </td>
                                        <td class="nd_donations_padding_30">
                                            <h5 class="nd_donations_font_size_13 nd_donations_text_transform_uppercase nd_options_color_grey"><?php _e('Last Name','nd-donations'); ?></h5>
                                            <div class="nd_donations_section nd_donations_height_5"></div>
                                            <p class="nd_donations_color_white_important nd_donations_line_height_16"><?php echo $nd_donations_current_user->user_lastname; ?></p>    
                                        </td>
                                    </tr>

                                </tbody>
                            </table> 
                        </div>

                        <div class="nd_donations_section nd_donations_border_1_solid_grey nd_donations_padding_20 nd_donations_box_sizing_border_box">

                            <table class="nd_donations_section">
                                <tbody>
                                   
                                   <tr class="">
                                        <td class="nd_donations_padding_10">  

                                            <div class="nd_donations_display_table nd_donations_float_left">
                    
                                                <div class="nd_donations_display_table_cell nd_donations_vertical_align_middle">
                                                    <img alt="" class="nd_donations_margin_right_20" width="25" src="<?php echo esc_url(plugins_url('icon-email-grey.svg', __FILE__ )); ?>">
                                                </div>

                                                <div class="nd_donations_display_table_cell nd_donations_vertical_align_middle">
                                                    <h5 class="nd_donations_font_size_13 nd_donations_text_transform_uppercase"><strong><?php _e('Email','nd-donations'); ?></strong></h5>
                                                    <div class="nd_donations_section nd_donations_height_5"></div>
                                                    <p class=""><?php echo $nd_donations_current_user->user_email; ?></p>
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="nd_donations_padding_10">  

                                            <div class="nd_donations_display_table nd_donations_float_left">
                    
                                                <div class="nd_donations_display_table_cell nd_donations_vertical_align_middle">
                                                    <img alt="" class="nd_donations_margin_right_20" width="25" src="<?php echo esc_url(plugins_url('icon-link-grey.svg', __FILE__ )); ?>">
                                                </div>

                                                <div class="nd_donations_display_table_cell nd_donations_vertical_align_middle">
                                                    <h5 class="nd_donations_font_size_13 nd_donations_text_transform_uppercase"><strong><?php _e('Url','nd-donations'); ?></strong></h5>
                                                    <div class="nd_donations_section nd_donations_height_5"></div>
                                                    <p class=""><?php echo $nd_donations_current_user->user_url; ?></p>
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td class="nd_donations_padding_10">  
                                            <h5 class="nd_donations_font_size_13 nd_donations_text_transform_uppercase"><strong><?php _e('About Me','nd-donations'); ?></strong></h5>
                                            <div class="nd_donations_section nd_donations_height_5"></div>
                                            <p class="nd_donations_line_height_25"><?php echo $nd_donations_current_user->description; ?></p>
                                        </td>
                                    </tr>

                                </tbody>
                            </table> 
                        </div>
                        

                    </div>

                    <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box nd_donations_bg_white ">
                        
                        <div class="nd_donations_width_50_percentage nd_donations_padding_10 nd_donations_box_sizing_border_box nd_donations_float_left nd_donations_text_align_center">
                            <a class="nd_donations_display_inline_block nd_donations_color_white_important nd_donations_bg_green nd_donations_box_sizing_border_box nd_donations_width_100_percentage nd_options_first_font nd_donations_padding_8  nd_donations_font_size_13" href="<?php echo get_edit_user_link(); ?>"><?php _e('EDIT PROFILE','nd-donations'); ?></a>
                        </div>  

                        <div class="nd_donations_width_50_percentage nd_donations_padding_10 nd_donations_box_sizing_border_box nd_donations_float_left nd_donations_text_align_center">
                            <a class="nd_donations_display_inline_block nd_donations_color_white_important nd_donations_bg_red nd_donations_box_sizing_border_box nd_donations_width_100_percentage nd_options_first_font nd_donations_padding_8  nd_donations_font_size_13" href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e('LOGOUT','nd-donations'); ?></a>
                        </div> 
                        
                    </div>



        		</div>
                <!--start preview-->

	        </div>

	    </div>






	    <div class="nd_donations_width_66_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">
	    	

	    	<!--START Tabs-->
			<div class="nd_donations_tabs nd_donations_section">

				<ul class="nd_donations_list_style_none nd_donations_margin_0 nd_donations_padding_0 nd_donations_section ">

					<?php 
					//custom hook
	    			do_action("nd_donations_shortcode_account_tab_list"); 
		    		?>	
				</ul>
			  
			  	<?php 
				//custom hook
				do_action("nd_donations_shortcode_account_tab_list_content"); 
		    	?>
			    
	    	</div>
	    	<!--END tabs-->



	    	<script type="text/javascript">
			<!--//--><![CDATA[//><!--
				jQuery(document).ready(function($) {
					$('.nd_donations_tabs').tabs();
				});
			//--><!]]>
			</script>


	    </div>




		<?php

		//custom hook
    	do_action("nd_donations_end_shortcode_account_on_user_login");

    	?>



    	<?php


	}else{

        $nd_donations_account_page_result = '';

        $nd_donations_account_page_result .= '

            <div class="nd_donations_section">
              <div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">
                
                <div class="nd_donations_section  nd_donations_border_1_solid_grey nd_donations_padding_20 nd_donations_box_sizing_border_box">
                    
                    <h6 class="nd_options_second_font nd_donations_bg_green nd_donations_padding_8 nd_donations_color_white_important nd_donations_display_inline_block">'.__('ALREADY A MEMBER','nd-donations').'</h6>
                    <div class="nd_donations_section nd_donations_height_10"></div>
                    <h3><strong>'.__('LOG IN','nd-donations').'</strong></h3>

                    '.do_shortcode("[nd_donations_login]").' 
                </div>

                
              </div>

        ';

        //START check if registration is enable
        if ( get_option( 'users_can_register' ) == 1 ) {

            $nd_donations_account_page_result .='

            <div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">

                <div class="nd_donations_section nd_donations_bg_white  nd_donations_border_1_solid_grey nd_donations_padding_20 nd_donations_box_sizing_border_box">
                
                    <h6 class="nd_options_second_font nd_donations_bg_green nd_donations_padding_8  nd_donations_color_white_important nd_donations_display_inline_block">'.__('I DO NOT HAVE AN ACCOUNT','nd-donations').'</h6>
                    <div class="nd_donations_section nd_donations_height_10"></div>
                    <h3><strong>'.__('REGISTER','nd-donations').'</strong></h3>

                    '.do_shortcode("[nd_donations_register]").'

                </div>
                
              </div>';

        }else{

            $nd_donations_account_page_result .='

            <div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">

                <div class="nd_donations_opacity_04 nd_donations_section nd_donations_bg_white  nd_donations_border_1_solid_grey nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_position_relative">
                
                    <div class="nd_donations_section nd_donations_position_absolute nd_donations_cursor_not_allowed nd_donations_height_100_percentage nd_donations_left_0 nd_donations_top_0"></div>

                    <h6 class="nd_options_second_font nd_donations_bg_green nd_donations_padding_8  nd_donations_color_white_important nd_donations_display_inline_block">'.__('I DO NOT HAVE AN ACCOUNT','nd-donations').'</h6>
                    <div class="nd_donations_section nd_donations_height_10"></div>
                    <h3><strong>'.__('REGISTRATION DISABLED','nd-donations').'</strong></h3>

                    
                    <form action="#" method="post">
                        <p>
                          <label class="nd_donations_section nd_donations_margin_top_20">'.__('Username','nd-donations').' *</label>
                          <input readonly type="text" name="nd_donations_username" class=" nd_donations_section" value="">
                        </p>
                        <p>
                          <label class="nd_donations_section nd_donations_margin_top_20">'.__('Password','nd-donations').' *</label>
                          <input readonly type="password" name="nd_donations_password" class=" nd_donations_section" value="">
                        </p>
                        <p>
                          <label class="nd_donations_section nd_donations_margin_top_20">'.__('Email','nd-donations').' *</label>
                          <input readonly type="text" name="nd_donations_email" class=" nd_donations_section" value="">
                        </p>
                        <p>
                          <label class="nd_donations_section nd_donations_margin_top_20">'.__('Website','nd-donations').'</label>
                          <input readonly type="text" name="nd_donations_website" class=" nd_donations_section" value="">
                        </p>
                        <p>
                          <label class="nd_donations_section nd_donations_margin_top_20">'.__('First Name','nd-donations').'</label>
                          <input readonly type="text" name="nd_donations_first_name" class="nd_donations_section" value="">
                        </p>
                        <p>
                          <label class="nd_donations_section nd_donations_margin_top_20">'.__('Last Name','nd-donations').'</label>
                          <input readonly type="text" name="nd_donations_last_name" class="nd_donations_section" value="">
                        </p>
                        <p>
                          <label class="nd_donations_section nd_donations_margin_top_20">'.__('Nickname','nd-donations').'</label>
                          <input readonly type="text" name="nd_donations_nickname" class="nd_donations_section" value="">
                        </p>
                        <p>
                          <label class="nd_donations_section nd_donations_margin_top_20">'.__('About / Bio','nd-donations').'</label>
                          <textarea readonly class="nd_donations_section" name="nd_donations_bio"></textarea>
                        </p>
                        <input disabled class="nd_donations_section nd_donations_margin_top_20" type="submit" name="submit" value="'.__('Registration Disabled','nd-donations').'">
                    </form>
    

                </div>


              </div>';

        }
        //END check if registration is enable


        $nd_donations_account_page_result .='</div>';


        echo $nd_donations_account_page_result;
		

	}
	//end if


}
add_shortcode('nd_donations_account', 'nd_donations_shortcode_account');
//END nd_donations_account







//add attendees tab list in the custom hook
add_action('nd_donations_shortcode_account_tab_list','nd_donations_single_cause_add_offline_donations_tab_list');
function nd_donations_single_cause_add_offline_donations_tab_list(){

  $nd_donations_offline_donations_tab = '';


  $nd_donations_offline_donations_tab .= '
    <li class="nd_donations_display_inline_block nd_donations_margin_right_40">
    <h4>
      <a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_donations_offline_donations_tab">
        '.__('Offline Donations','nd-donations').'
      </a>
    </h4>
  </li>
    ';

    echo $nd_donations_offline_donations_tab;

}


//Add donations on account page
function nd_donations_show_offline_donations(){

  //declare variable
  $nd_donations_result = '';

  //get current user id
  $nd_donations_current_user = wp_get_current_user();
  $nd_donations_current_user_id = $nd_donations_current_user->ID;

  global $wpdb;

  $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';
  $nd_donations_action_type = "'offline-donation'";

  //START select for items
  $nd_donations_donation_ids = $wpdb->get_results( "SELECT * FROM $nd_donations_table_name WHERE id_user = $nd_donations_current_user_id AND action_type = $nd_donations_action_type");

  //title section
  $nd_donations_result .= '
    <div class="nd_donations_section" id="nd_donations_offline_donations_tab">
      <div class="nd_donations_section nd_donations_height_10"></div>
  ';

  //no results
  if ( empty($nd_donations_donation_ids) ) { 
    $nd_donations_result .= '<div class="nd_donations_section nd_donations_height_10"></div><p>'.__('You do not have any donation','nd-donations').'</p>'; 
  }else{


    $nd_donations_result .= '
      
      <div class="nd_donations_section nd_donations_box_sizing_border_box nd_donations_overflow_hidden nd_donations_overflow_x_auto nd_donations_cursor_move_responsive">
      <table>
        <thead>
          <tr class="nd_donations_border_bottom_1_solid_grey">
              <td class="nd_donations_padding_20 nd_donations_width_20_percentage">
                  <h6 class="nd_donations_text_transform_uppercase">'.__('CAUSE','nd-donations').'</h6>    
              </td>
              <td class="nd_donations_padding_20 nd_donations_width_50_percentage nd_donations_display_none_all_iphone">
                      
              </td>
              <td class="nd_donations_padding_20 nd_donations_width_20_percentage">
                  <h6 class="nd_donations_text_transform_uppercase">'.__('VALUE','nd-donations').'</h6>    
              </td>
              <td class="nd_donations_padding_20 nd_donations_width_10_percentage">
                    
              </td>
          </tr>
      </thead>
      <tbody>
    ';

    foreach ( $nd_donations_donation_ids as $nd_donations_donation_id ) 
    {
      $nd_donations_result .= '

        <tr class="nd_donations_border_bottom_1_solid_grey">
            <td class="nd_donations_padding_20">  
                <img alt="" class="nd_donations_section" src="'.nd_donations_get_cause_img_src($nd_donations_donation_id->id_cause).'"> 
            </td>
            <td class="nd_donations_padding_20">  
                <h4 class="nd_donations_text_transform_uppercase">'.get_the_title($nd_donations_donation_id->id_cause).'</h4> 
                <div class="nd_donations_section nd_donations_height_5"></div>
                <p>'.__('Transiction : ','nd-donations').''.$nd_donations_donation_id->paypal_tx.'</p> 
            </td>
            <td class="nd_donations_padding_20 nd_donations_display_none_all_iphone">
                <p class="nd_options_color_greydark">'.nd_donations_get_currency().' '.$nd_donations_donation_id->donation_value.'</p>    
            </td>
            <td class="nd_donations_padding_20 nd_donations_text_align_right">'; 

                if ( $nd_donations_donation_id->paypal_payment_status == 'Completed' ) {
                    $nd_donations_result .= '<a class="nd_donations_bg_greydark nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8  nd_donations_font_size_13 nd_donations_text_transform_uppercase">'.__('COMPLETED','nd-donations').'</a>';
                }else{
                    $nd_donations_result .= '<a class="nd_donations_bg_red nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8  nd_donations_font_size_13 nd_donations_text_transform_uppercase">'.$nd_donations_donation_id->paypal_payment_status.'</a>';
                }

            $nd_donations_result .= '</td>
        </tr>

      ';
    }
    $nd_donations_result .= '</tbody></table></div>';

  }
  //END select for items

  $nd_donations_result .= '</div>';

  echo $nd_donations_result;
  

}
//END
add_action('nd_donations_shortcode_account_tab_list_content','nd_donations_show_offline_donations');







//add attendees tab list in the custom hook
add_action('nd_donations_shortcode_account_tab_list','nd_donations_single_cause_add_paypal_donations_tab_list');
function nd_donations_single_cause_add_paypal_donations_tab_list(){

  $nd_donations_paypal_donations_tab = '';


  $nd_donations_paypal_donations_tab .= '
    <li class="nd_donations_display_inline_block nd_donations_margin_right_40">
    <h4>
      <a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_donations_paypal_donations_tab">
        '.__('Paypal Donations','nd-donations').'
      </a>
    </h4>
  </li>
    ';

    echo $nd_donations_paypal_donations_tab;

}


//Add donations on account page
function nd_donations_show_paypal_donations(){

  //declare variable
  $nd_donations_result = '';

  //get current user id
  $nd_donations_current_user = wp_get_current_user();
  $nd_donations_current_user_id = $nd_donations_current_user->ID;

  global $wpdb;

  $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';
  $nd_donations_action_type = "'paypal'";

  //START select for items
  $nd_donations_donation_ids = $wpdb->get_results( "SELECT * FROM $nd_donations_table_name WHERE id_user = $nd_donations_current_user_id AND action_type = $nd_donations_action_type");

  //title section
  $nd_donations_result .= '
    <div class="nd_donations_section" id="nd_donations_paypal_donations_tab">
      <div class="nd_donations_section nd_donations_height_10"></div>
  ';

  //no results
  if ( empty($nd_donations_donation_ids) ) { 
    $nd_donations_result .= '<div class="nd_donations_section nd_donations_height_10"></div><p>'.__('You do not have any donation','nd-donations').'</p>'; 
  }else{


    $nd_donations_result .= '
      
      <div class="nd_donations_section nd_donations_box_sizing_border_box nd_donations_overflow_hidden nd_donations_overflow_x_auto nd_donations_cursor_move_responsive">
      <table>
        <thead>
          <tr class="nd_donations_border_bottom_1_solid_grey">
              <td class="nd_donations_padding_20 nd_donations_width_20_percentage">
                  <h6 class="nd_donations_text_transform_uppercase">'.__('CAUSE','nd-donations').'</h6>    
              </td>
              <td class="nd_donations_padding_20 nd_donations_width_50_percentage nd_donations_display_none_all_iphone">
                      
              </td>
              <td class="nd_donations_padding_20 nd_donations_width_20_percentage">
                  <h6 class="nd_donations_text_transform_uppercase">'.__('VALUE','nd-donations').'</h6>    
              </td>
              <td class="nd_donations_padding_20 nd_donations_width_10_percentage">
                    
              </td>
          </tr>
      </thead>
      <tbody>
    ';

    foreach ( $nd_donations_donation_ids as $nd_donations_donation_id ) 
    {
      $nd_donations_result .= '

        <tr class="nd_donations_border_bottom_1_solid_grey">
            <td class="nd_donations_padding_20">  
                <img alt="" class="nd_donations_section" src="'.nd_donations_get_cause_img_src($nd_donations_donation_id->id_cause).'"> 
            </td>
            <td class="nd_donations_padding_20">  
                <h4 class="nd_donations_text_transform_uppercase">'.get_the_title($nd_donations_donation_id->id_cause).'</h4> 
                <div class="nd_donations_section nd_donations_height_5"></div>
                <p>'.__('Transiction : ','nd-donations').''.$nd_donations_donation_id->paypal_tx.'</p> 
            </td>
            <td class="nd_donations_padding_20 nd_donations_display_none_all_iphone">
                <p class="nd_options_color_greydark">'.nd_donations_get_currency().' '.$nd_donations_donation_id->donation_value.'</p>    
            </td>
            <td class="nd_donations_padding_20 nd_donations_text_align_right">'; 

                if ( $nd_donations_donation_id->paypal_payment_status == 'Completed' ) {
                    $nd_donations_result .= '<a class="nd_donations_bg_greydark nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8  nd_donations_font_size_13 nd_donations_text_transform_uppercase">'.__('COMPLETED','nd-donations').'</a>';
                }else{
                    $nd_donations_result .= '<a class="nd_donations_bg_red nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8  nd_donations_font_size_13 nd_donations_text_transform_uppercase">'.$nd_donations_donation_id->paypal_payment_status.'</a>';
                }

            $nd_donations_result .= '</td>
        </tr>

      ';
    }

    $nd_donations_result .= '</tbody></table></div>';

  }
  //END select for items

  $nd_donations_result .= '</div>';

  echo $nd_donations_result;
  

}
//END
add_action('nd_donations_shortcode_account_tab_list_content','nd_donations_show_paypal_donations');


