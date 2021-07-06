<?php

//recover font family and color
$nd_donations_customizer_font_family_h = get_option( 'nd_options_customizer_font_family_h', 'Montserrat:400,700' );
$nd_donations_font_family_h_array = explode(":", $nd_donations_customizer_font_family_h);
$nd_donations_font_family_h = str_replace("+"," ",$nd_donations_font_family_h_array[0]);
$nd_donations_customizer_font_color_h = get_option( 'nd_options_customizer_font_color_h', '#727475' );

//submit form bg
$nd_donations_customizer_forms_submit_bg = get_option( 'nd_options_customizer_forms_submit_bg', '#444' );


$nd_donations_cause_color = get_post_meta( get_the_ID(), 'nd_donations_meta_box_color', true );




?>


<!--START  for post-->
<style type="text/css">

    
    /*new l2 rules*/
    #nd_donations_single_cause_header_img_title_content { width: 100%; }
    #nd_donations_single_cause_header_img_title_content_2 { display: none; }
    #nd_donations_single_cause_header_img_title { text-align: center; font-size: 60px; font-weight: bold; }
    #nd_donations_single_cause_header_img_filter { background-color: rgb(40 40 40 / 0.5); }
    #nd_donations_single_cause_info_bar_donate_btn a { border-radius: 0px; font-size: 13px; letter-spacing: 1px; padding: 10px 20px; line-height: 13px; margin-top: 10px; font-weight: bold; background-color: #fff !important; color: <?php echo $nd_donations_customizer_font_color_h; ?> !important; }
    #nd_donations_single_cause_info_bar_goal h5.nd_options_color_grey { color: #fff; font-size: 13px; }
    #nd_donations_single_cause_info_bar_donations h5.nd_options_color_grey { color: #fff; font-size: 13px; }
    #nd_donations_single_cause_header_testimonial_section h2 { line-height: 1.5em; }
    #nd_donations_single_cause_tab_list h4 a { font-weight: bold; letter-spacing: 1px; }
    #nd_donations_single_cause_image_loader .nd_donations_height_3 { height: 5px; }
    #nd_donations_single_cause_image_loader p.nd_donations_border_radius_100_percentage { border-radius: 0px; }
    #nd_donations_single_cause_info_bar_goal_btn a { background-color: <?php echo $nd_donations_cause_color; ?> ;}
    .nd_donations_tabs .ui-tabs-active.ui-state-active h4 a {border-bottom: 4px solid <?php echo $nd_donations_cause_color; ?>;line-height: 12px;padding: 0px;margin: 0px;}
    .nd_donations_tabs .ui-tabs-active.ui-state-active { border-bottom-width: 0px; }
    #nd_donations_single_cause_tab_list h4 a { margin: 0px; padding: 0px; }
    #nd_donations_single_cause_tab_list h4 span.nd_donations_margin_top_8 { margin-top: 5px; }
    #nd_donations_single_cause_step_1 div.nd_donations_border_radius_100_percentage,
    #nd_donations_single_cause_step_2 div.nd_donations_border_radius_100_percentage,
    #nd_donations_single_cause_step_3 div.nd_donations_border_radius_100_percentage { border-radius: 0px; }
    input[type="text"].nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected { color:#fff !important; }
    input[type="text"].nd_donations_single_cause_form_donation_value#nd_donations_single_cause_form_donation_value.nd_donations_fixed_value_donation_selected::placeholder{ color:#fff !important; }
    #nd_donations_single_cause_step_1 h4,
    #nd_donations_single_cause_step_2 h4,
    #nd_donations_single_cause_step_3 h4 a { text-transform: initial; font-weight: bold; }
    #nd_donations_single_cause_step_2 h4 a { font-weight: normal; }
    #nd_donations_single_cause_form_donation_checkout_submit { font-size: 13px;line-height: 13px;letter-spacing: 1px;font-weight: bold;padding: 10px 20px;border-radius: 0px; }
    #nd_donations_single_cause_tab_offline_donation button { font-size: 13px;line-height: 13px;letter-spacing: 1px;font-weight: bold;border-radius: 0;padding: 10px 20px; }
    #nd_donations_single_cause_form_donation_paypal_submit { font-size: 13px;line-height: 13px;letter-spacing: 1px;font-weight: bold;border-radius: 0;padding: 10px 20px; }
    .nd_donations_single_cause_bottom_pagination.nd_donations_border_bottom_1_solid_greydark { border-bottom-width: 0px; }
    body.single-causes #nd_options_comments_form #respond .form-submit input[type="submit"].submit#submit {font-size: 13px !important;letter-spacing: 1px !important;line-height: 13px !important;padding: 10px 20px !important;border-radius: 0px !important;font-weight: bold !important;}


    /*sidebar*/
    .nd_donations_sidebar .widget { margin-bottom: 40px; }
    .nd_donations_sidebar .widget img, .nd_donations_sidebar .widget select { max-width: 100%; }
    .nd_donations_sidebar .widget h3 { margin-bottom: 20px; font-weight: normal; }

    /*search*/
    .nd_donations_sidebar .widget.widget_search input[type="text"] { width: 100%; }
    .nd_donations_sidebar .widget.widget_search input[type="submit"] { margin-top: 20px; }

    /*list*/
    .nd_donations_sidebar .widget ul { margin: 0px; padding: 0px; list-style: none; }
    .nd_donations_sidebar .widget > ul > li { padding: 10px; border-bottom: 1px solid #f1f1f1; }
    .nd_donations_sidebar .widget > ul > li:last-child { padding-bottom: 0px; border-bottom: 0px solid #f1f1f1; }
    .nd_donations_sidebar .widget ul li { padding: 10px; }
    .nd_donations_sidebar .widget ul.children { padding: 10px; }
    .nd_donations_sidebar .widget ul.children:last-child { padding-bottom: 0px; }

    /*calendar*/
    .nd_donations_sidebar .widget.widget_calendar table { text-align: center; background-color: #fff; width: 100%; border: 1px solid #f1f1f1; line-height: 20px; }
    .nd_donations_sidebar .widget.widget_calendar table th { padding: 10px 5px; font-weight: normal; }
    .nd_donations_sidebar .widget.widget_calendar table td { padding: 10px 5px; }
    .nd_donations_sidebar .widget.widget_calendar table tbody td a { color: #fff; padding: 5px; border-radius: 0px; }
    .nd_donations_sidebar .widget.widget_calendar table tfoot td a { color: #fff; background-color: #444444; padding: 5px; border-radius: 0px; font-size: 13px; }
    .nd_donations_sidebar .widget.widget_calendar table tfoot td { padding-bottom: 20px; }
    .nd_donations_sidebar .widget.widget_calendar table tfoot td#prev { text-align: right; }
    .nd_donations_sidebar .widget.widget_calendar table tfoot td#next { text-align: left; }
    .nd_donations_sidebar .widget.widget_calendar table caption { font-size: 20px; font-weight: normal; background-color: #f9f9f9; padding: 20px; border: 1px solid #f1f1f1; border-bottom: 0px; }

    /*color calendar*/
    .nd_donations_sidebar .widget.widget_calendar table thead { color: <?php echo $nd_donations_customizer_font_color_h;  ?>; }
    .nd_donations_sidebar .widget.widget_calendar table tbody td a { background-color: <?php echo $nd_donations_customizer_forms_submit_bg; ?>; }
    .nd_donations_sidebar .widget.widget_calendar table caption { color: <?php echo $nd_donations_customizer_font_color_h;  ?>; font-family: '<?php echo $nd_donations_font_family_h; ?>', sans-serif; }

    /*menu*/
    .nd_donations_sidebar .widget div ul { margin: 0px; padding: 0px; list-style: none; }
    .nd_donations_sidebar .widget div > ul > li { padding: 10px; border-bottom: 1px solid #f1f1f1; }
    .nd_donations_sidebar .widget div > ul > li:last-child { padding-bottom: 0px; border-bottom: 0px solid #f1f1f1; }
    .nd_donations_sidebar .widget div ul li { padding: 10px; }
    .nd_donations_sidebar .widget div ul.sub-menu { padding: 10px; }
    .nd_donations_sidebar .widget div ul.sub-menu:last-child { padding-bottom: 0px; }

    /*tag*/
    .nd_donations_sidebar .widget.widget_tag_cloud a { padding: 5px 10px; border: 1px solid #f1f1f1; border-radius: 0px; display: inline-block; margin: 5px; margin-left: 0px; font-size: 13px !important; line-height: 20px; }

</style>
<!--END css for post-->