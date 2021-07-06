<?php


add_action('admin_menu','nd_donations_add_settings_menu_import_export');
function nd_donations_add_settings_menu_import_export(){

  add_submenu_page( 'nd-donations-settings','Import Export', __('Import Export','nd-donations'), 'manage_options', 'nd-donations-settings-import-export', 'nd_donations_settings_menu_import_export' );

}



function nd_donations_settings_menu_import_export() {

  //ajax results
  $nd_donations_import_settings_params = array(
      'nd_donations_ajaxurl_import_settings' => admin_url('admin-ajax.php'),
      'nd_donations_ajaxnonce_import_settings' => wp_create_nonce('nd_donations_import_settings_nonce'),
  );

  wp_enqueue_script( 'nd_donations_import_sett', esc_url( plugins_url( 'js/nd_donations_import_settings.js', __FILE__ ) ), array( 'jquery' ) ); 
  wp_localize_script( 'nd_donations_import_sett', 'nd_donations_my_vars_import_settings', $nd_donations_import_settings_params ); 

?>

  
  <div class="nd_donations_section nd_donations_padding_right_20 nd_donations_padding_left_2 nd_donations_box_sizing_border_box nd_donations_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_donations_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_donations_get_profile_bg_color(2); ?>;" class="nd_donations_section nd_donations_padding_20  nd_donations_box_sizing_border_box">
      <h2 class="nd_donations_color_ffffff nd_donations_display_inline_block"><?php _e('ND Donations','nd-donations'); ?></h2><span class="nd_donations_margin_left_10 nd_donations_color_a0a5aa"><?php echo nd_donations_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_donations_section  nd_donations_box_shadow_0_1_1_000_04 nd_donations_background_color_ffffff nd_donations_border_1_solid_e5e5e5 nd_donations_border_top_width_0 nd_donations_border_left_width_0 nd_donations_overflow_hidden nd_donations_position_relative">
    
      <!--START menu-->
      <div style="background-color:<?php echo nd_donations_get_profile_bg_color(1); ?>;" class="nd_donations_width_20_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_min_height_3000 nd_donations_position_absolute">

        <ul class="nd_donations_navigation">
          
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings'); ?>"><?php _e('Plugin Settings','nd-donations'); ?></a></li>

          <?php 

          if ( get_option('nicdark_theme_author') == 1 ){ ?>

            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings-addons-manager'); ?>"><?php _e('Addons Manager','nd-donations'); ?></a></li>

          <?php }
          
          ?>

          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-paypal-settings'); ?>"><?php _e('Paypal Settings','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-offline-donations-page'); ?>"><?php _e('Offline Donations','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-paypal-donations-page'); ?>"><?php _e('Paypal Donations','nd-donations'); ?></a></li>
          <li><a style="background-color:<?php echo nd_donations_get_profile_bg_color(2); ?>;" class="" href="" ><?php _e('Import Export','nd-donations'); ?></a></li>
        
          <?php 

          if ( get_option('nicdark_theme_author') != 1 ){ ?>

          <li><a style="background-color:<?php echo nd_donations_get_profile_bg_color(2); ?>;" class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings-premium-addons'); ?>" ><?php _e('Premium Addons','nd-donations'); ?></a></li>

          <?php }

          ?>
        
        </ul>
      </div>
      <!--END menu-->


      <!--START content-->
      <div class="nd_donations_width_80_percentage nd_donations_margin_left_20_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_20">


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Import/Export','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Export or Import your theme options.','nd-donations'); ?></p>
          </div>
        </div>
        <!--END-->

        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>


        <?php


          $nd_donations_all_options = wp_load_alloptions();
          $nd_donations_my_options  = array();

          $nd_donations_name_write = '';
           
          foreach ( $nd_donations_all_options as $nd_donations_name => $nd_donations_value ) {
              if ( stristr( $nd_donations_name, 'nd_donations_' ) ) {
                  
                $nd_donations_my_options[ $nd_donations_name ] = $nd_donations_value;
                $nd_donations_name_write .= $nd_donations_name.'[nd_donations_option_value]'.$nd_donations_value.'[nd_donations_end_option]';

              }
          }

          $nd_donations_name_write_new_1 = str_replace(" ", "%20", $nd_donations_name_write);
          $nd_donations_name_write_new = str_replace("#", "[SHARP]", $nd_donations_name_write_new_1);
           
        ?>


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Export Settings','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Export Nd Donations and customizer options.','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <div class="nd_donations_section nd_donations_padding_left_20 nd_donations_padding_right_20 nd_donations_box_sizing_border_box">
              
                <a class="button button-primary" href="data:application/octet-stream;charset=utf-8,<?php echo $nd_donations_name_write_new; ?>" download="nd-donations-export.txt"><?php _e('Export','nd-donations'); ?></a>
              
            </div>

          </div>
        </div>
        <!--END-->

        
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>

        

        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Import Settings','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Paste in the textarea the text of your export file','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <div class="nd_donations_section nd_donations_padding_left_20 nd_donations_padding_right_20 nd_donations_box_sizing_border_box">
              
                <textarea id="nd_donations_import_settings" class="nd_donations_margin_bottom_20 nd_donations_width_100_percentage" name="nd_donations_import_settings" rows="10"><?php echo esc_attr( get_option('nd_donations_textarea') ); ?></textarea>
                
                <a onclick="nd_donations_import_settings()" class="button button-primary"><?php _e('Import','nd-donations'); ?></a>

                <div class="nd_donations_margin_top_20 nd_donations_section" id="nd_donations_import_settings_result_container"></div>
                
            </div>

          </div>
        </div>
        <!--END-->


      </div>
      <!--END content-->


    </div>

  </div>

<?php } 
/*END 1*/







//START nd_donations_import_settings_php_function for AJAX
function nd_donations_import_settings_php_function() {

  check_ajax_referer( 'nd_donations_import_settings_nonce', 'nd_donations_import_settings_security' );

  //recover datas
  $nd_donations_value_import_settings = sanitize_text_field($_GET['nd_donations_value_import_settings']);

  $nd_donations_import_settings_result .= '';

  //START import and update options only if is superadmin
  if ( current_user_can('manage_options') ) {


    if ( $nd_donations_value_import_settings != '' ) {

      $nd_donations_array_options = explode("[nd_donations_end_option]", $nd_donations_value_import_settings);

      foreach ($nd_donations_array_options as $nd_donations_array_option) {
          
        $nd_donations_array_single_option = explode("[nd_donations_option_value]", $nd_donations_array_option);
        
        $nd_donations_option = $nd_donations_array_single_option[0];
        $nd_donations_new_value = $nd_donations_array_single_option[1];
        $nd_donations_new_value = str_replace("[SHARP]","#",$nd_donations_new_value);

        if ( $nd_donations_new_value != '' ){

          //remove \ from new value
          $nd_donations_new_value_str_replace = str_replace("\'", "'", $nd_donations_new_value );


          //START update option only it contains the plugin suffix
          if ( strpos($nd_donations_option, 'nd_donations_') !== false ) {

            $nd_donations_update_result = update_option($nd_donations_option,$nd_donations_new_value_str_replace);  

            if ( $nd_donations_update_result == 1 ) {
              
              $nd_donations_import_settings_result .= '
                <div class="notice updated is-dismissible nd_donations_margin_0_important">
                  <p>'.__('Updated option','nd-donations').' "'.$nd_donations_option.'" '.__('with','nd-donations').' '.$nd_donations_new_value.'.</p>
                </div>';

            }else{

              $nd_donations_import_settings_result .= '
                <div class="notice updated is-dismissible nd_donations_margin_0_important">
                  <p>'.__('Updated option','nd-donations').' "'.$nd_donations_option.'" '.__('with the same value','nd-donations').'.</p>
                </div>'; 
                   
            }
          

          }else{

            $nd_donations_import_settings_result .= '
              <div class="notice notice-error is-dismissible nd_donations_margin_0">
                <p>'.__('You do not have permission to change this option','nd-donations').'</p>
              </div>
            ';

          }
          //END update option only it contains the plugin suffix
          

        }else{

          if ( $nd_donations_option != '' ){
            $nd_donations_import_settings_result .= '

          <div class="notice notice-warning is-dismissible nd_donations_margin_0">
            <p>'.__('No value founded for','nd-donations').' "'.$nd_donations_option.'" '.__('option.','nd-donations').'</p>
          </div>
          ';
          }

          
        }
        
      }

    }else{

      $nd_donations_import_settings_result .= '
        <div class="notice notice-error is-dismissible nd_donations_margin_0">
          <p>'.__('Empty textarea, please paste your export options.','nd-donations').'</p>
        </div>
      ';

    }




  }else{

    $nd_donations_import_settings_result .= '
      <div class="notice notice-error is-dismissible nd_donations_margin_0">
        <p>'.__('You do not have the privileges to do this.','nd-donations').'</p>
      </div>
    ';

  }
  //END import and update options only if is superadmin



  
  
  echo $nd_donations_import_settings_result;

  die();


}
add_action( 'wp_ajax_nd_donations_import_settings_php_function', 'nd_donations_import_settings_php_function' );
//END