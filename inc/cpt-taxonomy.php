<?php

if ( ! function_exists('motts_portfolio_cpt') ) {

// Register Custom Post Type
	function motts_portfolio_cpt() {

		$labels = array(
			'name'                  => _x( 'Portfolios', 'Post Type General Name', 'themename' ),
			'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'themename' ),
			'menu_name'             => __( 'Portfolios', 'themename' ),
			'name_admin_bar'        => __( 'Portfolio', 'themename' ),
			'archives'              => __( 'Portfolio Archives', 'themename' ),
			'attributes'            => __( 'Portfolio Attributes', 'themename' ),
			'parent_item_colon'     => __( 'Parent Portfolio:', 'themename' ),
			'all_items'             => __( 'All Portfolios', 'themename' ),
			'add_new_item'          => __( 'Add New Portfolio', 'themename' ),
			'add_new'               => __( 'Add New', 'themename' ),
			'new_item'              => __( 'New Portfolio', 'themename' ),
			'edit_item'             => __( 'Edit Portfolio', 'themename' ),
			'update_item'           => __( 'Update Portfolio', 'themename' ),
			'view_item'             => __( 'View Portfolio', 'themename' ),
			'view_items'            => __( 'View Portfolios', 'themename' ),
			'search_items'          => __( 'Search Portfolio', 'themename' ),
			'not_found'             => __( 'Not found', 'themename' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'themename' ),
			'featured_image'        => __( 'Featured Image', 'themename' ),
			'set_featured_image'    => __( 'Set featured image', 'themename' ),
			'remove_featured_image' => __( 'Remove featured image', 'themename' ),
			'use_featured_image'    => __( 'Use as featured image', 'themename' ),
			'insert_into_item'      => __( 'Insert into Portfolio', 'themename' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'themename' ),
			'items_list'            => __( 'Portfolios list', 'themename' ),
			'items_list_navigation' => __( 'Portfolios list navigation', 'themename' ),
			'filter_items_list'     => __( 'Filter Portfolios list', 'themename' ),
		);
		$args = array(
			'label'                 => __( 'Portfolio', 'themename' ),
			'description'           => __( 'Portfolio Description', 'themename' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'            => array( 'portfolio_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-welcome-view-site',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => 'portfolio',
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'portfolio', $args );

	}
	add_action( 'init', 'motts_portfolio_cpt', 0 );

}

if ( ! function_exists( 'motts_portfolio_tag_taxonomy' ) ) {

// Register Custom Taxonomy
	function motts_portfolio_tag_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Tags', 'Taxonomy General Name', 'themename' ),
			'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'themename' ),
			'menu_name'                  => __( 'Tags', 'themename' ),
			'all_items'                  => __( 'All Tags', 'themename' ),
			'parent_item'                => __( 'Parent Tag', 'themename' ),
			'parent_item_colon'          => __( 'Parent Tag:', 'themename' ),
			'new_item_name'              => __( 'New Tag Name', 'themename' ),
			'add_new_item'               => __( 'Add New Tag', 'themename' ),
			'edit_item'                  => __( 'Edit Tag', 'themename' ),
			'update_item'                => __( 'Update Tag', 'themename' ),
			'view_item'                  => __( 'View Tag', 'themename' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'themename' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'themename' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'themename' ),
			'popular_items'              => __( 'Popular tags', 'themename' ),
			'search_items'               => __( 'Search Tags', 'themename' ),
			'not_found'                  => __( 'Not Found', 'themename' ),
			'no_terms'                   => __( 'No tags', 'themename' ),
			'items_list'                 => __( 'Tags list', 'themename' ),
			'items_list_navigation'      => __( 'Tags list navigation', 'themename' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $args );

	}
	add_action( 'init', 'motts_portfolio_tag_taxonomy', 0 );

}
