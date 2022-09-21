<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Side_Image_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'side-image';
  }
  public function get_title() {
    return 'Side Image';
  }
  public function get_icon() {
    return 'eicon-featured-image';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'side_image_section', [
      'label' => esc_html__( 'Side Image', 'themezinho' ),
    ] );


    $this->add_control(
      'main_image',
      array(
        'label' => __( 'Main Image', 'themezinho' ),
        'type' => Controls_Manager::MEDIA,

      )
    );

    $this->add_control(
      'main_image_alt',
      array(
        'label' => __( 'Main Image ALT', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

    $this->add_control(
      'sub_image',
      array(
        'label' => __( 'Sub Image', 'themezinho' ),
        'type' => Controls_Manager::MEDIA,

      )
    );


    $this->add_control(
      'sub_image_alt',
      array(
        'label' => __( 'Sub Image ALT', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
<div class="side-image">
  <figure class="reveal-effect se2-white wow main-image"><img src="<?php echo wp_kses( $settings['main_image']['url'], array() ); ?>" alt="<?php echo esc_attr( $settings['main_image_alt'], array() ); ?>"> </figure>
  <figure class="reveal-effect se2-white wow sub-image"> <img src="<?php echo wp_kses( $settings['sub_image']['url'], array() ); ?>" alt="<?php echo esc_attr( $settings['sub_image_alt'], array() ); ?>"> </figure>
</div>
<?php


}
}
