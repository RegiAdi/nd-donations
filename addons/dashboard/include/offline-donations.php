<?php


//create Menu
add_action('nd_donations_add_menu_settings','nd_donations_add_offline_donations_page');
function nd_donations_add_offline_donations_page(){

  add_submenu_page( 'nd-donations-settings','ND Offline Donations', __('Offline Donations','nd-donations'), 'manage_options', 'nd-donations-offline-donations-page', 'nd_donations_offline_donations_page' );

}


//call library
if (!class_exists('WP_List_Table')) {
 require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
}
 


//nd_donations_offline_donations
class nd_donations_offline_donations extends WP_List_Table
{
  

  //prepare all donations
  function nd_donations_prepare_offline_donations()
  {
    
    global $wpdb;
    $nd_donations_table_name = $wpdb->prefix.'nd_donations_donations';
    
    //pagination
    $nd_donations_per_page = 10;

    $nd_donations_action_type = "'offline-donation'";
    $nd_donations_columns  = $this->get_columns();
    $nd_donations_hidden   = $this->get_columns_hidden();
    $nd_donations_sortable = $this->get_columns_sortable();
 
    $this->_column_headers = array($nd_donations_columns,$nd_donations_hidden,$nd_donations_sortable);
 
    if (!isset($_REQUEST['paged'])) $nd_donations_paged = 0;
      else $nd_donations_paged = max(0,(intval($_REQUEST['paged'])-1)*10);
 
    if (isset($_REQUEST['orderby'])
        and in_array($_REQUEST['orderby'],array_keys($nd_donations_sortable)))
    $nd_donations_orderby = $_REQUEST['orderby']; else $nd_donations_orderby = 'id';
 
    if (isset($_REQUEST['order'])
        and in_array($_REQUEST['order'],array('asc','desc')))
    $nd_donations_order = $_REQUEST['order']; else $nd_donations_order = 'desc';
 

    $nd_donations_all_orders = $wpdb->get_var(
      "SELECT COUNT(id) FROM $nd_donations_table_name WHERE action_type = $nd_donations_action_type");
 
    
    $this->items = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $nd_donations_table_name ".
            "WHERE action_type = $nd_donations_action_type".
            "ORDER BY $nd_donations_orderby $nd_donations_order ".
            "LIMIT %d OFFSET %d",$nd_donations_per_page, $nd_donations_paged), ARRAY_A);


    //pagination
    $this->set_pagination_args( 
      array(
        'total_items' => $nd_donations_all_orders,                  
        'per_page'    => $nd_donations_per_page                     
      ) 
    );
    


  }
 

 

  //get columns
  function get_columns()
  {
    $nd_donations_columns = array(
      'id' => __('ID Donation','nd-donations'),
      #'id_cause' => __('ID Cause','nd-donations'),
      'title_cause' => __('Title Cause','nd-donations'),
      'donation_value' => __('Value','nd-donations'),
      'user_first_name' => __('Name','nd-donations'),
      'user_last_name' => __('Surname','nd-donations'),
      'paypal_email' => __('Email','nd-donations'),
      #'user_address' => __('Address','nd-donations'),
      #'user_city' => __('City','nd-donations'),
      #'user_country' => __('Country','nd-donations'),
      'date' => __('Time & Date','nd-donations'),
      #'user_message' => __('Message','nd-donations'),
      'paypal_payment_status' => __('Status','nd-donations'),
      'paypal_tx' => __('Transaction','nd-donations'),
      'id_user' => __('ID User','nd-donations'),
      #'qnt' => __('Qnt','nd-donations'),
      #'paypal_currency' => __('Paypal currency','nd-donations'),
      #'action_type' => __('Action type','nd-donations'),
      
    );
    return $nd_donations_columns;
  }
 



  //get_columns_sortable
  function get_columns_sortable()
  {
    $nd_donations_sortable_columns = array(
      'id'       => array('id',true),
      'id_cause'       => array('id_cause',true),
      'id_user'       => array('id_user',true),
    );
    return $nd_donations_sortable_columns;
  }
 
  


  //get_columns_hidden column_default
  function get_columns_hidden() { return array(); }
  function column_default($nd_donations_item,$nd_donations_column_name) {  
    return $nd_donations_item[$nd_donations_column_name]; 
  }


  
  //column_id
  function column_id($nd_donations_item)
  {
   
    $nd_donations_actions = array(
      'edit'   => 
        sprintf('<a href="?page=%s&action=%s&id=%s">'.__('Edit','nd-donations').'</a>',
           $_REQUEST['page'],'edit',$nd_donations_item['id']),
   
      'delete' => 
        sprintf('<a href="?page=%s&action=%s&id=%s">'.__('Delete','nd-donations').'</a>',
           $_REQUEST['page'],'delete',$nd_donations_item['id']),
    );

    return sprintf('%1$s %2$s',$nd_donations_item['id'],
      $this->row_actions($nd_donations_actions));
  }


 
}





//nd_donations_offline_donations_page
function nd_donations_offline_donations_page()
{
  
  $nd_donations_table = new nd_donations_offline_donations();
  $nd_donations_table->nd_donations_prepare_offline_donations();
 
  $nd_donations_page  = filter_input(INPUT_GET,'page' ,FILTER_SANITIZE_STRIPPED);
  $nd_donations_paged = filter_input(INPUT_GET,'paged',FILTER_SANITIZE_NUMBER_INT);


  //declare
  if ( isset($_GET['action']) ) {} else { $_GET['action'] = ''; }


  //DELETE
  if ( sanitize_text_field($_GET['action']) == 'delete' ) {


    $nd_donations_record_to_delete = sanitize_text_field($_GET['id']);

    

    //START delete query
    if ( isset($_POST['nd_donations_delete_record']) ) {

      global $wpdb;

      $nd_donations_table_name = $wpdb->prefix.'nd_donations_donations';

      $wpdb->delete( 
        $nd_donations_table_name, 
        array( 
          'id' => $_POST['nd_donations_delete_record_id']
        ) 
      );

      echo '

        <div id="setting-error-settings_updated" class="error settings-error notice is-dismissible"> 
          <p>
            <strong>'.__('Record Deleted','nd-donations').'</strong>
          </p>
          <button type="button" class="notice-dismiss">
            <span class="screen-reader-text">'.__('Dismiss this notice.','nd-donations').'</span>
          </button>
        </div>

      ';

    }else{

      $nd_donations_edit_page_result = '';

      $nd_donations_edit_page_result .= '

        <div class="wrap">

          <h2>'.__('Delete Record with ID : ','nd-donations').' '.$nd_donations_record_to_delete.'</h2>

          <form method="POST">
            <table class="form-table">
              <tbody>
                <tr>
                  <th scope="row">
                    <label>'.__('ID','nd-donations').'</label>
                  </th>
                  <td>
                    <input name="nd_donations_delete_record_id" readonly value="'.$nd_donations_record_to_delete.'" type="text" class="regular-text">
                    <input type="hidden" name="nd_donations_delete_record" value="nd_donations_delete_record" >
                  </td>
                </tr>
              </tbody>
            </table>

            <p class="submit">
              <input type="submit" class="button button-primary" value="'.__('Confirm Delete','nd-donations').'">
            </p>

          </form>

        </div>';


      echo $nd_donations_edit_page_result;

    }
    //END



  }
  //EDIT
  elseif ( sanitize_text_field($_GET['action']) == 'edit' ){


    if ( isset($_POST['nd_donations_edit_record']) ) {

      global $wpdb;
      $nd_donations_table_name = $wpdb->prefix . 'nd_donations_donations';

      //START INSERT DB
      $nd_donations_edit_record = $wpdb->update( 
        
        $nd_donations_table_name, 
        
        array( 
          'id_cause' => sanitize_text_field($_POST['nd_donations_order_info_id_cause']),
          'title_cause' => sanitize_text_field($_POST['nd_donations_order_info_title_cause']),
          'donation_value' => sanitize_text_field($_POST['nd_donations_order_info_donation_value']),
          'date' => sanitize_text_field($_POST['nd_donations_order_info_date']),
          'qnt' => sanitize_text_field($_POST['nd_donations_order_info_qnt']),
          'paypal_payment_status' => sanitize_text_field($_POST['nd_donations_order_info_paypal_payment_status']),
          'paypal_currency' => sanitize_text_field($_POST['nd_donations_order_info_paypal_currency']),
          'paypal_email' => sanitize_email($_POST['nd_donations_order_info_paypal_email']),
          'paypal_tx' => sanitize_text_field($_POST['nd_donations_order_info_paypal_tx']),
          'id_user' => sanitize_text_field($_POST['nd_donations_order_info_id_user']),
          'user_country' => sanitize_text_field($_POST['nd_donations_order_info_user_country']),
          'user_address' => sanitize_text_field($_POST['nd_donations_order_info_user_address']),
          'user_first_name' => sanitize_text_field($_POST['nd_donations_order_info_user_first_name']),
          'user_last_name' => sanitize_text_field($_POST['nd_donations_order_info_user_last_name']),
          'user_city' => sanitize_text_field($_POST['nd_donations_order_info_user_city']),
          'user_message' => sanitize_text_field($_POST['nd_donations_order_info_user_message']),
          'action_type' => sanitize_text_field($_POST['nd_donations_order_info_action_type']),
        ),
        array( 'ID' => sanitize_text_field($_POST['nd_donations_order_info_id']) )

      );
      
      if ($nd_donations_edit_record){

        echo '

          <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
            <p>
              <strong>'.__('Settings saved.','nd-donations').'</strong>
            </p>
            <button type="button" class="notice-dismiss">
              <span class="screen-reader-text">'.__('Dismiss this notice.','nd-donations').'</span>
            </button>
          </div>

        ';

      }else{

        #$wpdb->show_errors();
        #$wpdb->print_error();

      }

    }



    $nd_donations_record_to_edit = sanitize_text_field($_GET['id']);

    global $wpdb;

    $nd_donations_table_name = $wpdb->prefix.'nd_donations_donations';

    $nd_donations_donation_info = $wpdb->get_row( "SELECT * FROM $nd_donations_table_name WHERE id = ".$nd_donations_record_to_edit." " );


    $nd_donations_edit_page_result = '';


    $nd_donations_edit_page_result .= '

      <div class="wrap">

        <h2>'.__('Edit Record with ID : ','nd-donations').' '.$nd_donations_donation_info->id.'</h2>


        <form method="POST">
          <table class="form-table">
            <tbody>
              

              <tr class="nd_donations_display_none">
                <th scope="row">
                  <label>'.__('ID','nd-donations').'</label>
                </th>
                <td>
                  <input name="nd_donations_order_info_id" readonly value="'.$nd_donations_donation_info->id.'" type="text" class="regular-text">
                  <input type="hidden" name="nd_donations_edit_record" value="edit-record" >
                </td>
              </tr>


              <tr class="nd_donations_display_none">
                <th scope="row">
                  <label>'.__('Id Cause','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_id_cause" class="regular-text" type="text" value="'.$nd_donations_donation_info->id_cause.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('Title Cause','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_title_cause" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->title_cause.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('Donation Value','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_donation_value" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->donation_value.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('Date','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_date" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->date.'">
              </td>
              </tr>


              <tr class="nd_donations_display_none">
                <th scope="row">
                  <label>'.__('Qnt','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_qnt" class="regular-text" type="text" value="'.$nd_donations_donation_info->qnt.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('Payment Status','nd-donations').'</label>
                </th>
                <td>


              <select name="nd_donations_order_info_paypal_payment_status" class="regular-text">
                <option '; if ( $nd_donations_donation_info->paypal_payment_status == 'Pending' ){ $nd_donations_edit_page_result .= 'selected="selected"'; }  $nd_donations_edit_page_result .= 'value="Pending">'.__('Pending','nd-donations').'</option>
                <option '; if ( $nd_donations_donation_info->paypal_payment_status == 'Completed' ){ $nd_donations_edit_page_result .= 'selected="selected"'; }  $nd_donations_edit_page_result .= 'value="Completed">'.__('Completed','nd-donations').'</option>
              </select>


              </td>
              </tr>


              <tr class="nd_donations_display_none">
                <th scope="row">
                  <label>'.__('Paypal Currency','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_paypal_currency" class="regular-text" type="text" value="'.$nd_donations_donation_info->paypal_currency.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('Email','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_paypal_email" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->paypal_email.'">
              </td>
              </tr>

              <tr>
                <th scope="row">
                  <label>'.__('Transaction','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_paypal_tx" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->paypal_tx.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('Id User','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_id_user" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->id_user.'">
              </td>
              </tr>


          

              <tr>
                <th scope="row">
                  <label>'.__('User Address','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_user_address" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->user_address.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User City','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_user_city" readonly class="regular-text"  type="text" value="'.$nd_donations_donation_info->user_city.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User Country','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_user_country" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->user_country.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User First Name','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_user_first_name" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->user_first_name.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User Last Name','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_user_last_name" readonly class="regular-text" type="text" value="'.$nd_donations_donation_info->user_last_name.'">
              </td>
              </tr>


              <tr>
                <th scope="row">
                  <label>'.__('User Message','nd-donations').'</label>
                </th>
                <td>
              <textarea name="nd_donations_order_info_user_message" rows="10" readonly class="regular-text">'.$nd_donations_donation_info->user_message.'</textarea>
              </td>
              </tr>


              <tr class="nd_donations_display_none">
                <th scope="row">
                  <label>'.__('Action Type','nd-donations').'</label>
                </th>
                <td>
              <input name="nd_donations_order_info_action_type" class="regular-text"  type="text" value="'.$nd_donations_donation_info->action_type.'">
              </td>
              </tr>



            </tbody>
          </table>



          <p class="submit">
            <input type="submit" class="button button-primary" value="'.__('Save Changes','nd-donations').'">
          </p>

        </form>

      </div>

    ';



    echo $nd_donations_edit_page_result;


  }
  //DISPLAY ALL ORDERS
  else{

    echo '<div class="wrap">';
    echo '<h2>'.__('Offline Donations','nd-donations').'</h2>';   
    echo '<form id="personale-table" method="GET">';
    echo '<input type="hidden" name="paged" value="'.$nd_donations_paged.'"/>';
      $nd_donations_table->display();
    echo '</form>';
    echo '</div>';

  }


}