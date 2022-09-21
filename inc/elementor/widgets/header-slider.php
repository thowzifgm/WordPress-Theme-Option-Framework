<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Header_Slider_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'header-slider';
  }
  public function get_title() {
    return 'Header Slider';
  }
  public function get_icon() {
    return 'eicon-slides';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {
    $this->start_controls_section( 'header_slider_section', [
      'label' => esc_html__( 'Header Slider', 'themezinho' ),
      'tab' => Controls_Manager::TAB_CONTENT
    ] );

    $this->add_control(
      'prev_label',
      array(
        'label' => __( 'Slider Prev Label', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

    $this->add_control(
      'next_label',
      array(
        'label' => __( 'Slider Next Label', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );
	  
	  
	   $this->add_control(
      'display_scrolldown',
      array(
        'label' => __( 'Display Scrolldown', 'themezinho' ),
        'type' => Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'themezinho' ),
		'label_off' => __( 'Hide', 'themezinho' ),
        'default' => 'yes',
        'return_value' => 'yes',
      )
    );


    $this->add_control( 'slider_items', [
      'type' => Controls_Manager::REPEATER,
      'seperator' => 'before',
      'deafult' => '',
      'fields' => [

        [
          'name' => 'slider_image',
          'label' => esc_html__( 'Image', 'themezinho' ),
          'type' => Controls_Manager::MEDIA,
          'default' => ''
        ],
        [
          'name' => 'slider_mob_image',
          'label' => esc_html__( 'Responsive Mobile Image', 'themezinho' ),
          'type' => Controls_Manager::MEDIA,
          'default' => ''
        ],
        [
          'name' => 'slider_tagline',
          'label' => esc_html__( 'Tagline', 'themezinho' ),
          'type' => Controls_Manager::TEXT,
          'default' => '',
        ],
        [
          'name' => 'slider_title',
          'label' => esc_html__( 'Title', 'themezinho' ),
          'type' => Controls_Manager::TEXT,
          'default' => '',
        ],
        [
          'name' => 'slider_desc',
          'label' => esc_html__( 'Description', 'themezinho' ),
          'type' => Controls_Manager::TEXTAREA,
          'default' => '',

        ],
        [
          'name' => 'slider_link_label',
          'label' => esc_html__( 'Link Label', 'themezinho' ),
          'type' => Controls_Manager::TEXT,
          'default' => '',

        ],
        [
          'name' => 'slider_link_url',
          'label' => esc_html__( 'Link URL', 'themezinho' ),
          'type' => Controls_Manager::TEXT,
          'default' => '',

        ],

      ],
      'title_field' => '{{slider_title}}'
    ] );
    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/


  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
<section class="slider">
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <?php foreach ( $settings[ 'slider_items' ] as $item ) { ?>
      <div class="swiper-slide bg-image" <?php if($item['slider_image'][ 'url' ]){ ?> data-background="<?php echo esc_url($item['slider_image'][ 'url' ]); ?>" <?php } ?>>
        <div class="mobile-slide bg-image" <?php if($item['slider_mob_image'][ 'url' ]){ ?>data-background="<?php echo $item[ 'slider_mob_image' ][ 'url' ] ?>"  <?php } ?>></div>
        <div class="inner">
          <?php if ( $item[ 'slider_tagline' ] ) { ?>
          <h5 data-swiper-parallax="-600"><?php echo $item[ 'slider_tagline' ] ?></h5>
          <?php } ?>
          <?php if ( $item[ 'slider_title' ] ) { ?>
          <h2 data-swiper-parallax="-400"><?php echo $item[ 'slider_title' ] ?></h2>
          <?php } ?>
          <?php if ( $item[ 'slider_desc' ] ) { ?>
          <p data-swiper-parallax="-200"><?php echo $item[ 'slider_desc' ] ?></p>
          <?php } ?>
          <?php if ( $item[ 'slider_link_label' ] ) { ?>
          <a href="<?php echo $item[ 'slider_link_url' ] ?>" class="link"><?php echo $item[ 'slider_link_label' ] ?></a>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
    <!-- end swiper-wrapper --> 
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Navigation -->
	  <?php if ( $settings[ 'prev_label' ] ) { ?>
    <div class="slider-navigation">
      <div class="swiper-button-prev"><span><?php echo esc_html( $settings['prev_label'], array() ); ?></span><img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.svg" alt="Image"></div>
      <span class="swiper-button-line"></span>
      <div class="swiper-button-next"><span><?php echo esc_html( $settings['next_label'], array() ); ?></span><img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt="Image"></div>
    </div>
    <!-- end slider-navigation --> 
	  <?php } ?>
  </div>
  <!-- end swiper-container -->
	<?php if ( $settings[ 'display_scrolldown'] == 'yes'  ) { ?>
  <div class="scroll-down"><span></span></div>
	<?php } ?>
</section>
<!-- end slider -->

<?php


}
}
