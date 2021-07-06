<?php


add_action('customize_register','nd_donations_customizer_plugin_colors');
function nd_donations_customizer_plugin_colors( $wp_customize ) {
  

	//ADD section 1
	$wp_customize->add_section( 'nd_donations_customizer_plugin_colors' , array(
	  'title' => 'Plugin Colors',
	  'priority'    => 10,
	  'panel' => 'nd_donations_customizer_donations',
	) );


	//color
	$wp_customize->add_setting( 'nd_donations_customizer_color_green', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_donations_customizer_color_green', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Green Color' ),
	      'description' => __('Select color for your green elements','nd-donations'),
	      'section' => 'nd_donations_customizer_plugin_colors',
	    )
	  )
	);




	//color
	$wp_customize->add_setting( 'nd_donations_customizer_color_red', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_donations_customizer_color_red', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Red Color' ),
	      'description' => __('Select color for your red elements','nd-donations'),
	      'section' => 'nd_donations_customizer_plugin_colors',
	    )
	  )
	);


	//color
	$wp_customize->add_setting( 'nd_donations_customizer_color_greydark', array(
	  'type' => 'option', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => '',
	  'sanitize_js_callback' => '', // Basically to_json.
	) );
	$wp_customize->add_control(
	  new WP_Customize_Color_Control(
	    $wp_customize, // WP_Customize_Manager
	    'nd_donations_customizer_color_greydark', // Setting id
	    array( // Args, including any custom ones.
	      'label' => __( 'Greydark Color' ),
	      'description' => __('Select color for your greydark elements','nd-donations'),
	      'section' => 'nd_donations_customizer_plugin_colors',
	    )
	  )
	);



}





//css inline
function nd_donations_customizer_add_colors() { 
?>

	<?php

	//get colors
	$nd_donations_customizer_color_green = get_option( 'nd_donations_customizer_color_green', '#00baa3' );
	$nd_donations_customizer_color_red = get_option( 'nd_donations_customizer_color_red', '#d55342' );
	$nd_donations_customizer_color_greydark = get_option( 'nd_donations_customizer_color_greydark', '#444' );

	?>

    <style type="text/css">

    	/*green*/
		.nd_donations_bg_green { background-color: <?php echo $nd_donations_customizer_color_green;  ?>; }
		
		/*red*/
		.nd_donations_bg_red { background-color: <?php echo $nd_donations_customizer_color_red;  ?>; }
		.nd_donations_single_cause_form_validation_errors { background-color: <?php echo $nd_donations_customizer_color_red;  ?>; }

		/*greydark*/
		.nd_donations_bg_greydark { background-color: <?php echo $nd_donations_customizer_color_greydark;  ?>; }
		.nd_donations_tabs .ui-tabs-active.ui-state-active { border-bottom: 2px solid <?php echo $nd_donations_customizer_color_greydark;  ?>; }
       
    </style>
    

<?php
}
add_action('wp_head', 'nd_donations_customizer_add_colors');
