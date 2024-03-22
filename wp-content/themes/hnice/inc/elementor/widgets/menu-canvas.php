<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Hnice_Elementor__Menu_Canvas extends Elementor\Widget_Base {

    public function get_name() {
        return 'hnice-menu-canvas';
    }

    public function get_title() {
        return esc_html__('Hnice Menu Canvas', 'hnice');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return ['hnice-addons'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'icon-menu_style',
            [
                'label' => esc_html__('Icon', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'        => esc_html__('Layout Style', 'hnice'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'layout-1' => esc_html__('Layout 1', 'hnice'),
                    'layout-2' => esc_html__('Layout 2', 'hnice'),
                ],
                'default'      => 'layout-2',
                'prefix_class' => 'hnice-canvas-menu-',
            ]
        );

//        $this->add_responsive_control(
//            'icon_menu_size',
//            [
//                'label'     => esc_html__( 'Size Icon', 'hnice' ),
//                'type'      => Controls_Manager::SLIDER,
//                'range'     => [
//                    'px' => [
//                        'min' => 6,
//                        'max' => 300,
//                    ],
//                ],
//                'selectors' => [
//                    '{{WRAPPER}} .menu-mobile-nav-button i' => 'font-size: {{SIZE}}{{UNIT}};',
//                ],
//            ]
//        );

        $this->start_controls_tabs( 'color_tabs' );

        $this->start_controls_tab( 'colors_normal',
            [
                'label' => esc_html__( 'Normal', 'hnice' ),
            ]
        );

        $this->add_control(
            'menu_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button .hnice-icon > span'             => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .menu-mobile-nav-button:not(:hover) .screen-reader-text' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'colors_hover',
            [
                'label' => esc_html__( 'Hover', 'hnice' ),
            ]
        );

        $this->add_control(
            '_menu_color_hover',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button:hover .hnice-icon > span'             => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .menu-mobile-nav-button:hover .screen-reader-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-canvas-menu-wrapper');
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <?php hnice_mobile_nav_button(); ?>
        </div>
        <?php
    }

}

$widgets_manager->register(new Hnice_Elementor__Menu_Canvas());
