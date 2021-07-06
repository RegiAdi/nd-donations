<?php


if ( get_option('nicdark_theme_author') == 1 ){
   
add_action('admin_menu','nd_donations_add_settings_menu_addons');
function nd_donations_add_settings_menu_addons(){

  add_submenu_page( 'nd-donations-settings','Addons Manager', __('Addons Manager','nd-donations'), 'manage_options', 'nd-donations-settings-addons-manager', 'nd_donations_settings_menu_addons_manager' );
  add_action( 'admin_init', 'nd_donations_addons_settings' );

}


function nd_donations_addons_settings() {

  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_documents_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_fixed_donation_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_info_donation_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_comments_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_donors_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_free_tab_content_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_header_img_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_testimonial_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_urgent_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_message_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_sidebar_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_pagination_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_slug_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_visualcomposer_enable' );
  register_setting( 'nd_donations_addons_settings_group', 'nd_donations_elementor_enable' );
}


function nd_donations_settings_menu_addons_manager() { ?>


<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_donations_addons_settings_group' ); ?>
  <?php do_settings_sections( 'nd_donations_addons_settings_group' ); ?>
  
  <div class="nd_donations_section nd_donations_padding_right_20 nd_donations_padding_left_2 nd_donations_box_sizing_border_box nd_donations_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_donations_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_donations_get_profile_bg_color(2); ?>;" class="nd_donations_section nd_donations_padding_20  nd_donations_box_sizing_border_box">
      <h2 class="nd_donations_color_ffffff nd_donations_display_inline_block"><?php _e('ND Donations','nd-donations'); ?></h2><span class="nd_donations_margin_left_10 nd_donations_color_a0a5aa"><?php echo nd_donations_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_donations_section  nd_donations_box_shadow_0_1_1_000_04 nd_donations_background_color_ffffff nd_donations_border_1_solid_e5e5e5 nd_donations_border_top_width_0 nd_donations_border_left_width_0 nd_donations_overflow_hidden nd_donations_position_relative">
    
      <!--START menu-->
      <div style="background-color:<?php echo nd_donations_get_profile_bg_color(1); ?>;" class="nd_donations_width_20_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_min_height_3000 nd_donations_position_absolute">

        <ul class="nd_donations_navigation">
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings'); ?>"><?php _e('Plugin Settings','nd-donations'); ?></a></li>
          <li><a style="background-color:<?php echo nd_donations_get_profile_bg_color(2); ?>;" class="" href="" ><?php _e('Addons Manager','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-paypal-settings'); ?>"><?php _e('Paypal Settings','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-offline-donations-page'); ?>"><?php _e('Offline Donations','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-paypal-donations-page'); ?>"><?php _e('Paypal Donations','nd-donations'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-donations-settings-import-export'); ?>"><?php _e('Import Export','nd-donations'); ?></a></li>
        </ul>
      </div>
      <!--END menu-->


      <!--START content-->
      <div class="nd_donations_width_80_percentage nd_donations_margin_left_20_percentage nd_donations_float_left nd_donations_box_sizing_border_box nd_donations_padding_20">


        <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Addons Manager','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Here you can remove some plugins addons.','nd-donations'); ?></p>
          </div>
        </div>
        <!--END-->

        <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>


         <!--START-->
        <div class="nd_donations_section">
          <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            <h2 class="nd_donations_section nd_donations_margin_0"><?php _e('Addons','nd-donations'); ?></h2>
            <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10"><?php _e('Manage your plugin addons','nd-donations'); ?></p>
          </div>
          <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
            
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_documents_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_documents_enable" type="checkbox" value="1"> <?php _e('Documents','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_fixed_donation_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_fixed_donation_enable" type="checkbox" value="1"> <?php _e('Fixed Donation','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_info_donation_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_info_donation_enable" type="checkbox" value="1"> <?php _e('Info Donation','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_comments_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_comments_enable" type="checkbox" value="1"> <?php _e('Comments','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_donors_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_donors_enable" type="checkbox" value="1"> <?php _e('Donors','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_free_tab_content_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_free_tab_content_enable" type="checkbox" value="1"> <?php _e('Free Tab Content','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_header_img_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_header_img_enable" type="checkbox" value="1"> <?php _e('Header Image','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_testimonial_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_testimonial_enable" type="checkbox" value="1"> <?php _e('Testimonial','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_urgent_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_urgent_enable" type="checkbox" value="1"> <?php _e('Urgent','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_message_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_message_enable" type="checkbox" value="1"> <?php _e('Mail on Order','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_sidebar_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_sidebar_enable" type="checkbox" value="1"> <?php _e('Sidebar on Single Cause','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_pagination_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_pagination_enable" type="checkbox" value="1"> <?php _e('Pagination on Single Cause','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_slug_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_slug_enable" type="checkbox" value="1"> <?php _e('Slug Post Type','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_visualcomposer_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_visualcomposer_enable" type="checkbox" value="1"> <?php _e('Visual Composer','nd-donations'); ?></label>
            <div class="nd_donations_section nd_donations_height_20"></div>
            <label class="nd_donations_section"><input <?php if( get_option('nd_donations_elementor_enable') == 1 ) { echo 'checked="checked"'; } ?> name="nd_donations_elementor_enable" type="checkbox" value="1"> <?php _e('Elementor','nd-donations'); ?></label>

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
/*END 1*/

}
