<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Image_Box_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'image-box';
  }
  public function get_title() {
    return 'Image Box';
  }
  public function get_icon() {
    return 'eicon-image-rollover';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'image_box_section', [
      'label' => esc_html__( 'Image Box', 'themezinho' ),
    ] );


    $this->add_control(
      'image',
      array(
        'label' => __( 'Image', 'themezinho' ),
        'type' => Controls_Manager::MEDIA,

      )
    );

    $this->add_control(
      'alt',
      array(
        'label' => __( 'ALT', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

   


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>

  <figure class="reveal-effect se2-white wow image-box"><img src="<?php echo wp_kses( $settings['image']['url'], array() ); ?>" alt="<?php echo esc_attr( $settings['alt'], array() ); ?>"> </figure>
<?php


}
}
