<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Hnice\Elementor\Hnice_Base_Widgets;

class Hnice_Elementor_Virtual_Tour extends Hnice_Base_Widgets {

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
        return 'hnice-virtual-tour';
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
        return esc_html__('Virtual Tour', 'hnice');
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
        return ['hnice-elementor-virtual-tour',];
    }

    public function get_categories() {
        return array('hnice-addons');
    }

    protected function get_virtual_tour() {
        $params  = array(
            'posts_per_page' => -1,
            'post_type'      => [
                'hnice_virtual_tour',
            ],
        );
        $query   = new WP_Query($params);
        $options = array();
        while ($query->have_posts()): $query->the_post();
            $options[get_the_ID()] = get_the_title();
        endwhile;

        return $options;
    }

    public static function get_query_args($settings) {
        $query_args = [
            'post_type'           => 'hnice_virtual_tour',
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish', // Hide drafts/private posts for admins
        ];

        if (isset($settings['virtual_tour']) && !empty($settings['virtual_tour']) && $settings['type'] == 'name') {
            $query_args['post__in'] = $settings['virtual_tour'];
        }
        $query_args['posts_per_page'] = $settings['posts_per_page'];

        if (!empty($settings['categories'])) {
            $query_args['tax_query'] = [
                [
                    'taxonomy' => 'hnice_virtual_tour_cat',
                    'field'    => 'slug',
                    'terms'    => $settings['categories'],
                ]
            ];
        }

        if (is_front_page()) {
            $query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        return $query_args;
    }

    public function query_posts() {
        $query_args = $this->get_query_args($this->get_settings());
        return new WP_Query($query_args);
    }

    protected function get_service_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'hnice_virtual_tour_cat',
                'hide_empty' => false,
            )
        );

        $results = array();
        if (!is_wp_error($categories) && !empty($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
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
            'section_content',
            [
                'label' => esc_html__('Virtual Tour', 'hnice'),
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => esc_html__('Query', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ranrom',
                'options' => [
                    'ranrom' => esc_html__('Random', 'hnice'),
                    'name'   => esc_html__('Name', 'hnice')
                ],
            ]
        );

        $this->add_control(
            'virtual_tour',
            [
                'label'     => esc_html__('Show Virtual Tour', 'hnice'),
                'type'      => \Elementor\Controls_Manager::SELECT2,
                'multiple'  => true,
                'options'   => $this->get_virtual_tour(),
                'condition' => [
                    'type' => 'name'
                ]
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'     => esc_html__('Posts Per Page', 'hnice'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 6,
                'condition' => [
                    'type' => 'ranrom'
                ]
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'    => __('Include Categories', 'hnice'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_service_categories(),
                'multiple' => true,
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
            'style',
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
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'hnice'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-virtual-tour:hover .title' => 'color: {{VALUE}};',
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
        $query    = $this->query_posts();

        if (!$query->found_posts) {
            return;
        }
//        if (!empty($settings['images']) && is_array($settings['images'])) {
        // wrapper
        $this->add_render_attribute('wrapper', 'class', 'elementor-virtual-tour-wrapper');
        $this->add_render_attribute('item', 'class', 'elementor-virtual-tour-item');

        $this->get_data_elementor_columns();

        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <div <?php $this->print_render_attribute_string('container'); ?>>
                <div <?php $this->print_render_attribute_string('inner'); ?>>
                    <?php
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <div <?php $this->print_render_attribute_string('item'); ?>>
                            <div class="item-inner">
                                <div data-link="<?php the_permalink(); ?>" class="elementor-virtual-tour">
                                    <div class="virtual-tour-thumbnail">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('hnice-360'); ?>
                                        <?php else: ?>
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/360.jpeg'; ?>"/>
                                        <?php endif; ?><!-- .post-thumbnail -->
                                    </div>
                                    <span class="title"><?php the_title(); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php $this->get_swiper_navigation($query->post_count); ?>
        </div>
        <?php
    }
//    }
}

$widgets_manager->register(new Hnice_Elementor_Virtual_Tour());

