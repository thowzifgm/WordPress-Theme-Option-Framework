<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Contact_Box_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'contact-box';
  }
  public function get_title() {
    return 'Contact Box';
  }
  public function get_icon() {
    return 'eicon-document-file';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {
    $this->start_controls_section( 'contact_box_widget', [
      'label' => esc_html__( 'Contact Box', 'themezinho' ),
    ] );

$this->add_control(
      'title',
      array(
        'label' => __( 'Title', 'themezinho' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'themezinho' ),
      )
    );
	  
	  $this->add_control(
      'phone',
      array(
        'label' => __( 'Phone', 'themezinho' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'themezinho' ),
      )
    );
	  
	    $this->add_control(
      'email',
      array(
        'label' => __( 'E-mail', 'themezinho' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'themezinho' ),
      )
    );
	  
    $this->add_control(
      'address',
      array(
        'label' => __( 'Address', 'themezinho' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( '', 'themezinho' ),
      )
    );
	  
	  $this->add_control(
      'link_label',
      array(
        'label' => __( 'Maps Link Label', 'themezinho' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'themezinho' ),
      )
    );
	  
	  $this->add_control(
      'link_url',
      array(
        'label' => __( 'Maps Link URL', 'themezinho' ),
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

<div class="contact-box">
      <h4><?php echo wp_kses( $settings['title'], array() ); ?></h4>
      <p><?php echo wp_kses( $settings['phone'], array() ); ?><br>
        <a href="mailto:<?php echo wp_kses( $settings['email'], array() ); ?>"><?php echo wp_kses( $settings['email'], array() ); ?></a><br>
        <?php echo wp_kses( $settings['address'], array() ); ?> </p>
	<?php if ( $settings[ 'link_label' ] ) { ?>
	<a href="<?php echo wp_kses( $settings['link_url'], array() ); ?>" data-fancybox="" data-width="640" data-height="360"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path d="M12 22.31l-6.38-8.2A7.7 7.7 0 0 1 11.7 1.69h.6a7.7 7.7 0 0 1 6.08 12.42zm-.3-18.62A5.7 5.7 0 0 0 6 9.39a5.77 5.77 0 0 0 1.2 3.5l4.8 6.17 4.8-6.17a5.77 5.77 0 0 0 1.2-3.5 5.7 5.7 0 0 0-5.7-5.7z"></path>
        <circle cx="12" cy="9.69" r="2"></circle>
      </svg>
      <?php echo wp_kses( $settings['link_label'], array() ); ?></a>
	 <?php } ?>
    
      </div>


<?php


}
}
