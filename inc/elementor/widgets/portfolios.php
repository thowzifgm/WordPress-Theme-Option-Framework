<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )exit;

class Portfolios_Widget extends Widget_Base {
  use Themezinho_Helper;
  public function get_name() {
    return 'portfolios';
  }
  public function get_title() {
    return 'Portfolios';
  }
  public function get_icon() {
    return 'eicon-gallery-grid';
  }
  public function get_categories() {
    return [ 'themezinho' ];
  }

  // Registering Controls
  protected function register_controls() {

    /*****   START CONTROLS SECTION   ******/
    $this->start_controls_section( 'portfolios_section', [
      'label' => esc_html__( 'Portfolios', 'themezinho' ),
    ] );
	  
	  
	  $this->add_control(
      'display_filter',
      array(
        'label' => __( 'Display Filter', 'themezinho' ),
        'type' => Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'themezinho' ),
		'label_off' => __( 'Hide', 'themezinho' ),
        'default' => 'yes',
        'return_value' => 'yes',
      )
    );


    $this->add_control(
      'total_count',
      array(
        'label' => __( 'Total', 'themezinho' ),
        'type' => Controls_Manager::TEXT,

      )
    );

    $this->add_control(
      'column',
      array(
        'label' => __( 'Column', 'themezinho' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
          'two-cols' => esc_html__( 'Two Column', 'themezinho' ),
          'three-cols' => esc_html__( 'Three Column', 'themezinho' ),
          'four-cols' => esc_html__( 'Four Column', 'themezinho' ),
          'five-cols' => esc_html__( 'Five Column', 'themezinho' )
        ],
        'default' => 'three-cols'
      )
    );


    $this->end_controls_section();
    /*****   END CONTROLS SECTION   ******/

  }
  protected function render() {
    $settings = $this->get_settings_for_display();


    $args = array(
      'post_type' => 'portfolio',
      'post_status' => 'publish',
      'posts_per_page' => $settings[ 'total_count' ],
      'meta_query' => array(
        array(
          'key' => 'thumbnail_image',
          'value' => '',
          'compare' => '!='
        )
      )
    );


    $portfolio = new\ WP_Query( $args );

    if ( $portfolio->have_posts() ):


      ?>
<?php
$portfolio_tags = get_terms( 'portfolio_tag' );
$filter_term = false;
if ( get_field( 'tags' ) && get_field( 'tags' ) > 0 ) {
  $filter_term = true;
}

if ( count( $portfolio_tags ) && $filter_term === false ) {
	
	if ( $settings[ 'display_filter'] == 'yes'  ) {
		
  ?>



<ul class="grid-item isotope-filter">
  <li><span data-filter="*" class="current"><?php echo esc_html__( 'ALL', 'anchor' ); ?></span></li>
  <?php
  foreach ( $portfolio_tags as $tag ) {
    ?>
  <li><span data-filter=".<?php echo esc_attr( $tag->slug ); ?>"><?php echo esc_html( $tag->name ); ?></span></li>
  <?php
  }
  ?>
</ul>

<?php
}
	}
?>
<div class="works <?php echo esc_attr( $settings['column'], array() ); ?>">
  <div class="grid-sizer"></div>
  <?php
  $i = 1;
  while ( $portfolio->have_posts() ):
    $portfolio->the_post();

  $thumbnail_image = get_field( 'thumbnail_image' );
  $terms = get_the_terms( $portfolio->post->ID, 'portfolio_tag' );

  $grid_classes = array();

  if ( get_field( 'vc_item_grid' ) ) {
    $grid_classes[] = get_field( 'vc_item_grid' );
  } else {
    $grid_classes[] = 'grid-item';
  }

  $term_name = array();
  if ( count( $terms ) ) {
    foreach ( $terms as $term ) {
      $grid_classes[] = $term->slug;
      $term_name[] = $term->name;
    }
  }

  $grid_classes = implode( ' ', $grid_classes );
  $term_name = implode( ',', $term_name );
  ?>
  <div class="<?php echo esc_attr( $grid_classes ); ?>" data-tilt data-tilt-perspective="1000">
    <figure class="reveal-effect wow"> <img src="<?php echo esc_url( $thumbnail_image ); ?>" alt="<?php the_title(); ?>" />
      <figcaption> <a href="<?php the_permalink(); ?>">
        <div class="bg-color" data-background="<?php echo esc_attr( get_field( 'overlay_bg_color' ) ); ?>"></div>
        <?php if( get_field( 'logo' ) ) { ?>
        <div class="brand"> <img src="<?php echo esc_url( get_field( 'logo' ) ); ?>" /> </div>
        <?php } ?>
        <h5>
          <?php the_title(); ?>
        </h5>
        <?php if( $term_name !== '' ){ ?>
        <small><?php echo esc_html( $term_name ); ?></small>
        <?php } ?>
        </a> </figcaption>
    </figure>
  </div>
  <?php
  $i++;
  endwhile;
  ?>
</div>
<?php
endif;

wp_reset_query();

}
}
