<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Hnice\Elementor\Hnice_Base_Widgets;


class Hnice_Elementor_Testimonials extends Hnice_Base_Widgets {

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'hnice-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Hnice Testimonials', 'hnice');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_script_depends() {
        return ['hnice-elementor-testimonial'];
    }

    public function get_categories() {
        return array('hnice-addons');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => esc_html__('Testimonials', 'hnice'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_title',
            [
                'label'   => esc_html__('Title', 'hnice'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Testimonial title',
            ]
        );

        $repeater->add_control(
            'testimonial_icon',
            [
                'label' => esc_html__('Icon', 'hnice'),
                'type'  => Controls_Manager::ICONS,
            ]
        );

        $repeater->add_control(
            'testimonial_rating',
            [
                'label'   => esc_html__('Rating', 'hnice'),
                'default' => 5,
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    0 => esc_html__('Hidden', 'hnice'),
                    1 => esc_html__('Very poor', 'hnice'),
                    2 => esc_html__('Not that bad', 'hnice'),
                    3 => esc_html__('Average', 'hnice'),
                    4 => esc_html__('Good', 'hnice'),
                    5 => esc_html__('Perfect', 'hnice'),
                ]
            ]
        );
        $repeater->add_control(
            'testimonial_content',
            [
                'label'       => esc_html__('Content', 'hnice'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                'label_block' => true,
                'rows'        => '10',
            ]
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label'   => esc_html__('Name', 'hnice'),
                'default' => 'John Doe',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'testimonial_job',
            [
                'label'   => esc_html__('Job', 'hnice'),
                'default' => 'Design',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'testimonial_image',
            [
                'label'      => esc_html__('Choose Image', 'hnice'),
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'testimonial_link',
            [
                'label'       => esc_html__('Link to', 'hnice'),
                'placeholder' => esc_html__('https://your-link.com', 'hnice'),
                'type'        => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label'       => esc_html__('Items', 'hnice'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );
        $this->add_control(
            'icon-view',
            [
                'label'        => esc_html__('Icon-view', 'hnice'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'default' => esc_html__('Default', 'hnice'),
                    'stacked' => esc_html__('Stacked', 'hnice'),
                    'framed'  => esc_html__('Framed', 'hnice'),
                ],
                'default'      => 'default',
                'prefix_class' => 'elementor-view-',
            ]
        );
        $this->add_control(
            'shape',
            [
                'label'        => esc_html__('Shape', 'hnice'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'circle' => esc_html__('Circle', 'hnice'),
                    'square' => esc_html__('Square', 'hnice'),
                ],
                'default'      => 'circle',
                'condition'    => [
                    'icon-view!' => 'default',
                ],
                'prefix_class' => 'elementor-shape-',
            ]
        );
        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'testimonial_image',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'testimonial_layout',
            [
                'label'   => esc_html__('Layout', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => 'Style 1',
                    '2' => 'Style 2',
                    '3' => 'Style 3',
                    '4' => 'Style 4',
                    '5' => 'Style 5',
                ],
            ]
        );
        $this->add_control(
            'view',
            [
                'label'   => esc_html__('View', 'hnice'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        // WRAPPER STYLE
        $this->start_controls_section(
            'section_style_testimonial_wrapper',
            [
                'label' => esc_html__('Wrapper', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_responsive_control(
            'testimonial_width',
            [
                'label'          => esc_html__('Width', 'hnice'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper .inner' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_estimonial_wrapper',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_testimonial_wrapper',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_hover_bottom',
            [
                'label'        => esc_html__('Show Hover Bottom', 'hnice'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'show-hover-bottom-',
                'separator'    => 'before',
            ]
        );

        $this->add_responsive_control(
            'hover-height',
            [
                'label'      => esc_html__('Height', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'vh'],
                'condition'  => [
                    'show_hover_bottom' => 'yes',
                ],
                'selectors'  => [
                    '{{WRAPPER}}.show-hover-bottom-yes .elementor-testimonial-item-wrapper .inner:after' => 'height: {{SIZE}}{{UNIT}}',

                ],
            ]
        );

        $this->add_control(
            'background_hover',
            [
                'label'     => esc_html__('Background Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'show_hover_bottom' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}.show-hover-bottom-yes .elementor-testimonial-item-wrapper .inner:after' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'color_testimonial_background',
            [
                'label'     => esc_html__('Background Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'testimonial_box-shadow',
                'selector' => '{{WRAPPER}} .inner',
            ]
        );


        $this->add_responsive_control(
            'testimonial_alignment',
            [
                'label'       => esc_html__('Alignment Content', 'hnice'),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
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
                'label_block' => false,
                'selectors'   => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper .inner'                        => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper .testimonial-caption .details' => 'text-align: {{VALUE}}'

                ],
            ]
        );
        $this->add_responsive_control(
            'align_caption',
            [
                'label'     => esc_html__('Alignment Info ', 'hnice'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'hnice'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'hnice'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__('Right', 'hnice'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-item-wrapper .testimonial-caption' => 'justify-content: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'wrapper_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .inner',
                'separator'   => 'before',

            ]
        );

        $this->add_control(
            'wrapper_radius',
            [
                'label'      => esc_html__('Border Radius', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_testimonial_img',
            [
                'label' => esc_html__('Image', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'testimonial_width_img',
            [
                'label'      => esc_html__('Width', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%', 'vw'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_height_img',
            [
                'label'      => esc_html__('Height', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'vh'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'testimonial_radius_img',
            [
                'label'      => esc_html__('Border Radius', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_testimonial_img',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_testimonial_img',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title
        $this->start_controls_section(
            'section_style_testimonial_title',
            [
                'label' => esc_html__('Title', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_title_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_title_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item-box:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'     => esc_html__('Spacing', 'hnice'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content style
        $this->start_controls_section(
            'section_style_testimonial_style',
            [
                'label' => esc_html__('Content', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_content_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_content_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .inner:hover .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .content',
            ]
        );

        $this->add_responsive_control(
            'content_spacing',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Name.
        $this->start_controls_section(
            'section_style_testimonial_name',
            [
                'label' => esc_html__('Name', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .name, {{WRAPPER}} .name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .inner .name:hover, {{WRAPPER}} .inner .name a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .name',
            ]
        );

        $this->add_responsive_control(
            'name_padding',
            [
                'size_units' => ['px', 'em', '%'],
                'label'      => esc_html__('Spacing', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_testimonial_job',
            [
                'label' => esc_html__('Job', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'job_text_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .inner:hover .job' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .job',
            ]
        );

        $this->end_controls_section();

        // rating
        $this->start_controls_section(
            'section_style_testimonial_rating',
            [
                'label' => esc_html__('Rating', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-testimonial-rating' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_spacing',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon
        $this->start_controls_section(
            'section_style_testimonial_icon',
            [
                'label' => esc_html__('Icon', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .inner:hover .icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size_inner',
            [
                'label'      => __('Size', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .inner .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .inner .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Carousel column
        $this->get_controls_column();
        // Carousel options
        $this->get_control_carousel();

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['testimonials']) && is_array($settings['testimonials'])) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-testimonial-item-wrapper');
            // Row
            $this->get_data_elementor_columns();
            $this->add_render_attribute('inner', 'class', 'layout-' . esc_attr($settings['testimonial_layout']));
            // Item
            $this->add_render_attribute('item', 'class', 'elementor-grid-item elementor-testimonial-item');
            $this->add_render_attribute('details', 'class', 'details');


            ?>
            <div <?php $this->print_render_attribute_string('wrapper'); ?>>
                <div <?php $this->print_render_attribute_string('container'); ?>>
                    <div <?php $this->print_render_attribute_string('inner'); ?>>
                        <?php foreach ($settings['testimonials'] as $testimonial): ?>
                            <div <?php $this->print_render_attribute_string('item'); ?>>
                                <?php if ($settings['testimonial_layout'] == '1'): ?>
                                    <div class="item-inner inner">
                                        <div class="testimonial-content-text">
                                            <?php if (!empty($testimonial['testimonial_icon']['value'])): ?>
                                                <div class="icon"><?php \Elementor\Icons_Manager::render_icon($testimonial['testimonial_icon'], ['aria-hidden' => 'true']); ?></div>
                                            <?php endif; ?>
                                            <?php $this->render_rating($testimonial); ?>


                                            <?php if (!empty($testimonial['testimonial_title'])) : ?>
                                                <h3 class="title"><?php echo esc_html($testimonial["testimonial_title"]) ?></h3>
                                            <?php endif; ?>

                                            <?php if (!empty($testimonial['testimonial_content'])) : ?>
                                                <div class="content"><?php echo sprintf('%s', $testimonial['testimonial_content']); ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="testimonial-caption">
                                            <div class="caption-top">
                                                <?php $this->render_image($settings, $testimonial); ?>
                                            </div>
                                            <div <?php $this->print_render_attribute_string('details'); ?>>
                                                <?php
                                                $testimonial_name_html = $testimonial['testimonial_name'];
                                                if (!empty($testimonial['testimonial_link']['url'])) :
                                                    $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . esc_html($testimonial_name_html) . '</a>';
                                                endif;
                                                printf('<span class="name">%s</span>', $testimonial_name_html);
                                                ?>
                                                <?php if ($testimonial['testimonial_job']): ?>
                                                    <span class="job"><?php echo esc_html($testimonial['testimonial_job']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['testimonial_layout'] == '2'): ?>
                                    <div class="item-inner inner">
                                        <div class="testimonial-caption">
                                            <div class="caption-top">
                                                <?php $this->render_image($settings, $testimonial); ?>
                                                <div <?php $this->print_render_attribute_string('details'); ?>>
                                                    <?php
                                                    $testimonial_name_html = $testimonial['testimonial_name'];
                                                    if (!empty($testimonial['testimonial_link']['url'])) :
                                                        $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . esc_html($testimonial_name_html) . '</a>';
                                                    endif;
                                                    printf('<span class="name">%s</span>', $testimonial_name_html);
                                                    ?>
                                                    <?php if ($testimonial['testimonial_job']): ?>
                                                        <span class="job"><?php echo esc_html($testimonial['testimonial_job']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="content-icon">
                                                <?php if (!empty($testimonial['testimonial_icon']['value'])): ?>
                                                    <div class="icon"><?php \Elementor\Icons_Manager::render_icon($testimonial['testimonial_icon'], ['aria-hidden' => 'true']); ?></div>
                                                <?php endif; ?>
                                                <?php $this->render_rating($testimonial); ?>
                                            </div>
                                        </div>
                                        <div class="testimonial-content-text">


                                            <?php if (!empty($testimonial['testimonial_title'])) : ?>
                                                <h3 class="title"><?php echo esc_html($testimonial["testimonial_title"]) ?></h3>
                                            <?php endif; ?>

                                            <?php if (!empty($testimonial['testimonial_content'])) : ?>
                                                <div class="content"><?php echo sprintf('%s', $testimonial['testimonial_content']); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['testimonial_layout'] == '3'): ?>
                                    <div class="item-inner inner">
                                        <div class="caption-top">
                                            <?php $this->render_image($settings, $testimonial); ?>
                                            <?php if (!empty($testimonial['testimonial_icon']['value'])): ?>
                                                <div class="icon"><?php \Elementor\Icons_Manager::render_icon($testimonial['testimonial_icon'], ['aria-hidden' => 'true']); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="testimonial-content-text">

                                            <?php $this->render_rating($testimonial); ?>


                                            <?php if (!empty($testimonial['testimonial_title'])) : ?>
                                                <h3 class="title"><?php echo esc_html($testimonial["testimonial_title"]) ?></h3>
                                            <?php endif; ?>

                                            <?php if (!empty($testimonial['testimonial_content'])) : ?>
                                                <div class="content"><?php echo sprintf('%s', $testimonial['testimonial_content']); ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="testimonial-caption">

                                            <div <?php $this->print_render_attribute_string('details'); ?>>
                                                <?php
                                                $testimonial_name_html = $testimonial['testimonial_name'];
                                                if (!empty($testimonial['testimonial_link']['url'])) :
                                                    $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . esc_html($testimonial_name_html) . '</a>';
                                                endif;
                                                printf('<span class="name">%s</span>', $testimonial_name_html);
                                                ?>
                                                <?php if ($testimonial['testimonial_job']): ?>
                                                    <span class="job"><?php echo esc_html($testimonial['testimonial_job']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['testimonial_layout'] == '4'): ?>
                                    <div class="item-inner inner">
                                        <div class="caption-top">
                                            <?php $this->render_image($settings, $testimonial); ?>
                                        </div>
                                        <div class="testimonial-content-text">
                                            <?php if (!empty($testimonial['testimonial_icon']['value'])): ?>
                                                <div class="icon"><?php \Elementor\Icons_Manager::render_icon($testimonial['testimonial_icon'], ['aria-hidden' => 'true']); ?></div>
                                            <?php endif; ?>
                                            <?php $this->render_rating($testimonial); ?>


                                            <?php if (!empty($testimonial['testimonial_title'])) : ?>
                                                <h3 class="title"><?php echo esc_html($testimonial["testimonial_title"]) ?></h3>
                                            <?php endif; ?>

                                            <?php if (!empty($testimonial['testimonial_content'])) : ?>
                                                <div class="content"><?php echo sprintf('%s', $testimonial['testimonial_content']); ?></div>
                                            <?php endif; ?>
                                            <div class="testimonial-caption">

                                                <div <?php $this->print_render_attribute_string('details'); ?>>
                                                    <?php
                                                    $testimonial_name_html = $testimonial['testimonial_name'];
                                                    if (!empty($testimonial['testimonial_link']['url'])) :
                                                        $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . esc_html($testimonial_name_html) . '</a>';
                                                    endif;
                                                    printf('<span class="name">%s</span>', $testimonial_name_html);
                                                    ?>
                                                    <?php if ($testimonial['testimonial_job']): ?>
                                                        <span class="job"><?php echo esc_html($testimonial['testimonial_job']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['testimonial_layout'] == '5'): ?>
                                    <div class="item-inner inner">
                                        <div class="testimonial-content-text">

                                            <?php $this->render_rating($testimonial); ?>

                                            <?php if (!empty($testimonial['testimonial_title'])) : ?>
                                                <h3 class="title"><?php echo esc_html($testimonial["testimonial_title"]) ?></h3>
                                            <?php endif; ?>

                                            <?php if (!empty($testimonial['testimonial_content'])) : ?>
                                                <div class="content"><?php echo sprintf('%s', $testimonial['testimonial_content']); ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="testimonial-caption">
                                            <div class="caption-top">
                                                <?php $this->render_image($settings, $testimonial); ?>
                                                <?php if (!empty($testimonial['testimonial_icon']['value'])): ?>
                                                    <div class="icon"><?php \Elementor\Icons_Manager::render_icon($testimonial['testimonial_icon'], ['aria-hidden' => 'true']); ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div <?php $this->print_render_attribute_string('details'); ?>>
                                                <?php
                                                $testimonial_name_html = $testimonial['testimonial_name'];
                                                if (!empty($testimonial['testimonial_link']['url'])) :
                                                    $testimonial_name_html = '<a href="' . esc_url($testimonial['testimonial_link']['url']) . '">' . esc_html($testimonial_name_html) . '</a>';
                                                endif;
                                                printf('<span class="name">%s</span>', $testimonial_name_html);
                                                ?>
                                                <?php if ($testimonial['testimonial_job']): ?>
                                                    <span class="job"><?php echo esc_html($testimonial['testimonial_job']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php $this->get_swiper_navigation(count($settings['testimonials'])); ?>
            </div>
            <?php
        }
    }

    private function render_image($settings, $testimonial) {
        if (!empty($testimonial['testimonial_image']['url'])) :
            ?>
            <div class="elementor-testimonial-image">
                <?php
                $testimonial['testimonial_image_size']             = $settings['testimonial_image_size'];
                $testimonial['testimonial_image_custom_dimension'] = $settings['testimonial_image_custom_dimension'];
                echo Group_Control_Image_Size::get_attachment_image_html($testimonial, 'testimonial_image');
                ?>
            </div>
        <?php
        endif;
    }

    private function render_rating($testimonial) {
        if ($testimonial['testimonial_rating'] && $testimonial['testimonial_rating'] > 0) {
            echo '<div class="elementor-testimonial-rating">';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $testimonial['testimonial_rating']) {
                    echo '<i class="hnice-icon-star active" aria-hidden="true"></i>';
                }
            }
            echo '</div>';
        }
    }
}

$widgets_manager->register(new Hnice_Elementor_Testimonials());

