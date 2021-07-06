<?php


add_action('customize_register','nd_donations_customizer_archive_causes');
function nd_donations_customizer_archive_causes( $wp_customize ) {
  

	//ADD section 1
	$wp_customize->add_section( 'nd_donations_customizer_archive_causes_section' , array(
	  'title' => 'Archive Causes',
	  'priority'    => 10,
	  'panel' => 'nd_donations_customizer_donations',
	) );


	//Disable Header
	$wp_customize->add_setting( 'nd_donations_customizer_archive_causes_header_image_display', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control( 'nd_donations_customizer_archive_causes_header_image_display', array(
	  'label' => __( 'Disable Header Section' ),
	  'type' => 'checkbox',
	  'section' => 'nd_donations_customizer_archive_causes_section',
	) );

	
	//causes Header Image
	$wp_customize->add_setting( 'nd_donations_customizer_archive_causes_header_image', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'nd_donations_customizer_archive_causes_header_image', 
			array(
			  'label' => __( 'Causes Header Image', 'nd-donations' ),
			  'section' => 'nd_donations_customizer_archive_causes_section',
			  'mime_type' => 'image',
			) 
		) 
	);



	//image position
	$wp_customize->add_setting( 'nd_donations_customizer_archive_causes_header_image_position', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control( 'nd_donations_customizer_archive_causes_header_image_position', array(
	  'label' => __( 'Image Position' ),
	  'type' => 'select',
	  'section' => 'nd_donations_customizer_archive_causes_section',
	  'choices' => array(
	        'nd_donations_background_position_center_top' => 'Position Top',
	        'nd_donations_background_position_center_bottom' => 'Position Bottom',
	        'nd_donations_background_position_center' => 'Position Center',
	    ),
	) );



}
