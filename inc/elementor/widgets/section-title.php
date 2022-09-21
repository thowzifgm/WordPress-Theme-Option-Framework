<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Section_Title_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'section-title';
  }
  public function get_title() {
    return 'Section Title';
  }
  public function get_icon() {
    return 'eicon-post-title';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'section_title_section', [
      'label' => esc_html__( 'Section Title', 'themezinho' ),
    ] );


	   $this->add_control(
      'position',
      array(
        'label' => __( 'Position', 'themezinho' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
          'text-left' => esc_html__( 'Left', 'themezinho' ),
          'text-center' => esc_html__( 'Center', 'themezinho' ),
          'text-right' => esc_html__( 'Right', 'themezinho' )
        ],
        'default' => 'text-left'
      )
    );
	  
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
      'display_description',
      array(
        'label' => __( 'Display Description', 'themezinho' ),
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes',
        'return_value' => 'yes',
      )
    );
	  
	  
	   $this->add_control(
      'description',
      array(
		  'condition' => [ 'display_description!' => 'no' ],
        'label' => __( 'Description', 'themezinho' ),
        'type' => Controls_Manager::WYSIWYG,

      )
    );
		  
		  
    


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();
    ?>


<div class="section-title <?php echo wp_kses( $settings['position'], array() ); ?>">
  <h5><?php echo esc_html( $settings['tagline'], array() ); ?></h5>
  <h2><?php echo esc_html( $settings['title'], array() ); ?></h2>
	
	 <?php if ( $settings[ 'display_description'] == 'yes'  ) { ?>
	 <?php if ( $settings[ 'description' ] ) { ?>
  <div class="description"><?php echo wp_kses_post( $settings['description'], array() ); ?></div>
  <?php } ?>
	 <?php } ?>
  </div>

<?php


}
}
