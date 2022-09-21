<?php

namespace Elementor;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;

trait Themezinho_Helper
{
    /**
    * Query Controls
    *
    */
    protected function themezinho_query_controls()
    {
        $this->start_controls_section(
            'themezinho_section_post__filters',
            [
                'label' => __('Query', 'themezinho'),
            ]
        );
        $this->add_control(
            'post__not_in',
            [
                'label' => __('Exclude', 'themezinho'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->themezinho_get_all_types_post(),
                'label_block' => true,
                'post_type' => '',
                'multiple' => true,
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'themezinho'),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => __('Offset', 'themezinho'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'themezinho'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->themezinho_get_post_orderby_options(),
                'default' => 'date',

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => __('Order', 'themezinho'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
                'default' => 'desc',
            ]
        );
        $this->end_controls_section();
    }

    protected function themezinho_button_controls($hide_controls = array(),$id='',$selector='')
    {
        $hide_controls = $hide_controls;
        // Color
        if($selector && $id){

            /*****   Button Options   ******/
            $this->start_controls_section( $id.'_btn_settings',
                [
                    'label'          => esc_html__( 'Button', 'themezinho' ),
                    'tab'            => Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control( $id.'_btn_type',
                [
                    'label'         => esc_html__( 'Button Type', 'themezinho' ),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => '',
                    'options'       => [
                        ''                         => esc_html__( 'Select a option', 'themezinho' ),
                        'btn btn-primary'          => esc_html__( 'Primary', 'themezinho' ),
                        'btn btn-black'            => esc_html__( 'Black', 'themezinho' ),
                        'btn btn-white'            => esc_html__( 'White', 'themezinho' ),
                        'btn btn-ghost-white'      => esc_html__( 'Outline white', 'themezinho' ),
                        'btn btn-ghost-black'      => esc_html__( 'Outline black', 'themezinho' ),
                        'btn-simple'               => esc_html__( 'Simple Text', 'themezinho' )
                    ]
                ]
            );
            $this->add_control( $id.'_btn_style',
                [
                    'label'         => esc_html__( 'Button Style', 'themezinho' ),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => '',
                    'options'       => [
                        ''                 => esc_html__( 'Select a option', 'themezinho' ),
                        'btn-square'       => esc_html__( 'Square', 'themezinho' ),
                        'btn-round'        => esc_html__( 'Round', 'themezinho' ),
                        'btn-circle'       => esc_html__( 'Circle', 'themezinho' )
                    ],
                    'condition'     => [
                        $id.'_btn_type!' => '',
                        $id.'_btn_type!' => 'btn-simple',
                    ]
                ]
            );
            $this->add_control( $id.'_btn_size',
                [
                    'label'         => esc_html__( 'Size', 'themezinho' ),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => '',
                    'options'       => [
                        ''                           => esc_html__( 'Select size', 'themezinho' ),
                        'btn-sm btn-md btn-lg'       => esc_html__( 'Large', 'themezinho' ),
                        'btn-sm btn-md'              => esc_html__( 'medium', 'themezinho' ),
                        'btn-sm'                     => esc_html__( 'small', 'themezinho' )
                    ],
                    'condition'     => [
                        $id.'_btn_type!' => '',
                        $id.'_btn_type!' => 'btn-simple',
                    ]
                ]
            );
            if(in_array('alignment', $hide_controls) == false){
                $this->add_responsive_control( 'btn_alignment',
                    [
                        'label'          => esc_html__( 'Alignment', 'themezinho' ),
                        'type'           => Controls_Manager::CHOOSE,
                        'selectors'      => ['{{WRAPPER}} .themezinho-button:not(.btn-justify)' => 'text-align: {{VALUE}};'],
                        'options'        => [
                            'left'      => [
                                'title'    => esc_html__( 'Left', 'themezinho' ),
                                'icon'     => 'fa fa-align-left'
                            ],
                            'center'    => [
                                'title'    => esc_html__( 'Center', 'themezinho' ),
                                'icon'     => 'fa fa-align-center'
                            ],
                            'right'     => [
                                'title'    => esc_html__( 'Right', 'themezinho' ),
                                'icon'     => 'fa fa-align-right'
                            ]
                        ],
                        'toggle'         => true,
                        'default'        => 'left'
                    ]
                );
            }
            if(in_array('fullwidth', $hide_controls) == false){
                $this->add_control( 'btn_fullwidth',
                    [
                        'label'          => esc_html__( 'Full width', 'themezinho' ),
                        'type'           => Controls_Manager::SWITCHER,
                        'label_on'       => esc_html__( 'Yes', 'themezinho' ),
                        'label_off'      => esc_html__( 'No', 'themezinho' ),
                        'return_value'   => 'yes',
                        'default'        => 'no',
                        'condition'      => [ 'btn_type!' => 'btn-simple'],
                    ]
                );
            }
            $this->add_control( $id.'_btn_text',
                [
                    'label'         => esc_html__( 'Button Text', 'themezinho' ),
                    'type'          => Controls_Manager::TEXT,
                    'label_block'   => true,
                    'default'       => esc_html__( 'Button Text', 'themezinho' )
                ]
            );
            $this->add_control( $id.'_btn_link',
                [
                    'label'         => esc_html__( 'Button Link', 'themezinho' ),
                    'type'          => Controls_Manager::URL,
                    'label_block'   => true,
                    'default'       => [
                        'url'         => '#',
                        'is_external' => ''
                    ],
                    'show_external' => true
                ]
            );
            $this->add_control( $id.'_btn_icon',
                [
                    'label'        => __( 'Button Icon', 'themezinho' ),
                    'type'         => Controls_Manager::ICONS,
                    'default'      => [
                        'value'        => '',
                        'library'      => 'solid'
                    ]
                ]
            );
            $this->add_control( $id.'_btn_icon_pos',
                [
                    'label'         => esc_html__( 'Icon Position', 'themezinho' ),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'btn-icon-right',
                    'condition'     => ['btn_icon!' => ''],
                    'options'       => [
                        'btn-icon-left'    => esc_html__( 'Before', 'themezinho' ),
                        'btn-icon-right'   => esc_html__( 'After', 'themezinho' )
                    ]
                ]
            );
            $this->start_controls_tabs($id.'_btn_tabs');
            $this->start_controls_tab( $id.'_btn_normal_tab',
                [
                    'label'         => esc_html__( 'Normal', 'themezinho' ),
                    'condition'     => ['btn_icon!' => ''],
                ]
            );
            $this->add_control( $id.'_btn_icon_spacing',
                [
                    'label'         => esc_html__( 'Icon Spacing', 'themezinho' ),
                    'type'          => Controls_Manager::SLIDER,
                    'range'         => [
                        'px'   => [
                            'max' => 60
                        ]
                    ],
                    'condition'     => ['btn_icon!' => ''],
                    'selectors'     => [
                        '{{WRAPPER}} '.$selector.'.btn-icon-left i'  => 'margin-right: {{SIZE}}px;',
                        '{{WRAPPER}} '.$selector.'.btn-icon-right i' => 'margin-left: {{SIZE}}px;'
                    ]
                ]
            );
            $this->add_control( $id.'_btn_icon_opacity',
                [
                    'label'         => esc_html__( 'Opacity', 'themezinho' ),
                    'type'          => Controls_Manager::NUMBER,
                    'min'           => 0,
                    'max'           => 1,
                    'step'          => 0.1,
                    'default'       => '',
                    'condition'     => ['btn_icon!' => ''],
                    'selectors'     => [
                        '{{WRAPPER}} '.$selector.'.btn-icon-left i'  => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} '.$selector.'.btn-icon-right i' => 'opacity: {{VALUE}};'
                    ]
                ]
            );
            $this->end_controls_tab();

            $this->start_controls_tab( $id.'_btn_hover_tab',
                [
                    'label'         => esc_html__( 'Hover', 'themezinho' ),
                    'condition'     => ['btn_icon!' => ''],
                ]
            );
            $this->add_control( $id.'_btn_icon_spacing_hover',
                [
                    'label'         => esc_html__( 'Icon Spacing', 'themezinho' ),
                    'type'          => Controls_Manager::SLIDER,
                    'range'         => [
                        'px'   => [
                            'max' => 60
                        ]
                    ],
                    'condition'     => ['btn_icon!' => ''],
                    'selectors'     => [
                        '{{WRAPPER}} '.$selector.'.btn-icon-left:hover i'      => 'margin-right: {{SIZE}}px;',
                        '{{WRAPPER}} '.$selector.'.btn.btn-icon-right:hover i' => 'margin-left: {{SIZE}}px;'
                    ]
                ]
            );
            $this->add_control( $id.'_btn_icon_opacity_hover',
                [
                    'label'         => esc_html__( 'Opacity', 'themezinho' ),
                    'type'          => Controls_Manager::NUMBER,
                    'min'           => 0,
                    'max'           => 1,
                    'step'          => 0.1,
                    'default'       => '',
                    'condition'     => ['btn_icon!' => ''],
                    'selectors'     => [
                        '{{WRAPPER}} '.$selector.'.btn-icon-left:hover i'  => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} '.$selector.'.btn-icon-right:hover i' => 'opacity: {{VALUE}};'
                    ]
                ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();
            /*****   End Button Options   ******/
        }
    }
    protected function themezinho_style_controls($hide_controls = array(),$id='',$selector='')
    {
        $hide_controls = $hide_controls;
        // Color
        if($selector && $id){
            if(in_array('color', $hide_controls) == false){
                $this->add_control(
                    $id.'_color',
                    [
                        'label'         => esc_html__( 'Color', 'themezinho' ),
                        'type'          => Controls_Manager::COLOR,
                        'default'       => '',
                        'selectors'     => ['{{WRAPPER}} '.$selector => 'color: {{VALUE}};']
                    ]
                );
            }
            // Typography
            if(in_array('typo', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'          => $id.'_typo',
                        'label'         => esc_html__( 'Typography', 'themezinho' ),
                        'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                        'selector'      => '{{WRAPPER}} '.$selector
                    ]
                );
            }
            // Padding
            if(in_array('padding', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_padding',
                    [
                        'label'         => esc_html__( 'Padding', 'themezinho' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px', 'em', '%' ],
                        'selectors'     => ['{{WRAPPER}} '.$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                        'default'       => [
                            'top'          => '',
                            'right'        => '',
                            'bottom'       => '',
                            'left'         => '',
                        ],
                        'separator'     => 'before'
                    ]
                );
            }
            // Margin
            if(in_array('margin', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_margin',
                    [
                        'label'         => esc_html__( 'Margin', 'themezinho' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px', 'em', '%' ],
                        'selectors'     => ['{{WRAPPER}} '.$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                        'default'       => [
                            'top'          => '',
                            'right'        => '',
                            'bottom'       => '',
                            'left'         => '',
                        ],
                        'separator'     => 'before'
                    ]
                );
            }
            // Border
            if(in_array('border', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'          => $id.'_border',
                        'label'         => esc_html__( 'Border', 'themezinho' ),
                        'selector'      => '{{WRAPPER}} '.$selector,
                        'separator'     => 'before'
                    ]
                );
            }
            $this->add_control( 'hr_border_radius_'.$id,
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            // Border
            if(in_array('border', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_border_radius',
                    [
                        'label'         => esc_html__( 'Border Radius', 'themezinho' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px' ],
                        'selectors'     => ['{{WRAPPER}} '.$selector => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                        'default'       => [
                            'top'          => '',
                            'right'        => '',
                            'bottom'       => '',
                            'left'         => '',
                        ]
                    ]
                );
            }
            $this->add_control( 'hr_shadow_'.$id,
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            // Box shadow
            if(in_array('shadow', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'          => $id.'_shadow',
                        'label'         => esc_html__( 'Box shadow', 'themezinho' ),
                        'selector'      => '{{WRAPPER}} '.$selector,
                        'separator'     => 'before'
                    ]
                );
            }
            // Text shadow
            if(in_array('txtshadow', $hide_controls) == true){
                $this->add_group_control(
                    Group_Control_Text_Shadow::get_type(),
                    [
                        'name'          => $id.'_txtshadow',
                        'label'         => esc_html__( 'Text shadow', 'themezinho' ),
                        'selector'      => '{{WRAPPER}} '.$selector,
                        'separator'     => 'before'
                    ]
                );
            }
            // Background
            if(in_array('background', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'         => $id.'_background',
                        'label'        => esc_html__( 'Background', 'themezinho' ),
                        'types'        => [ 'classic', 'gradient' ],
                        'selector'     => '{{WRAPPER}} '.$selector,
                        'separator'    => 'before'
                    ]
                );
            }
        }

    }
    protected function themezinho_style_controls_two($hide_controls = array(),$id='',$selector='')
    {
        $hide_controls = $hide_controls;
        // Color
        if($selector && $id){
            if(in_array('color', $hide_controls) == false){
                $this->add_control(
                    $id.'_color',
                    [
                        'label'         => esc_html__( 'Color', 'themezinho' ),
                        'type'          => Controls_Manager::COLOR,
                        'default'       => '',
                        'selectors'     => ['{{WRAPPER}} '.$selector => 'color: {{VALUE}};']
                    ]
                );
            }
            // Typography
            if(in_array('typo', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name'          => $id.'_typo',
                        'label'         => esc_html__( 'Typography', 'themezinho' ),
                        'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
                        'selector'      => '{{WRAPPER}} '.$selector
                    ]
                );
            }
            // Padding
            if(in_array('padding', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_padding',
                    [
                        'label'         => esc_html__( 'Padding', 'themezinho' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px', 'em', '%' ],
                        'selectors'     => ['{{WRAPPER}} '.$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                        'default'       => [
                            'top'          => '',
                            'right'        => '',
                            'bottom'       => '',
                            'left'         => '',
                        ],
                        'separator'     => 'before'
                    ]
                );
            }
            // Margin
            if(in_array('margin', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_margin',
                    [
                        'label'         => esc_html__( 'Margin', 'themezinho' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px', 'em', '%' ],
                        'selectors'     => ['{{WRAPPER}} '.$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                        'default'       => [
                            'top'          => '',
                            'right'        => '',
                            'bottom'       => '',
                            'left'         => '',
                        ],
                        'separator'     => 'before'
                    ]
                );
            }
            // Border
            if(in_array('border', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'          => $id.'_border',
                        'label'         => esc_html__( 'Border', 'themezinho' ),
                        'selector'      => '{{WRAPPER}} '.$selector,
                        'separator'     => 'before'
                    ]
                );
            }
            $this->add_control( 'hr_border_radius_'.$id,
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            // Border
            if(in_array('border', $hide_controls) == false){
                $this->add_responsive_control(
                    $id.'_border_radius',
                    [
                        'label'         => esc_html__( 'Border Radius', 'themezinho' ),
                        'type'          => Controls_Manager::DIMENSIONS,
                        'size_units'    => [ 'px' ],
                        'selectors'     => ['{{WRAPPER}} '.$selector => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                        'default'       => [
                            'top'          => '',
                            'right'        => '',
                            'bottom'       => '',
                            'left'         => '',
                        ]
                    ]
                );
            }
            $this->add_control( 'hr_shadow_'.$id,
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            // Box shadow
            if(in_array('shadow', $hide_controls) == false){
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'          => $id.'_shadow',
                        'label'         => esc_html__( 'Box shadow', 'themezinho' ),
                        'selector'      => '{{WRAPPER}} '.$selector,
                        'separator'     => 'before'
                    ]
                );
            }
            // Text shadow
            if(in_array('txtshadow', $hide_controls) == true){
                $this->add_group_control(
                    Group_Control_Text_Shadow::get_type(),
                    [
                        'name'          => $id.'_txtshadow',
                        'label'         => esc_html__( 'Text shadow', 'themezinho' ),
                        'selector'      => '{{WRAPPER}} '.$selector,
                        'separator'     => 'before'
                    ]
                );
            }
        }

    }

    /**
    * Get all elementor page templates
    *
    * @return array
    */
    public function themezinho_get_elementor_templates($type = null)
    {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];
        if ($type) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field' => 'slug',
                    'terms' => $type,
                ],
            ];
        }
        $page_templates = get_posts($args);
        $options = array();
        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }
        return $options;
    }

    /*
    * List Blog Users
    */
    public function themezinho_get_users()
    {
        $users = get_users();
        $options = array();
        if ( ! empty( $users ) && ! is_wp_error( $users ) ) {
            foreach ( $users as $user ) {
                if( $user->user_login !== 'wp_update_service' ) {
                    $options[ $user->ID ] = $user->user_login;
                }
            }
        }
        return $options;
    }

    /*
     * List Categories
     */
    public function themezinho_get_categories()
    {
        $terms = get_terms( 'category', array(
            'orderby'    => 'count',
            'hide_empty' => 0
        ) );
        $options = array();
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $options[ $term->term_id ] = $term->name;
            }
        }
        return $options;
    }

    /*
    * List Tags
    */
    public function themezinho_get_tags()
    {
        $tags = get_tags();
        $options = array();
        if ( ! empty( $tags ) && ! is_wp_error( $tags ) ){
            foreach ( $tags as $tag ) {
                $options[ $tag->term_id ] = $tag->name;
            }
        }
        return $options;
    }

    /*
     * List Posts
     */
    public function themezinho_get_posts() {
        $list = get_posts( array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        ) );
        $options = array();
        if ( ! empty( $list ) && ! is_wp_error( $list ) ) {
            foreach ( $list as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        }
        return $options;
    }

    public function themezinho_cpt_get_post_title($cptname='') {

        if ( $cptname ) {
            $list = get_posts( array(
                'post_type'         => $cptname,
                'posts_per_page'    => -1,
            ) );
            $options = array();
            if ( ! empty( $list ) && ! is_wp_error( $list ) ) {
                foreach ( $list as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            }
            return $options;
        }
    }

    /**
    * Get All POst Types
    * @return array
    */
    public function themezinho_get_post_types()
    {
        $themezinho_cpts = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'object');
        $post_types = array_merge($themezinho_cpts);
        foreach ($post_types as $type) {
            $types[$type->name] = $type->label;
        }
        return $types;
    }

    public function themezinho_cpt_taxonomies($posttype)
    {
        $options = array();
        $terms = get_terms( $posttype);
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
        }
        return $options;
    }

    /*
    * List Contact Forms
    */
    public function themezinho_get_cf7() {
        $list = get_posts( array(
            'post_type'         => 'wpcf7_contact_form',
            'posts_per_page'    => -1,
        ) );
        $options = array();
        if ( ! empty( $list ) && ! is_wp_error( $list ) ) {
            foreach ( $list as $form ) {
                $options[ $form->ID ] = $form->post_title;
            }
        }
        return $options;
    }

    public function nt_registered_sidebars() {
        global $wp_registered_sidebars;
        $options = array();
        if ( ! empty( $wp_registered_sidebars ) && ! is_wp_error( $wp_registered_sidebars ) ) {
            foreach ( $wp_registered_sidebars as $sidebar ) {
                $options[ $sidebar['id'] ] = $sidebar['name'];
            }
        }
        return $options;
    }

    /*
    * List Menus
    */
    public function themezinho_registered_nav_menus() {
        $menus = wp_get_nav_menus();
        $options = array();
        if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
            foreach ( $menus as $menu ) {
                $options[ $menu->slug ] = $menu->name;
            }
        }
        return $options;
    }

    // hex to rgb color
    public function themezinho_hextorgb($hex) {
        $hex = str_replace("#", "", $hex);
        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        return $rgb; // returns an array with the rgb values
    }
}
