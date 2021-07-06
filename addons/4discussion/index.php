<?php


$nd_donations_comments_enable = get_option('nd_donations_comments_enable');
if ( $nd_donations_comments_enable == 1 and get_option('nicdark_theme_author') == 1 ) {


//add comments tab list in the custom hook
add_action('nd_donations_single_cause_tab_list','nd_donations_single_cause_add_comments_tab_list');
function nd_donations_single_cause_add_comments_tab_list(){

  $nd_donations_comments_tab = '';

  if ( comments_open(get_the_ID()) ) {

    $nd_donations_comments_tab .= '
        <li class="nd_donations_display_inline_block nd_donations_margin_right_40">
            <h4>
              <a class="nd_donations_outline_0 nd_donations_padding_10_0 nd_donations_display_inline_block nd_options_first_font nd_options_color_greydark" href="#nd_donations_single_cause_tab_comments">
                '.__('Comments','nd-donations').'
              </a>
              <span style="background-color:'.nd_donations_get_cause_color(get_the_ID()).';" class="nd_donations_color_white_important nd_donations_float_right nd_donations_font_size_10 nd_donations_margin_left_10 nd_donations_margin_top_8 nd_donations_padding_5">'.get_comments_number(get_the_ID()).'</span>
            </h4>
      </li>
    ';

  }

  
    echo $nd_donations_comments_tab;

}


//add shortcode in the custom hook
add_action('nd_donations_single_cause_tab_content','nd_donations_shortcode_comments');

//START  nd_donations_attendees
function nd_donations_shortcode_comments() {


  echo '<div class="nd_donations_section" id="nd_donations_single_cause_tab_comments">';

    comments_template();
  
  echo '</div>';


  echo '

    <!--START  for post-->
    <style type="text/css">

        #nd_donations_single_cause_tab_comments #nd_options_comments h3 { text-transform:uppercase; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #commentform.comment-form input[type="submit"],
        #nd_donations_single_cause_tab_comments #commentform.comment-form .form-submit input[type="submit"]
        { padding:15px 25px; border-radius:30px !important; font-size:16px; line-height:16px; } 

        /*comment list*/
        #nd_donations_single_cause_tab_comments #nd_options_comments { margin-top: 10px; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul { margin:0px; margin-top:30px; padding: 0px; list-style: none; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li { padding:30px 20px; margin:0px; float: left; width: 100%; border-top:1px solid #f1f1f1; box-sizing:border-box; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li:last-child { border-bottom:1px solid #f1f1f1; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .children { margin:0px; padding: 10px 40px; list-style: none; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .reply a.comment-reply-link { color: #fff; margin-top: 10px; display: inline-block; line-height: 13px; border-radius: 0px; padding: 8px; font-size: 13px; text-transform: uppercase; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .comment-author .fn, 
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .comment-author .fn a { font-weight: bold; font-style: normal; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .comment-author img { border-radius: 100%; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .comment-author { display: table; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .comment-author .fn { display: table-cell; vertical-align: middle; padding: 0px 10px; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .comment-author .says { display: table-cell; vertical-align: middle; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .comment-author img { display: inline; vertical-align: middle; }
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul h3.comment-reply-title { margin-top:40px; }

        /*comment form*/
        #nd_donations_single_cause_tab_comments #nd_options_comments_form h3.comment-reply-title, 
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #respond.comment-respond h3.comment-reply-title { font-weight: bolder; margin-bottom: 10px; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #respond.comment-respond h3.comment-reply-title { margin-top: 0px; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form label, 
        #nd_donations_single_cause_tab_comments #nd_options_comments_form input[type="text"], 
        #nd_donations_single_cause_tab_comments #nd_options_comments_form textarea { float: left; width: 100%; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form input[type="submit"] { border: 0px; color: #fff; border-radius: 3px; margin-top: 10px; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form p { margin: 10px 0px; float: left; width: 100%; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #commentform.comment-form label, 
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #commentform.comment-form input[type="text"], 
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #commentform.comment-form textarea { float: left; width: 100%; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #commentform.comment-form input[type="submit"] { border: 0px; color: #fff; border-radius: 3px; margin-top: 10px; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #commentform.comment-form p { margin: 10px 0px; float: left; width: 100%; }

        /*font and color*/
        #nd_donations_single_cause_tab_comments .nd_options_comments_ul li .reply a.comment-reply-link { background-color: '.nd_donations_get_cause_color(get_the_ID()).'; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form input[type="submit"] { background-color: '.nd_donations_get_cause_color(get_the_ID()).'; }
        #nd_donations_single_cause_tab_comments #nd_options_comments_form #commentform.comment-form input[type="submit"],
        #nd_donations_single_cause_tab_comments #commentform.comment-form .form-submit input[type="submit"] { background-color: '.nd_donations_get_cause_color(get_the_ID()).'; }


    </style>
    <!--END css for post-->

  ';



}

}