<?php


add_action('customize_register','nd_donations_customizer_plugin_styles');
function nd_donations_customizer_plugin_styles( $wp_customize ) {
  

	//ADD section 1
	$wp_customize->add_section( 'nd_donations_customizer_plugin_styles' , array(
	  'title' => 'Plugin Styles',
	  'priority'    => 10,
	  'panel' => 'nd_donations_customizer_donations',
	) );


	
	//styles
	$wp_customize->add_setting( 'nd_donations_customizer_plugin_style', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control( 'nd_donations_customizer_plugin_style', array(
	  'label' => __( 'Select Style' ),
	  'type' => 'select',
	  'section' => 'nd_donations_customizer_plugin_styles',
	  'choices' => array(
	        'default-style' => 'Default Plugin Style',
	        'custom-style-1' => 'Custom Style 1',
	        'custom-style-2' => 'Custom Style 2',
	    ),
	) );




	



}





//css inline
function nd_donations_customizer_add_style() { 

	//get colors
	$nd_donations_customizer_plugin_style = get_option( 'nd_donations_customizer_plugin_style' );
	if ( $nd_donations_customizer_plugin_style == '' ) { $nd_donations_customizer_plugin_style = 'default-style'; }

	include $nd_donations_customizer_plugin_style.".php";

}
add_action('wp_head', 'nd_donations_customizer_add_style');
