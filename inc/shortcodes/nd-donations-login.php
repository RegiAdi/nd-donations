<?php

//START  nd_donations_login
function nd_donations_shortcode_login() {

  //recover datas from plugin settings
  $nd_donations_account_page = get_option('nd_donations_account_page');
  $nd_donations_account_page_url = get_permalink($nd_donations_account_page);

  $args = array(
      'echo'           => false,
      'redirect'       => $nd_donations_account_page_url, 
      'form_id'        => 'nd_donations_shortcode_account_login_form',
      'label_username' => __( 'Username','nd-donations' ),
      'label_password' => __( 'Password','nd-donations' ),
      'label_remember' => __( 'Remember Me','nd-donations' ),
      'label_log_in'   => __( 'LOG IN','nd-donations' ),
      'id_username'    => 'nd_donations_login_form_user',
      'id_password'    => 'nd_donations_login_form_password',
      'id_remember'    => 'nd_donations_login_form_remember',
      'id_submit'      => 'nd_donations_login_form_submit',
      'remember'       => true,
      'value_username' => NULL,
      'value_remember' => false
  );


  return wp_login_form( $args );


}
add_shortcode('nd_donations_login', 'nd_donations_shortcode_login');
//END nd_donations_login