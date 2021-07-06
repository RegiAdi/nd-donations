<?php


//START ELEMENT POST GRID
class nd_donations_causes_element extends \Elementor\Widget_Base {

  public function get_name() { return 'causes'; }
  public function get_title() { return __( 'Causes', 'nd-donations' ); }
  public function get_icon() { return 'fa fa-hands-helping'; }
  public function get_categories() { return [ 'nd-donations' ]; }

  /*START CONTROLS*/
  protected function _register_controls() {

    /*Create Tab*/
    $this->start_controls_section(
      'content_section',
      [
        'label' => __( 'Main Options', 'nd-donations' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'causes_layout',
      [
        'label' => __( 'Layout', 'nd-donations' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'layout-1',
        'options' => [
          'layout-1'  => __( 'Layout 1', 'nd-donations' ),
          'layout-2' => __( 'Layout 2', 'nd-donations' ),
          'layout-3' => __( 'Layout 3', 'nd-donations' ),
        ],
      ]
    );

    $this->add_control(
      'causes_width',
      [
        'label' => __( 'Width', 'nd-donations' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'nd_donations_width_100_percentage',
        'options' => [
          'nd_donations_width_100_percentage'  => __( '1 Column', 'nd-donations' ),
          'nd_donations_width_50_percentage' => __( '2 Columns', 'nd-donations' ),
          'nd_donations_width_33_percentage'  => __( '3 Columns', 'nd-donations' ),
          'nd_donations_width_25_percentage' => __( '4 Columns', 'nd-donations' ),
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Image_Size::get_type(),
      [
        'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
        'exclude' => [ 'custom' ],
        'include' => [],
        'default' => 'large',
      ]
    );

    $this->add_control(
      'causes_order',
      [
        'label' => __( 'Order', 'nd-donations' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'DESC',
        'options' => [
          'DESC'  => __( 'DESC', 'nd-donations' ),
          'ASC' => __( 'ASC', 'nd-donations' ),
        ],
      ]
    );

    $this->add_control(
      'causes_orderby',
      [
        'label' => __( 'Order By', 'nd-donations' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'date',
        'options' => [
          'ID'  => __( 'ID', 'nd-donations' ),
          'author' => __( 'Author', 'nd-donations' ),
          'title'  => __( 'Title', 'nd-donations' ),
          'name' => __( 'Name', 'nd-donations' ),
          'type'  => __( 'Type', 'nd-donations' ),
          'date' => __( 'Date', 'nd-donations' ),
          'modified'  => __( 'Modified', 'nd-donations' ),
          'rand' => __( 'Random', 'nd-donations' ),
          'comment_count'  => __( 'Comment Count', 'nd-donations' ),
        ],
      ]
    );

    $this->add_control(
      'causes_qnt',
      [
        'label' => __( 'Posts Per Page', 'nd-donations' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => -1,
        'max' => 20,
        'step' => 1,
        'default' => 3,
      ]
    );


    $this->add_control(
      'causes_id',
      [
        'label' => __( 'ID', 'nd-elements' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 1,
        'max' => 9000,
        'step' => 1,
      ]
    );
    
    $this->end_controls_section();

  }
  //END CONTROLS


 
  /*START RENDER*/
  protected function render() {

    $nd_donations_result = '';

    //add script
    wp_enqueue_script('masonry');
    wp_enqueue_script('nd_donations_postgrid_js', esc_url( plugins_url('js/causes.js', __FILE__ )) );

    //get datas
    $nd_donations_settings = $this->get_settings_for_display();
    $nd_donations_postgrid_order = $nd_donations_settings['causes_order'];
    $nd_donations_postgrid_orderby = $nd_donations_settings['causes_orderby'];
    $causes_qnt = $nd_donations_settings['causes_qnt'];
    $causes_width = $nd_donations_settings['causes_width'];
    $causes_layout = $nd_donations_settings['causes_layout'];
    $causes_image_size = $nd_donations_settings['thumbnail_size'];
    $causes_id = $nd_donations_settings['causes_id'];

    //default values
    if ($causes_width == '') { $causes_width = "nd_donations_width_100_percentage"; }
    if ($causes_layout == '') { $causes_layout = "layout-1"; }
    if ($causes_qnt == '') { $causes_qnt = 3; }
    if ($nd_donations_postgrid_order == '') { $nd_donations_postgrid_order = 'DESC'; }
    if ($nd_donations_postgrid_orderby == '') { $nd_donations_postgrid_orderby = 'date'; }
    if ($causes_image_size == '') { $causes_image_size = 'large'; }

    //args
    $args = array(
      'post_type' => 'causes',
      'posts_per_page' => $causes_qnt,
      'order' => $nd_donations_postgrid_order,
      'orderby' => $nd_donations_postgrid_orderby,
      'p' => $causes_id,
    );
    $the_query = new WP_Query( $args );

    //START LAYOUT
    $nd_donations_result .= '
    <div class="nd_donations_section nd_donations_masonry_content">';

      while ( $the_query->have_posts() ) : $the_query->the_post();

        //info
        $nd_donations_id = get_the_ID(); 
        $nd_donations_title = get_the_title();
        $nd_donations_excerpt = get_the_excerpt();
        $nd_donations_permalink = get_permalink( $nd_donations_id );

        //include the layout selected
  		include 'layout/'.$causes_layout.'.php';

      endwhile;

    $nd_donations_result .= '
    </div>';
    //END LAYOUT


    wp_reset_postdata();

    echo $nd_donations_result;

  }
  //END RENDER


}
//END ELEMENT POST GRID
