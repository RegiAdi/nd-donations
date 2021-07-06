<?php


//START
add_shortcode('nd_donations_causes_pg', 'nd_donations_vc_shortcode_causes');
function nd_donations_vc_shortcode_causes($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_donations_class' => '',
    'nd_donations_layout' => '',
    'nd_donations_width' => '',
    'nd_donations_qnt' => '',
    'nd_donations_id' => '',
    'nd_donations_order' => '',
    'nd_donations_orderby' => '',
  ), $atts);

  $str = '';

  //get variables
  $nd_donations_class = $atts['nd_donations_class'];
  $nd_donations_layout = $atts['nd_donations_layout'];
  $nd_donations_width = $atts['nd_donations_width'];
  $nd_donations_qnt = $atts['nd_donations_qnt'];
  $nd_donations_id = $atts['nd_donations_id'];
  $nd_donations_order = $atts['nd_donations_order'];
  $nd_donations_orderby = $atts['nd_donations_orderby'];


  //default value
  if ($nd_donations_layout == '') { $nd_donations_layout = "layout-1"; }
  if ($nd_donations_width == '') { $nd_donations_width = "nd_donations_width_100_percentage"; }
  if ($nd_donations_qnt == '') { $nd_donations_qnt = -1; }
  if ($nd_donations_order == '') { $nd_donations_order = 'DESC'; }
  if ($nd_donations_orderby == '') { $nd_donations_orderby = 'date'; }



  $args = array(
    'post_type' => 'causes',
    'posts_per_page' => $nd_donations_qnt,
    'order' => $nd_donations_order,
    'orderby' => $nd_donations_orderby,
    'p' => $nd_donations_id
  );

  $the_query = new WP_Query( $args );

  
  //include the layout selected
  include 'layout/'.$nd_donations_layout.'.php';


  wp_reset_postdata();
  
  return apply_filters('uds_shortcode_out_filter', $str);

}
//END





//vc
add_action( 'vc_before_init', 'nd_donations_causes_pg' );
function nd_donations_causes_pg() {


  //START get all layout
  $nd_donations_layouts = array();

  //php function to descover all name files in directory
  $nd_donations_directory = plugin_dir_path( __FILE__ ) .'layout/';
  $nd_donations_layouts = scandir($nd_donations_directory);


  //cicle for delete hidden file that not are php files
  $i = 0;
  foreach ($nd_donations_layouts as $value) {
    
    //remove all files that aren't php
    if ( strpos( $nd_donations_layouts[$i] , ".php" ) != true ){
      unset($nd_donations_layouts[$i]);
    }else{
      $nd_donations_layout_name = str_replace(".php","",$nd_donations_layouts[$i]);
      $nd_donations_layouts[$i] = $nd_donations_layout_name;
    } 
    $i++; 

  }
  //END get all layout


   vc_map( array(
      "name" => __( "Causes", "nd-donations" ),
      "base" => "nd_donations_causes_pg",
      'description' => __( 'Add Causes Post Grid', 'nd-donations' ),
      'show_settings_on_create' => true,
      "icon" => esc_url(plugins_url('causes.jpg', __FILE__ )),
      "class" => "",
      "category" => __( "ND Donations", "nd-donations"),
      "params" => array(
   

          array(
           'type' => 'dropdown',
            'heading' => __( 'Layout', 'nd-donations' ),
            'param_name' => 'nd_donations_layout',
            'value' => $nd_donations_layouts,
            'description' => __( "Choose the layout", "nd-donations" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Width", "nd-donations" ),
          'param_name' => 'nd_donations_width',
          'value' => array( __( 'Select Width', 'nd-donations' ) => 'nd_donations_width_100_percentage nd_donations_float_left', __( '20 %', 'nd-donations' ) => 'nd_donations_width_20_percentage nd_donations_float_left', __( '25 %', 'nd-donations' ) => 'nd_donations_width_25_percentage nd_donations_float_left', __( '33 %', 'nd-donations' ) => 'nd_donations_width_33_percentage nd_donations_float_left', __( '50 %', 'nd-donations' ) => 'nd_donations_width_50_percentage nd_donations_float_left', __( '100 %', 'nd-donations' ) => 'nd_donations_width_100_percentage nd_donations_float_left' ),
          'description' => __( "Select the width for cause preview grid", "nd-donations" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Qnt Causes", "nd-donations" ),
            "param_name" => "nd_donations_qnt",
            "description" => __( "Insert the quantity of causes that you want display.", "nd-donations" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Order", "nd-donations" ),
          'param_name' => 'nd_donations_order',
          'value' => array('DESC','ASC'),
          'description' => __( "Select the Order paramater, more info <a target='_blank' href='https://codex.wordpress.org/it:Riferimento_classi/WP_Query#Parametri_Order_.26_Orderby'>here</a>", "nd-donations" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Order By", "nd-donations" ),
          'param_name' => 'nd_donations_orderby',
          'value' => array('none','ID','author','title','name','date','modified','rand','comment_count'),
          'description' => __( "Select the OrderBy paramater, more info <a target='_blank' href='https://codex.wordpress.org/it:Riferimento_classi/WP_Query#Parametri_Order_.26_Orderby'>here</a>", "nd-donations" )
         ),
           array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "ID Cause", "nd-donations" ),
            "param_name" => "nd_donations_id",
            "description" => __( "Insert the id of the cause that you want display ( NB: only one cause )", "nd-donations" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Custom class", "nd-donations" ),
            "param_name" => "nd_donations_class",
            "description" => __( "Insert custom class", "nd-donations" )
         )

        
      )
   ) );
}
//end shortcode