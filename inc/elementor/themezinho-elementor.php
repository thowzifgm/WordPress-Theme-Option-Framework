<?php


/*
 * Exit if accessed directly.
 */

if ( !defined( 'ABSPATH' ) )exit;

define( 'THEMEZINHO_PLUGIN_FILE', __FILE__ );
define( 'THEMEZINHO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'THEMEZINHO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'THEMEZINHO_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

final class Themezinho_Elementor_Addons {

  const VERSION = '1.0.4';


  const MINIMUM_ELEMENTOR_VERSION = '2.0.0';


  const MINIMUM_PHP_VERSION = '7.0';


  private static $_instance = null;


  public static function instance() {

    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }


  public function __construct() {
    add_action( 'init', [ $this, 'i18n' ] );
    add_action( 'plugins_loaded', [ $this, 'init' ] );
  }

  public function i18n() {
    load_plugin_textdomain( 'themezinho' );
  }


  public function init() {

    // Check if Elementor is installed and activated
    if ( !did_action( 'elementor/loaded' ) ) {
      add_action( 'admin_notices', [ $this, 'themezinho_admin_notice_missing_main_plugin' ] );
      return;
    }
    // Check for required Elementor version
    if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
      add_action( 'admin_notices', [ $this, 'themezinho_admin_notice_minimum_elementor_version' ] );
      return;
    }
    // Check for required PHP version
    if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
      add_action( 'admin_notices', [ $this, 'themezinho_admin_notice_minimum_php_version' ] );
      return;
    }

    /* Custom plugin helper functions */
    require_once( __DIR__ . '/class-helpers-functions.php' );


    // Categories registered
    add_action( 'elementor/elements/categories_registered', [ $this, 'themezinho_add_widget_category' ] );
    // Widgets registered
    add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
    // Register Widget Styles
    add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
    // Register Widget Scripts
    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );
    // Register Widget Scripts
    add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'admin_custom_scripts' ] );
    //elementor custom editor style
    add_action( 'wp_print_styles', [ $this, 'themezinho_elementor_addons_dequeue_style' ], 100 );
  }

  public function themezinho_elementor_addons_dequeue_style() {
    if ( is_page_template( 'page-builder.php' ) ) {
      wp_dequeue_style( 'themezinho-framework-style' );
    }
  }
  public function admin_custom_scripts() {
    // Plugin custom css

  }


  public function themezinho_admin_notice_missing_main_plugin() {

    if ( isset( $_GET[ 'activate' ] ) )unset( $_GET[ 'activate' ] );

    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor */
      esc_html__( '%1$s requires %2$s to be installed and activated.', 'themezinho' ),
      '<strong>' . esc_html__( 'Themezinho Elements', 'themezinho' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor', 'themezinho' ) . '</strong>'
    );

    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

  }


  public function themezinho_admin_notice_minimum_elementor_version() {

    if ( isset( $_GET[ 'activate' ] ) )unset( $_GET[ 'activate' ] );

    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
      esc_html__( '%1$s requires %2$s version %3$s or greater.', 'themezinho' ),
      '<strong>' . esc_html__( 'Themezinho Elements', 'themezinho' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor', 'themezinho' ) . '</strong>',
      self::MINIMUM_ELEMENTOR_VERSION
    );

    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

  }


  public function themezinho_admin_notice_minimum_php_version() {
    if ( isset( $_GET[ 'activate' ] ) )unset( $_GET[ 'activate' ] );
    $message = sprintf(
      /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
      esc_html__( '%1$s requires %2$s version %3$s or greater.', 'themezinho' ),
      '<strong>' . esc_html__( 'Themezinho Elements', 'themezinho' ) . '</strong>',
      '<strong>' . esc_html__( 'PHP', 'themezinho' ) . '</strong>',
      self::MINIMUM_PHP_VERSION
    );
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }

  /**
   * Register Widgets Category
   *
   */
  public function themezinho_add_widget_category( $elements_manager ) {
    $elements_manager->add_category( 'themezinho', [ 'title' => esc_html__( 'Themezinho', 'themezinho' ) ] );


  }


  public function init_widgets() {

    /*
     * Register widgets and include widget files
     */


    if ( !get_option( 'disable_header_slider' ) == 1 ) {
      require_once( __DIR__ . '/widgets/header-slider.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Header_Slider_Widget() );
    }
    if ( !get_option( 'disable_header_video' ) == 1 ) {
      require_once( __DIR__ . '/widgets/header-video.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Header_Video_Widget() );
    }

    if ( !get_option( 'disable_header_animation' ) == 1 ) {
      require_once( __DIR__ . '/widgets/header-animation.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Header_Animation_Widget() );
    }


    if ( !get_option( 'disable_icon_box' ) == 1 ) {
      require_once( __DIR__ . '/widgets/icon-box.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Icon_Box_Widget() );
    }

    if ( !get_option( 'disable_portfolios' ) == 1 ) {
      require_once( __DIR__ . '/widgets/portfolios.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Portfolios_Widget() );
    }

    if ( !get_option( 'disable_side_image' ) == 1 ) {
      require_once( __DIR__ . '/widgets/side-image.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Side_Image_Widget() );
    }

    if ( !get_option( 'disable_side_content' ) == 1 ) {
      require_once( __DIR__ . '/widgets/side-content.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Side_Content_Widget() );
    }

    if ( !get_option( 'disable_section_title' ) == 1 ) {
      require_once( __DIR__ . '/widgets/section-title.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Section_Title_Widget() );
    }


    if ( !get_option( 'disable_award_box' ) == 1 ) {
      require_once( __DIR__ . '/widgets/award-box.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Award_Box_Widget() );
    }

    if ( !get_option( 'disable_image_box' ) == 1 ) {
      require_once( __DIR__ . '/widgets/image-box.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Image_Box_Widget() );
    }

    if ( !get_option( 'disable_text_box' ) == 1 ) {
      require_once( __DIR__ . '/widgets/text-box.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Text_Box_Widget() );
    }

    if ( !get_option( 'disable_team_member' ) == 1 ) {
      require_once( __DIR__ . '/widgets/team-member.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Team_Member_Widget() );
    }


    if ( !get_option( 'disable_logo_box' ) == 1 ) {
      require_once( __DIR__ . '/widgets/logo-box.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Logo_Box_Widget() );
    }

    if ( !get_option( 'disable_contact_box' ) == 1 ) {
      require_once( __DIR__ . '/widgets/contact-box.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Contact_Box_Widget() );
    }

    if ( !get_option( 'disable_contact_form' ) == 1 ) {
      require_once( __DIR__ . '/widgets/contact-form.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Contact_Form_Widget() );
    }


  }

  public function widget_styles() {

  }

  public function widget_scripts() {

  }
}
Themezinho_Elementor_Addons::instance();