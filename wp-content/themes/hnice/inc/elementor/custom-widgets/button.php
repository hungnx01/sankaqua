<?php
// Button
use Elementor\Controls_Manager;

add_action('elementor/element/button/section_button/after_section_end', function ($element, $args) {

    $element->update_control(
        'button_type',
        [
            'label'        => esc_html__('Type', 'hnice'),
            'type'         => Controls_Manager::SELECT,
            'default'      => 'default',
            'options'      => [
                'default'   => esc_html__('Default', 'hnice'),
                'outline' => esc_html__('OutLine', 'hnice'),
                'info'    => esc_html__('Info', 'hnice'),
                'success' => esc_html__('Success', 'hnice'),
                'warning' => esc_html__('Warning', 'hnice'),
                'danger'  => esc_html__('Danger', 'hnice'),
                'link'  => esc_html__('Link', 'hnice'),
            ],
            'prefix_class' => 'elementor-button-',
        ]
    );
}, 10, 2);

add_action( 'elementor/element/button/section_style/after_section_end', function ($element, $args ) {

    $element->update_control(
        'background_color',
        [
            'global' => [
                'default' => '',
            ],
			'selectors' => [
				'{{WRAPPER}} .elementor-button' => ' background-color: {{VALUE}};',
			],
        ]
    );
}, 10, 2 );

add_action('elementor/element/button/section_style/before_section_end', function ($element, $args) {

    $element->add_control(
        'button_line_style',
        [
            'label'     => esc_html__('Line Button', 'hnice'),
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'button-line-',
            'separator'   => 'before',
        ]
    );

    $element->add_control(
        'icon_button_size',
        [
            'label' => esc_html__('Icon Size', 'hnice'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-button .elementor-button-icon'   => 'display: flex; align-items: center;',
            ],
            'condition' => [
                'selected_icon[value]!' => '',
            ],
        ]
    );
    $element->add_control(
        'button_icon_color',
        [
            'label'     => esc_html__('Icon Color', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon i' => 'fill: {{VALUE}}; color: {{VALUE}};',
                '{{WRAPPER}}.button-link-yes .elementor-button .elementor-button-content-wrapper:after' => 'background-color: {{VALUE}};',
                '{{WRAPPER}}.button-link-yes .elementor-button .elementor-button-content-wrapper:before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}};',
            ],

        ]
    );

    $element->add_control(
        'button_icon_color_hover',
        [
            'label'     => esc_html__('Icon Color Hover', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-button:hover .elementor-button-icon i' => 'fill: {{VALUE}}; color: {{VALUE}};',
                '{{WRAPPER}}.button-link-yes .elementor-button:hover .elementor-button-content-wrapper:after' => 'background-color: {{VALUE}};',
                '{{WRAPPER}}.button-link-yes .elementor-button:hover .elementor-button-content-wrapper:before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}};',
            ],

        ]
    );

    $element->add_control(
        'line_color',
        [
            'label'     => esc_html__('Line Color', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}}.elementor-button-link .elementor-button:before' => 'background-color: {{VALUE}};',
            ],

        ]
    );

    $element->add_control(
        'line_color_hover',
        [
            'label'     => esc_html__('Line Color Hover', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}}.elementor-button-link .elementor-button:hover:before' => 'background-color: {{VALUE}};',
            ],

        ]
    );
}, 10, 2);




