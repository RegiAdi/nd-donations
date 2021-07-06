<?php


$nd_donations_pagination_enable = get_option('nd_donations_pagination_enable');
if ( $nd_donations_pagination_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

   function nd_donations_add_pagination_on_single_cause(){

        //next link
        $nd_donations_next_post_link_result = '';
        $nd_donations_next_post = get_next_post();
        if (!empty( $nd_donations_next_post )){
            $nd_donations_next_post_link = get_permalink( $nd_donations_next_post->ID ); 
            $nd_donations_next_post_link_result .= '

                <a href="'.$nd_donations_next_post_link.'"><img alt="" class=" " width="20" src="'.esc_url(plugins_url('icon-next-white.svg', __FILE__ )).'"></a>

            ';
        }

        //previous link
        $nd_donations_previous_post_link_result = '';
        $nd_donations_previous_post = get_previous_post();
        if (!empty( $nd_donations_previous_post )){
            $nd_donations_previous_post_link = get_permalink( $nd_donations_previous_post->ID ); 
            $nd_donations_previous_post_link_result .= '

                <a href="'.$nd_donations_previous_post_link.'"><img alt="" class=" " width="20" src="'.esc_url(plugins_url('icon-prev-white.svg', __FILE__ )).'"></a>

            ';
        }



        echo '

            <div class="nd_donations_single_cause_bottom_pagination nd_donations_border_bottom_1_solid_greydark nd_donations_section nd_donations_box_sizing_border_box">
                <div class="nd_donations_section nd_donations_bg_greydark">

                    <div class="nd_donations_width_33_percentage nd_donations_box_sizing_border_box  nd_donations_float_left">
                    
                        <!--START-->
                        <div class="nd_donations_section nd_donations_position_relative  nd_donations_text_align_center">
                                            
                            <div class="nd_donations_section">

                                <div class="nd_donations_section nd_donations_height_30"></div>
                                '.$nd_donations_previous_post_link_result.'
                                <div class="nd_donations_section nd_donations_height_30"></div>

                            </div>

                        </div>
                        <!--END-->

                    </div>

                    <div class="nd_donations_width_33_percentage nd_donations_box_sizing_border_box  nd_donations_float_left">
                    
                        <!--START-->
                        <div class="nd_donations_section nd_donations_position_relative  nd_donations_text_align_center">
                                            
                            <div class="nd_donations_section">

                                <div class="nd_donations_section nd_donations_height_30"></div>
                                <a href="'.get_post_type_archive_link('causes').'"><img alt="" class=" " width="20" src="'.esc_url(plugins_url('icon-archive-white.svg', __FILE__ )).'"></a>
                                <div class="nd_donations_section nd_donations_height_30"></div>

                            </div>

                        </div>
                        <!--END-->

                    </div>

                    <div class="nd_donations_width_33_percentage nd_donations_box_sizing_border_box  nd_donations_float_left">
                    
                        <!--START-->
                        <div class="nd_donations_section nd_donations_position_relative nd_donations_text_align_center">
                                            
                            <div class="nd_donations_section ">

                                <div class="nd_donations_section nd_donations_height_30"></div>
                                '.$nd_donations_next_post_link_result.'
                                <div class="nd_donations_section nd_donations_height_30"></div>

                            </div>

                        </div>
                        <!--END-->

                    </div> 
                </div>    

            </div>

        ';

       

   } 

   add_action('nd_donations_single_cause_end_content','nd_donations_add_pagination_on_single_cause');

}
