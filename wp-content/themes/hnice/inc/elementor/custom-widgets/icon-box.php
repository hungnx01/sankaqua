<?php
use Elementor\Controls_Manager;

add_action('elementor/element/icon-box/section_style_content/before_section_end', function ($element, $args) {
	$element->add_control(
		'icon_box_title_hover',
		[
			'label'     => esc_html__('Color Title Hover', 'hnice'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
			],
            'separator'    => 'before',
		]
	);
}, 10, 2);

add_action('elementor/element/icon-box/section_style_content/before_section_end', function ($element, $args) {
    $element->add_responsive_control(
        'icon_box_title_margin',
        [
            'label' => esc_html__('Title Margin', 'hnice'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/icon-box/section_style_content/before_section_end', function ($element, $args) {
    $element->add_responsive_control(
        'icon_box_description_margin',
        [
            'label' => esc_html__('Description Margin', 'hnice'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-box-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
    $element->add_control(
        'icon_box_color_border',
        [
            'label'     => esc_html__('Color Border', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'view' => 'framed',
            ],
        ]
    );
}, 10, 2);


add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
    $element->add_control(
        'icon_box_shape_color',
        [
            'label'     => esc_html__('Color Shape', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}}.icon-shape-yes .elementor-icon i:after, {{WRAPPER}}.icon-shape-yes .elementor-icon svg:after' => 'background-color: {{VALUE}};',

            ],
            'condition' => [
                'icon_box_shape' => 'yes',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
    $element->add_control(
        'icon_box_shape_color_hover',
        [
            'label'     => esc_html__('Color Shape Hover', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}}.icon-shape-yes:hover .elementor-icon i:after, {{WRAPPER}}.icon-shape-yes:hover .elementor-icon svg:after' => 'background-color: {{VALUE}};',

            ],
            'condition' => [
                'icon_box_shape' => 'yes',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
    $element->add_responsive_control(
        'icon_box_shape_size',
        [
            'label'     => esc_html__('Shape Size', 'hnice'),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 150,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.icon-shape-yes .elementor-icon i:after, {{WRAPPER}}.icon-shape-yes .elementor-icon svg:after' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
            ],
            'condition' => [
                'icon_box_shape' => 'yes',
            ],
        ]
    );

}, 10, 2);


add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
    $element->add_responsive_control(
        'icon_box_shape_color_right',
        [
            'label'     => esc_html__('Color Shape Top Horizontal', 'hnice'),
            'type'      => Controls_Manager::SLIDER,
            'size_units'=> ['px', 'em', '%'],
            'range' => [
                'px' => [
                    'min' => -30,
                    'max' => 60,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.icon-shape-yes .elementor-icon i:after, {{WRAPPER}}.icon-shape-yes .elementor-icon svg:after' => 'right: {{SIZE}}{{UNIT}};',

            ],
            'condition' => [
                'icon_box_shape' => 'yes',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
    $element->add_responsive_control(
        'icon_box_shape_color_top',
        [
            'label'     => esc_html__('Color Shape Top Vertical', 'hnice'),
            'type'      => Controls_Manager::SLIDER,
            'size_units'=> ['px', 'em', '%'],
            'range' => [
                'px' => [
                    'min' => -30,
                    'max' => 60,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.icon-shape-yes .elementor-icon i:after, {{WRAPPER}}.icon-shape-yes .elementor-icon svg:after' => 'top: {{SIZE}}{{UNIT}};',

            ],
            'condition' => [
                'icon_box_shape' => 'yes',
            ],
        ]
    );
}, 10, 2);


add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
    $element->add_control(
        'icon_box_boxed_color_hover',
        [
            'label'     => esc_html__('Icon color when hovering to block', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}}:hover .elementor-icon i, {{WRAPPER}}:hover .elementor-icon svg' => 'fill: {{VALUE}}; color:{{VALUE}};',
            ]
        ]
    );
}, 10, 2);
    add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
        $element->add_control(
            'effects_color',
            [
                'label'     => esc_html__('Effects color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}.enable-effects-yes .elementor-icon-box-icon .elementor-icon:before' => 'background-color:{{VALUE}};',
                ]
            ]
        );
}, 10, 2);

add_action('elementor/element/icon-box/section_style_icon/before_section_end', function ($element, $args) {
    $element->add_control(
        'icon_box_boxed_background_color_hover',
        [
            'label'     => esc_html__('Background color when hovering to block ', 'hnice'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}}:hover .elementor-icon' => 'background-color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'name' => 'view',
                        'operator' => '==',
                        'value' => 'stacked',
                    ],
                    [
                        'name' => 'view',
                        'operator' => '==',
                        'value' => 'framed',
                    ],
                ],
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/icon-box/section_icon/before_section_end', function ($element, $args) {
    $element->add_control(
        'circle_enable_effects',
        [
            'label'     => esc_html__('Effects', 'hnice'),
            'type'      => Controls_Manager::SWITCHER,
            'prefix_class' => 'enable-effects-',
        ]
    );
}, 10, 2);