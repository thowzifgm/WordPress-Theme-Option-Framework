<?php
/*
Plugin Name: Themezinho Core
Plugin URI: http://anchor.themezinho.net
Description: Themezinho Core Plugin
Author: Themezinho
Version: 3.1.0
Author URI: http://themeforest.net/user/themezinho/portfolio
*/

define( "ANCHOR_CORE_PATH", plugin_dir_path( __FILE__ ) );
define( "ANCHOR_CORE_URI", plugins_url( 'themeoptions_core/'  ) );
/*
 * Elementor
 */

require_once( 'inc/elementor/themeoptions-elementor.php' );


function add_elementor_widget_categories( $elements_manager ) {

  $categories = [];
  $categories[ 'themeoptions' ] = [
    'title' => 'Theme Options',
    'icon' => 'fas fa-adjust'
  ];

  $old_categories = $elements_manager->get_categories();
  $categories = array_merge( $categories, $old_categories );

  $set_categories = function ( $categories ) {
    $this->categories = $categories;
  };

  $set_categories->call( $elements_manager, $categories );

}

add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

/**
 * Include advanced custom field
 */
// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');

function anchor_acf_settings_path( $path ) {
	$path = ANCHOR_CORE_PATH . '/inc/acf/';

	return $path;
}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'anchor_acf_settings_dir');

function anchor_acf_settings_dir( $dir ) {
	$dir = ANCHOR_CORE_URI . '/inc/acf/';

	return $dir;
}

//Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');
require ANCHOR_CORE_PATH .  '/inc/acf/acf.php';

require_once ANCHOR_CORE_PATH . '/inc/theme-options.php';

require_once ANCHOR_CORE_PATH . '/inc/cpt-taxonomy.php';




// Default Theme Options
function anchor_after_import(){

	update_field('enable_preloader', 1, 'option');


	$preloader_text = array(
		array( 'title'		=> esc_html__( 'Hangin there', 'anchor' ) ),
		array( 'title'		=> esc_html__( 'Still loading', 'anchor' ) ),
		array( 'title'		=> esc_html__( 'Almost there', 'anchor' ) ),
	);
	update_field( 'pre_loader_text_rotater', $preloader_text, 'option' );

	$social_media = array(
		array(
			'title'		=> esc_html__( 'Facebook', 'anchor' ),
			'label'		=> esc_html__( '.facebook', 'anchor' ),
			'url'		=> '#',
		),
		array(
			'title'		=> esc_html__( 'Twitter', 'anchor' ),
			'label'		=> esc_html__( '.twitter', 'anchor' ),
			'url'		=> '#',
		),
		array(
			'title'		=> esc_html__( 'Instagram', 'anchor' ),
			'label'		=> esc_html__( '.instagram', 'anchor' ),
			'url'		=> '#',
		),	

	);
	update_field( 'social_media', $social_media, 'option' );
	update_field( 'nav_menu_type', 'hamburger', 'option' );

	update_field( 'archive_show_sidebar', 'no', 'option' );
	update_field( 'archive_strip_content', 'yes', 'option' );
	update_field( 'show_call_to_action', 1, 'option' );
	
	update_field( 'footer_cta_tagline', wp_kses_post( "Creativity is Everywhere" ), 'option' );
	update_field( 'footer_cta_tagline_title', wp_kses_post( "DON'T <span>HASITATE</span> AND TALK TO US?" ), 'option' );
	update_field( 'footer_cta_tagline_button_label', wp_kses_post( "LET'S BE IN TOUCH" ), 'option' );
	update_field( 'footer_cta_tagline_button_link', '#', 'option' );

	update_field( 'show_phone', 1, 'option' );
	update_field( 'phone_label', esc_html__( 't:', 'anchor' ) , 'option' );
	update_field( 'phone_number', esc_html__( '+380 83 857 5 577', 'anchor' ) , 'option' );
}