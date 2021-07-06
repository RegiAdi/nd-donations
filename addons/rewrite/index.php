<?php


$nd_donations_slug_enable = get_option('nd_donations_slug_enable');
if ( $nd_donations_slug_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

    
    function nd_donations_register_setting_slug(){
        register_setting( 'nd_donations_settings_group', 'nd_donations_plugin_slug' );
    }
    add_action('nd_donations_add_settings_group','nd_donations_register_setting_slug');


    //add setting slug on main page of setting plugin
    function nd_donations_add_setting_slug(){

        echo '

            <!--START-->
            <div class="nd_donations_section">
              <div class="nd_donations_width_40_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
                <h2 class="nd_donations_section nd_donations_margin_0">'.__('Slug Rewrite','nd-donations').'</h2>
                <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_10">'.__('Plugin Slug','nd-donations').'</p>
              </div>
              <div class="nd_donations_width_60_percentage nd_donations_padding_20 nd_donations_box_sizing_border_box nd_donations_float_left">
                
                <input class="nd_donations_width_100_percentage" type="text" name="nd_donations_plugin_slug" value="'.esc_attr( get_option('nd_donations_plugin_slug') ).'" />
                <p class="nd_donations_color_666666 nd_donations_section nd_donations_margin_0 nd_donations_margin_top_20">'.__('If you set this field, you have to refresh your permalinks. Go in Appearance -> Permalinks, set "Plain" save and set again to "Post Name" and save for the last time','nd-donations').'</p>

              </div>
            </div>
            <!--END-->
            <div class="nd_donations_section nd_donations_height_1 nd_donations_background_color_E7E7E7 nd_donations_margin_top_10 nd_donations_margin_bottom_10"></div>

        ';

    } 
    add_action('nd_donations_add_setting_on_main_page','nd_donations_add_setting_slug');

}
