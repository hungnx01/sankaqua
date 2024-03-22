<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

class Hnice_Video_Popup extends Elementor\Widget_Base {


    public function get_name() {
        return 'hnice-video-popup';
    }

    public function get_title() {
        return esc_html__('Hnice Video Popup', 'hnice');
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_script_depends() {
        return ['hnice-elementor-video', 'magnific-popup'];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_videos',
            [
                'label' => esc_html__('General', 'hnice'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label'       => esc_html__('Link to', 'hnice'),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__('Support video from Youtube and Vimeo', 'hnice'),
                'placeholder' => esc_html__('https://your-link.com', 'hnice'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'hnice'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Tile', 'hnice'),
                'default'     => '',
            ]
        );
        $this->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'hnice'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Description', 'hnice'),
                'default'     => '',
            ]
        );

        $this->add_responsive_control(
            'video_align',
            [
                'label'     => esc_html__('Alignment', 'hnice'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'hnice'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'hnice'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'hnice'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_icon',
            [
                'label' => esc_html__( 'Icon', 'hnice' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ]
            ]
        );

        $this->add_control(
            'video_icon_align',
            [
                'label' => esc_html__( 'Icon Position', 'hnice' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'after',
                'options' => [
                    'before' => esc_html__( 'Before', 'hnice' ),
                    'after' => esc_html__( 'After', 'hnice' ),
                ],
                'condition' => [
                    'video_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'show_title_block',
            [
                'label'     => esc_html__('Position Vertical', 'hnice'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'hnice'),
                'label_on'  => esc_html__('On', 'hnice'),
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hnice-video-popup .elementor-video-popup' => 'flex-direction: column; text-align: center;',
                ],
            ]
        );


        $this->end_controls_section();

        //Wrapper
        $this->start_controls_section(
            'section_video_wrapper',
            [
                'label' => esc_html__('Wrapper', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_wrapper_style');

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => esc_html__('Normal', 'hnice'),
            ]
        );

        $this->add_control(
            'background_wrapper',
            [
                'label'     => esc_html__('Background', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_hover',
            [
                'label' => esc_html__('Hover', 'hnice'),
            ]
        );

        $this->add_control(
            'background_wrapper_hover',
            [
                'label'     => esc_html__('Background', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_wrapper_hover',
            [
                'label'     => esc_html__('Border Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(

            Group_Control_Border::get_type(),
            [
                'name'        => 'border_wrapper',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-video-popup',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'section_video_style',
            [
                'label' => esc_html__('Icon', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_size',
            [
                'label'     => esc_html__('Font Size', 'hnice'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hnice-video-popup .elementor-video-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_width',
            [
                'label'     => esc_html__('Width', 'hnice'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'video_icon[value]!' => '',
                ],

                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-icon ' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_height',
            [
                'label'     => esc_html__('Height', 'hnice'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_effects',
            [
                'label'     => esc_html__( 'Effects', 'hnice' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'prefix_class'  => 'video-icon-effects'
            ]
        );

        $this->start_controls_tabs('tabs_video_style');

        $this->start_controls_tab(
            'tab_video_normal',
            [
                'label' => esc_html__('Normal', 'hnice'),
                'condition' => [
                    'video_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'video_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hnice-video-popup .elementor-video-icon ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_background_color',
            [
                'label'     => esc_html__('Background Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hnice-video-popup .elementor-video-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_video_hover',
            [
                'label' => esc_html__('Hover', 'hnice'),
                'condition' => [
                    'video_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'video_hover_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .elementor-video-icon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'video_hover_background_color',
            [
                'label'     => esc_html__('Background Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .elementor-video-icon:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-icon:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'video_hover_box_shadow',
                'condition' => [
                    'video_icon[value]!' => '',
                ],
                'selector' => '{{WRAPPER}} .hnice-video-popup:hover .elementor-video-icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_video',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-video-popup .elementor-video-icon',
                'separator'   => 'before',
            ]
        );


        $this->add_control(
            'video_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup .elementor-video-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'video_box_shadow',
                'selector' => '{{WRAPPER}} .hnice-video-popup .elementor-video-icon',
            ]
        );

        $this->add_responsive_control(
            'video_padding',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hnice-video-popup .elementor-video-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_responsive_control(
            'video_margin',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hnice-video-popup .elementor-video-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->end_controls_section();

        //title
        $this->start_controls_section(
            'section_video_title',
            [
                'label' => esc_html__('Title', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hnice-video-popup .elementor-video-title' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                //'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .hnice-video-popup .elementor-video-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_video_description',
            [
                'label' => esc_html__('Description', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hnice-video-popup .elementor-video-description' => 'color: {{VALUE}};',

                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_description',
                //'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .hnice-video-popup .elementor-video-description',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['video_link'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'elementor-video-wrapper');
        $this->add_render_attribute('wrapper', 'class', 'hnice-video-popup');

        $this->add_render_attribute('button', 'class', 'elementor-video-popup');
        $this->add_render_attribute('button', 'role', 'button');
        $this->add_render_attribute('button', 'href', esc_url($settings['video_link']));
        $this->add_render_attribute('button', 'data-effect', 'mfp-zoom-in');

        $this->add_render_attribute('video-icon', 'class', 'elementor-video-icon');
        $this->add_render_attribute('video-icon', 'class', 'video-icon-align-' . esc_attr($settings['video_icon_align']));
        $titleHtml = !empty($settings['title']) ? '<span class="elementor-video-title">' . $settings['title'] . '</span>' : '';
        $this->add_render_attribute('description', 'class', ['elementor-video-description',]);


        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>

            <a <?php $this->print_render_attribute_string('button'); ?>>
                    <span class="video-content">
                        <?php printf('%s', $titleHtml); ?>

                        <?php if (!empty($settings['description'])) : ?>
                            <span <?php $this->print_render_attribute_string('description'); ?>>
                            <?php printf('%s', $settings['description']); ?>
                        </span>
                        <?php endif; ?>
                    </span>

                    <span <?php $this->print_render_attribute_string('video-icon'); ?>>
                    <span class="animation"> </span>
                    <?php  Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
            </a>
        </div>
        <?php
    }

}

$widgets_manager->register(new Hnice_Video_Popup());
