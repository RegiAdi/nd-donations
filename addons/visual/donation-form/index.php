<?php

//START
add_shortcode('nd_donations_donation_form', 'nd_donations_vc_shortcode_donation_form');
function nd_donations_vc_shortcode_donation_form($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_donations_class' => '',
    'nd_donations_layout' => '',
    'nd_donations_width' => '',
    'nd_donations_style' => '',
    'nd_donations_color' => '',
    'nd_donations_adv_options' => '',
    'nd_learning_hide_address' => '',
    'nd_learning_hide_city' => '',
    'nd_learning_hide_country' => '',
    'nd_learning_hide_message' => '',
    'nd_learning_btn_full_width' => '',
  ), $atts);

  $str = '';

  //get variables
  $nd_donations_class = $atts['nd_donations_class'];
  $nd_donations_layout = $atts['nd_donations_layout'];
  $nd_donations_width = $atts['nd_donations_width'];
  $nd_donations_color = $atts['nd_donations_color'];
  $nd_donations_style = $atts['nd_donations_style'];
  $nd_donations_adv_options = $atts['nd_donations_adv_options'];
  $nd_learning_hide_address = $atts['nd_learning_hide_address'];
  $nd_learning_hide_city = $atts['nd_learning_hide_city'];
  $nd_learning_hide_country = $atts['nd_learning_hide_country'];
  $nd_learning_hide_message = $atts['nd_learning_hide_message'];
  $nd_learning_btn_full_width = $atts['nd_learning_btn_full_width'];

  //hide fields class
  if ( $nd_learning_hide_address == 1 ) { $nd_learning_hide_address = "nd_donations_display_none"; }else{ $nd_learning_hide_address = ""; }
  if ( $nd_learning_hide_city == 1 ) { $nd_learning_hide_city = "nd_donations_display_none"; }else{ $nd_learning_hide_city = ""; }
  if ( $nd_learning_hide_country == 1 ) { $nd_learning_hide_country = "nd_donations_display_none"; }else{ $nd_learning_hide_country = ""; }
  if ( $nd_learning_hide_message == 1 ) { $nd_learning_hide_message = "nd_donations_display_none"; }else{ $nd_learning_hide_message = ""; }

  //default value
  if ($nd_donations_layout == '') { $nd_donations_layout = "layout-1"; }
  if ($nd_donations_style == '') { $nd_donations_style = "nd_donations_donation_form_default_style"; }
  if ($nd_donations_width == '') { $nd_donations_width = "nd_donations_width_100_percentage"; }
  if ($nd_donations_color == '') { $nd_donations_color = "#000"; }
  if ($nd_donations_adv_options == '') { $nd_donations_adv_options = "nd_donations_adv_options_no"; }
  if ( $nd_learning_btn_full_width == 1 ) { $nd_learning_btn_full_width = "nd_donations_width_100_percentage nd_donations_text_align_center"; }else{ $nd_learning_btn_full_width = ""; }

  //add style
  if ($nd_donations_style == 'nd_donations_donation_form_opacity_style') {

    $str .= '
      <style type="text/css">
      .nd_donations_single_cause_form_field{ background-color: rgba(255, 255, 255, 0.10) !important; border-color: rgba(0, 0, 0, 0) !important; }
      </style>
    ';  

  }

  //include the layout selected
  include 'layout/'.$nd_donations_layout.'.php';

  return apply_filters('uds_shortcode_out_filter', $str);

}
//END




//vc
add_action( 'vc_before_init', 'nd_donations_donation_form' );
function nd_donations_donation_form() {


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
      "name" => __( "Donation Form", "nd-donations" ),
      "base" => "nd_donations_donation_form",
      'description' => __( 'Add Donation Form', 'nd-donations' ),
      'show_settings_on_create' => true,
      "icon" => esc_url(plugins_url('form.jpg', __FILE__ )),
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
         'type' => 'dropdown',
          "heading" => __( "Style", "nd-donations" ),
          'param_name' => 'nd_donations_style',
          'value' => array( __( 'Default', 'nd-donations' ) => 'nd_donations_donation_form_default_style', __( 'Opacity', 'nd-donations' ) => 'nd_donations_donation_form_opacity_style'),
          'description' => __( "Select the style for your input fields", "nd-donations" )
         ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Color", "nd-donations" ),
            "param_name" => "nd_donations_color",
            "description" => __( "Choose color", "nd-donations" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Advanced Options", "nd-donations" ),
          'param_name' => 'nd_donations_adv_options',
          'value' => array('select'=>'','Yes'=>'nd_donations_adv_options_yes','No'=>'nd_donations_adv_options_no'),
          'description' => __( "Enable advanced options", "nd-donations" )
         ),
           array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Address Field', 'nd-donations' ),
          'param_name' => 'nd_learning_hide_address',
          'value' => array( __( 'Yes', 'nd-donations' ) => '1' ),
          'description' => __( 'Check if you want to hide this field', 'nd-donations' ),
          'dependency' => array( 'element' => 'nd_donations_adv_options', 'value' => array( 'nd_donations_adv_options_yes' ) )
        ),
            array(
          'type' => 'checkbox',
          'heading' => __( 'Hide City Field', 'nd-donations' ),
          'param_name' => 'nd_learning_hide_city',
          'value' => array( __( 'Yes', 'nd-donations' ) => '1' ),
          'description' => __( 'Check if you want to hide this field', 'nd-donations' ),
          'dependency' => array( 'element' => 'nd_donations_adv_options', 'value' => array( 'nd_donations_adv_options_yes' ) )
        ),
             array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Country Field', 'nd-donations' ),
          'param_name' => 'nd_learning_hide_country',
          'value' => array( __( 'Yes', 'nd-donations' ) => '1' ),
          'description' => __( 'Check if you want to hide this field', 'nd-donations' ),
          'dependency' => array( 'element' => 'nd_donations_adv_options', 'value' => array( 'nd_donations_adv_options_yes' ) )
        ),
              array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Message Field', 'nd-donations' ),
          'param_name' => 'nd_learning_hide_message',
          'value' => array( __( 'Yes', 'nd-donations' ) => '1' ),
          'description' => __( 'Check if you want to hide this field', 'nd-donations' ),
          'dependency' => array( 'element' => 'nd_donations_adv_options', 'value' => array( 'nd_donations_adv_options_yes' ) )
        ),
        array(
          'type' => 'checkbox',
          'heading' => __( 'Full Width Button', 'nd-donations' ),
          'param_name' => 'nd_learning_btn_full_width',
          'value' => array( __( 'Yes', 'nd-donations' ) => '1' ),
          'description' => __( 'Check if you want the full width button', 'nd-donations' ),
          'dependency' => array( 'element' => 'nd_donations_adv_options', 'value' => array( 'nd_donations_adv_options_yes' ) )
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