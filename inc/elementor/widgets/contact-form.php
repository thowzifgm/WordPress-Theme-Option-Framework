<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Contact_Form_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'contact-form';
  }
  public function get_title() {
    return 'Contact Form';
  }
  public function get_icon() {
    return 'eicon-form-horizontal';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {
    $this->start_controls_section( 'contact_form_widget', [
      'label' => esc_html__( 'Contact Form', 'themezinho' ),
    ] );


    $this->add_control(
      'shortcode',
      array(
        'label' => __( 'Contact Form Shortcode', 'themezinho' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'themezinho' ),
      )
    );


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/


  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
<?php echo wp_kses_post( $settings['shortcode'], array() ); ?>
<?php


}
}