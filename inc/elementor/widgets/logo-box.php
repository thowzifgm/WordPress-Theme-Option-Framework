<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Logo_Box_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'logo-box';
  }
  public function get_title() {
    return 'Logo Box';
  }
  public function get_icon() {
    return 'eicon-image-hotspot';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'logo_box_section', [
      'label' => esc_html__( 'Logo Box', 'themezinho' ),
    ] );


    $this->add_control(
      'logo',
      array(
        'label' => __( 'Logo', 'themezinho' ),
        'type' => Controls_Manager::MEDIA,

      )
    );

    $this->add_control(
      'brand',
      array(
        'label' => __( 'Brand', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

   


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>

  <figure class="reveal-effect se2-white wow logo-box"><img src="<?php echo wp_kses( $settings['logo']['url'], array() ); ?>" alt="<?php echo esc_attr( $settings['brand'], array() ); ?>"> </figure>
<?php


}
}
