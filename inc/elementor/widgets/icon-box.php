<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Icon_Box_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'icon-box';
  }
  public function get_title() {
    return 'Icon Box';
  }
  public function get_icon() {
    return 'eicon-image';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'icon_box_section', [
      'label' => esc_html__( 'Icon Box', 'themezinho' ),
    ] );


    $this->add_control(
      'icon',
      array(
        'label' => __( 'Icon', 'themezinho' ),
        'type' => Controls_Manager::MEDIA,

      )
    );

    $this->add_control(
      'title',
      array(
        'label' => __( 'Title', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

    $this->add_control(
      'description',
      array(
        'label' => __( 'Description', 'themezinho' ),
        'type' => Controls_Manager::TEXTAREA,

      )
    );


    $this->add_control(
      'link_label',
      array(
        'label' => __( 'Link Label', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

    $this->add_control(
      'link_url',
      array(
        'label' => __( 'Link URL', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
<div class="icon-box">
  <figure><img src="<?php echo wp_kses( $settings['icon']['url'], array() ); ?>" alt="<?php echo esc_attr( $settings['title'], array() ); ?>"></figure>
  <h3><?php echo wp_kses( $settings['title'], array() ); ?></h3>
  <p><?php echo wp_kses( $settings['description'], array() ); ?></p>
  <a href="<?php echo esc_url( $settings['link_url'], array() ); ?>"><?php echo wp_kses( $settings['link_label'], array() ); ?></a> </div>
<?php


}
}
