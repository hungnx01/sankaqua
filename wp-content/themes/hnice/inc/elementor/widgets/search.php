<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Hnice_Elementor_Search extends Elementor\Widget_Base {
    public function get_name() {
        return 'hnice-search';
    }

    public function get_title() {
        return esc_html__('Hnice Search Form', 'hnice');
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return array('hnice-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'search-form-style',
            [
                'label' => esc_html__('Style', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__('Layout Style', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'hnice'),
                    'layout-2' => esc_html__('Layout 2', 'hnice'),
                    'layout-3' => esc_html__('Layout 3', 'hnice'),
                ],
                'default' => 'layout-1',
            ]
        );


        $this->add_responsive_control(
            'border_width',
            [
                'label'      => esc_html__('Border width', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} form input[type=search]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color_focus',
            [
                'label'     => esc_html__('Border Color Focus', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .button-search-popup .content' => 'color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
                    'text_color_hover',
                    [
                        'label'     => esc_html__('Text Hover', 'hnice'),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' => [
                            '{{WRAPPER}} .button-search-popup:hover .content' => 'color: {{VALUE}};',
                        ],
                    ]
                );

        $this->add_control(
            'text_color_placeholder',
            [
                'label'     => esc_html__('Text Color Placeholder', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_form',
            [
                'label'     => esc_html__('Background Form', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'background: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
              'icon_color_form',
              [
                    'label'     => esc_html__('Color Icon', 'hnice'),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .widget_product_search form::before' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .button-search-popup .hnice-icon-search' => 'color: {{VALUE}};',
                    ],
              ]
         );

          $this->add_control(
                 'icon_color_form_hover',
                 [
                     'label'     => esc_html__('Icon Hover', 'hnice'),
                     'type'      => Controls_Manager::COLOR,
                     'default'   => '',
                     'selectors' => [
                        '{{WRAPPER}} .button-search-popup:hover .hnice-icon-search' => 'color: {{VALUE}};',
                     ],
                 ]
          );

        $this->add_control(
            'border_radius_input',
            [
                'label'      => esc_html__('Border Radius Input', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form input[type=search]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_input',
            [
                'label'      => esc_html__('Padding Input', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form input[type=search]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width_button',
            [
                'label'      => esc_html__('Width Button', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 40,
                        'max' => 200,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}.elementor-widget-hnice-search .widget form button[type=submit]' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['layout_style'] === 'layout-1'):{
            if(hnice_is_woocommerce_activated()){
                hnice_product_search();
            }else{
                ?>
                <div class="site-search widget_search">
                    <?php get_search_form(); ?>
                </div>
                <?php
            }

        }
        endif;

        if ($settings['layout_style'] === 'layout-2'):{
            wp_enqueue_script('hnice-search-popup');
            add_action('wp_footer', 'hnice_header_search_popup', 1);
            ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup">
                    <i class="hnice-icon-search2"></i>
                    <span class="content"><?php echo esc_html__('Search', 'hnice'); ?></span>
                </a>
            </div>
            <?php
        }
        endif;

         if ($settings['layout_style'] === 'layout-3'):{
            wp_enqueue_script('hnice-search-popup');
            add_action('wp_footer', 'hnice_header_search_popup', 1);
            ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup layout-3">
                    <i class="hnice-icon-search2"></i>
                    <span class="content"><?php echo esc_html__('Search...', 'hnice'); ?></span>
                </a>
            </div>
            <?php
        }
        endif;

    }
}

$widgets_manager->register(new Hnice_Elementor_Search());
