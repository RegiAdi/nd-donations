//START function
function nd_donations_import_settings(){

  //variables
  var nd_donations_value_import_settings = jQuery( "#nd_donations_import_settings").val();

  //empty result div
  jQuery( "#nd_donations_import_settings_result_container").empty();

  //START post method
  jQuery.get(
    
  
    //ajax
    nd_donations_my_vars_import_settings.nd_donations_ajaxurl_import_settings,
    {
      action : 'nd_donations_import_settings_php_function',         
      nd_donations_value_import_settings: nd_donations_value_import_settings,
      nd_donations_import_settings_security : nd_donations_my_vars_import_settings.nd_donations_ajaxnonce_import_settings,
    },
    //end ajax


    //START success
    function( nd_donations_import_settings_result ) {
    
      jQuery( "#nd_donations_import_settings").val('');
      jQuery( "#nd_donations_import_settings_result_container").append(nd_donations_import_settings_result);

    }
    //END
  

  );
  //END

  
}
//END function
