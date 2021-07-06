<?php


//START add custom css
function nd_donations_admin_style() {
  
  wp_enqueue_style( 'nd_donations_admin_style', esc_url(plugins_url('admin-style.css', __FILE__ )) , array(), false, false );
  
}
add_action( 'admin_enqueue_scripts', 'nd_donations_admin_style' );
//END add custom css


/////////////////////////////////////////////////// START MAIN PLUGIN SETTINGS ///////////////////////////////////////////////////////////////
add_action('admin_menu', 'nd_donations_create_menu');
function nd_donations_create_menu() {
  
  add_menu_page('Donations Plugin', __('Donation Plugin','nd-donations'), 'manage_options', 'nd-donations-settings', 'nd_donations_settings_page', 'dashicons-admin-generic' );
  add_action( 'admin_init', 'nd_donations_settings' );

  //custom hook
  do_action("nd_donations_add_menu_settings");

}

function nd_donations_settings() {
  register_setting( 'nd_donations_settings_group', 'nd_donations_currency' );
  register_setting( 'nd_donations_settings_group', 'nd_donations_thankyou_page' );
  register_setting( 'nd_donations_settings_group', 'nd_donations_account_page' );
  register_setting( 'nd_donations_settings_group', 'nd_donations_container' );
  register_setting( 'nd_donations_settings_group', 'nd_donations_thankyou_page_info' );
  register_setting( 'nd_donations_settings_group', 'nd_donations_plugin_dev_mode' );

  //custom hook
  do_action("nd_donations_add_settings_group");

}

function nd_donations_settings_page() {
?>


<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_donations_settings_group' ); ?>
  <?php do_settings_sections( 'nd_donations_settings_group' ); ?>


  <div class="nd_donations_section nd_donations_padding_right_20 nd_donations_padding_left_2 nd_donations_box_sizing_border_box nd_donations_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_donations_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_donations_get_profile_bg_color(2); ?>;" class="nd_donations_section nd_donations_padding_20 nd_donations_box_sizing_border_box">
      <h2 class="nd_donations_color_ffffff nd_donations_display_inline_block"><?php _e('ND Donations','nd-donations'); ?></h2><span class="nd_donations_margin_left_10 nd_donations_color_a0a5aa"><?php echo nd_donations_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_donations_section  nd_donations_box_shadow_0_1_1_000_04 nd_donations_background_color_ffffff nd_donations_border_1_solid_e5e5e5 nd_donations_border_top_width_0 nd_donations_border_left_width_0 nd_donations_overflow_hidden nd_donations_position_relative">

      <!--START menu-->
      <div style="background-color:<?php echo nd_donations_get_profile_bg_color(1); ?>;" class="nd_donations_width_20_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_min_height_3000 nd_donations_position_absolute">

        <ul class="nd_donations_navigation">
          <li><a style="background-color:<?php echo nd_donations_get_profile_bg_color(2); ?>;" class="" href="#"><?php _e('Plugin Settings','nd-donations'); ?></a></li>

          <?php 

          if ( get_option('nicdark_theme_author') == 1 ){ ?>

            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings-addons-manager'); ?>"><?php _e('Addons Manager','nd-donations'); ?></a></li>

          <?php }
          
          ?>

          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings-import-export'); ?>"><?php _e('Xendit Settings','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-paypal-settings'); ?>"><?php _e('Paypal Settings','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-offline-donations-page'); ?>"><?php _e('Offline Donations','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-paypal-donations-page'); ?>"><?php _e('Paypal Donations','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings-import-export'); ?>"><?php _e('Import Export','nd-donations'); ?></a></li>

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
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Plugin Settings','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Below some important plugin settings.','nd-donations'); ?></p>
          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Currency','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Plugin Currency','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <input class="nd_donations_width_100_percentage" type="text" name="nd_donations_currency" value="<?php echo esc_attr( get_option('nd_donations_currency') ); ?>" />
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('Insert the currency. Eg: $','nd-donations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>


        <?php
          //custom hook
          do_action("nd_donations_add_setting_on_main_page");
        ?>


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Container','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Remove default container','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <input <?php if( get_option('nd_donations_container') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_container" type="checkbox" value="1">
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('If your theme does not need the default container of 1200px in template pages you can remove it by flagging the checkbox.','nd-donations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Developer Mode','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Enable developer mode','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <input <?php if( get_option('nd_donations_plugin_dev_mode') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_plugin_dev_mode" type="checkbox" value="1">
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('In this mode all donations will not be saved in your database','nd-donations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>

        
        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Account Page','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Select your account page','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <select class="nd_donations_width_100_percentage" name="nd_donations_account_page">
              <?php $nd_donations_pages = get_pages(); ?>
              <?php foreach ($nd_donations_pages as $nd_donations_page) : ?>
                  <option

                  <?php 
                    if( get_option('nd_donations_account_page') == $nd_donations_page->ID ) { 
                      echo 'selected="selected"';
                    } 
                  ?>

                   value="<?php echo $nd_donations_page->ID; ?>">
                      <?php echo $nd_donations_page->post_title; ?>
                  </option>
              <?php endforeach; ?>
            </select>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('Select the page where you have added the shortcode [nd_donations_account]','nd-donations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Thank you Page','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Select your thank you page','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <select class="nd_donations_width_100_percentage" name="nd_donations_thankyou_page">
              <?php $nd_donations_pages = get_pages(); ?>
              <?php foreach ($nd_donations_pages as $nd_donations_page) : ?>
                  <option

                  <?php 
                    if( get_option('nd_donations_thankyou_page') == $nd_donations_page->ID ) { 
                      echo 'selected="selected"';
                    } 
                  ?>

                   value="<?php echo $nd_donations_page->ID; ?>">
                      <?php echo $nd_donations_page->post_title; ?>
                  </option>
              <?php endforeach; ?>
            </select>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('Select the page where you have added the shortcode [nd_donations_thankyou]','nd-donations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Infobox','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Infobox Content','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <textarea rows="10" class="nd_donations_width_100_percentage" name="nd_donations_thankyou_page_info"><?php echo esc_attr( get_option('nd_donations_thankyou_page_info') ); ?></textarea>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('Insert your informations which will appear in the thank you page for offline donations','nd-donations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>



        <div class="nd_donations_section nd_donations_padding_left_20 nd_donations_padding_right_20 nd_donations_box_sizing_border_box">
          <?php submit_button(); ?>
        </div>      


      </div>
      <!--END content-->


    </div>

  </div>
</form>

<?php } 
/////////////////////////////////////////////////// END MAIN PLUGIN SETTINGS ///////////////////////////////////////////////////////////////



/////////////////////////////////////////////////// START PAYPAL SETTINGS ///////////////////////////////////////////////////////////////

add_action('nd_donations_add_menu_settings','nd_donations_add_paypal_settings');
function nd_donations_add_paypal_settings(){

  add_submenu_page( 'nd-donations-settings','ND Booking', __('Paypal Settings','nd-donations'), 'manage_options', 'nd-donations-paypal-settings', 'nd_donations_paypal_page' );
  add_action( 'admin_init', 'nd_donations_paypal_settings' );

}


function nd_donations_paypal_settings() {
  register_setting( 'nd_donations_paypal_settings_group', 'nd_donations_paypal_developer' );
  register_setting( 'nd_donations_paypal_settings_group', 'nd_donations_paypal_email' );
  register_setting( 'nd_donations_paypal_settings_group', 'nd_donations_paypal_token' );
  register_setting( 'nd_donations_paypal_settings_group', 'nd_donations_paypal_currency' );
}


function nd_donations_paypal_page() {
?>
<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_donations_paypal_settings_group' ); ?>
  <?php do_settings_sections( 'nd_donations_paypal_settings_group' ); ?>


  <div class="nd_donations_section nd_donations_padding_right_20 nd_donations_padding_left_2 nd_donations_box_sizing_border_box nd_donations_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_donations_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_donations_get_profile_bg_color(2); ?>;" class="nd_donations_section nd_donations_padding_20 nd_donations_box_sizing_border_box">
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
          
          <li><a style="background-color:<?php echo nd_donations_get_profile_bg_color(2); ?>;" class="" href=""><?php _e('Paypal Settings','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-offline-donations-page'); ?>"><?php _e('Offline Donations','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-paypal-donations-page'); ?>"><?php _e('Paypal Donations','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings-import-export'); ?>"><?php _e('Import Export','nd-donations'); ?></a></li>

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
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Paypal Settings','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Below some important paypal settings.','nd-donations'); ?></p>
          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>

        


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Developer Mode Paypal','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Enable paypal developer mode','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <input <?php if( get_option('nd_donations_paypal_developer') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_paypal_developer" type="checkbox" value="1">
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('Check to use paypal in developer mode , more information','nd-donations'); ?> <a target="_blank" href="https://developer.paypal.com/docs/classic/lifecycle/sb_about-accounts/"><?php _e('HERE','nd-donations'); ?></a></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>



        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Email','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Insert your paypal email','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <input class="regular-text" type="text" name="nd_donations_paypal_email" value="<?php echo esc_attr( get_option('nd_donations_paypal_email') ); ?>" />
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('Insert your paypal email of your business account','nd-donations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>




        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('PDT identity token','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Insert paypal api token','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <input class="regular-text" type="text" name="nd_donations_paypal_token" value="<?php echo esc_attr( get_option('nd_donations_paypal_token') ); ?>" />
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('Insert your PDT identity token , more information','nd-donations'); ?> <a target="_blank" href="https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/paymentdatatransfer/"><?php _e('HERE','nd-donations'); ?></a> <?php _e('section Activating PDT','nd-donations'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>




        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Currency','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Set your paypal currency','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <select class="nd_donations_width_100_percentage" name="nd_donations_paypal_currency">
              <?php $nd_donations_currencies = array(
                
                "AUD","BRL","CAD","CZK","DKK","EUR","HKD","HUF","ILS","JPY","MYR","MXN","NOK","NZD","PHP","PLN","GBP","RUB","SGD","SEK","CHF","TWD","THB","TRY","USD"

                ); ?>
              <?php foreach ($nd_donations_currencies as $nd_donations_currency) : ?>
                  <option 

                  <?php 
                    if( get_option('nd_donations_paypal_currency') == $nd_donations_currency ) { 
                      echo 'selected="selected"';
                    } 
                  ?>

                  value="<?php echo $nd_donations_currency; ?>">
                      <?php echo $nd_donations_currency; ?>
                  </option>
              <?php endforeach; ?>
            </select>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20"><?php _e('Select your Currency, more information','nd-donations'); ?> <a target="_blank" href="https://developer.paypal.com/docs/classic/api/currency_codes/"><?php _e('HERE','nd-donations'); ?></a></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>



        <div class="nd_donations_section nd_donations_padding_left_20 nd_donations_padding_right_20 nd_donations_box_sizing_border_box">
          <?php submit_button(); ?>
        </div>
      


      </div>
      <!--END content-->


    </div>

  </div>
</form>


<?php } 
/////////////////////////////////////////////////// END PAYPAL SETTINGS ///////////////////////////////////////////////////////////////



//include all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once $file;
}

