<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Header_Animation_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'header-animation';
  }
  public function get_title() {
    return 'Header Animation';
  }
  public function get_icon() {
    return 'eicon-anchor';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {
    $this->start_controls_section( 'header_animation_section', [
      'label' => esc_html__( 'Header Animation', 'themezinho' ),
      'tab' => Controls_Manager::TAB_CONTENT
    ] );

	   $this->add_control(
      'animation_bg_image',
      array(
        'label' => __( 'Animation Image', 'themezinho' ),
		  'type' => Controls_Manager::MEDIA,

      )
    );
	  
	   $this->add_control(
      'animation_bg_color',
      array(
        'label' => __( 'Animation BG Color', 'themezinho' ),
		  'type' => Controls_Manager::COLOR,

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


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/


  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>

<section class="slider">
   <div class="animation-hero" style="background-image:url(

									  <?php echo esc_url($settings['animation_bg_image'][ 'url' ]); ?>
									  ); background-color:<?php echo esc_attr( $settings['animation_bg_color'], array() ); ?>; background-repeat: no-repeat; background-position:center; "></div>
   <!-- end animation-hero -->
    <?php if ( $settings[ 'display_scrolldown'] == 'yes'  ) { ?>
  <div class="scroll-down"><span></span></div>
	<?php } ?>
  </section>


<?php


}
}
