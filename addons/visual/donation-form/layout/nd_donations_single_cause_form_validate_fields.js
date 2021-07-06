


//START function for filter
function nd_donations_single_cause_form_filter(){
  jQuery("#nd_donations_single_cause_form_filter").css("z-index", "0");
}

//nd_donations_payment_method
//0 - if the function doesn't return any errors the system choose the offline donation
//1 - if the function doesn't return any errors the system unlock the checkout on single cause page
//2 - if the function doesn't return any errors the system open the popup checkout

//START function
function nd_donations_single_cause_form_validate_fields(nd_donations_payment_method){

  //variables
  var nd_donations_id = jQuery( "#nd_donations_single_cause_form_donation_id").val();
  var nd_donations_value = jQuery( ".nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected").val();
  var nd_donations_email = jQuery( "#nd_donations_single_cause_form_donation_email").val();
  var nd_donations_name = jQuery( "#nd_donations_single_cause_form_donation_name").val();
  var nd_donations_surname = jQuery( "#nd_donations_single_cause_form_donation_surname").val();
  var nd_donations_message = jQuery( "#nd_donations_single_cause_form_donation_message").val();

  //START post method
  jQuery.get(
    
  
    //ajax
    nd_donations_my_vars_single_cause_form_validate_fields.nd_donations_ajaxurl_single_cause_form_validate_fields,
    {
      action : 'nd_donations_single_cause_form_validate_fields_php_function', 
      nd_donations_id: nd_donations_id,        
      nd_donations_value: nd_donations_value,
      nd_donations_email: nd_donations_email,
      nd_donations_name: nd_donations_name,
      nd_donations_surname: nd_donations_surname,
      nd_donations_message: nd_donations_message,
      nd_donations_form_validate_fields_security : nd_donations_my_vars_single_cause_form_validate_fields.nd_donations_ajaxnonce_single_cause_form_validate_fields,
    },
    //end ajax


    //START success
    function( nd_donations_single_cause_form_validate_fields_result ) {
      
     

     if ( nd_donations_single_cause_form_validate_fields_result == 1 ){

        jQuery( ".nd_donations_single_cause_form_validation_errors").remove();
        
        if ( nd_donations_payment_method == 0 ) {

          //offline
          jQuery("#nd_donations_single_cause_form_donation_value_offline").val(nd_donations_value);
          jQuery("#nd_donations_single_cause_form_donation_submit").removeAttr('disabled');
          jQuery("#nd_donations_single_cause_form_donation_submit").trigger("click");

        }else if ( nd_donations_payment_method == 2 ){

          //popup payment
          jQuery( "#nd_donations_dialog_donation_form" ).dialog( "open" );
          jQuery( ".nd_donations_dialog" ).addClass( "nd_donations_dialog_filter_bg" );
          jQuery("#nd_donations_single_cause_form_donation_value_paypal").val(nd_donations_value);
          jQuery("#nd_donations_single_cause_form_donation_message_paypal").val(nd_donations_message);
          jQuery("#nd_donations_single_cause_form_donation_paypal_submit").removeAttr('disabled');    

        }else{

          //paypal
          jQuery("#nd_donations_single_cause_form_filter").css("z-index", "-1");
          jQuery("#nd_donations_single_cause_form_donation_value_paypal").val(nd_donations_value);
          jQuery("#nd_donations_single_cause_form_donation_message_paypal").val(nd_donations_message);
          jQuery("#nd_donations_single_cause_form_donation_paypal_submit").removeAttr('disabled');
          jQuery("#nd_donations_single_cause_form_donation_paypal_submit").removeClass( "nd_donations_display_none" );

        }
        
        

     }else{
        
        jQuery( ".nd_donations_single_cause_form_validation_errors").remove();

        //split all result
        var nd_donations_errors_validation = nd_donations_single_cause_form_validate_fields_result.split("[divider]");
        
        //declare variables
        var nd_donations_error_validation_value = nd_donations_errors_validation[0];
        var nd_donations_error_validation_name = nd_donations_errors_validation[1];
        var nd_donations_error_validation_surname = nd_donations_errors_validation[2];
        var nd_donations_error_validation_email = nd_donations_errors_validation[3];
        var nd_donations_error_validation_message = nd_donations_errors_validation[4];

        jQuery( "#nd_donations_single_cause_form_donation_value_container").append(nd_donations_error_validation_value);
        jQuery( "#nd_donations_single_cause_form_donation_name_container").append(nd_donations_error_validation_name);
        jQuery( "#nd_donations_single_cause_form_donation_surname_container").append(nd_donations_error_validation_surname);
        jQuery( "#nd_donations_single_cause_form_donation_email_container").append(nd_donations_error_validation_email);
        jQuery( "#nd_donations_single_cause_form_donation_message_container").append(nd_donations_error_validation_message);
     
     }

     

    }
    //END

  
  );
  //END

  
}
//END function
