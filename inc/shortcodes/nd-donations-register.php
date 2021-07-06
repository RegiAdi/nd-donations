<?php


function nd_donations_registration_form( $nd_donations_username, $nd_donations_password, $nd_donations_email, $nd_donations_website, $nd_donations_first_name, $nd_donations_last_name, $nd_donations_nickname, $nd_donations_bio ) {
     
    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    

    <p>
      <label class="nd_donations_section nd_donations_margin_top_20">'.__('Username *','nd-donations').'</label>
      <input type="text" name="nd_donations_username" class=" nd_donations_section" value="' . ( isset( $_POST['nd_donations_username'] ) ? $nd_donations_username : null ) . '">
    </p>
    <p>
      <label class="nd_donations_section nd_donations_margin_top_20">'.__('Password *','nd-donations').'</label>
      <input type="password" name="nd_donations_password" class=" nd_donations_section" value="' . ( isset( $_POST['nd_donations_password'] ) ? $nd_donations_password : null ) . '">
    </p>
    <p>
      <label class="nd_donations_section nd_donations_margin_top_20">'.__('Email *','nd-donations').'</label>
      <input type="text" name="nd_donations_email" class=" nd_donations_section" value="' . ( isset( $_POST['nd_donations_email']) ? $nd_donations_email : null ) . '">
    </p>
    <p>
      <label class="nd_donations_section nd_donations_margin_top_20">'.__('Website','nd-donations').'</label>
      <input type="text" name="nd_donations_website" class=" nd_donations_section" value="' . ( isset( $_POST['nd_donations_website']) ? $nd_donations_website : null ) . '">
    </p>
    <p>
      <label class="nd_donations_section nd_donations_margin_top_20">'.__('First Name','nd-donations').'</label>
      <input type="text" name="nd_donations_first_name" class="nd_donations_section" value="' . ( isset( $_POST['nd_donations_first_name']) ? $nd_donations_first_name : null ) . '">
    </p>
    <p>
      <label class="nd_donations_section nd_donations_margin_top_20">'.__('Last Name','nd-donations').'</label>
      <input type="text" name="nd_donations_last_name" class="nd_donations_section" value="' . ( isset( $_POST['nd_donations_last_name']) ? $nd_donations_last_name : null ) . '">
    </p>
    <p>
      <label class="nd_donations_section nd_donations_margin_top_20">'.__('Nickname','nd-donations').'</label>
      <input type="text" name="nd_donations_nickname" class="nd_donations_section" value="' . ( isset( $_POST['nd_donations_nickname']) ? $nd_donations_nickname : null ) . '">
    </p>
    <p>
      <label class="nd_donations_section nd_donations_margin_top_20">'.__('About / Bio','nd-donations').'</label>
      <textarea class="nd_donations_section" name="nd_donations_bio">' . ( isset( $_POST['nd_donations_bio']) ? $nd_donations_bio : null ) . '</textarea>
    </p>
    <input class="nd_donations_section nd_donations_margin_top_20" type="submit" name="submit" value="'.__('REGISTER','nd-donations').'"/>
    </form>
    ';
}




function nd_donations_registration_validation( $nd_donations_username, $nd_donations_password, $nd_donations_email, $nd_donations_website, $nd_donations_first_name, $nd_donations_last_name, $nd_donations_nickname, $nd_donations_bio )  {


  global $nd_donations_reg_errors;
  $nd_donations_reg_errors = new WP_Error;

  if ( empty( $nd_donations_username ) || empty( $nd_donations_password ) || empty( $nd_donations_email ) ) {
      $nd_donations_reg_errors->add('field', 'Required form field is missing');
  }


  if ( 4 > strlen( $nd_donations_username ) ) {
      $nd_donations_reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
  }

  if ( username_exists( $nd_donations_username ) )
      $nd_donations_reg_errors->add('user_name', 'Sorry, that username already exists!');

    if ( ! validate_username( $nd_donations_username ) ) {
      $nd_donations_reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
  }

  if ( 5 > strlen( $nd_donations_password ) ) {
          $nd_donations_reg_errors->add( 'nd_donations_password', 'Password length must be greater than 5' );
      }

      if ( !is_email( $nd_donations_email ) ) {
      $nd_donations_reg_errors->add( 'email_invalid', 'Email is not valid' );
  }

  if ( email_exists( $nd_donations_email ) ) {
      $nd_donations_reg_errors->add( 'nd_donations_email', 'Email Already in use' );
  }

  if ( ! empty( $nd_donations_website ) ) {
      if ( ! filter_var( $nd_donations_website, FILTER_VALIDATE_URL ) ) {
          $nd_donations_reg_errors->add( 'nd_donations_website', 'Website is not a valid URL' );
      }
  }

  if ( is_wp_error( $nd_donations_reg_errors ) ) {
   
      foreach ( $nd_donations_reg_errors->get_error_messages() as $nd_donations_error ) {
       
          echo '<div class="nd_donations_margin_top_20">';
          echo '<strong class="nd_donations_text_decoration_underline">'.__('ERROR','nd-donations').'</strong> : ';
          echo $nd_donations_error;
          echo '</div>';
           
      }
   
  }

}


function nd_donations_complete_registration() {
    global $nd_donations_reg_errors, $nd_donations_username, $nd_donations_password, $nd_donations_email, $nd_donations_website, $nd_donations_first_name, $nd_donations_last_name, $nd_donations_nickname, $nd_donations_bio;
    if ( 1 > count( $nd_donations_reg_errors->get_error_messages() ) ) {
        $nd_donations_userdata = array(
        'user_login'    =>   $nd_donations_username,
        'user_email'    =>   $nd_donations_email,
        'user_pass'     =>   $nd_donations_password,
        'user_url'      =>   $nd_donations_website,
        'first_name'    =>   $nd_donations_first_name,
        'last_name'     =>   $nd_donations_last_name,
        'nickname'      =>   $nd_donations_nickname,
        'description'   =>   $nd_donations_bio,
        );
        $nd_donations_user = wp_insert_user( $nd_donations_userdata );
        echo '<div class="nd_donations_section nd_donations_color_white_important nd_donations_bg_green nd_donations_padding_20 nd_donations_margin_top_20 nd_donations_box_sizing_border_box nd_donations_border_radius_3"><span class="nd_options_first_font">'.__('REGISTRATION COMPLETED','nd-donations').'</span> : '.__('Please for make the login using the form on the left.','nd-donations').'</div>';   
    }
}



function nd_donations_custom_registration_function() {
    if ( isset($_POST['submit'] ) ) {


        nd_donations_registration_validation(
        $_POST['nd_donations_username'],
        $_POST['nd_donations_password'],
        $_POST['nd_donations_email'],
        $_POST['nd_donations_website'],
        $_POST['nd_donations_first_name'],
        $_POST['nd_donations_last_name'],
        $_POST['nd_donations_nickname'],
        $_POST['nd_donations_bio']
        );
         
        // sanitize user form input
        global $nd_donations_username, $nd_donations_password, $nd_donations_email, $nd_donations_website, $nd_donations_first_name, $nd_donations_last_name, $nd_donations_nickname, $nd_donations_bio;
        $nd_donations_username   =   sanitize_user( $_POST['nd_donations_username'] );
        $nd_donations_password   =   esc_attr( $_POST['nd_donations_password'] );
        $nd_donations_email      =   sanitize_email( $_POST['nd_donations_email'] );
        $nd_donations_website    =   esc_url( $_POST['nd_donations_website'] );
        $nd_donations_first_name =   sanitize_text_field( $_POST['nd_donations_first_name'] );
        $nd_donations_last_name  =   sanitize_text_field( $_POST['nd_donations_last_name'] );
        $nd_donations_nickname   =   sanitize_text_field( $_POST['nd_donations_nickname'] );
        $nd_donations_bio        =   esc_textarea( $_POST['nd_donations_bio'] );
 
        // call @function complete_registration to create the user
        // only when no WP_error is found
        nd_donations_complete_registration(
        $nd_donations_username,
        $nd_donations_password,
        $nd_donations_email,
        $nd_donations_website,
        $nd_donations_first_name,
        $nd_donations_last_name,
        $nd_donations_nickname,
        $nd_donations_bio
        );
    }


    if ( isset( $nd_donations_username ) ) {

    }else{

      $nd_donations_username = ''; $nd_donations_password = ''; $nd_donations_email = ''; $nd_donations_website = '';
      $nd_donations_first_name = ''; $nd_donations_last_name = ''; $nd_donations_nickname = ''; $nd_donations_bio = '';

    }
 
    

    nd_donations_registration_form(
        $nd_donations_username,
        $nd_donations_password,
        $nd_donations_email,
        $nd_donations_website,
        $nd_donations_first_name,
        $nd_donations_last_name,
        $nd_donations_nickname,
        $nd_donations_bio
        );
}





add_shortcode( 'nd_donations_register', 'nd_donations_shortcode_register' );
function nd_donations_shortcode_register() {

    ob_start();

    //call function
    nd_donations_custom_registration_function();
    return ob_get_clean();

}



