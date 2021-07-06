<?php


if ( get_option('nicdark_theme_author') != 1 ){



  add_action('admin_menu','nd_donations_add_settings_menu_premium_addons');
  function nd_donations_add_settings_menu_premium_addons(){

    add_submenu_page( 'nd-donations-settings','Premium Addons', __('Premium Addons','nd-donations'), 'manage_options', 'nd-donations-settings-premium-addons', 'nd_donations_settings_menu_premium_addons' );

  }



  function nd_donations_settings_menu_premium_addons() {

  ?>

    
    <div class="nd_donations_section nd_donations_padding_right_20 nd_donations_padding_left_2 nd_donations_box_sizing_border_box nd_donations_margin_top_25 ">

      

      <div style="background-color:<?php echo nd_donations_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_donations_get_profile_bg_color(2); ?>;" class="nd_donations_section nd_donations_padding_20  nd_donations_box_sizing_border_box">
        <h2 class="nd_donations_color_ffffff nd_donations_display_inline_block"><?php _e('ND Donations','nd-donations'); ?></h2><span class="nd_donations_margin_left_10 nd_donations_color_a0a5aa"><?php echo nd_donations_get_plugin_version(); ?></span>
      </div>

      

      <div class="nd_donations_section nd_donations_min_height_400  nd_donations_box_shadow_0_1_1_000_04 nd_donations_background_color_ffffff nd_donations_border_1_solid_e5e5e5 nd_donations_border_top_width_0 nd_donations_border_left_width_0 nd_donations_overflow_hidden nd_donations_position_relative">
      
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
            <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings-import-export'); ?>"><?php _e('Import Export','nd-donations'); ?></a></li>

            <?php 

            if ( get_option('nicdark_theme_author') != 1 ){ ?>

              <li><a style="background-color:<?php echo nd_donations_get_profile_bg_color(2); ?>;" class="" href="" ><?php _e('Premium Addons','nd-donations'); ?></a></li>

            <?php }
            
            ?>


          </ul>
        </div>
        <!--END menu-->


        <!--START content-->
        <div class="nd_donations_width_80_percentage nd_donations_margin_left_20_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_20">


          <!--START-->
          <div class="nd_donations_section">
            
              


               <div class="nd_donations_section nd_donations_padding_20 nd_donations_box_sizing_border_box">
                <div class="nd_donations_section nd_donations_padding_30 nd_donations_box_sizing_border_box nd_donations_border_1_solid_e5e5e5 nd_donations_position_relative">
                  <h2 class="nd_donations_font_size_21 nd_donations_line_height_21 nd_donations_margin_0"><?php _e('Get All Addons','nd-donations'); ?></h2>
                  <p class="nd_donations_margin_top_10 nd_donations_color_666666 nd_donations_font_size_16 nd_donations_line_height_16 nd_donations_margin_0"><?php _e('Get all addons and an amazing Charity WP theme all in one pack.','nd-donations'); ?></p>
                  <a target="_blank" class="button button-primary button-hero nd_donations_top_30 nd_donations_right_30 nd_donations_position_absolute" href="https://goo.gl/Kzwfis"><?php _e('CHECK IT NOW !','nd-donations'); ?></a>
                </div>
              </div>





              <table id="nd_donations_table_premium_addons" class="nd_donations_width_60_percentage nd_donations_margin_auto nd_donations_border_collapse_collapse">
                
                <thead class="nd_donations_text_align_center">
                  <tr>
                    <td>
                    </td>
                    <td>
                      <h2><?php _e('FREE','nd-donations'); ?></h2>
                    </td>
                    <td>
                      <h2><?php _e('PREMIUM','nd-donations'); ?></h2>
                    </td>
                  </tr>
                </thead>

                <tbody>
                  

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Paypal','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Paypal Integration for all donations','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>

                    

                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Donation Form','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Default donation form for each cause','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>

                    

                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>



                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Cause CPT','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Custom Post Type for the creation of your causes','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>

                    

                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                
                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Documents','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Add documents tab on single cause page','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Fixed Donation','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Add the possibility to add fixed amount for your donation','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Info Donation','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Add amazing info bar for show some important stats of your cause','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Comments','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Allow comments in single cause page','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Donors','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Show donors list in each cause page','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Free Tab Content','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Add a single tab on each cause for adding some custom content','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Header Image','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Custom header image on single cause page','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Testimonial','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Add Testimonial section on single cause page','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Urgent','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Tag urgent on each cause','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Mail On Donation','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Automatic email when you receive a donation','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Sidebar','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Add sidebar in single cause page','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Pagination','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Adding pagination in single cause page','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Slug CPT','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Change the slug of causes custom post type','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Visual Composer','nd-donations'); ?></h2>
                      <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Custom components as cause post grid and donation form','nd-donations'); ?>. <a target="_blank" href="https://goo.gl/UR8UgO"><?php _e('View Demo','nd-donations'); ?></a></p>
                    </td>
                    
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-not.svg', __FILE__ )); ?>">
                    </td>
                    <td class="nd_donations_text_align_center">
                      <img width="25" height="25" src="<?php echo esc_url(plugins_url('icon-yes.svg', __FILE__ )); ?>">
                    </td>
                  </tr>


                  

                </tbody>

              </table>




          </div>
          <!--END-->


          


        </div>
        <!--END content-->


      </div>

    </div>

  <?php } 
  /*END 1*/

}



