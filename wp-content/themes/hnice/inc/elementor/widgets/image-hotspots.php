<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Hnice_Elementor_Image_Hotspots_Widget extends Widget_Base {

    public function get_name() {
        return 'hnice-image-hotspots';
    }

    public function is_reload_preview_required() {
        return true;
    }

    public function get_title() {
        return 'Hnice Image Hotspots';
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
        return 'eicon-image-hotspot';
    }

    public function get_script_depends() {
        return [
            'tooltipster',
            'jquery-scrollbar',
            'hnice-elementor-image-hotspots'
        ];
    }

    public function get_style_depends() {
        return [
            'tooltipster',
            'jquery-scrollbar'
        ];
    }

    public function get_categories() {
        return array('hnice-addons');
    }

    protected function register_controls() {

        /**START Background Image Section  **/
        $this->start_controls_section('image_hotspots_image_section',
            [
                'label' => esc_html__('Image', 'hnice'),
            ]
        );

        $this->add_control('image_hotspots_image',
            [
                'label'       => __('Choose Image', 'hnice'),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'background_image', // Actually its `image_size`.
                'default' => 'full'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_icons_settings',
            [
                'label' => esc_html__('Hotspots', 'hnice'),
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control('image_hotspots_title',
            [
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Hotspots tooltips title',
                'dynamic'     => ['active' => true],
                'label_block' => true,
            ]
        );

        $repeater->add_responsive_control('preimum_image_hotspots_main_icons_horizontal_position',
            [
                'label'      => esc_html__('Horizontal Position', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hnice-image-hotspots-main-icons' => 'left: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_responsive_control('preimum_image_hotspots_main_icons_vertical_position',
            [
                'label'      => esc_html__('Vertical Position', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hnice-image-hotspots-main-icons' => 'top: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_control('image_hotspots_content',
            [
                'label'   => esc_html__('Content to Show', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'text_editor'         => esc_html__('Text Editor', 'hnice'),
                    'elementor_templates' => esc_html__('Elementor Template', 'hnice'),
                    'elementor_product'   => esc_html__('Product', 'hnice'),
                ],
                'default' => 'text_editor'
            ]
        );

        $repeater->add_control('image_hotspots_texts',
            [
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Lorem ipsum',
                'dynamic'     => ['active' => true],
                'label_block' => true,
                'condition'   => [
                    'image_hotspots_content' => 'text_editor'
                ]
            ]
        );

        $repeater->add_control('image_hotspots_templates',
            [
                'label'       => esc_html__('Teamplate', 'hnice'),
                'type'        => Controls_Manager::SELECT,
                'options'     => hnice_get_hotspots(),
                'description' => esc_html__('Size chart will take templates name prefix is "Hotspots"', 'hnice'),
                'condition'   => [
                    'image_hotspots_content' => 'elementor_templates'
                ],
            ]
        );

        $repeater->add_control('image_hotspots_product',
            [
                'label'     => __('Product id', 'hnice'),
                'type'      => 'products',
                'multiple'    => false,
                'condition' => [
                    'image_hotspots_content' => 'elementor_product'
                ],
            ]
        );


        $repeater->add_control('image_hotspots_link_switcher',
            [
                'label'       => esc_html__('Link', 'hnice'),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__('Add a custom link or select an existing page link', 'hnice'),
            ]
        );

        $repeater->add_control('image_hotspots_url',
            [
                'label'       => esc_html__('URL', 'hnice'),
                'type'        => Controls_Manager::URL,
                'condition'   => [
                    'image_hotspots_link_switcher' => 'yes',
                ],
                'placeholder' => 'https://themelexus.com/',
                'label_block' => true
            ]
        );

        $this->add_control('image_hotspots',
            [
                'label'       => esc_html__('Hotspots', 'hnice'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ image_hotspots_title }}}',
            ]
        );


        $this->add_control('image_hotspots_icons_animation',
            [
                'label' => esc_html__('Hidden Radar Animation', 'hnice'),
                'type'  => Controls_Manager::SWITCHER,
                'prefix_class' => 'hidden-radar-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_tooltips_section',
            [
                'label' => esc_html__('Tooltips', 'hnice'),
            ]
        );

        $this->add_control(
            'image_hotspots_trigger_type',
            [
                'label'   => esc_html__('Trigger', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'click' => esc_html__('Click', 'hnice'),
                    'hover' => esc_html__('Hover', 'hnice'),
                ],
                'default' => 'hover'
            ]
        );

        $this->add_control(
            'image_hotspots_arrow',
            [
                'label'     => esc_html__('Show Arrow', 'hnice'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__('Show', 'hnice'),
                'label_off' => esc_html__('Hide', 'hnice'),
            ]
        );

        $this->add_control(
            'image_hotspots_tooltips_position',
            [
                'label'       => esc_html__('Positon', 'hnice'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => [
                    'top'    => esc_html__('Top', 'hnice'),
                    'bottom' => esc_html__('Bottom', 'hnice'),
                    'left'   => esc_html__('Left', 'hnice'),
                    'right'  => esc_html__('Right', 'hnice'),
                ],
                'description' => esc_html__('Sets the side of the tooltip. The value may one of the following: \'top\', \'bottom\', \'left\', \'right\'. It may also be an array containing one or more of these values. When using an array, the order of values is taken into account as order of fallbacks and the absence of a side disables it', 'hnice'),
                'default'     => ['top', 'bottom'],
                'label_block' => true,
                'multiple'    => true
            ]
        );

        $this->add_control('image_hotspots_tooltips_distance_position',
            [
                'label'   => esc_html__('Spacing', 'hnice'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('The distance between the origin and the tooltip in pixels, default is 6', 'hnice'),
                'default' => 6,
            ]
        );

        $this->add_control('image_hotspots_min_width',
            [
                'label'       => esc_html__('Min Width', 'hnice'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'description' => esc_html__('Set a minimum width for the tooltip in pixels, default: 0 (auto width)', 'hnice'),
            ]
        );

        $this->add_control('image_hotspots_max_width',
            [
                'label'       => esc_html__('Max Width', 'hnice'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'description' => esc_html__('Set a maximum width for the tooltip in pixels, default: null (no max width)', 'hnice'),
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_wrapper_height',
            [
                'label'       => esc_html__('Height', 'hnice'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em', '%'],
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ]
                ],
                'label_block' => true,
                'selectors'   => [
                    '.tooltipster-box.tooltipster-box-{{ID}}' => 'height: {{SIZE}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->add_control('image_hotspots_animation',
            [
                'label'       => esc_html__('Animation', 'hnice'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'fade'  => esc_html__('Fade', 'hnice'),
                    'grow'  => esc_html__('Grow', 'hnice'),
                    'swing' => esc_html__('Swing', 'hnice'),
                    'slide' => esc_html__('Slide', 'hnice'),
                    'fall'  => esc_html__('Fall', 'hnice'),
                ],
                'default'     => 'fade',
                'label_block' => true,
            ]
        );

        $this->add_control('image_hotspots_duration',
            [
                'label'   => esc_html__('Animation Duration', 'hnice'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('Set the animation duration in milliseconds, default is 350', 'hnice'),
                'default' => 350,
            ]
        );

        $this->add_control('image_hotspots_delay',
            [
                'label'   => esc_html__('Delay', 'hnice'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('Set the animation delay in milliseconds, default is 10', 'hnice'),
                'default' => 10,
            ]
        );

        $this->add_control('image_hotspots_hide',
            [
                'label'        => esc_html__('Hide on Mobiles', 'hnice'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => 'Show',
                'label_off'    => 'Hide',
                'description'  => esc_html__('Hide tooltips on mobile phones', 'hnice'),
                'return_value' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_image_style_settings',
            [
                'label' => esc_html__('Image', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_hotspots_image_border',
                'selector' => '{{WRAPPER}} .hnice-image-hotspots-container .hnice-addons-image-hotspots-ib-img',
            ]
        );

        $this->add_control('image_hotspots_image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hnice-image-hotspots-container .hnice-addons-image-hotspots-ib-img' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('image_hotspots_image_padding',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hnice-image-hotspots-container .hnice-addons-image-hotspots-ib-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_hotspots_image_align',
            [
                'label'     => __('Text Alignment', 'hnice'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'hnice'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'hnice'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'hnice'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .hnice-image-hotspots-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_tooltips_style_settings',
            [
                'label' => esc_html__('Tooltips', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_color',
            [
                'label'     => esc_html__('Text Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .hnice-image-hotspots-tooltips-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_typo',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .hnice-image-hotspots-tooltips-text, .hnice-image-hotspots-tooltips-text-{{ID}}'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_content_text_shadow',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .hnice-image-hotspots-tooltips-text'
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_background_color',
            [
                'label'     => esc_html__('Background Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'                                 => 'background: {{VALUE}};',
                    '.tooltipster-base.tooltipster-top .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'    => 'border-top-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-bottom .tooltipster-arrow-{{ID}} .tooltipster-arrow-background' => 'border-bottom-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-right .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'  => 'border-right-color: {{VALUE}};',
                    '.tooltipster-base.tooltipster-left .tooltipster-arrow-{{ID}} .tooltipster-arrow-background'   => 'border-left-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_border',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
            ]
        );

        $this->add_control('image_hotspots_tooltips_wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content' => 'border-radius: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_hotspots_tooltips_wrapper_box_shadow',
                'selector' => '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content'
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_wrapper_margin',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content, .tooltipster-arrow-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_wrapper_padding',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '.tooltipster-box.tooltipster-box-{{ID}} .tooltipster-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('img_hotspots_container_style',
            [
                'label' => esc_html__('Container', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control('img_hotspots_container_background',
            [
                'label'     => esc_html__('Background Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hnice-image-hotspots-container' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'img_hotspots_container_border',
                'selector' => '{{WRAPPER}} .hnice-image-hotspots-container',
            ]
        );

        $this->add_control('img_hotspots_container_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hnice-image-hotspots-container' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img_hotspots_container_box_shadow',
                'selector' => '{{WRAPPER}} .hnice-image-hotspots-container',
            ]
        );

        $this->add_responsive_control('img_hotspots_container_margin',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hnice-image-hotspots-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('img_hotspots_container_padding',
            [
                'label'      => esc_html__('Paddding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .hnice-image-hotspots-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = []) {
        // get our input from the widget settings.
        $settings        = $this->get_settings_for_display();
        $animation_class = '';
        if ($settings['image_hotspots_icons_animation'] == 'yes') {
            $animation_class = 'hnice-image-hotspots-animation';
        }

        $image_src = $settings['image_hotspots_image'];

        $image_src_size = Group_Control_Image_Size::get_attachment_image_src($image_src['id'], 'background_image', $settings);
        if (empty($image_src_size)) {
            $image_src_size = $image_src['url'];
        }

        $image_hotspots_settings = [
            'anim'        => $settings['image_hotspots_animation'],
            'animDur'     => !empty($settings['image_hotspots_duration']) ? $settings['image_hotspots_duration'] : 350,
            'delay'       => !empty($settings['image_hotspots_delay']) ? $settings['image_hotspots_delay'] : 10,
            'arrow'       => ($settings['image_hotspots_arrow'] == 'yes') ? true : false,
            'distance'    => !empty($settings['image_hotspots_tooltips_distance_position']) ? $settings['image_hotspots_tooltips_distance_position'] : 6,
            'minWidth'    => !empty($settings['image_hotspots_min_width']['size']) ? $settings['image_hotspots_min_width']['size'] : 0,
            'maxWidth'    => !empty($settings['image_hotspots_max_width']['size']) ? $settings['image_hotspots_max_width']['size'] : 'null',
            'side'        => !empty($settings['image_hotspots_tooltips_position']) ? $settings['image_hotspots_tooltips_position'] : array(
                'right',
                'left'
            ),
            'hideMobiles' => ($settings['image_hotspots_hide'] == true) ? true : false,
            'trigger'     => $settings['image_hotspots_trigger_type'],
            'id'          => $this->get_id()
        ];
        ?>

        <div id="hnice-image-hotspots-<?php echo esc_attr($this->get_id()); ?>"
             class="hnice-image-hotspots-container"
             data-settings='<?php echo wp_json_encode($image_hotspots_settings); ?>'>
            <img class="hnice-addons-image-hotspots-ib-img" alt="Backgroup" src="<?php echo esc_url($image_src_size); ?>">
            <?php foreach ($settings['image_hotspots'] as $index => $item) {
                $list_item_key = 'img_hotspot_' . $index;
                $this->add_render_attribute($list_item_key, 'class',
                    [
                        $animation_class,
                        'hnice-image-hotspots-main-icons',
                        'elementor-repeater-item-' . $item['_id'],
                        'tooltip-wrapper',
                        'hnice-image-hotspots-main-icons-' . $item['_id']
                    ]);
                $this->add_render_attribute($list_item_key, 'data-tab', '#elementor-tab-title-' . $item['_id']); ?>
                <div <?php $this->print_render_attribute_string($list_item_key); ?>
                        data-tooltip-content="#tooltip-content-<?php echo esc_attr($index); ?>">
                    <?php

                    if ($item['image_hotspots_link_switcher'] == 'yes' && $settings['image_hotspots_trigger_type'] == 'hover') : ?>
                        <?php
                        $link_url = '#';
                        if ($item['image_hotspots_url']['url']) {
                            $link_url = $item['image_hotspots_url']['url'];
                        } ?>
                        <a class="hnice-image-hotspots-tooltips-link" href="<?php echo esc_url($link_url); ?>"
                           <?php if (!empty($item['image_hotspots_url']['is_external'])) : ?>target="_blank"
                           <?php endif; ?><?php if (!empty($item['image_hotspots_url']['nofollow'])) : ?>rel="nofollow"<?php endif; ?>>
                            <i class="hnice-image-hotspots-icon"></i>
                        </a>
                    <?php else : ?>
                        <i class="hnice-image-hotspots-icon"></i>
                    <?php endif; ?>

                    <div class="hnice-image-hotspots-tooltips-wrapper">
                        <div id="tooltip-content-<?php echo esc_attr($index); ?>" class="tooltip-content hnice-image-hotspots-tooltips-text hnice-image-hotspots-tooltips-text-<?php echo esc_attr($this->get_id()); ?>">
                            <?php
                            if ($item['image_hotspots_content'] == 'elementor_templates') {
                                $slug         = $item['image_hotspots_templates'];
                                $queried_post = get_page_by_path($slug, OBJECT, 'elementor_library');

                                if (isset($queried_post->ID)) {
                                    echo Plugin::instance()->frontend->get_builder_content($queried_post->ID);
                                }
                            } elseif (($item['image_hotspots_content'] == 'elementor_product') && hnice_is_woocommerce_activated()) {
                                $product = wc_get_product($item['image_hotspots_product']);
                                if ($product) {
                                    echo '<a href="' . $product->get_permalink() . '" title="' . $product->get_title() . '">' . $product->get_image() . '</a>';
                                    echo '<h4><a href="' . $product->get_permalink() . '" title="' . $product->get_title() . '">' . $product->get_title() . '</a></h4>';
                                    echo '<div class="price">' . $product->get_price_html() . '</div>';
                                }
                            } else {
                                echo wp_kses_post( $item['image_hotspots_texts'] );
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

$widgets_manager->register(new Hnice_Elementor_Image_Hotspots_Widget());
