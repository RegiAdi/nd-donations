<?php


$nd_donations_message_enable = get_option('nd_donations_message_enable');
if ( $nd_donations_message_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

//nd_donations_send_message
function nd_donations_send_message($nd_donations_title_cause,$nd_donations_donation_value,$nd_donations_paypal_payment_status,$nd_donations_user_first_name,$nd_donations_user_last_name,$nd_donations_paypal_email,$nd_donations_user_address,$nd_donations_user_city,$nd_donations_user_country,$nd_donations_date,$nd_donations_paypal_tx,$nd_donations_user_message){

	// Multiple recipients $to = 'email1@gmail.com, email2@gmail.com';
	$to = get_option('admin_email');

	// Subject
	$subject = __('New Donation Arrived !','nd-donations');

	// Message
	$message = '
	<html>
	<head>
	  <title>'.__('New Donation Arrived !','nd-donations').'</title>
	</head>
	<body>
	  <p>'.__('Hi, you received a new donation on your site, here all details','nd-donations').' :</p>
	  <p>'.__('Title Cause','nd-donations').' : '.$nd_donations_title_cause.'</p>
	  <p>'.__('Donation Value','nd-donations').' : '.$nd_donations_donation_value.'</p>
	  <p>'.__('Status Payment','nd-donations').' : '.$nd_donations_paypal_payment_status.'</p>
	  <p>'.__('Name','nd-donations').' : '.$nd_donations_user_first_name.'</p>
	  <p>'.__('Surname','nd-donations').' : '.$nd_donations_user_last_name.'</p>
	  <p>'.__('Email','nd-donations').' : '.$nd_donations_paypal_email.'</p>
	  <p>'.__('Address','nd-donations').' : '.$nd_donations_user_address.'</p>
	  <p>'.__('City','nd-donations').' : '.$nd_donations_user_city.'</p>
	  <p>'.__('Country','nd-donations').' : '.$nd_donations_user_country.'</p>
	  <p>'.__('Date','nd-donations').' : '.$nd_donations_date.'</p>
	  <p>'.__('Transaction','nd-donations').' : '.$nd_donations_paypal_tx.'</p>
	  <p>'.__('Message','nd-donations').' : '.$nd_donations_user_message.'</p>
	</body>
	</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';

	// Additional headers
	//$headers[] = 'To: email1 <email1@gmail.com>, email2 <email2@gmail.com>';
	$headers[] = ''.__('To','nd-donations').' : '.get_option('blogname').' <'.get_option('admin_email').'>';
	$headers[] = ''.__('From','nd-donations').' : '.$nd_donations_user_first_name.' <'.$nd_donations_paypal_email.'>';
	//$headers[] = 'Cc: email@gmail.com';
	//$headers[] = 'Bcc: email@gmail.com';

	// Mail it
	mail($to, $subject, $message, implode("\r\n", $headers));




}
add_action('nd_donations_donation_added_in_db','nd_donations_send_message',10,12);

}