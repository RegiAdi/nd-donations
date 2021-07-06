<?php

/* **************************************** START CAUSE INFORMATION **************************************** */
function nd_donations_get_cause_price($nd_donations_cause_id){

	$nd_donations_cause_price = get_post_meta( $nd_donations_cause_id, 'nd_donations_meta_box_price', true );
  if ( $nd_donations_cause_price == '' ) { $nd_donations_cause_price = 0; } 

	return $nd_donations_cause_price;

}

function nd_donations_get_cause_color($nd_donations_cause_id){

	$nd_donations_cause_color = get_post_meta( $nd_donations_cause_id, 'nd_donations_meta_box_color', true );
	if ( $nd_donations_cause_color == '' ) { $nd_donations_cause_color = '#000'; } 

	return $nd_donations_cause_color;

}

function nd_donations_get_cause_img_src($nd_donations_cause_id){

	$nd_donations_image_id = get_post_thumbnail_id($nd_donations_cause_id);
	$nd_donations_image_attributes = wp_get_attachment_image_src( $nd_donations_image_id, 'large' );
	$nd_donations_cause_img_src = $nd_donations_image_attributes[0];

	return $nd_donations_cause_img_src;

}


function nd_donations_get_cause_sidebar($nd_donations_cause_id){

  $nd_donations_cause_sidebar = get_post_meta( $nd_donations_cause_id, 'nd_donations_meta_box_cause_sidebar_position', true );

  return $nd_donations_cause_sidebar;

}


function nd_donations_get_total_donations_value($nd_donations_cause_id){

  global $wpdb;

  $nd_donations_get_total_donations_value = 0;
  
  $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';
  $nd_donations_paypal_payment_status = "'completed'";
 
  //START select for items
  $nd_donations_donations = $wpdb->get_results( "SELECT donation_value FROM $nd_donations_table_name WHERE id_cause = $nd_donations_cause_id AND paypal_payment_status = $nd_donations_paypal_payment_status");

  
  //START if no results
  if ( empty($nd_donations_donations) ) { 

    return $nd_donations_get_total_donations_value;

  }else{

    
    //START cicle    
    foreach ( $nd_donations_donations as $nd_donations_donation ) 
    {
      $nd_donations_get_total_donations_value = $nd_donations_get_total_donations_value + $nd_donations_donation->donation_value;
    }
    //END cicle 

    return $nd_donations_get_total_donations_value;

  }
  //START if no results

}


function nd_donations_get_total_missing_money_to_goal($nd_donations_cause_id){


  if ( $nd_donations_cause_id == 0 ) {
    
    return 100000;
  
  }else{

    $nd_donations_get_total_missing_money_to_goal = nd_donations_get_cause_price($nd_donations_cause_id) - nd_donations_get_total_donations_value($nd_donations_cause_id);

    if ( $nd_donations_get_total_missing_money_to_goal < 0 ) {
      $nd_donations_get_total_missing_money_to_goal = 0;
    }else{
      $nd_donations_get_total_missing_money_to_goal = nd_donations_get_cause_price($nd_donations_cause_id) - nd_donations_get_total_donations_value($nd_donations_cause_id);
    }

  }

  return $nd_donations_get_total_missing_money_to_goal;

}


function nd_donations_get_total_donations_percentage($nd_donations_cause_id){

  $nd_donations_get_total_donations_percentage = nd_donations_get_total_donations_value($nd_donations_cause_id)*100/nd_donations_get_cause_price($nd_donations_cause_id);

  if ( $nd_donations_get_total_donations_percentage > 100 ){
    $nd_donations_get_total_donations_percentage = 100;
  }else{
    $nd_donations_get_total_donations_percentage = nd_donations_get_total_donations_value($nd_donations_cause_id)*100/nd_donations_get_cause_price($nd_donations_cause_id);
  }

  return intval($nd_donations_get_total_donations_percentage);

}


function nd_donations_get_total_missing_money_to_goal_percentage($nd_donations_cause_id){

  $nd_donations_get_total_missing_money_to_goal_percentage = 100 - nd_donations_get_total_donations_percentage($nd_donations_cause_id);

  return intval($nd_donations_get_total_missing_money_to_goal_percentage);

}



function nd_donations_get_qnt_donations($nd_donations_cause_id){

  global $wpdb;

  $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';
  $nd_donations_paypal_payment_status = "'completed'";

  //START select for items
  $nd_donations_donations = $wpdb->get_results( "SELECT qnt FROM $nd_donations_table_name WHERE id_cause = $nd_donations_cause_id AND paypal_payment_status = $nd_donations_paypal_payment_status");

  //no results
  if ( empty($nd_donations_donations) ) { 

    return 0;
    
  }else{

    $nd_donations_result = 0;

    foreach ( $nd_donations_donations as $nd_donations_donation ) 
    {
      $nd_donations_result = $nd_donations_donation->qnt + $nd_donations_result;
    }

    return $nd_donations_result;

  }
  //END select for items 

}

/* **************************************** END CAUSE INFORMATION **************************************** */







/* **************************************** START SETTINGS **************************************** */

function nd_donations_get_thankyou_page() {

  $nd_donations_thankyou_page = get_option('nd_donations_thankyou_page');
  $nd_donations_thankyou_page_url = get_permalink($nd_donations_thankyou_page);

  return $nd_donations_thankyou_page_url;

}

function nd_donations_thankyou_page_info() {

  $nd_donations_thankyou_page_info = get_option('nd_donations_thankyou_page_info');

  return $nd_donations_thankyou_page_info;

}

function nd_donations_get_account_page() {

  $nd_donations_account_page = get_option('nd_donations_account_page');
  $nd_donations_account_page_url = get_permalink($nd_donations_account_page);

  return $nd_donations_account_page_url;

}

function nd_donations_get_currency(){

	$nd_donations_currency = get_option('nd_donations_currency');

	return $nd_donations_currency;

}


function nd_donations_get_container(){

  $nd_donations_container = get_option('nd_donations_container');

  return $nd_donations_container;

}

/* **************************************** END SETTINGS **************************************** */








/* **************************************** START WORDPRESS INFORMATION **************************************** */

//function for get color profile admin
function nd_donations_get_profile_bg_color($nd_donations_color){
	
	global $_wp_admin_css_colors;
	$nd_donations_admin_color = get_user_option( 'admin_color' );
	
	$nd_donations_profile_bg_colors = $_wp_admin_css_colors[$nd_donations_admin_color]->colors; 


	if ( $nd_donations_profile_bg_colors[$nd_donations_color] == '#e5e5e5' ) {

		return '#6b6b6b';

	}else{

		return $nd_donations_profile_bg_colors[$nd_donations_color];
		
	}

	
}

/* **************************************** END WORDPRESS INFORMATION **************************************** */





/* **************************************** START DATABASE **************************************** */

//function for add order in db
function nd_donations_add_donation_in_db(
  
  $nd_donations_id_cause,
  $nd_donations_title_cause,
  $nd_donations_donation_value,
  $nd_donations_date,
  $nd_donations_qnt,
  $nd_donations_paypal_payment_status,
  $nd_donations_paypal_currency,
  $nd_donations_paypal_email,
  $nd_donations_paypal_tx,
  $nd_donations_id_user,
  $nd_donations_user_country,
  $nd_donations_user_address,
  $nd_donations_user_first_name,
  $nd_donations_user_last_name,
  $nd_donations_user_city,
  $nd_donations_user_message,
  $nd_donations_action_type

) {


  //START add order if the plugin is not in dev mode
  if ( get_option('nd_donations_plugin_dev_mode') == 1 ){

    //dev mode active not insert in db

  }else{

      global $wpdb;
      $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';


      //START INSERT DB
      $nd_donations_add_donation = $wpdb->insert( 
        
        $nd_donations_table_name, 
        
        array( 
          'id_cause' => $nd_donations_id_cause,
          'title_cause' => $nd_donations_title_cause,
          'donation_value' => $nd_donations_donation_value,
          'date' => $nd_donations_date,
          'qnt' => $nd_donations_qnt,
          'paypal_payment_status' => $nd_donations_paypal_payment_status,
          'paypal_currency' => $nd_donations_paypal_currency,
          'paypal_email' => $nd_donations_paypal_email,
          'paypal_tx' => $nd_donations_paypal_tx,
          'id_user' => $nd_donations_id_user,
          'user_country' => $nd_donations_user_country,
          'user_address' => $nd_donations_user_address,
          'user_first_name' => $nd_donations_user_first_name,
          'user_last_name' => $nd_donations_user_last_name,
          'user_city' => $nd_donations_user_city,
          'user_message' => $nd_donations_user_message,
          'action_type' => $nd_donations_action_type
        )

      );
      
      if ($nd_donations_add_donation){

        //order added in db

        //hook
        do_action('nd_donations_donation_added_in_db',$nd_donations_title_cause,$nd_donations_donation_value,$nd_donations_paypal_payment_status,$nd_donations_user_first_name,$nd_donations_user_last_name,$nd_donations_paypal_email,$nd_donations_user_address,$nd_donations_user_city,$nd_donations_user_country,$nd_donations_date,$nd_donations_paypal_tx,$nd_donations_user_message);

      }else{

        $wpdb->show_errors();
        $wpdb->print_error();

      }
      //END INSERT DB
      
            
      //close the function to avoid wordpress errors
      //die();

  }
  //END add order if the plugin is not in dev mode

  

}



//function for check if the donation is already present in db
function nd_donations_check_if_donation_is_present($nd_donations_tx){

  global $wpdb;

  $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';

  $nd_donations_donations_ids = $wpdb->get_results( "SELECT id FROM $nd_donations_table_name WHERE paypal_tx = '$nd_donations_tx'" );

  //no results
  if ( empty($nd_donations_donations_ids) ) { 

  return 0;

  }else{

  return 1;

  }

}
/* **************************************** END DATABASE **************************************** */







/* **************************************** START AJAX **************************************** */

//validate if a number is numeric
function nd_donations_is_numeric($nd_donations_number){

  if ( is_numeric($nd_donations_number) ) {
    return 1;
  }else{
    return 0;
  }

}


//validate if email is valid
function nd_donations_is_email($nd_donations_email){

  if (filter_var($nd_donations_email, FILTER_VALIDATE_EMAIL)) {
    return 1;  
  } else {
    return 0;
  }


}


//php function for validation fields on single cause form ( ajax )
function nd_donations_single_cause_form_validate_fields_php_function() {

  //check nonce
  check_ajax_referer( 'nd_donations_form_validate_fields_nonce', 'nd_donations_form_validate_fields_security' );

  //recover datas
  $nd_donations_id = sanitize_text_field($_GET['nd_donations_id']);
  $nd_donations_value = sanitize_text_field($_GET['nd_donations_value']);
  $nd_donations_name = sanitize_text_field($_GET['nd_donations_name']);
  $nd_donations_surname = sanitize_text_field($_GET['nd_donations_surname']);
  $nd_donations_email = sanitize_email($_GET['nd_donations_email']);
  $nd_donations_message = sanitize_text_field($_GET['nd_donations_message']);
  
  //declare
  $nd_donations_string_result = '';


  //value
  if ( $nd_donations_value == '' ) {

    $nd_donations_result_value = 0; 
    $nd_donations_string_result .= '<span class="nd_donations_single_cause_form_validation_errors">'.__('MANDATORY','nd-donations').'[divider]'.'</span>';     

  }elseif ( nd_donations_is_numeric($nd_donations_value) == 0 ) {

    $nd_donations_result_value = 0; 
    $nd_donations_string_result .= '<span class="nd_donations_single_cause_form_validation_errors">'.__('INSERT A NUMBER','nd-donations').'[divider]'.'</span>';

  }elseif ( $nd_donations_value > nd_donations_get_total_missing_money_to_goal($nd_donations_id) ) {

    $nd_donations_result_value = 0; 
    $nd_donations_string_result .= '<span class="nd_donations_single_cause_form_validation_errors">'.__('MAX AMOUNT FOR THIS DONATION IS : ','nd-donations').nd_donations_get_total_missing_money_to_goal($nd_donations_id).' '.nd_donations_get_currency().'[divider]'.'</span>'; 

  }
  else{

    $nd_donations_result_value = 1;

    $nd_donations_string_result .= ' [divider]'; 

  }


  //name
  if ( $nd_donations_name == '' ) {

    $nd_donations_result_name = 0; 

    if ( $nd_donations_id == 0 ) { $nd_donations_error_name_field_padding = ''; }else{ $nd_donations_error_name_field_padding = 'nd_donations_right_15_important'; }

    $nd_donations_string_result .= '<span class="nd_donations_single_cause_form_validation_errors '.$nd_donations_error_name_field_padding.' ">'.__('MANDATORY','nd-donations').'[divider]'.'</span>';     

  }else{

    $nd_donations_result_name = 1;

    $nd_donations_string_result .= ' [divider]';   

  }

  //surname
  if ( $nd_donations_surname == '' ) {

    $nd_donations_result_surname = 0; 

    $nd_donations_string_result .= '<span class="nd_donations_single_cause_form_validation_errors">'.__('MANDATORY','nd-donations').'[divider]'.'</span>';     

  }else{

    $nd_donations_result_surname = 1;

    $nd_donations_string_result .= ' [divider]'; 

  }


  //email
  if ( $nd_donations_email == '' ) {

    $nd_donations_result_email = 0; 

    if ( $nd_donations_id == 0 ) { $nd_donations_error_email_field_padding = ''; }else{ $nd_donations_error_email_field_padding = 'nd_donations_right_15_important'; }
    $nd_donations_string_result .= '<span class="nd_donations_single_cause_form_validation_errors '.$nd_donations_error_email_field_padding.' ">'.__('MANDATORY','nd-donations').'[divider]'.'</span>';     

  }elseif ( nd_donations_is_email($nd_donations_email) == 0 ) {

    $nd_donations_result_email = 0; 

    if ( $nd_donations_id == 0 ) { $nd_donations_error_email_field_padding = ''; }else{ $nd_donations_error_email_field_padding = 'nd_donations_right_15_important'; }
    $nd_donations_string_result .= '<span class="nd_donations_single_cause_form_validation_errors '.$nd_donations_error_email_field_padding.' ">'.__('NOT VALID','nd-donations').'[divider]'.'</span>';  

  }else{

    $nd_donations_result_email = 1;

    $nd_donations_string_result .= ' [divider]'; 

  }



  //message
  if ( strlen($nd_donations_message) >= 250 ) {

    $nd_donations_result_message = 0; 

    $nd_donations_string_result .= '<span class="nd_donations_single_cause_form_validation_errors">'.__('REDUCE YOUR MESSAGE, THE MAXIMUM ALLOWED CHARACTERS IS 250','nd-donations').'[divider]'.'</span>';     

  }else{

    $nd_donations_result_message = 1;

    $nd_donations_string_result .= ' [divider]'; 

  }



  //Determiante the final result
  if ( $nd_donations_result_value == 1 AND $nd_donations_result_name == 1 AND  $nd_donations_result_surname == 1 AND $nd_donations_result_email == 1 AND $nd_donations_result_message == 1 ){
    echo 1;
  }else{
    echo $nd_donations_string_result;  
  }

  
     
  //close the function to avoid wordpress errors
  die();

}
add_action( 'wp_ajax_nd_donations_single_cause_form_validate_fields_php_function', 'nd_donations_single_cause_form_validate_fields_php_function' );
add_action( 'wp_ajax_nopriv_nd_donations_single_cause_form_validate_fields_php_function', 'nd_donations_single_cause_form_validate_fields_php_function' );
/* **************************************** END AJAX **************************************** */



