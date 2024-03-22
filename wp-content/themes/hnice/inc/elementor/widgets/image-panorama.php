<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Image Panorama
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Hnice_Image_Panorama extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     *
     * @access public
     *
     */
    public function get_name() {
        return 'hnice-image-panorama';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     *
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Hnice Image Panorama', 'hnice');
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     *
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    public function get_script_depends() {
        return [
            'three',
            'panolens',
            'hnice-elementor-image-panorama'
        ];
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @return array Widget categories.
     * @since 1.0.0
     *
     * @access public
     *
     */
    public function get_categories() {
        return ['hnice-addons'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @return array Widget scripts dependencies.
     * @since 1.0.0
     *
     * @access public
     *
     */


    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'hnice'),
            ]
        );


        $this->add_control(
            'panorama_img',
            [
                'label'   => esc_html__('Choose Image', 'hnice'),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );
        $this->add_responsive_control(
            'content_height',
            [
                'label'      => esc_html__('Height', 'hnice'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'vh'],
                'selectors'  => [
                    '{{WRAPPER}} .hnice-panorama' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $images   = array();
        if (isset($settings['panorama_img'])) {
            $img           = wp_get_attachment_image_url($settings['panorama_img']['id'], 'full');
            $images['img'] = $img;
        }
        $this->add_render_attribute('wrapper', 'id', 'container');
        $this->add_render_attribute('wrapper', 'class', 'hnice-panorama');
        $this->add_render_attribute('wrapper', 'data-settings', wp_json_encode($images));

        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>></div>
        <?php

    }
}

$widgets_manager->register(new Hnice_Image_Panorama());
