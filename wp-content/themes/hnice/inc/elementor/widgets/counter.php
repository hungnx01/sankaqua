<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class Hnice_Elementor_Counter extends Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve counter widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'counter';
    }

    /**
     * Get widget title.
     *
     * Retrieve counter widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Hnice Counter', 'hnice');
    }

    /**
     * Get widget icon.
     *
     * Retrieve counter widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-counter';
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since  1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['jquery-numerator'];
    }

    /**
     * Register counter widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_counter',
            [
                'label' => __('Counter', 'hnice'),
            ]
        );

        $this->add_control(
            'starting_number',
            [
                'label'   => __('Starting Number', 'hnice'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $this->add_control(
            'ending_number',
            [
                'label'   => __('Ending Number', 'hnice'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 100,
            ]
        );

        $this->add_control(
            'prefix',
            [
                'label'       => __('Number Prefix', 'hnice'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => 1,
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label'       => __('Number Suffix', 'hnice'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => __('Plus', 'hnice'),
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'     => __('Show Icon', 'hnice'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'hnice'),
                'label_off' => __('Hide', 'hnice'),
            ]
        );

        $this->add_control(
            'icon_select',
            [
                'label'     => __('Icon select', 'hnice'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'use_icon',
                'options'   => [
                    'use_icon'  => __('Use Icon', 'hnice'),
                    'use_image' => __('Use Image', 'hnice'),
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => __('Choose Image', 'hnice'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_select' => 'use_image',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'      => __(' Size', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter .elementor-icon-counter img, {{WRAPPER}} .elementor-counter .elementor-icon-counter svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_select' => 'use_image',
                    'show_icon'   => 'yes',
                ],
            ]
        );


        $this->add_control(
            'icon',
            [
                'label'            => esc_html__('Icon', 'hnice'),
                'type'             => Controls_Manager::ICONS,
                'condition'  => [
                    'icon_select' => 'use_icon',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'duration',
            [
                'label'   => __('Animation Duration', 'hnice'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2000,
                'min'     => 100,
                'step'    => 100,
            ]
        );

        $this->add_control(
            'thousand_separator',
            [
                'label'     => __('Thousand Separator', 'hnice'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => __('Show', 'hnice'),
                'label_off' => __('Hide', 'hnice'),
            ]
        );

        $this->add_control(
            'thousand_separator_char',
            [
                'label'     => __('Separator', 'hnice'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'thousand_separator' => 'yes',
                ],
                'options'   => [
                    ''  => 'Default',
                    '.' => 'Dot',
                    ' ' => 'Space',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'hnice'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __('Cool Number', 'hnice'),
                'placeholder' => __('Cool Number', 'hnice'),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => __('Sub Title', 'hnice'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Sub Title', 'hnice'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __('Description', 'hnice'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __('Description...', 'hnice'),
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'hnice'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        //wrapper
        $this->start_controls_section(

            'section_wrapper',
            [
                'label' => __('Wrapper', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label'        => __('Alignment', 'hnice'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'     => [
                        'title'=> __('Left', 'hnice'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center'   => [
                        'title'=> __('Center', 'hnice'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right'    => [
                        'title'=> __('Right', 'hnice'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle'       => false,
                'prefix_class' => 'elementor-alignment-',
                'default'      => 'left',
            ]
        );

        $this->add_control(
            'content_vertical_alignment',
            [
                'label'        => __('Vertical Alignment', 'hnice'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'top'      => __('Top', 'hnice'),
                    'middle'   => __('Middle', 'hnice'),
                    'bottom'   => __('Bottom', 'hnice'),
                ],
                'default'      => 'top',
                'prefix_class' => 'elementor-vertical-align-',
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label'     => esc_html__('Background Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter' => 'background-color: {{VALUE}};',
                ],
                'condition'  => [
                    'style_special' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'background_color_hover',
            [
                'label'     => esc_html__('Background Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover' => 'background-color: {{VALUE}};',
                ],
                'condition'  => [
                    'style_special' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'border-width',
            [
                'label'      => __( 'Border Width', 'hnice' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter'        => 'border-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-counter:before' => 'top: -{{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-counter:after'  => 'bottom: -{{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'style_special2' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-counter:hover:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-counter:hover:after' => 'background-color: {{VALUE}};',
                ],
                'condition'  => [
                    'style_special2' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'border_color_effect',
            [
                'label'     => esc_html__('Border Color Effect', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-counter:after' => 'background-color: {{VALUE}};',
                ],
                'condition'  => [
                    'style_special2' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'width_box_effect',
            [
                'label' => esc_html__( 'Width Box Effect', 'hnice' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:before' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .elementor-counter:after' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'style_special2' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        //number
        $this->start_controls_section(

            'section_number',
            [
                'label' => __('Number', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     => __('Text Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'number_color_hover',
            [
                'label'     => __('Text Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-counter-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_number',
                'selector' => '{{WRAPPER}} .elementor-counter-number',
            ]
        );

        $this->add_responsive_control(
            'spacing_number_wrapper',
            [
                'label' => esc_html__('Margin', 'hnice'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        //number prefix
        $this->start_controls_section(

            'section_number_prefix',
            [
                'label' => __('Number Prefix', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_prefix_color',
            [
                'label'     => __('Text Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-prefix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_prefix_color_hover',
            [
                'label'     => __('Text Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-counter-number-prefix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_number_prefix',
                'selector' => '{{WRAPPER}} .elementor-counter-number-prefix',
            ]
        );

        $this->add_responsive_control(
            'spacing_number_prefix',
            [
                'label'      => __( 'Spacing', 'hnice' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-number-prefix' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //number suffix
        $this->start_controls_section(

            'section_number_suffix',
            [
                'label' => __('Number Suffix', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_suffix_color',
            [
                'label'     => __('Text Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-number-suffix' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'number_suffix_color_hover',
            [
                'label'     => __('Text Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-counter-number-suffix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_number_suffix',
                'selector' => '{{WRAPPER}} .elementor-counter-number-suffix',
            ]
        );

        $this->add_responsive_control(
            'spacing_number_suffix',
            [
                'label'      => __( 'Spacing', 'hnice' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-number-suffix' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //title
        $this->start_controls_section(
            'section_title',
            [
                'label'     => __('Title', 'hnice'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title!' => '',
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Text Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => __('Text Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-counter-title' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_title',
                'selector' => '{{WRAPPER}} .elementor-counter-title',
            ]
        );

        $this->add_responsive_control(
            'spacing_title',
            [
                'label'      => __( 'Spacing', 'hnice' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //sub title
        $this->start_controls_section(
            'section_sub_title',
            [
                'label'     => __('Sub Title', 'hnice'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'sub_title!' => '',
                ]
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('Text Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sub_title_color_hover',
            [
                'label'     => __('Text Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-counter-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_sub_title',
                'selector' => '{{WRAPPER}} .elementor-counter-sub-title',
            ]
        );

        $this->add_responsive_control(
            'spacing_sub_title',
            [
                'label'      => __( 'Spacing', 'hnice' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-counter-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //description
        $this->start_controls_section(
            'section_description',
            [
                'label'     => __('Description', 'hnice'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'description!' => '',
                ]
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __('Text Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_color_hover',
            [
                'label'     => __('Text Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-counter-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_description',
                'selector' => '{{WRAPPER}} .elementor-counter-description',
            ]
        );

        $this->end_controls_section();

        //icon
        $this->start_controls_section(
            'section_icon',
            [
                'label'     => __('Icon', 'hnice'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'icon_select' => 'use_icon',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-counter'     => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-icon-counter' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background_color',
            [
                'label'     => __('Background Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-counter'     => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background_color_hover',
            [
                'label'     => __('Background Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-icon-counter'     => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __( 'Size', 'hnice' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-counter' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_width',
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
                    '{{WRAPPER}} .elementor-icon-counter' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label'          => esc_html__('Height', 'hnice'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .elementor-icon-counter' => 'height: {{SIZE}}{{UNIT}}; line-height:{{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __( 'Margin', 'hnice' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hnice'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //image
        $this->start_controls_section(
            'section_image',
            [
                'label'     => __('Image & SVG', 'hnice'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'icon_select' => 'use_image',
                    'show_icon'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'svg_color',
            [
                'label'     => __('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-counter svg'     => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'svg_color_hover',
            [
                'label'     => __('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-counter:hover .elementor-icon-counter svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_counter_margin',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon-counter img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-icon-counter svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Render counter widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function content_template() {
        return;
    }

    /**
     * Render counter widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $has_icon = !empty($settings['icon']);

        if ($has_icon) {
            $this->add_render_attribute('icon', 'class', $settings['icon']);
            $this->add_render_attribute('icon', 'aria-hidden', 'true');
        }

        if (empty($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            $settings['icon'] = 'fa fa-star';
        }

        if (!empty($settings['icon'])) {
            $this->add_render_attribute('icon', 'class', $settings['icon']);
            $this->add_render_attribute('icon', 'aria-hidden', 'true');
        }

        $this->add_render_attribute('counter', [
            'class'         => 'elementor-counter-number',
            'data-duration' => $settings['duration'],
            'data-to-value' => $settings['ending_number'],
        ]);

        if (!empty($settings['thousand_separator'])) {
            $delimiter = empty($settings['thousand_separator_char']) ? ',' : $settings['thousand_separator_char'];
            $this->add_render_attribute('counter', 'data-delimiter', $delimiter);
        }
        ?>
        <div class="elementor-counter">
            <?php
            $this->get_image_icon();
            Icons_Manager::render_icon('icon', ['aria-hidden' => 'true']);
            ?>
            <div class="elementor-counter-wrapper">
                <div class="elementor-counter-number-wrapper">
                    <span class="elementor-counter-number-prefix"><?php $this->print_unescaped_setting('prefix'); ?></span>
                    <span <?php $this->print_render_attribute_string('counter'); ?>><?php $this->print_unescaped_setting('starting_number'); ?></span>
                    <span class="elementor-counter-number-suffix"><?php $this->print_unescaped_setting('suffix'); ?></span>
                </div>

                <div class="elementor-counter-title-wrap">
                    <?php if ($settings['title']) : ?>
                        <div class="elementor-counter-title"><?php $this->print_unescaped_setting('title'); ?></div>
                    <?php endif; ?>
                    <?php if ($settings['sub_title']) : ?>
                        <div class="elementor-counter-sub-title"><?php $this->print_unescaped_setting('sub_title'); ?></div>
                    <?php endif; ?>
                    <?php if ($settings['description']) : ?>
                        <div class="elementor-counter-description"><?php $this->print_unescaped_setting('description'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    private function get_image_icon() {
        $settings = $this->get_settings_for_display();
        if ('yes' === $settings['show_icon']):
            ?>
            <div class="elementor-icon-counter">
                <?php if ('use_image' === $settings['icon_select'] && !empty($settings['image']['url'])) :
                    $image_url = '';
                    $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, '', 'image');
                    $image_url = $settings['image']['url'];
                    $path_parts = pathinfo($image_url);
                    if ($path_parts['extension'] === 'svg') {
                        $image = $this->get_settings_for_display('image');
                        $pathSvg = get_attached_file($image['id']);
                        $image_html = hnice_get_icon_svg($pathSvg);
                    }
                    echo sprintf('%s', $image_html);
                    ?>
                <?php elseif ('use_icon' === $settings['icon_select'] && !empty($settings['icon'])) : ?>
                    <i <?php $this->print_render_attribute_string('icon'); ?>></i>
                <?php endif; ?>
            </div>
        <?php
        endif;
    }
}
$widgets_manager->register(new Hnice_Elementor_Counter());
