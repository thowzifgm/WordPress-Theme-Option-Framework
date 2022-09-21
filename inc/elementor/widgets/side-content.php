<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Side_Content_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'side-content';
  }
  public function get_title() {
    return 'Side Content';
  }
  public function get_icon() {
    return 'eicon-post-excerpt';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'side_content_section', [
      'label' => esc_html__( 'Side Content', 'themezinho' ),
    ] );


    $this->add_control(
      'tagline',
      array(
        'label' => __( 'Tagline', 'themezinho' ),
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

    $this->add_control(
      'description',
      array(
        'label' => __( 'Description', 'themezinho' ),
        'type' => Controls_Manager::WYSIWYG,

      )
    );
	  
	  $this->add_control(
      'display_button',
      array(
        'label' => __( 'Display Button', 'themezinho' ),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'return_value' => 'yes',
      )
    );


    $this->add_control(
      'button_label',
      array(
		  'condition' => [ 'display_button!' => 'no' ],
        'label' => __( 'Button Label', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

    $this->add_control(
      'button_url',
      array(
		  'condition' => [ 'display_button!' => 'no' ],
        'label' => __( 'Button URL', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
<div class="side-content ">
  <h5><?php echo esc_html( $settings['tagline'], array() ); ?></h5>
  <h2><?php echo esc_html( $settings['title'], array() ); ?></h2>
  <?php echo wp_kses_post( $settings['description'], array() ); ?> 
	<?php if ( $settings[ 'display_button'] == 'yes'  ) { ?>
	<a href="<?php echo esc_attr( $settings['button_url'], array() ); ?>"> <span data-hover="<?php echo esc_attr( $settings['button_label'], array() ); ?>"> <?php echo esc_html( $settings['button_label'], array() ); ?> </span> </a> 
<?php } ?>
</div>

<?php


}
}
