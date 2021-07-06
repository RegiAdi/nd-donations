<?php

///////////////////////////////////////////////////CAUSES///////////////////////////////////////////////////////////////
function nd_donations_create_post_type_causes() {

    if ( get_option('nd_donations_plugin_slug') == '' ) {
        $nd_donations_plugin_slug = 'causes';
    }else{
        $nd_donations_plugin_slug = get_option('nd_donations_plugin_slug');
    }

    register_post_type('causes',
        array(
            'labels' => array(
                'name' => __('Causes', 'nd-donations'),
                'singular_name' => __('Causes', 'nd-donations')
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => $nd_donations_plugin_slug ),
            'menu_icon'   => 'dashicons-universal-access',
            'supports' => array('title', 'editor', 'thumbnail' , 'excerpt' , 'comments' )
        )
    );
}
add_action('init', 'nd_donations_create_post_type_causes');

