<?php


//header
get_header( );


//hook
do_action('nd_donations_single_cause_below_header');


//hook
do_action('nd_donations_single_cause_start_content');


//add conteiner
if ( nd_donations_get_container() != 1) { echo '<div class="nd_donations_container nd_donations_clearfix">'; }


if(have_posts()) :
	while(have_posts()) : the_post();


	    //default
	    $nd_donations_title_cause = get_the_title();
	    $nd_donations_content_cause = do_shortcode(get_the_content());
	    $nd_donations_id = get_the_ID();

	    //image
	    if ( has_post_thumbnail() ) { 
			$nd_donations_image_cause = '
				<img alt="" class="nd_donations_section" src="'.nd_donations_get_cause_img_src(get_the_ID()).'">
			';
	    }else{ 
	    	$nd_donations_image_cause = '';
	    }

	    //transaction TX id
	    $nd_donations_tx = rand(100000000,999999999);


	    //include tabs js
		wp_enqueue_script('jquery-ui-tabs');

		//ajax results
		$nd_donations_single_cause_form_validate_fields = array(
		    'nd_donations_ajaxurl_single_cause_form_validate_fields' => admin_url('admin-ajax.php'),
		    'nd_donations_ajaxnonce_single_cause_form_validate_fields' => wp_create_nonce('nd_donations_form_validate_fields_nonce'),
		);

		wp_enqueue_script( 'nd_donations_single_cause_form_validate_fields', esc_url( plugins_url( 'nd_donations_single_cause_form_validate_fields.js', __FILE__ ) ), array( 'jquery' ) ); 
		wp_localize_script( 'nd_donations_single_cause_form_validate_fields', 'nd_donations_my_vars_single_cause_form_validate_fields', $nd_donations_single_cause_form_validate_fields ); 


	  	$nd_donations_result = '';
	    
	  	
	  	//START header content
	    $nd_donations_result .= '

	    	<div class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box">';
	    			
	    		//check image is present
	    		if ( has_post_thumbnail() ) { 

	    			$nd_donations_result .= '

	    				<div class="nd_donations_section nd_donations_height_40"></div>

						<!--image and testimonial-->
			    		<div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_section nd_donations_display_table">	

				    		<!--start image-->
				    		<div class="nd_donations_width_66_percentage nd_donations_width_100_percentage_all_iphone nd_donations_float_left_all_iphone nd_donations_display_block_all_iphone nd_donations_box_sizing_border_box_all_iphone nd_donations_position_relative nd_donations_display_table_cell nd_donations_vertical_align_middle">

				    			'.$nd_donations_image_cause.' ';

				    			echo $nd_donations_result;

				    			//hook
						        do_action('nd_donations_single_cause_below_image',20,20);

						        $nd_donations_result = '';

						        //START progress bar
					            if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

					            	$nd_donations_progress_label_class = '';

					            	if ( nd_donations_get_total_donations_percentage(get_the_ID()) <= 50 ) {
					            		$nd_donations_progress_label_class = ' top:-25px; right:-40px; ';
					            	}else{
					            		$nd_donations_progress_label_class = ' top:-25px; right:0px; ';	
					            	}

					            	$nd_donations_result .= '

					            		<div id="nd_donations_single_cause_image_loader" class="nd_donations_section nd_donations_bg_greydark nd_donations_box_sizing_border_box">
										    <div class="nd_donations_height_3 nd_donations_section nd_donations_bg_greydark">
										        <div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; width:'.nd_donations_get_total_donations_percentage(get_the_ID()).'%;" class="nd_donations_height_3 nd_donations_float_left nd_donations_position_relative">
										            <p style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; '.$nd_donations_progress_label_class.' " class="nd_donations_line_height_50 nd_donations_width_50 nd_donations_height_50 nd_donations_text_align_center nd_donations_color_white_important nd_donations_font_size_15 nd_donations_border_radius_100_percentage  nd_donations_display_inline_block nd_donations_position_absolute">'.nd_donations_get_total_donations_percentage(get_the_ID()).'%</p>
										        </div>
										    </div>
										</div>

					            	';

					            }
					            //END progress bar


				    		$nd_donations_result .= '
				    		</div>
				    		<!--end image-->';


				    		echo $nd_donations_result;

				    		//hook
				    		do_action('nd_donations_single_cause_below_image_2');


				    	$nd_donations_result = '</div>
				    	<div class="nd_donations_section nd_donations_height_20"></div>
				    	<!--END image and testimonial-->';

	    		}	
	    		//end check image is present

	        $nd_donations_result .= '</div>
	    ';
	    //END header content


	    //start check if sidebar is present
	    if ( nd_donations_get_cause_sidebar(get_the_ID()) == 'nd_donations_left_sidebar' OR nd_donations_get_cause_sidebar(get_the_ID()) == 'nd_donations_right_sidebar' ) {
	    	$nd_donations_single_cause_sidebar_class = 'nd_donations_width_66_percentage';
	    }else{
	    	$nd_donations_single_cause_sidebar_class = 'nd_donations_width_100_percentage';	
	    }
	    //end check if sidebar is present


	    echo $nd_donations_result;


	    //custom hook
		do_action("nd_donations_single_cause_before_text_content");


	    //START center content
	    $nd_donations_result = '

	    <!--start column-->
	    <div class=" '.$nd_donations_single_cause_sidebar_class.' nd_donations_float_left nd_donations_width_100_percentage_responsive">

	    	<div class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box">
	    		
		    	<!--START Tabs-->
				<div class="nd_donations_tabs nd_donations_section">

					<ul id="nd_donations_single_cause_tab_list" class="nd_donations_list_style_none nd_donations_margin_0 nd_donations_padding_0 nd_donations_section">

						<li class="nd_donations_display_inline_block nd_donations_margin_right_40">
							<h4>
								<a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_donations_single_cause_tab_description">'.__('Description','nd-donations').'</a>
							</h4>
						</li>';


						echo  $nd_donations_result;

						//custom hook
			    		do_action("nd_donations_single_cause_tab_list");
						

			    	$nd_donations_result = '
					</ul>

					<div class="nd_donations_section nd_donations_height_30"></div>

					<div class="nd_donations_section" id="nd_donations_single_cause_tab_description">
						'.$nd_donations_content_cause.'
					</div>';
					

					echo  $nd_donations_result;

					//custom hook
					do_action("nd_donations_single_cause_tab_content"); 

				
				$nd_donations_result = '		  
				</div>
				<!--END tabs-->

			</div>


			<script type="text/javascript">
			<!--//--><![CDATA[//><!--
				jQuery(document).ready(function($) {
					$(".nd_donations_tabs").tabs();
				});
			//--><!]]>
			</script>


			<div class="nd_donations_section nd_donations_height_20"></div>

	    ';
	    //END center content




		//START check if cause is completed
		if ( nd_donations_get_total_missing_money_to_goal(get_the_ID()) == 0 AND nd_donations_get_cause_price(get_the_ID()) != 0  ) {

			$nd_donations_result .= '

				<div class="nd_donations_section nd_donations_height_10"></div>

		    	<div id="nd_donations_single_cause_goal_achieved" class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box">
		    		<h3 class="">'.__('GOAL achieved thanks for all your donations','nd-donations').'</h3>
		    	</div>

		    	<div class="nd_donations_section nd_donations_height_10"></div>

		    ';

		}
		//END check if cause is completed


	    //START check for show the donation form
	    if ( nd_donations_get_cause_price(get_the_ID()) != 0 AND nd_donations_get_total_missing_money_to_goal(get_the_ID()) != 0 ) {

	    	

	    	//recover datas from plugin settings
			$nd_donations_paypal_email = get_option('nd_donations_paypal_email');
			$nd_donations_paypal_currency = get_option('nd_donations_paypal_currency');
			$nd_donations_paypal_token = get_option('nd_donations_paypal_token');

			$nd_donations_paypal_developer = get_option('nd_donations_paypal_developer');
			if ( $nd_donations_paypal_developer == 1) {
			  $nd_donations_paypal_action_1 = 'https://www.sandbox.paypal.com/cgi-bin';
			  $nd_donations_paypal_action_2 = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
			}
			else{  
			  $nd_donations_paypal_action_1 = 'https://www.paypal.com/cgi-bin';
			  $nd_donations_paypal_action_2 = 'https://www.paypal.com/cgi-bin/webscr';
			}


			//START check if user is logged
			if ( is_user_logged_in() == 1 ) {
				$nd_donations_current_user = wp_get_current_user();
				$nd_donations_current_user_id = $nd_donations_current_user->ID;
			}else{
				$nd_donations_current_user_id = 0;	
			}
			//END check if user is logged



	    	$nd_donations_result .= '

	    	<div class="nd_donations_section nd_donations_height_10"></div>

	    	<div id="nd_donations_single_cause_form_section" class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box">

	    		<h3><strong>'.__('DONATE NOW','nd-donations').'</strong></h3>
	    		
	    		
	    		
	    		<!--START FORM-->
	    		<form method="post" action="'.nd_donations_get_thankyou_page().'">

	    			<!--start title-->
	    			<div class="nd_donations_section nd_donations_height_40"></div>
	    			<div id="nd_donations_single_cause_step_1" class="nd_donations_section">
						<div class="nd_donations_display_table nd_donations_float_left">

						    <div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_display_none_responsive nd_donations_height_30 nd_donations_width_30 nd_donations_text_align_center nd_donations_border_radius_100_percentage nd_donations_display_table_cell nd_donations_vertical_align_middle">
						        <p class="nd_donations_line_height_30 nd_donations_color_white_important nd_donations_margin_0 nd_donations_padding_0"><strong>1</strong></p>
						    </div>
						    <h4 class="nd_donations_display_table_cell nd_donations_vertical_align_middle nd_options_color_greydark nd_donations_padding_0_responsive nd_donations_padding_left_20 nd_donations_margin_0 nd_donations_padding_top_0 nd_donations_text_transform_uppercase">'.__('Insert your amount','nd-donations').'</h4>
						</div>
					</div>
					<!--end title-->

	    			<div class="nd_donations_section nd_donations_height_20"></div>

	    			<!--START hidden value-->
	    			<input name="nd_donations_single_cause_form" type="hidden" value="true">
	    			<input id="nd_donations_single_cause_form_donation_id" name="nd_donations_id" type="hidden" value="'.get_the_ID().'">
	    			<input name="nd_donations_tx" type="hidden" value="'.$nd_donations_tx.'">
	    			<input id="nd_donations_single_cause_form_donation_value_offline" type="hidden" name="nd_donations_single_cause_form_donation_value_offline" value="">
	    			<!--END hidden value-->';

	    			echo $nd_donations_result;

	    			//custom hook
  					do_action("nd_donations_start_values_single_cause_form");


	    		$nd_donations_result = '

	    			<script type="text/javascript">
					//<![CDATA[

						jQuery(document).ready(function() {

							jQuery(".nd_donations_single_cause_form_donation_value").on("click", function(e) {
								jQuery(".nd_donations_single_cause_form_donation_value").removeClass("nd_donations_fixed_value_donation_selected");
								jQuery(this).addClass("nd_donations_fixed_value_donation_selected");
						    });

						});

					//]]>
					</script>


					<style type="text/css">
						.nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected { background-color: '.nd_donations_get_cause_color(get_the_ID()).' !important; border:1px solid '.nd_donations_get_cause_color(get_the_ID()).' !important; }
						.nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected::-webkit-input-placeholder { color: #fff !important; }
						.nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected::-moz-placeholder { color: #fff !important; }
						.nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected:-ms-input-placeholder { color: #fff !important; }
						.nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected:-moz-placeholder { color: #fff !important; }
					</style>


		    		<div id="nd_donations_single_cause_form_donation_value_container"  class="nd_donations_section nd_donations_position_relative">
		    			<input onclick="nd_donations_single_cause_form_filter()" onchange="nd_donations_single_cause_form_filter()" class="nd_donations_cursor_pointer nd_donations_section nd_donations_single_cause_form_donation_value" id="nd_donations_single_cause_form_donation_value" name="nd_donations_value" type="text" placeholder="'.__('Insert custom value','nd-donations').'">
		    		</div>';


		    		//START IF USER IS LOGGED
		    		if ( is_user_logged_in() == 1 ){

		    			//get datas
		    			$nd_donations_current_user = wp_get_current_user();

		    			//START personal informations
				    	$nd_donations_result .= '
			    		<!--start title-->
		    			<div class="nd_donations_section nd_donations_height_40"></div>
		    			<div id="nd_donations_single_cause_step_2" class="nd_donations_section">
							<div class="nd_donations_display_table nd_donations_float_left">

							    <div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_height_30 nd_donations_display_none_responsive nd_donations_width_30 nd_donations_text_align_center nd_donations_border_radius_100_percentage nd_donations_display_table_cell nd_donations_vertical_align_middle">
							        <p class="nd_donations_line_height_30 nd_donations_color_white_important nd_donations_margin_0 nd_donations_padding_0"><strong>2</strong></p>
							    </div>
							    <h4 class="nd_donations_line_height_25_all_iphone nd_donations_display_table_cell nd_donations_vertical_align_middle nd_options_color_greydark nd_donations_padding_0_responsive nd_donations_padding_left_20 nd_donations_margin_0 nd_donations_padding_top_0 nd_donations_text_transform_uppercase">'.__('You are donating as ','nd-donations').' @'.$nd_donations_current_user->user_login.' <a target="_blank" class="nd_donations_margin_left_10 nd_donations_display_inline_block nd_donations_color_white_important  nd_donations_bg_greydark nd_donations_padding_5_10 nd_donations_font_size_13" href="'.get_edit_user_link().'">'.__('YOU CAN ADD/EDIT YOUR DATAS HERE','nd-donations').'</a></h4>
							</div>
						</div>
						<!--end title-->

						<div class="nd_donations_section nd_donations_height_20"></div>

			    		<div class="nd_donations_section">
			    			<div id="nd_donations_single_cause_form_donation_name_container" class="nd_donations_position_relative nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_bottom_20_important_responsive nd_donations_padding_right_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_cursor_not_allowed nd_donations_section" id="nd_donations_single_cause_form_donation_name" name="nd_donations_name" type="text" readonly placeholder="'.__('Name','nd-donations').'" value="'.$nd_donations_current_user->user_firstname.'" >
			    			</div>
			    			<div id="nd_donations_single_cause_form_donation_surname_container"  class="nd_donations_position_relative nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_left_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_cursor_not_allowed nd_donations_section" id="nd_donations_single_cause_form_donation_surname" name="nd_donations_surname" type="text" readonly placeholder="'.__('Surname','nd-donations').'" value="'.$nd_donations_current_user->user_lastname.'">
			    			</div>
			    		</div>
			    		<div class="nd_donations_section nd_donations_height_20"></div>
			    		<div class="nd_donations_section">
			    			<div id="nd_donations_single_cause_form_donation_email_container"  class="nd_donations_position_relative nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_bottom_20_important_responsive nd_donations_padding_right_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_cursor_not_allowed nd_donations_section" id="nd_donations_single_cause_form_donation_email" name="nd_donations_email" type="text" readonly placeholder="'.__('Email','nd-donations').'" value="'.$nd_donations_current_user->user_email.'" >
			    			</div>
			    			<div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_left_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" name="nd_donations_address" type="text" placeholder="'.__('Address','nd-donations').'">
			    			</div>
			    		</div>
			    		<div class="nd_donations_section nd_donations_height_20"></div>
			    		<div class="nd_donations_section">
			    			<div id="nd_donations_single_cause_form_donation_city_container" class="nd_donations_padding_bottom_20_important_responsive nd_donations_width_50_percentage nd_donations_float_left nd_donations_position_relative nd_donations_padding_right_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" id="nd_donations_single_cause_form_donation_city" name="nd_donations_city" type="text" placeholder="'.__('City','nd-donations').'">
			    			</div>
			    			<div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_left_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" name="nd_donations_country" type="text" placeholder="'.__('Country','nd-donations').'">
			    			</div>
			    		</div>
			    		<div class="nd_donations_section nd_donations_height_20"></div>
			    		<div id="nd_donations_single_cause_form_donation_message_container" class="nd_donations_section nd_donations_position_relative">
			    			<textarea onclick="nd_donations_single_cause_form_filter()" onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" name="nd_donations_message" id="nd_donations_single_cause_form_donation_message" rows="5" placeholder="'.__('Message','nd-donations').'"></textarea>
			    		</div>
			    		<div class="nd_donations_section nd_donations_height_20"></div>
			    		<div class="nd_donations_section">
			    			<input id="nd_donations_single_cause_form_donation_submit" class="nd_donations_display_none_important" disabled="disabled" type="submit" value="'.__('DONATE NOW','nd-donations').'">
			    		</div>';
			    		//END personal informations

		    		}else{


		    			//START personal informations
				    	$nd_donations_result .= '
			    		<!--start title-->
		    			<div class="nd_donations_section nd_donations_height_40"></div>
		    			<div id="nd_donations_single_cause_step_2" class="nd_donations_section">
							<div class="nd_donations_display_table nd_donations_float_left">

							    <div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_height_30 nd_donations_display_none_responsive nd_donations_width_30 nd_donations_text_align_center nd_donations_border_radius_100_percentage nd_donations_display_table_cell nd_donations_vertical_align_middle">
							        <p class="nd_donations_line_height_30 nd_donations_color_white_important"><strong>2</strong></p>
							    </div>
							    <h4 class="nd_donations_line_height_25_all_iphone nd_donations_display_table_cell nd_donations_vertical_align_middle nd_options_color_greydark nd_donations_padding_0_responsive nd_donations_padding_left_20 nd_donations_text_transform_uppercase">'.__('You are donating as guest','nd-donations').' <span class="nd_donations_font_size_13 nd_donations_margin_0_10">or</span> <a class="nd_donations_display_inline_block nd_donations_color_white_important  nd_donations_bg_greydark nd_donations_padding_5_10 nd_donations_font_size_13" href="'.nd_donations_get_account_page().'">'.__('LOGIN','nd-donations').'</a></h4>
							</div>
						</div>
						<!--end title-->

						<div class="nd_donations_section nd_donations_height_20"></div>

			    		<div class="nd_donations_section">
			    			<div id="nd_donations_single_cause_form_donation_name_container" class="nd_donations_position_relative nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_bottom_20_important_responsive nd_donations_padding_right_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" id="nd_donations_single_cause_form_donation_name" name="nd_donations_name" type="text" placeholder="'.__('Name','nd-donations').'">
			    			</div>
			    			<div id="nd_donations_single_cause_form_donation_surname_container"  class="nd_donations_position_relative nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_left_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" id="nd_donations_single_cause_form_donation_surname" name="nd_donations_surname" type="text" placeholder="'.__('Surname','nd-donations').'">
			    			</div>
			    		</div>
			    		<div class="nd_donations_section nd_donations_height_20"></div>
			    		<div class="nd_donations_section">
			    			<div id="nd_donations_single_cause_form_donation_email_container"  class="nd_donations_position_relative nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_bottom_20_important_responsive nd_donations_padding_right_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" id="nd_donations_single_cause_form_donation_email" name="nd_donations_email" type="text" placeholder="'.__('Email','nd-donations').'">
			    			</div>
			    			<div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_left_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" name="nd_donations_address" type="text" placeholder="'.__('Address','nd-donations').'">
			    			</div>
			    		</div>
			    		<div class="nd_donations_section nd_donations_height_20"></div>
			    		<div class="nd_donations_section">
			    			<div id="nd_donations_single_cause_form_donation_city_container" class="nd_donations_padding_bottom_20_important_responsive nd_donations_width_50_percentage nd_donations_float_left nd_donations_position_relative nd_donations_padding_right_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" id="nd_donations_single_cause_form_donation_city" name="nd_donations_city" type="text" placeholder="'.__('City','nd-donations').'">
			    			</div>
			    			<div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_padding_left_15 nd_donations_padding_0_responsive nd_donations_box_sizing_border_box nd_donations_width_100_percentage_responsive">
			    				<input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" name="nd_donations_country" type="text" placeholder="'.__('Country','nd-donations').'">
			    			</div>
			    		</div>
			    		<div class="nd_donations_section nd_donations_height_20"></div>
			    		<div id="nd_donations_single_cause_form_donation_message_container" class="nd_donations_section nd_donations_position_relative">
			    			<textarea onclick="nd_donations_single_cause_form_filter()" onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section" name="nd_donations_message" id="nd_donations_single_cause_form_donation_message" rows="5" placeholder="'.__('Message','nd-donations').'"></textarea>
			    		</div>
			    		<div class="nd_donations_section nd_donations_height_20"></div>
			    		<div class="nd_donations_section">
			    			<input id="nd_donations_single_cause_form_donation_submit" class="nd_donations_display_none" disabled="disabled" type="submit" value="'.__('DONATE NOW','nd-donations').'">
			    		</div>';
			    		//END personal informations


		    		}
		    		//END IF USER IS LOGGED


			    
		    	$nd_donations_result .= '	
	    		</form>


	    		<button id="nd_donations_single_cause_form_donation_checkout_submit" style="background-color:'.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_border_radius_30 nd_donations_display_inline_block nd_donations_box_sizing_border_box nd_donations_color_white_important nd_options_first_font nd_donations_padding_10_20 nd_donations_cursor_pointer nd_donations_outline_0 nd_donations_font_size_15 nd_donations_border_width_0" onclick="nd_donations_single_cause_form_validate_fields(1)">'.__('CHECKOUT','nd-donations').'</button>
	    		<div class="nd_donations_section nd_donations_height_40"></div>

	    		';




				$nd_donations_result .= '
	    		<!--START Tabs-->
				<div id="nd_donations_tab_payment_selection" class="nd_donations_tabs nd_donations_section nd_donations_position_relative ">

					<div style="z-index:0;" id="nd_donations_single_cause_form_filter" class="nd_donations_section nd_donations_position_absolute nd_donations_bg_white_alpha_85 nd_donations_cursor_not_allowed nd_donations_height_100_percentage"></div>

					<div id="nd_donations_single_cause_step_3" class="nd_donations_section">
					    
					    <div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_display_none_responsive nd_donations_height_30 nd_donations_width_30 nd_donations_text_align_center nd_donations_border_radius_100_percentage nd_donations_float_left">
					        <p class="nd_donations_line_height_30 nd_donations_color_white_important"><strong>3</strong></p>
					    </div>
					    
						
						<ul class="nd_donations_list_style_none nd_donations_margin_0 nd_donations_padding_0 nd_donations_padding_0_responsive nd_donations_float_left nd_donations_padding_left_20">
							<li class="nd_donations_display_inline_block nd_donations_margin_right_40">
								<h4>
									<a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_padding_top_5 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark nd_donations_text_transform_uppercase" href="#nd_donations_single_cause_tab_paypal">'.__('Paypal','nd-donations').'</a>
								</h4>
							</li>
							<li class="nd_donations_display_inline_block nd_donations_margin_right_40">
								<h4>
									<a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_padding_top_5 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark nd_donations_text_transform_uppercase" href="#nd_donations_single_cause_tab_offline_donation">'.__('Offline Donation','nd-donations').'</a>
								</h4>
							</li>
						</ul>

					</div>


					<div class="nd_donations_section nd_donations_height_30"></div>';



					//START offline donation content
					$nd_donations_result .= '
					<div class="nd_donations_section" id="nd_donations_single_cause_tab_offline_donation">
						
						<div class="nd_donations_section nd_donations_box_sizing_border_box">
                                        
						    <div class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_border_1_solid_grey">
						        <div class="nd_donations_display_table nd_donations_float_left">
						            <img alt="" class="nd_donations_margin_right_10 nd_donations_display_table_cell nd_donations_vertical_align_middle" width="15" src="'.esc_url(plugins_url('icon-alert-greydark.svg', __FILE__ )).'">
						            <h6 class="nd_donations_padding_top_0 nd_donations_display_table_cell nd_donations_vertical_align_middle nd_options_color_grey"><span class="nd_options_color_greydark"><strong>'.__('NOTE','nd-donations').' : </strong></span>'.__('YOUR DONATION WILL BE APPROVED BY THE ADMINISTRATOR ONCE THE TRANSFER WILL BE COMPLETED','nd-donations').'</h6>
						        </div>
						    </div>

						</div>

						<div class="nd_donations_section nd_donations_height_30"></div>

						<button style="background-color:'.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_border_radius_30 nd_donations_display_inline_block nd_donations_box_sizing_border_box nd_donations_color_white_important nd_options_first_font nd_donations_padding_10_20 nd_donations_cursor_pointer nd_donations_outline_0 nd_donations_font_size_15 nd_donations_border_width_0" onclick="nd_donations_single_cause_form_validate_fields(0)">'.__('DONATE NOW','nd-donations').'</button>
					
					</div>';
					//END offline donation content
					



					//START paypal donation content
					$nd_donations_result .= '
					<div class="nd_donations_section" id="nd_donations_single_cause_tab_paypal">
						

						<form target="paypal" action="'.$nd_donations_paypal_action_1.'" method="post" >
						      
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="business" value="'.$nd_donations_paypal_email.'">
							<input type="hidden" name="lc" value="">
							<input type="hidden" name="item_name" value="'.$nd_donations_title_cause.'">
							<input type="hidden" name="item_number" value="'.$nd_donations_id.'">
							<input id="nd_donations_single_cause_form_donation_message_paypal" type="hidden" name="custom" value="">
							<input id="nd_donations_single_cause_form_donation_value_paypal" type="hidden" name="amount" value="">
							<input type="hidden" name="currency_code" value="'.$nd_donations_paypal_currency.'">
							<input type="hidden" name="rm" value="2" />
							<input type="hidden" name="return" value="'.nd_donations_get_thankyou_page().'" />
							<input type="hidden" name="cancel_return" value="" />
							<input type="hidden" name="button_subtype" value="services">
							<input type="hidden" name="no_note" value="0">
							<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">

						
							<div class="nd_donations_section nd_donations_box_sizing_border_box">
	                                        
							    <div class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_border_1_solid_grey">
							        <div class="nd_donations_display_table nd_donations_float_left">
							            <img alt="" class="nd_donations_margin_right_10 nd_donations_display_table_cell nd_donations_vertical_align_middle" width="15" src="'.esc_url(plugins_url('icon-alert-greydark.svg', __FILE__ )).'">
							            <h6 class="nd_donations_padding_top_0 nd_donations_display_table_cell nd_donations_vertical_align_middle nd_options_color_grey"><span class="nd_options_color_greydark"><strong>'.__('NOTE','nd-donations').' : </strong></span>'.__('WAIT THE AUTOMATIC RETURN TO THE SITE TO COMPLETE THE TRANSACTION','nd-donations').'</h6>
							        </div>
							    </div>

							</div>

							<div class="nd_donations_section nd_donations_height_30"></div>

							<div class="nd_donations_section nd_donations_box_sizing_border_box">
								<input style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; background-image:url('.esc_url(plugins_url('icon-paypal-white.svg', __FILE__ )).'); background-size: 57px; padding-right: 83px !important; background-position: right 20px top -10px; background-repeat:no-repeat;" id="nd_donations_single_cause_form_donation_paypal_submit" class="nd_donations_background_repeat_no_repeat nd_donations_border_radius_30 nd_donations_box_sizing_border_box nd_donations_color_white_important nd_options_first_font nd_donations_padding_10_20_important nd_donations_cursor_pointer nd_donations_outline_0 nd_donations_font_size_15 nd_donations_border_width_0 " type="submit" disabled="disabled" value="'.__('DONATE WITH','nd-donations').'">
							</div>

						</form>

					</div>';
					//END paypal donation content





					$nd_donations_result .= '
				</div>
				<!--END tabs-->
					
		  
		
	
	    		<!--END FORM-->


				<div class="nd_donations_section nd_donations_height_50"></div>    		
	    		

	    	</div>';

	    }
	    //END check for show the donation form

	    

	    $nd_donations_result .= '</div><!--end column-->';



		echo $nd_donations_result; 


		//custom hook
		do_action("nd_donations_single_cause_after_text_content");

	      
	endwhile;
endif;


//close conteiner
if ( nd_donations_get_container() != 1) { echo '</div>'; }


//hook
do_action('nd_donations_single_cause_end_content');


//footer
get_footer( );


