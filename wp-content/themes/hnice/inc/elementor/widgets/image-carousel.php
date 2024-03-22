<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Hnice\Elementor\Hnice_Base_Widgets;

class Hnice_Elementor_Image_Carousel extends Hnice_Base_Widgets {

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
        return 'hnice-image-carousel';
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
        return esc_html__('Hnice Image Carousel', 'hnice');
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
        return 'eicon-gallery-grid';
    }

    public function get_script_depends() {
        return ['hnice-elementor-image-carousel'];
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
                'label' => esc_html__('Image', 'hnice'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image_title',
            [
                'label'       => esc_html__('Title', 'hnice'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'title',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'image_link_source',
            [
                'label'      => esc_html__('Choose Image', 'hnice'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'image_link',
            [
                'label'       => esc_html__('Link to', 'hnice'),
                'placeholder' => esc_html__('https://your-link.com', 'hnice'),
                'type'        => Controls_Manager::URL,
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'target_link',
            [
                'label'   => esc_html__('Target', 'hnice'),
                'default' => 'yes',
                'type'    => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'image-carousel',
            [
                'label'       => esc_html__('Items', 'hnice'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ image_title }}}',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
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

        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__('Style', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tilte_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .title, {{WRAPPER}} .title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
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
        if (!empty($settings['image-carousel']) && is_array($settings['image-carousel'])) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-image-carousel-item-wrapper');

            $this->get_data_elementor_columns();
            ?>
            <div <?php $this->print_render_attribute_string('wrapper'); ?>>
                <div <?php $this->print_render_attribute_string('container'); ?>>
                    <div <?php $this->print_render_attribute_string('inner'); ?>>
                        <?php foreach ($settings['image-carousel'] as $index => $item):
                            $repeater_image_link_key = $this->get_repeater_setting_key('image_link', 'image-carousel', $index);

                            $this->add_render_attribute($repeater_image_link_key, 'href', $item['image_link']['url']);

                            if ($item['target_link']) {
                                $this->add_render_attribute($repeater_image_link_key, 'target', '_blank');
                            }
                            ?>
                            <div <?php $this->print_render_attribute_string('item'); ?>>
                                <a <?php $this->print_render_attribute_string($repeater_image_link_key); ?>>
                                    <?php
                                    $image_url = Group_Control_Image_Size::get_attachment_image_src($item['image_link_source']['id'], 'image', $settings);
                                    if (!$image_url && isset($attachment['url'])) {
                                        $image_url = $item['url'];
                                    } ?>
                                    <img class="image" src="<?php echo esc_url($image_url); ?>" alt="image">
                                    <?php if ($item['image_title']) : ?>
                                        <span class="title"><?php printf('%s', $item['image_title']); ?></span>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php $this->get_swiper_navigation(count($settings['image-carousel'])); ?>
            </div>
            <?php
        }
    }

}

$widgets_manager->register(new Hnice_Elementor_Image_Carousel());

