<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Hnice\Elementor\Hnice_Base_Widgets;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;


/**
 * Class Hnice_Elementor_Blog
 */
class Hnice_Elementor_Post_Grid extends Hnice_Base_Widgets {

    public function get_name() {
        return 'hnice-post-grid';
    }

    public function get_title() {
        return esc_html__('Posts Grid', 'hnice');
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
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return array('hnice-addons');
    }

    public function get_script_depends() {
        return ['hnice-elementor-posts-grid'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Query', 'hnice'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => esc_html__('Posts Per Page', 'hnice'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );


        $this->add_control(
            'advanced',
            [
                'label' => esc_html__('Advanced', 'hnice'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order By', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_date',
                'options' => [
                    'post_date'  => esc_html__('Date', 'hnice'),
                    'post_title' => esc_html__('Title', 'hnice'),
                    'menu_order' => esc_html__('Menu Order', 'hnice'),
                    'rand'       => esc_html__('Random', 'hnice'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__('ASC', 'hnice'),
                    'desc' => esc_html__('DESC', 'hnice'),
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'       => esc_html__('Categories', 'hnice'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_post_categories(),
                'label_block' => true,
                'multiple'    => true,
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label'     => esc_html__('Category Operator', 'hnice'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => esc_html__('AND', 'hnice'),
                    'IN'     => esc_html__('IN', 'hnice'),
                    'NOT IN' => esc_html__('NOT IN', 'hnice'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout', 'hnice'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'post_style',
            [
                'label'   => esc_html__('Style', 'hnice'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'post-style-1' => esc_html__('Style 1', 'hnice'),
                    'post-style-2' => esc_html__('Style 2', 'hnice'),
                ],
                'default' => 'post-style-1'
            ]
        );
        $this->end_controls_section();

        $this->get_control_pagination();
        $this->get_controls_column();
        $this->get_control_carousel();
    }

    protected function get_post_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'category',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    public static function get_query_args($settings) {
        $query_args = [
            'post_type'           => 'post',
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish', // Hide drafts/private posts for admins
        ];

        if (!empty($settings['categories'])) {
            $categories = array();
            foreach ($settings['categories'] as $category) {
                $cat = get_term_by('slug', $category, 'category');
                if (!is_wp_error($cat) && is_object($cat)) {
                    $categories[] = $cat->term_id;
                }
            }

            if ($settings['cat_operator'] == 'AND') {
                $query_args['category__and'] = $categories;
            } elseif ($settings['cat_operator'] == 'IN') {
                $query_args['category__in'] = $categories;
            } else {
                $query_args['category__not_in'] = $categories;
            }
        }

        $query_args['posts_per_page'] = $settings['posts_per_page'];
        if ($settings['post_style'] == 'post-special') {
            $query_args['posts_per_page'] = 4;
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


    protected function render() {
        $settings = $this->get_settings_for_display();

        $query = $this->query_posts();

        if (!$query->found_posts) {
            return;
        }
        $this->add_render_attribute('wrapper', 'class', ['elementor-post-wrapper', 'layout-' . $settings['post_style']]);
        // Item
        $this->add_render_attribute('item', 'class', 'elementor-posts-item');
        $this->get_data_elementor_columns();

        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <div <?php $this->print_render_attribute_string('container'); ?>>
                <div <?php $this->print_render_attribute_string('inner'); ?>>
                    <?php
                    $style = $settings['post_style'];
                    while ($query->have_posts()) {
                        $query->the_post(); ?>
                        <div <?php $this->print_render_attribute_string('item'); ?>>
                            <?php get_template_part('template-parts/posts-grid/item-' . $style); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php $this->render_loop_footer(); ?>
            <?php $this->get_swiper_navigation($query->post_count); ?>
        </div>
        <?php
        wp_reset_postdata();
    }
}

$widgets_manager->register(new Hnice_Elementor_Post_Grid());