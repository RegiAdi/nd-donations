<?php


//START  nd_donations_thankyou
function nd_donations_shortcode_thankyou() {

  $nd_donations_shortcode_thankyou_result = '';

  //START arrive from OFFLINE DONATION
  if ( isset( $_POST['nd_donations_single_cause_form'] ) ){


    //START check if user is logged
    if ( is_user_logged_in() == 1 ) {
      $nd_donations_current_user = wp_get_current_user();
      $nd_donations_current_user_id = $nd_donations_current_user->ID;
    }else{
      $nd_donations_current_user_id = 'guest-user'; 
    }
    //END check if user is logged


    //recover datas
    $nd_donations_single_cause_form = sanitize_text_field($_POST['nd_donations_single_cause_form']);
    $nd_donations_id = sanitize_text_field($_POST['nd_donations_id']);
    $nd_donations_tx = sanitize_text_field($_POST['nd_donations_tx']);
    $nd_donations_value = sanitize_text_field($_POST['nd_donations_single_cause_form_donation_value_offline']);
    $nd_donations_name = sanitize_text_field($_POST['nd_donations_name']);
    $nd_donations_surname = sanitize_text_field($_POST['nd_donations_surname']);
    $nd_donations_address = sanitize_text_field($_POST['nd_donations_address']);
    $nd_donations_country = sanitize_text_field($_POST['nd_donations_country']);
    $nd_donations_email = sanitize_email($_POST['nd_donations_email']);
    $nd_donations_city = sanitize_text_field($_POST['nd_donations_city']);
    $nd_donations_message = sanitize_text_field($_POST['nd_donations_message']);

    //title cause
    if ( $nd_donations_id == 0 ) {
      $nd_donations_title_cause = get_bloginfo('name');
    }else{
      $nd_donations_title_cause = get_the_title($_POST['nd_donations_id']); 
    }


    //image cause
    if ( $nd_donations_id == 0 ) {
      $nd_donations_customizer_archive_causes_header_image = get_option( 'nd_donations_customizer_archive_causes_header_image' );
      if ( $nd_donations_customizer_archive_causes_header_image == '' ) { 
          $nd_donations_img_cause = ''; 
      }else{
          $nd_donations_img_cause = wp_get_attachment_url($nd_donations_customizer_archive_causes_header_image);
      }
    }else{
      $nd_donations_img_cause = nd_donations_get_cause_img_src($_POST['nd_donations_id']);
    }


    //get current date
    $nd_donations_date = date('H:m:s F j Y');


    $nd_donations_shortcode_thankyou_result = '';

    $nd_donations_shortcode_thankyou_result .= '




      <!--START FIRST COLUMN-->
      <div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">

        <h4>'.__('THANKS FOR YOUR DONATION','nd-donations').' :</h4>
        <div class="nd_donations_section nd_donations_height_30"></div>

        <!--start table-->
        <table>
          <tbody> 
            <tr class="nd_donations_border_bottom_1_solid_grey nd_donations_border_top_1_solid_grey">
              <td class="nd_donations_padding_20_10 nd_donations_width_20_percentage">  
                  <img alt="" class="nd_donations_section" src="'.$nd_donations_img_cause.'"> 
              </td>
              <td class="nd_donations_padding_20_10 nd_donations_width_50_percentage">  
                  <h5 class="nd_donations_text_transform_uppercase">'.$nd_donations_title_cause.'</h5> 
                  <div class="nd_donations_section nd_donations_height_5"></div>
                  <p>'.__('ID','nd-donations').' : '.$nd_donations_tx.'</p> 
              </td>
              <td class="nd_donations_padding_20_10 nd_donations_width_20_percentage">
                  <p class="nd_options_color_greydark">'.nd_donations_get_currency().' '.$nd_donations_value.'</p>    
              </td>
              <td class="nd_donations_padding_20_10 nd_donations_width_10_percentage nd_donations_text_align_right">
                <a class="nd_donations_bg_red nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8  nd_donations_font_size_13 nd_donations_text_transform_uppercase">'.__('PENDING','nd-donations').'</a>
              </td>
            </tr>
          </tbody>
        </table>
        <!--end table-->


        <div class="nd_donations_section nd_donations_height_40"></div>
          

        '.do_shortcode(nd_donations_thankyou_page_info()).'


        <div class="nd_donations_section nd_donations_height_40"></div>


        <div class="nd_donations_section nd_donations_box_sizing_border_box">
                                        
            <div class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_border_1_solid_grey">
                <div class="nd_donations_display_table nd_donations_float_left">
                    <img alt="" class="nd_donations_margin_right_10 nd_donations_display_table_cell nd_donations_vertical_align_middle" width="20" src="'.esc_url(plugins_url('icon-alert-greydark.svg', __FILE__ )).'">
                    <h6 class="nd_donations_line_height_25 nd_donations_display_table_cell nd_donations_vertical_align_middle nd_options_color_grey"><span class="nd_options_color_greydark"><strong>'.__('NOTE','nd-donations').' : </strong></span>'.__('YOUR DONATION WILL BE APPROVED BY THE ADMINISTRATOR ONCE THE TRANSFER WILL BE COMPLETED','nd-donations').'</h6>
                </div>
            </div>

        </div>

      </div>
      <!--END FIRST COLUMN-->

      

      <!--START SECOND COLUMN-->
      <div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">
      

        <h4>'.__('SUMMERY OF YOUR DATAS','nd-donations').' :</h4>
        <div class="nd_donations_section nd_donations_height_30"></div>


        <div class="nd_donations_section nd_donations_bg_grey nd_donations_border_1_solid_grey nd_donations_padding_20 nd_donations_box_sizing_border_box  nd_donations_overflow_hidden nd_donations_overflow_x_auto nd_donations_cursor_move_responsive">


          <table class="nd_donations_section">
              <tbody>
              <tr class="nd_donations_border_top_2_solid_grey nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10 nd_donations_width_40_percentage">
                      <p>'.__('Name','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 nd_donations_width_60_percentage">  
                      <p class="nd_options_color_grey">'.$nd_donations_name.'</p> 
                  </td>
              </tr>
              <tr class="nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10">
                      <p>'.__('Surname','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_surname.'</p> 
                  </td>
              </tr>
              <tr class="nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10">
                      <p>'.__('Email','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_email.'</p> 
                  </td>
              </tr>
              <tr class="nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10">
                      <p>'.__('Address','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_address.'</p> 
                  </td>
              </tr>
              <tr class="nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10">
                      <p>'.__('City','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_city.'</p> 
                  </td>
              </tr>
              <tr class="">
                  <td class="nd_donations_padding_10">
                      <p>'.__('Country','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_country.'</p> 
                  </td>
              </tr>
              </tbody>
          </table>


          <div class="nd_donations_section">
            <div class="nd_donations_width_100_percentage nd_donations_padding_10 nd_donations_box_sizing_border_box nd_donations_float_left">
              <a class=" nd_donations_thankyou_back_to_causes_btn nd_donations_display_inline_block nd_donations_text_align_center nd_donations_box_sizing_border_box nd_donations_width_100_percentage nd_donations_color_white_important nd_donations_bg_green nd_options_first_font nd_donations_padding_10_20 nd_donations_border_radius_30 " href="'.get_post_type_archive_link('causes').'">'.__('BACK TO CAUSES','nd-donations').'</a>   
            </div>
          </div> 

        </div>
      </div>
      <!--END SECOND COLUMN-->';



    //START add order in db
    if ( nd_donations_check_if_donation_is_present($nd_donations_tx) == 0 ) {
    
      nd_donations_add_donation_in_db(
        $nd_donations_id,
        $nd_donations_title_cause,
        $nd_donations_value,
        $nd_donations_date,
        1,
        'Pending',
        0,
        $nd_donations_email,
        $nd_donations_tx,
        $nd_donations_current_user_id,
        $nd_donations_country,
        $nd_donations_address,
        $nd_donations_name,
        $nd_donations_surname,
        $nd_donations_city,
        $nd_donations_message,
        'offline-donation'
      ); 
      
    }
    //END add order in db


  }elseif ( isset($_GET['tx']) ){


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

    //START process after paypla payment
    $nd_donations_tx = sanitize_text_field($_GET['tx']);

    // Init cURL
    $nd_donations_request = curl_init();

    // Set request options
    curl_setopt_array($nd_donations_request, array
    (
      CURLOPT_URL => $nd_donations_paypal_action_2,
      CURLOPT_POST => TRUE,
      CURLOPT_POSTFIELDS => http_build_query(array
        (
          'cmd' => '_notify-synch',
          'tx' => $nd_donations_tx,
          'at' => $nd_donations_paypal_token,
        )),
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_HEADER => FALSE,
    ));

    // Execute request and get response and status code
    $nd_donations_response = curl_exec($nd_donations_request);
    $nd_donations_status   = curl_getinfo($nd_donations_request, CURLINFO_HTTP_CODE);

    // Close connection
    curl_close($nd_donations_request);


    //START IF 4
    if($nd_donations_status == 200 AND strpos($nd_donations_response, 'SUCCESS') === 0){

      
      // Remove SUCCESS part (7 characters long)
      $nd_donations_response = substr($nd_donations_response, 7);

      // URL decode
      $nd_donations_response = urldecode($nd_donations_response);

      // Turn into associative array
      preg_match_all('/^([^=\s]++)=(.*+)/m', $nd_donations_response, $m, PREG_PATTERN_ORDER);
      $nd_donations_response = array_combine($m[1], $m[2]);

      // Fix character encoding if different from UTF-8 (in my case)
      if(isset($nd_donations_response['charset']) AND strtoupper($nd_donations_response['charset']) !== 'UTF-8')
      {
        foreach($nd_donations_response as $key => &$value)
        {
          $value = mb_convert_encoding($value, 'UTF-8', $nd_donations_response['charset']);
        }
        $nd_donations_response['charset_original'] = $nd_donations_response['charset'];
        $nd_donations_response['charset'] = 'UTF-8';
      }

      // Sort on keys for readability (handy when debugging)
      ksort($nd_donations_response);

      //title cause
      if ( $nd_donations_response['item_number'] == 0 ) {
        $nd_donations_title_cause = get_bloginfo('name');
      }else{
        $nd_donations_title_cause = get_the_title($nd_donations_response['item_number']);
      }

      //image cause
      if ( $nd_donations_response['item_number'] == 0 ) {
        $nd_donations_customizer_archive_causes_header_image = get_option( 'nd_donations_customizer_archive_causes_header_image' );
        if ( $nd_donations_customizer_archive_causes_header_image == '' ) { 
            $nd_donations_img_cause = ''; 
        }else{
            $nd_donations_img_cause = wp_get_attachment_url($nd_donations_customizer_archive_causes_header_image);
        }
      }else{
        $nd_donations_img_cause = nd_donations_get_cause_img_src($nd_donations_response['item_number']);
      }



      $nd_donations_response_result = '';
      $nd_donations_response_result .= '



        <!--START FIRST COLUMN-->
        <div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">

          <h4>'.__('THANKS FOR YOUR DONATION','nd-donations').' :</h4>
          <div class="nd_donations_section nd_donations_height_30"></div>

          <!--start table-->
          <table>
            <tbody> 
              <tr class="nd_donations_border_bottom_1_solid_grey nd_donations_border_top_1_solid_grey">
                <td class="nd_donations_padding_20_10 nd_donations_width_20_percentage">  
                    <img alt="" class="nd_donations_section" src="'.$nd_donations_img_cause.'"> 
                </td>
                <td class="nd_donations_padding_20_10 nd_donations_width_50_percentage">  
                    <h5 class="nd_donations_text_transform_uppercase">'.$nd_donations_title_cause.'</h5> 
                    <div class="nd_donations_section nd_donations_height_5"></div>
                    <p>'.__('ID','nd-donations').' : '.$nd_donations_response['txn_id'].'</p> 
                </td>
                <td class="nd_donations_padding_20_10 nd_donations_width_20_percentage">
                    <p class="nd_options_color_greydark">'.$nd_donations_response['mc_gross'].' '.$nd_donations_response['mc_currency'].'</p>    
                </td>
                <td class="nd_donations_padding_20_10 nd_donations_width_10_percentage nd_donations_text_align_right">
                  <a class="nd_donations_bg_greydark nd_donations_display_inline_block nd_donations_color_white_important nd_options_first_font nd_donations_padding_8  nd_donations_font_size_13 nd_donations_text_transform_uppercase">'.$nd_donations_response['payment_status'].'</a>
                </td>
              </tr>
            </tbody>
          </table>
          <!--end table-->


        </div>
        <!--END FIRST COLUMN-->

        

        <!--START SECOND COLUMN-->
        <div class="nd_donations_width_50_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_15 nd_donations_width_100_percentage_responsive">
        
          <h4>'.__('SUMMERY OF YOUR DATAS','nd-donations').' :</h4>
          <div class="nd_donations_section nd_donations_height_30"></div>

          <div class="nd_donations_section nd_donations_bg_grey nd_donations_border_1_solid_grey nd_donations_padding_20 nd_donations_box_sizing_border_box  nd_donations_overflow_hidden nd_donations_overflow_x_auto nd_donations_cursor_move_responsive">


            <table class="nd_donations_section">
              <tbody>
              <tr class="nd_donations_border_top_2_solid_grey nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10 nd_donations_width_40_percentage">
                      <p>'.__('Name','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 nd_donations_width_60_percentage">  
                      <p class="nd_options_color_grey">'.$nd_donations_response['first_name'].'</p> 
                  </td>
              </tr>
              <tr class="nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10">
                      <p>'.__('Surname','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_response['last_name'].'</p> 
                  </td>
              </tr>
              <tr class="nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10">
                      <p>'.__('Email','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_response['payer_email'].'</p> 
                  </td>
              </tr>
              <tr class="nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10">
                      <p>'.__('Address','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_response['address_street'].' '.$nd_donations_response['address_zip'].'</p> 
                  </td>
              </tr>
              <tr class="nd_donations_border_bottom_1_solid_grey">
                  <td class="nd_donations_padding_10">
                      <p>'.__('City','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_response['address_city'].'</p> 
                  </td>
              </tr>
              <tr class="">
                  <td class="nd_donations_padding_10">
                      <p>'.__('Country','nd-donations').'</p>   
                  </td>
                  <td class="nd_donations_padding_10 ">  
                      <p class="nd_options_color_grey">'.$nd_donations_response['address_country'].'</p> 
                  </td>
              </tr>
              </tbody>
          </table>                    
            




            <div class="nd_donations_section">
              <div class="nd_donations_width_100_percentage nd_donations_padding_10 nd_donations_box_sizing_border_box nd_donations_float_left">
                <a class="nd_donations_display_inline_block nd_donations_text_align_center nd_donations_box_sizing_border_box nd_donations_width_100_percentage nd_donations_color_white_important nd_donations_bg_green nd_options_first_font nd_donations_padding_10_20 nd_donations_border_radius_30 " href="'.get_post_type_archive_link('causes').'">'.__('BACK TO CAUSES','nd-donations').'</a>   
              </div>
            </div> 

          </div>
        </div>
        <!--END SECOND COLUMN-->

      ';


      echo $nd_donations_response_result;

      //START add order in db
      if ( nd_donations_check_if_donation_is_present($nd_donations_response['txn_id']) == 0 ) {

        //START check if user is logged
        if ( is_user_logged_in() == 1 ) {
          $nd_donations_current_user = wp_get_current_user();
          $nd_donations_current_user_id = $nd_donations_current_user->ID;
        }else{
          $nd_donations_current_user_id = 0;  
        }
        //END check if user is logged

        nd_donations_add_donation_in_db(

          $nd_donations_response['item_number'],
          $nd_donations_title_cause,
          $nd_donations_response['mc_gross'],
          $nd_donations_response['payment_date'],
          $nd_donations_response['quantity'],
          $nd_donations_response['payment_status'],
          $nd_donations_response['mc_currency'],
          $nd_donations_response['payer_email'],
          $nd_donations_response['txn_id'],
          $nd_donations_current_user_id,
          $nd_donations_response['address_country'],
          $nd_donations_response['address_street'].' '.$nd_donations_response['address_zip'],
          $nd_donations_response['first_name'],
          $nd_donations_response['last_name'],
          $nd_donations_response['address_city'],
          $nd_donations_response['custom'],
          'paypal'

        );
      }
      //END add order in db

      

    }
    //END IF 4
    else{
      echo '


      <div class="nd_donations_section nd_donations_box_sizing_border_box">
                                          
          <div class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_border_1_solid_grey">
              <div class="nd_donations_display_table nd_donations_float_left">
                  <img alt="" class="nd_donations_margin_right_10 nd_donations_display_table_cell nd_donations_vertical_align_middle" width="15" src="'.esc_url(plugins_url('icon-alert-greydark.svg', __FILE__ )).'">
                  <h6 class="nd_donations_display_table_cell nd_donations_vertical_align_middle nd_options_color_grey"><span class="nd_options_color_greydark"><strong>'.__('NOTE','nd-donations').' : </strong></span>'.__('AN ERROR HAS OCCURED, CONTACT THE ADMINISTRATOR','nd-donations').'</h6>
              </div>
          </div>

      </div>
      <div class="nd_donations_section nd_options_height_20"></div>
      <a class="nd_donations_bg_green nd_donations_font_size_15 nd_options_first_font nd_donations_display_inline_block nd_donations_color_white_important nd_donations_text_decoration_none nd_donations_padding_10_20 nd_donations_border_radius_30" href="'.get_post_type_archive_link('causes').'">'.__('BACK TO ALL CAUSES','nd-donations').'</a>

    ';   
    }
    //END  



  }else{

    $nd_donations_shortcode_thankyou_result .= '


      <div class="nd_donations_section nd_donations_box_sizing_border_box">
                                          
          <div class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_border_1_solid_grey">
              <div class="nd_donations_display_table nd_donations_float_left">
                  <img alt="" class="nd_donations_margin_right_10 nd_donations_display_table_cell nd_donations_vertical_align_middle" width="15" src="'.esc_url(plugins_url('icon-alert-greydark.svg', __FILE__ )).'">
                  <h6 class="nd_donations_display_table_cell nd_donations_vertical_align_middle nd_options_color_grey"><span class="nd_options_color_greydark"><strong>'.__('NOTE','nd-donations').' : </strong></span>'.__('BACK TO ALL CAUSES FOR A PROPER DONATION','nd-donations').'</h6>
              </div>
          </div>

      </div>
      <div class="nd_donations_section nd_options_height_20"></div>
      <a class="nd_donations_bg_green nd_donations_font_size_15 nd_options_first_font nd_donations_display_inline_block nd_donations_color_white_important nd_donations_text_decoration_none nd_donations_padding_10_20 nd_donations_border_radius_30" href="'.get_post_type_archive_link('causes').'">'.__('BACK TO ALL CAUSES','nd-donations').'</a>

    ';

  }
  //END arrive from single cause form

  

  echo $nd_donations_shortcode_thankyou_result;
    
}
//END


add_shortcode('nd_donations_thankyou', 'nd_donations_shortcode_thankyou');
//END nd_donations_thankyou