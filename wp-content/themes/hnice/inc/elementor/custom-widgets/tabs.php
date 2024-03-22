<?php
// Image
use Elementor\Controls_Manager;


add_action('elementor/element/nested-tabs/section_tabs/before_section_end', function ($element, $args) {
    $element->add_control(
        'tabs_style_theme',
        [
            'label'        => esc_html__('Theme Style', 'hnice'),
            'type'         => Controls_Manager::SWITCHER,
            'prefix_class' => 'tabs-style-hnice-',
        ]
    );

}, 10, 2);



