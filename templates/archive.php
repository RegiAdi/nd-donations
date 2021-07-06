<?php


get_header( );

wp_enqueue_script('masonry');

//causes archive
if ( is_post_type_archive('causes') ){
	include "archive-causes.php";
}


get_footer( ); ?>
