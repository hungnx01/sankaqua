<?php
//Accordion
use Elementor\Controls_Manager;

add_action( 'elementor/element/accordion/section_title_style/before_section_end', function ($element, $args ) {

    $element->remove_control( 'border_width', [
        'type' => Controls_Manager::HIDDEN,
    ] );
    $element->remove_control( 'border_color', [
        'type' => Controls_Manager::HIDDEN,
    ] );

    $element->add_control(
        'title_margin',
        [
            'label' => esc_html__( 'Margin', 'hnice' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'style_theme',
        [
            'label' => esc_html__('Layout', 'hnice'),
            'type' => Controls_Manager::SELECT,
            'default' => 'hnice-1',
            'options' => [
                'layout-1' => esc_html__('Layout 1', 'hnice'),
                'layout-2' => esc_html__('Layout 2', 'hnice'),
                'layout-3' => esc_html__('Layout 3', 'hnice'),
            ],
            'prefix_class' => 'hnice-accordion-',
        ]
    );

},10,2);

add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', function ( $element, $args ) {

    $element->update_control( 'title_color', [
        'global' => [
            'default' => '',
        ],
    ] );

    $element->update_control( 'tab_active_color', [
        'global' => [
            'default' => '',
        ],
    ] );
//
    $element->update_control( 'title_typography', [
        'global' => [
            'default' => '',
        ],
    ] );

    $element->add_control(
        'title_background_active',
        [
            'label' => esc_html__( 'Background Active', 'hnice' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
            ],
        ]
    );

},10,2);
