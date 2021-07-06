<?php

wp_enqueue_script('jquery-ui-dialog');
wp_enqueue_script('jquery-effects-fade');
wp_enqueue_style( 'jquery-ui-dialog-css', esc_url(plugins_url('jquery-ui-dialog.css', __FILE__ )) );

//transaction TX id
$nd_donations_tx = rand(100000000,999999999);


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


//ajax results
$nd_donations_donation_form_l1_params = array(
    'nd_donations_ajaxurl_single_cause_form_validate_fields' => admin_url('admin-ajax.php'),
    'nd_donations_ajaxnonce_single_cause_form_validate_fields' => wp_create_nonce('nd_donations_form_validate_fields_nonce'),
);

wp_enqueue_script( 'nd_donations_single_cause_form_validate_fields', esc_url( plugins_url( 'nd_donations_single_cause_form_validate_fields.js', __FILE__ ) ), array( 'jquery' ) ); 
wp_localize_script( 'nd_donations_single_cause_form_validate_fields', 'nd_donations_my_vars_single_cause_form_validate_fields', $nd_donations_donation_form_l1_params ); 


$str .= '

  <div class="nd_donations_section '.$nd_donations_class.' ">

    <!--START FORM-->
    <form method="post" action="'.nd_donations_get_thankyou_page().'">

      <!--START hidden value-->
      <input name="nd_donations_single_cause_form" type="hidden" value="true">
      <input id="nd_donations_single_cause_form_donation_id" name="nd_donations_id" type="hidden" value="0">
      <input name="nd_donations_tx" type="hidden" value="'.$nd_donations_tx.'">
      <input id="nd_donations_single_cause_form_donation_value_offline" type="hidden" name="nd_donations_single_cause_form_donation_value_offline" value="">
      <!--END hidden value-->

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
        .nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected { background-color: '.$nd_donations_color.' !important; border:1px solid '.$nd_donations_color.' !important; }
        .nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected::-webkit-input-placeholder { color: #fff !important; }
        .nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected::-moz-placeholder { color: #fff !important; }
        .nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected:-ms-input-placeholder { color: #fff !important; }
        .nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected:-moz-placeholder { color: #fff !important; }
      </style>

      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' nd_donations_width_100_percentage_all_iphone ">
        <div id="nd_donations_single_cause_form_donation_value_container"  class="nd_donations_position_relative nd_donations_section">
          <input onclick="nd_donations_single_cause_form_filter()" onchange="nd_donations_single_cause_form_filter()" class="nd_donations_cursor_pointer nd_donations_section nd_donations_single_cause_form_donation_value nd_donations_single_cause_form_field" id="nd_donations_single_cause_form_donation_value" name="nd_donations_value" type="text" placeholder="'.__('Insert custom value','nd-donations').'">
        </div>
      </div>

      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' nd_donations_width_100_percentage_all_iphone ">
        <div id="nd_donations_single_cause_form_donation_name_container" class="nd_donations_position_relative nd_donations_section">
          <input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section nd_donations_single_cause_form_field" id="nd_donations_single_cause_form_donation_name" name="nd_donations_name" type="text" placeholder="'.__('Name','nd-donations').'">
        </div>
      </div>

      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' nd_donations_width_100_percentage_all_iphone ">
        <div id="nd_donations_single_cause_form_donation_surname_container"  class="nd_donations_position_relative nd_donations_section">
          <input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section nd_donations_single_cause_form_field" id="nd_donations_single_cause_form_donation_surname" name="nd_donations_surname" type="text" placeholder="'.__('Surname','nd-donations').'">
        </div>
      </div>

      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' nd_donations_width_100_percentage_all_iphone ">
        <div id="nd_donations_single_cause_form_donation_email_container"  class="nd_donations_position_relative nd_donations_section">
          <input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section nd_donations_single_cause_form_field" id="nd_donations_single_cause_form_donation_email" name="nd_donations_email" type="text" placeholder="'.__('Email','nd-donations').'">
        </div>
      </div>

      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' '.$nd_learning_hide_address.' nd_donations_width_100_percentage_all_iphone ">
        <div class="nd_donations_position_relative nd_donations_section">
          <input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section nd_donations_single_cause_form_field" name="nd_donations_address" type="text" placeholder="'.__('Address','nd-donations').'">
        </div>
      </div>

      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' '.$nd_learning_hide_city.' nd_donations_width_100_percentage_all_iphone ">
        <div class="nd_donations_position_relative nd_donations_section">
          <input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section nd_donations_single_cause_form_field" id="nd_donations_single_cause_form_donation_city" name="nd_donations_city" type="text" placeholder="'.__('City','nd-donations').'">
        </div>
      </div>

      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' '.$nd_learning_hide_country.' nd_donations_width_100_percentage_all_iphone ">
        <div class="nd_donations_position_relative nd_donations_section">
          <input onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section nd_donations_single_cause_form_field" name="nd_donations_country" type="text" placeholder="'.__('Country','nd-donations').'">
        </div>
      </div>

      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' '.$nd_learning_hide_message.' nd_donations_width_100_percentage_all_iphone ">
        <div id="nd_donations_single_cause_form_donation_message_container" class="nd_donations_position_relative nd_donations_section">
          <textarea onclick="nd_donations_single_cause_form_filter()" onchange="nd_donations_single_cause_form_filter()" class="nd_donations_section nd_donations_single_cause_form_field" name="nd_donations_message" id="nd_donations_single_cause_form_donation_message" rows="5" placeholder="'.__('Message','nd-donations').'"></textarea>
        </div>
      </div>


     <input id="nd_donations_single_cause_form_donation_submit" class="nd_donations_display_none" disabled="disabled" type="submit" value="'.__('DONATE NOW','nd-donations').'">


      <div class="nd_donations_section nd_donations_padding_10 nd_donations_box_sizing_border_box '.$nd_donations_width.' nd_donations_width_100_percentage_all_iphone ">
        <div class="nd_donations_position_relative nd_donations_section">
          <a id="nd_donations_single_cause_form_donation_checkout_submit" style="background-color:'.$nd_donations_color.';" class=" '.$nd_learning_btn_full_width.' nd_donations_border_radius_30 nd_donations_display_inline_block nd_donations_box_sizing_border_box nd_donations_color_white_important nd_options_first_font nd_donations_padding_20 nd_donations_cursor_pointer nd_donations_outline_0 nd_donations_font_size_15 nd_donations_border_width_0" onclick="nd_donations_single_cause_form_validate_fields(2)">'.__('CHECKOUT','nd-donations').'</a> 
        </div>
      </div>

    </form>
    <!--END FORM-->

  </div>








  <!--START POPOUP-->
  <div style="overflow:visible;" id="nd_donations_dialog_donation_form">

    <div class="nd_donations_bg_white nd_donations_border_radius_3 nd_donations_position_relative nd_donations_section nd_donations_box_sizing_border_box">

      <a style="background-image:url('.esc_url(plugins_url('icon-close-2-white.svg', __FILE__ )).'); width:40px; height:40px; background-size:15px; right:-20px; top:-20px; border-radius:100%;" id="nd_donations_dialog_donation_form_close" class="nd_donations_bg_greydark nd_donations_position_absolute nd_donations_background_position_center nd_donations_background_size_25 nd_donations_background_repeat_no_repeat nd_donations_cursor_pointer nd_donations_display_inline_block"></a>

      <div class="nd_donations_section nd_donations_box_sizing_border_box nd_donations_padding_30">
        
          <div class="nd_donations_border_right_1_solid_grey nd_donations_border_0_all_iphone nd_donations_width_50_percentage nd_donations_width_100_percentage_all_iphone nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_float_left nd_donations_text_align_center">
            
            <img alt="" class="" width="50" src="'.esc_url(plugins_url('icon-offline-grey.svg', __FILE__ )).'">
            <div class="nd_donations_section nd_donations_height_10"></div>
            <h3>'.__('OFFLINE PAYMENT','nd-donations').'</h3>
            <div class="nd_donations_section nd_donations_height_30"></div>
            <button style="background-color:'.$nd_donations_color.';" class="nd_donations_border_radius_30 nd_donations_display_inline_block nd_donations_box_sizing_border_box nd_donations_color_white_important nd_options_first_font nd_donations_padding_10_20 nd_donations_cursor_pointer nd_donations_outline_0 nd_donations_font_size_15 nd_donations_border_width_0" onclick="nd_donations_single_cause_form_validate_fields(0)">'.__('DONATE NOW','nd-donations').'</button>
          
          </div>


          <div class="nd_donations_width_50_percentage nd_donations_width_100_percentage_all_iphone nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_float_left nd_donations_text_align_center">
            


            <img alt="" class="" width="50" src="'.esc_url(plugins_url('icon-paypal-grey.svg', __FILE__ )).'">
            <form target="paypal" action="'.$nd_donations_paypal_action_1.'" method="post" >
                  
              <input type="hidden" name="cmd" value="_xclick">
              <input type="hidden" name="business" value="'.$nd_donations_paypal_email.'">
              <input type="hidden" name="lc" value="">
              <input type="hidden" name="item_name" value="'.get_bloginfo( 'name' ).'">
              <input type="hidden" name="item_number" value="0">
              <input id="nd_donations_single_cause_form_donation_message_paypal" type="hidden" name="custom" value="">
              <input id="nd_donations_single_cause_form_donation_value_paypal" type="hidden" name="amount" value="">
              <input type="hidden" name="currency_code" value="'.$nd_donations_paypal_currency.'">
              <input type="hidden" name="rm" value="2" />
              <input type="hidden" name="return" value="'.nd_donations_get_thankyou_page().'" />
              <input type="hidden" name="cancel_return" value="" />
              <input type="hidden" name="button_subtype" value="services">
              <input type="hidden" name="no_note" value="0">
              <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">

              <div class="nd_donations_section nd_donations_height_10"></div>
              <h3>'.__('PAYPAL PAYMENT','nd-donations').'</h3>
              <div class="nd_donations_section nd_donations_height_30"></div>

              <div class="nd_donations_section nd_donations_box_sizing_border_box">
                <input style="background-color:'.$nd_donations_color.'; background-image:url('.esc_url(plugins_url('icon-paypal-white.svg', __FILE__ )).'); background-size: 57px; padding-right: 83px !important; background-position: right 20px top -10px; background-repeat:no-repeat;" id="nd_donations_single_cause_form_donation_paypal_submit" class="nd_donations_background_repeat_no_repeat nd_donations_border_radius_30 nd_donations_box_sizing_border_box nd_donations_color_white_important nd_options_first_font nd_donations_padding_10_20_important nd_donations_cursor_pointer nd_donations_outline_0 nd_donations_font_size_15 nd_donations_border_width_0 " type="submit" disabled="disabled" value="'.__('DONATE WITH','nd-donations').'">
              </div>

            </form>



          </div>


      </div>

    </div>

  </div>
  <!--END POPOUP-->



  <script type="text/javascript">
    //<![CDATA[
    
    jQuery(document).ready(function() {

      jQuery( "#nd_donations_dialog_donation_form" ).dialog({
        autoOpen: false,
        draggable: false,
        width: 800,
        modal: false,
        resizable: false,
        dialogClass: "nd_donations_dialog",
        show: {
          effect: "fade",
          duration: 800
        },
        hide: {
          effect: "fade",
          duration: 800
        }
      });
   
      jQuery( "#nd_donations_dialog_donation_form_close" ).click(function() {
        jQuery( "#nd_donations_dialog_donation_form" ).dialog( "close" );
      });

    });

    //]]>
  </script>




  <style>
    .nd_donations_dialog_filter_bg:after{
      width: 100% !important;
      height: 100% !important;
      background-color: rgba(101, 100, 96, 0.9);
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      z-index:99;
    }


    @media only screen and (min-width: 768px) and (max-width: 959px) {
      .nd_donations_dialog_filter_bg { width: 100% !important; }
      #nd_donations_dialog_donation_form { width:758px !important; margin-left: -379px; left: 50%; }  
    }

    @media only screen and (min-width: 480px) and (max-width: 767px) {
      .nd_donations_dialog_filter_bg { width: 100% !important; }
      #nd_donations_dialog_donation_form { width:470px !important; margin-left: -235px; left: 50%; }    
    }

    @media only screen and (min-width: 320px) and (max-width: 479px){
      .nd_donations_dialog_filter_bg { width: 100% !important; }
      #nd_donations_dialog_donation_form { width:310px !important; margin-left: -155px; left: 50%; }   
    }

  </style>



';








