<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Award_Box_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'award-box';
  }
  public function get_title() {
    return 'Award Box';
  }
  public function get_icon() {
    return 'eicon-rating';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'award_box_section', [
      'label' => esc_html__( 'Award Box', 'themezinho' ),
    ] );


    $this->add_control(
      'logo',
      array(
        'label' => __( 'Logo', 'themezinho' ),
        'type' => Controls_Manager::MEDIA,

      )
    );

    $this->add_control(
      'alt',
      array(
        'label' => __( 'ALT Tag', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

    $this->add_control(
      'odometer',
      array(
        'label' => __( 'Odometer Value', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
<div class="award-box">
  <figure> <img src="<?php echo wp_kses( $settings['logo']['url'], array() ); ?>" alt="<?php echo esc_attr( $settings['alt'], array() ); ?>"></figure>
  <span class="odometer" data-count="<?php echo wp_kses( $settings['odometer'], array() ); ?>" data-status="yes">0</span> </div>
<?php


}
}
