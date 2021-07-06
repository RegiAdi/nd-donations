<?php


get_header( );


// ******* START HEADER IMAGE *******

//get value
$nd_donations_customizer_archive_causes_header_image_display = get_option( 'nd_donations_customizer_archive_causes_header_image_display' );
if ( $nd_donations_customizer_archive_causes_header_image_display == '' ) { $nd_donations_customizer_archive_causes_header_image_display = 0;  }
$nd_donations_customizer_nd_donations_archive_header_image_title = get_post_type_object(get_post_type())->labels->singular_name;

if ( $nd_donations_customizer_archive_causes_header_image_display != 1 ) { ?>


	<?php

		//header image
		$nd_donations_customizer_archive_causes_header_image = get_option( 'nd_donations_customizer_archive_causes_header_image' );
		if ( $nd_donations_customizer_archive_causes_header_image == '' ) { 
		    $nd_donations_customizer_archive_causes_header_image = '';  
		}else{
		    $nd_donations_customizer_archive_causes_header_image = wp_get_attachment_url($nd_donations_customizer_archive_causes_header_image);
		}


		//position
		$nd_donations_customizer_archive_causes_header_image_position = get_option( 'nd_donations_customizer_archive_causes_header_image_position' );
		if ( $nd_donations_customizer_archive_causes_header_image_position == '' ) { 
		    $nd_donations_customizer_archive_causes_header_image_position = 'nd_donations_background_position_center_top';  
		}

	?>

	<div id="nd_donations_archive_causes_header_img" class="nd_donations_section nd_donations_background_size_cover <?php echo $nd_donations_customizer_archive_causes_header_image_position; ?> nd_donations_bg_greydark" style="background-image:url(<?php echo $nd_donations_customizer_archive_causes_header_image; ?>);">

        <div class="nd_donations_section nd_donations_bg_greydark_alpha_3">
            
      		<?php if ( nd_donations_get_container() != 1) { ?> <div class="nd_donations_container nd_donations_clearfix"> <?php } ?>

                <div id="nd_donations_archive_causes_header_img_spacer_top" class="nd_donations_section nd_donations_height_130"></div>

                <div class="nd_donations_section nd_donations_padding_15 nd_donations_box_sizing_border_box">
                    <span id="nd_donations_archive_causes_header_img_title" class="nd_donations_color_white_important nd_donations_font_size_40 nd_options_first_font"><?php echo $nd_donations_customizer_nd_donations_archive_header_image_title; ?></span>
                </div>

                <div id="nd_donations_archive_causes_header_img_spacer_bottom" class="nd_donations_section nd_donations_height_130"></div>

            <?php if ( nd_donations_get_container() != 1) { ?> </div> <?php } ?>

        </div>

    </div>


<?php }
// ******* END HEADER IMAGE *******





//add conteiner
if ( nd_donations_get_container() != 1) { echo '<div class="nd_donations_container nd_donations_clearfix">'; }


wp_enqueue_script('masonry');

//prepare args
if (is_post_type_archive('causes')){

	$nd_donations_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1 ;

	$args = array(
		'post_type' => 'causes',
	  	'paged' => $nd_donations_paged
	);	

}
$the_query = new WP_Query( $args );


//prepare masonry script
$nd_donations_archive_result = '';
$nd_donations_archive_result .= '

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


$nd_donations_archive_result .= '
	
	<div class="nd_donations_section nd_donations_height_45"></div>

	<div class="nd_donations_section nd_donations_masonry_content">';


		//START loop
		while ( $the_query->have_posts() ) : $the_query->the_post();

			//info
			$nd_donations_id = get_the_ID(); 
			$nd_donations_title = get_the_title();
			$nd_donations_excerpt = get_the_excerpt();
			$nd_donations_permalink = get_permalink( $nd_donations_id );


			//image
		    if ( has_post_thumbnail() ) { 
				$nd_donations_image_cause = '


					<div class="nd_donations_section nd_donations_position_relative">

					    <div class="nd_donations_archive_causes_single_cause_filter nd_donations_bg_greydark_alpha_gradient_3 nd_donations_position_absolute nd_donations_left_0 nd_donations_top_0 nd_donations_height_100_percentage nd_donations_width_100_percentage "></div>

					    <img class="nd_donations_section nd_donations_archive_causes_single_cause_img" src="'.nd_donations_get_cause_img_src(get_the_ID()).'">';


					    if ( nd_donations_get_cause_price(get_the_ID()) != 0 AND nd_donations_get_total_missing_money_to_goal(get_the_ID()) != 0 ) {

					    	$nd_donations_image_cause .= '

					    		<!--start donate now link-->
							    <div class="nd_donations_position_absolute nd_donations_bottom_40 nd_donations_left_40">
							        
							        <div class="nd_donations_float_left">
							            <p class="nd_donations_archive_causes_single_cause_donate_link nd_donations_margin_0 nd_donations_color_white nd_donations_font_size_13 nd_donations_float_left"><a class="nd_donations_color_white_important" href="'.$nd_donations_permalink.'#nd_donations_single_cause_form_section">'.__('DONATE NOW','nd-donations').' +</a></p>
							        </div>

							    </div>
							    <!--end donate now link-->	

					    	';

					    }
					    


				$nd_donations_image_cause .= '

					</div>

				';
		    }else{ 
		    	$nd_donations_image_cause = '';
		    }

			$nd_donations_archive_result .= '

				<div id="nd_donations_archive_causes_single_cause_'.$nd_donations_id.'" class="nd_donations_archive_causes_single_cause nd_donations_width_33_percentage nd_donations_padding_15 nd_donations_box_sizing_border_box nd_donations_masonry_item nd_donations_width_100_percentage_responsive">

			        <div class="nd_donations_section">
			            
			            <!--start preview-->
			            <div class="nd_donations_section nd_donations_border_1_solid_grey">
			                
			                '.$nd_donations_image_cause.' ';


			            //START progress bar
			            if ( nd_donations_get_cause_price(get_the_ID()) != 0 ) {

			            	$nd_donations_progress_label_class = '';

			            	if ( nd_donations_get_total_donations_percentage(get_the_ID()) <= 50 ) {
			            		$nd_donations_progress_label_class = ' top:-20px; right:-40px; ';
			            	}else{
			            		$nd_donations_progress_label_class = ' top:-20px; right:0px; ';	
			            	}

			            	$nd_donations_archive_result .= '

			            		<div class="nd_donations_archive_causes_single_cause_slider_donation nd_donations_section nd_donations_bg_greydark nd_donations_box_sizing_border_box">
								    <div class="nd_donations_height_3 nd_donations_section nd_donations_bg_greydark">
								        <div style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; width:'.nd_donations_get_total_donations_percentage(get_the_ID()).'%;" class="nd_donations_height_3 nd_donations_float_left nd_donations_position_relative">
								            <p style="background-color:'.nd_donations_get_cause_color($nd_donations_id).'; '.$nd_donations_progress_label_class.' " class="nd_donations_line_height_40 nd_donations_width_40 nd_donations_height_40 nd_donations_text_align_center nd_donations_color_white_important nd_donations_font_size_13 nd_donations_border_radius_100_percentage  nd_donations_display_inline_block nd_donations_position_absolute">'.nd_donations_get_total_donations_percentage(get_the_ID()).'%</p>
								        </div>
								    </div>
								</div>

			            	';

			            }
			            //END progress bar
			            

						$nd_donations_archive_result .= '

			                <div class="nd_donations_section nd_donations_padding_40 nd_donations_box_sizing_border_box nd_donations_bg_white">
			                
			                    <h3 class="nd_donations_archive_causes_single_cause_title">'.$nd_donations_title.'</h3>';


			                    echo $nd_donations_archive_result;

			                    //hook
			                    do_action('nd_donations_archive_causes_preview_below_title',35,35);


			                    $nd_donations_archive_result = '

			                    <div class="nd_donations_section nd_donations_height_20"></div> 
			                    <p class="nd_donations_archive_causes_single_cause_text nd_donations_margin_0">'.$nd_donations_excerpt.'</p>
			                    <div class="nd_donations_section nd_donations_height_20"></div>
			                    <a style="background-color:'.nd_donations_get_cause_color($nd_donations_id).';" class="nd_donations_archive_causes_single_cause_button nd_donations_border_radius_30 nd_donations_padding_10_20 nd_donations_display_inline_block nd_donations_color_white_important nd_donations_font_size_14" href="'.$nd_donations_permalink.'">'.__('Read More','nd-donations').'</a>

			                </div>

			            </div>
			            <!--start preview-->

			        </div> 

			    </div>


			  ';


		endwhile;
		//END loop


$nd_donations_archive_result .= '
	</div>
<div class="nd_donations_section nd_donations_height_50"></div>';
echo $nd_donations_archive_result;


//START pagination
$nd_donations_archive_result = '
<!--START pagination-->

<div class="nd_donations_section">';


	the_posts_pagination( array(
		'prev_text'          => __( 'Prev', 'nd-donations' ),
		'next_text'          => __( 'Next', 'nd-donations' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'nd-donations' ) . ' </span>',
	) );


	$nd_donations_archive_result .= '</div><div class="nd_donations_section nd_donations_height_50"></div>
<!--END pagination-->';

echo $nd_donations_archive_result;
//END pagination


//close conteiner
if ( nd_donations_get_container() != 1) { echo '</div>'; }


get_footer( ); ?>
