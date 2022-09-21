<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Team_Member_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'team-member';
  }
  public function get_title() {
    return 'Team Member';
  }
  public function get_icon() {
    return 'eicon-person';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'team_member_section', [
      'label' => esc_html__( 'Team Member', 'themezinho' ),
    ] );


    $this->add_control(
      'image',
      array(
        'label' => __( 'Image', 'themezinho' ),
        'type' => Controls_Manager::MEDIA,

      )
    );

    $this->add_control(
      'name',
      array(
        'label' => __( 'Name', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

    $this->add_control(
      'title',
      array(
        'label' => __( 'Title', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
<figure class="member"> <img src="<?php echo wp_kses( $settings['image']['url'], array() ); ?>" alt="<?php echo esc_attr( $settings['name'], array() ); ?>">
  <figcaption>
    <div>
      <h3><?php echo esc_html( $settings['name'], array() ); ?></h3>
      <small><?php echo esc_html( $settings['title'], array() ); ?></small> </div>
  </figcaption>
</figure>
<?php


}
}
