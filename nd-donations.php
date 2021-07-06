<?php
/*
Plugin Name:       Donations
Description:       The plugin is used to manage your donations. To get started: 1) Click the "Activate" link to the left of this description. 2) Follow the documentation for installation for use the plugin in the better way.
Version:           1.7
Plugin URI:        https://nicdark.com
Author:            Nicdark
Author URI:        https://nicdark.com
License:           GPLv2 or later
*/

///////////////////////////////////////////////////TRANSLATIONS///////////////////////////////////////////////////////////////

//translation
function nd_donations_load_textdomain()
{
  load_plugin_textdomain("nd-donations", false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'nd_donations_load_textdomain');


///////////////////////////////////////////////////DB///////////////////////////////////////////////////////////////
register_activation_hook( __FILE__, 'nd_donations_create_donations_db' );
function nd_donations_create_donations_db()
{
    global $wpdb;

    $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';

    $nd_donations_sql = "CREATE TABLE $nd_donations_table_name (
      id int(11) NOT NULL AUTO_INCREMENT,
      id_cause int(11) NOT NULL,
      title_cause varchar(255) NOT NULL,
      donation_value int(11) NOT NULL,
      date varchar(255) NOT NULL,
      qnt int(11) NOT NULL,
      paypal_payment_status varchar(255) NOT NULL,
      paypal_currency varchar(255) NOT NULL,
      paypal_email varchar(255) NOT NULL,
      paypal_tx varchar(255) NOT NULL,
      id_user int(11) NOT NULL,
      user_country varchar(255) NOT NULL,
      user_address varchar(255) NOT NULL,
      user_first_name varchar(255) NOT NULL,
      user_last_name varchar(255) NOT NULL,
      user_city varchar(255) NOT NULL,
      user_message varchar(255) NOT NULL,
      action_type varchar(255) NOT NULL,
      UNIQUE KEY id (id)
    );";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $nd_donations_sql );
}


///////////////////////////////////////////////////IMAGE SIZE///////////////////////////////////////////////////////////////

//create custom size for causes post grid
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'nd_donations_img_740_501', 740, 500, true );
  add_image_size( 'nd_donations_img_200_200', 200, 200, true ); 
}


///////////////////////////////////////////////////CSS STYLE///////////////////////////////////////////////////////////////

//add custom css
function nd_donations_scripts() {
  
  //basic css plugin
  wp_enqueue_style( 'nd_donations_style', esc_url(plugins_url('assets/css/style.css', __FILE__ )) );

  wp_enqueue_script('jquery');
  
}
add_action( 'wp_enqueue_scripts', 'nd_donations_scripts' );


///////////////////////////////////////////////////GET TEMPLATE ///////////////////////////////////////////////////////////////

//single cause
function nd_donations_get_cause_template($nd_donations_single_cause_template) {
     global $post;

     if ($post->post_type == 'causes') {
          $nd_donations_single_cause_template = dirname( __FILE__ ) . '/templates/single-cause.php';
     }
     return $nd_donations_single_cause_template;
}
add_filter( 'single_template', 'nd_donations_get_cause_template' );

//archive causes
function nd_donations_get_archive_template($nd_donations_archive_template) {
     global $post; 

     if ( is_post_type_archive('causes') ) {
          $nd_donations_archive_template = dirname( __FILE__ ) . '/templates/archive.php';
     }
     return $nd_donations_archive_template;
}
add_filter( 'template_include', 'nd_donations_get_archive_template' );

//update theme options
function nd_donations_theme_setup_update(){
    update_option( 'nicdark_theme_author', 0 );
}
add_action( 'after_switch_theme' , 'nd_donations_theme_setup_update');


///////////////////////////////////////////////////CPT///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "inc/cpt/*.php" ) as $file ){
  include_once $file;
}


///////////////////////////////////////////////////SHORTCODES ///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "inc/shortcodes/*.php" ) as $file ){
  include_once $file;
}


///////////////////////////////////////////////////ADDONS ///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "addons/*/index.php" ) as $file ){
  include_once $file;
}


///////////////////////////////////////////////////FUNCTIONS///////////////////////////////////////////////////////////////
require_once dirname( __FILE__ ) . '/inc/functions/functions.php';


///////////////////////////////////////////////////METABOX ///////////////////////////////////////////////////////////////
foreach ( glob ( plugin_dir_path( __FILE__ ) . "inc/metabox/*.php" ) as $file ){
  include_once $file;
}


///////////////////////////////////////////////////PLUGIN SETTINGS ///////////////////////////////////////////////////////////
require_once dirname( __FILE__ ) . '/inc/admin/plugin-settings.php';


//function for get plugin version
function nd_donations_get_plugin_version(){

    $nd_donations_plugin_data = get_plugin_data( __FILE__ );
    $nd_donations_plugin_version = $nd_donations_plugin_data['Version'];

    return $nd_donations_plugin_version;

}



