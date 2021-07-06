<?php

$nd_donations_visualcomposer_enable = get_option('nd_donations_visualcomposer_enable');
if ( $nd_donations_visualcomposer_enable == 1 and get_option('nicdark_theme_author') == 1 ) {

//include all shortcodes
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
	include_once $file;
}

}