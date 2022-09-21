<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Text_Box_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'text-box';
  }
  public function get_title() {
    return 'Text Box';
  }
  public function get_icon() {
    return 'eicon-text';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {
    $this->start_controls_section( 'text_box_widget', [
      'label' => esc_html__( 'Text Box', 'themezinho' ),
    ] );


    $this->add_control(
      'text_box',
      array(
        'label' => __( 'Text Box', 'themezinho' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( '', 'themezinho' ),
      )
    );


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/


  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
<div class="text-box">
  <?php if ( $settings[ 'text_box' ] ) { ?>
  <?php echo wp_kses_post( $settings['text_box'], array() ); ?>
  <?php } ?>
</div>
<?php


}
}
