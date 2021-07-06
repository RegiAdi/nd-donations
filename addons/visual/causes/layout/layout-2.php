<?php


wp_enqueue_script('masonry');

$str .= '

	<script type="text/javascript">
    //<![CDATA[
    
    jQuery(document).ready(function() {

      //START masonry
      jQuery(function ($) {
        
        //Masonry
    		var $nd_donations_masonry_content = $(".nd_donations_masonry_content").imagesLoaded( function() {
    		  // init Masonry after all images have loaded
    		  $nd_donations_masonry_content.masonry({
    		    itemSelector: ".nd_donations_masonry_item"
    		  });
    		});

      });
      //END masonry

    });

    //]]>
  </script>

';


$str .= '<div class="nd_donations_section nd_donations_masonry_content '.$nd_donations_class.' ">';

while ( $the_query->have_posts() ) : $the_query->the_post();

//info
$nd_donations_id = get_the_ID(); 
$nd_donations_title = get_the_title();
$nd_donations_excerpt = get_the_excerpt();
$nd_donations_permalink = get_permalink( $nd_donations_id );


//START image
if ( has_post_thumbnail() ) { 
  
  //div class
  $nd_donations_div_padding = 'nd_donations_padding_left_120';

  //image
  $nd_donations_image_id = get_post_thumbnail_id( $nd_donations_id );
  $nd_donations_image_attributes = wp_get_attachment_image_src( $nd_donations_image_id, 'nd_donations_img_200_200' );
  $nd_donations_image_cause = '<a href="'.$nd_donations_permalink.'"><img alt="" class="nd_donations_postgrid_causes_2_single_cause_img nd_donations_position_absolute" width="100" height="100" src="'.$nd_donations_image_attributes[0].'"></a>';
}else{ 
  $nd_donations_image_cause = '';
  $nd_donations_div_padding = 'nd_donations_padding_left_0';
}
//END IMAGE





//START urgent label
$nd_donations_urgent_donation = '';
if ( has_post_thumbnail() ) { 

  $nd_donations_meta_box_urgent = get_post_meta( get_the_ID(), 'nd_donations_meta_box_urgent', true ); 

  if ( $nd_donations_meta_box_urgent == 1 ) {

    $nd_donations_urgent_donation .= '
    <div style="top:35px;left:35px;" class="nd_donations_position_absolute nd_donations_urgent_label">                                
        <div class="nd_donations_bg_red nd_donations_padding_10 nd_donations_float_left">
            <p class="nd_donations_margin_0 nd_donations_color_white_important nd_donations_font_size_13 nd_donations_float_left nd_donations_margin_right_5">'.__('URGENT','nd-donations').'</p>
            <img class="nd_donations_float_left" width="12" src="'.esc_url(plugins_url('icon-thunder-white.svg', __FILE__ )).'">
        </div>
    </div>';

  }

}
//END Urgent




//START info bar
$nd_donations_info_donation = '';

if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

  $nd_donations_info_donation .= '

    <div class="nd_donations_section nd_donations_height_15"></div>
    <div class="nd_donations_section nd_donations_postgrid_causes_2_single_cause_info_donation">
        <div class="nd_donations_section">

            <p class="nd_options_color_grey nd_donations_font_size_13 nd_donations_line_height_20">
              '.__('GOAL','nd-donations').' : <span class="nd_donations_margin_right_10">'.nd_donations_get_cause_price(get_the_ID()).' '.nd_donations_get_currency().'</span>
              '.__('RAISED','nd-donations').' : '.nd_donations_get_total_donations_value(get_the_ID()).' '.nd_donations_get_currency().'
            </p>

        </div>
    </div>


  ';

}
//END info bar



$str .= '

  <div id="nd_donations_postgrid_causes_2_single_cause_'.$nd_donations_id.'" class="nd_donations_postgrid_causes_2_single_cause '.$nd_donations_width.' nd_donations_padding_10_0 nd_donations_box_sizing_border_box nd_donations_masonry_item nd_donations_width_100_percentage_responsive">
    <div class="nd_donations_section nd_donations_position_relative">
      
      '.$nd_donations_image_cause.'

      <div class="nd_donations_min_height_100 nd_donations_section '.$nd_donations_div_padding.' nd_donations_box_sizing_border_box">
          
          <div class="nd_donations_section nd_donations_height_3"></div>
          <h4><a class="nd_options_color_greydark" href="'.$nd_donations_permalink.'">'.$nd_donations_title.'</a></h4>
          '.$nd_donations_info_donation.'
          <div class="nd_donations_section nd_donations_height_15"></div>
          <a style="background-color: '.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_display_inline_block nd_donations_color_white_important nd_donations_padding_8  nd_donations_font_size_13" href="'.$nd_donations_permalink.'">'.__('Read More','nd-donations').'</a>

      </div>
    </div>
  </div>

';

endwhile;

$str .= '</div>';