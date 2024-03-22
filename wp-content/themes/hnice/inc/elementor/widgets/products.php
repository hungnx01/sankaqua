<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!hnice_is_woocommerce_activated()) {
    return;
}

use Elementor\Icons_Manager;
use Hnice\Elementor\Hnice_Base_Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Hnice_Elementor_Widget_Products extends Hnice_Base_Widgets {


    public function get_categories() {
        return array('hnice-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'hnice-products';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Products', 'hnice');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
    }


    public function get_script_depends() {
        return [
            'hnice-elementor-products',
            'tooltipster'
        ];
    }

    public function on_export($element) {
        unset($element['settings']['categories']);
        unset($element['settings']['tag']);

        return $element;
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'hnice'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'limit',
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
                'default' => 'date',
                'options' => [
                    'date'       => esc_html__('Date', 'hnice'),
                    'id'         => esc_html__('Post ID', 'hnice'),
                    'menu_order' => esc_html__('Menu Order', 'hnice'),
                    'popularity' => esc_html__('Number of purchases', 'hnice'),
                    'rating'     => esc_html__('Average Product Rating', 'hnice'),
                    'title'      => esc_html__('Product Title', 'hnice'),
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
                'options'     => $this->get_product_categories(),
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
            'tag',
            [
                'label'       => esc_html__('Tags', 'hnice'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $this->get_product_tags(),
                'multiple'    => true,
            ]
        );

        $this->add_control(
            'tag_operator',
            [
                'label'     => esc_html__('Tag Operator', 'hnice'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => esc_html__('AND', 'hnice'),
                    'IN'     => esc_html__('IN', 'hnice'),
                    'NOT IN' => esc_html__('NOT IN', 'hnice'),
                ],
                'condition' => [
                    'tag!' => ''
                ],
            ]
        );

        $this->add_control(
            'product_type',
            [
                'label'   => esc_html__('Product Type', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'newest',
                'options' => [
                    'newest'       => esc_html__('Newest Products', 'hnice'),
                    'on_sale'      => esc_html__('On Sale Products', 'hnice'),
                    'best_selling' => esc_html__('Best Selling', 'hnice'),
                    'top_rated'    => esc_html__('Top Rated', 'hnice'),
                    'featured'     => esc_html__('Featured Product', 'hnice'),
                    'ids'          => esc_html__('Product Name', 'hnice'),
                ],
            ]
        );

        $this->add_control(
            'product_ids',
            [
                'label'       => esc_html__('Products name', 'hnice'),
                'type'        => 'products',
                'label_block' => true,
                'multiple'    => true,
                'condition'   => [
                    'product_type' => 'ids'
                ]
            ]
        );

        $this->add_control(
            'paginate',
            [
                'label'   => esc_html__('Paginate', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'       => esc_html__('None', 'hnice'),
                    'pagination' => esc_html__('Pagination', 'hnice'),
                ],
            ]
        );

        $this->add_control(
            'product_layout',
            [
                'label'   => esc_html__('Product Layout', 'hnice'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'hnice'),
                    'list' => esc_html__('List', 'hnice'),
                ],
            ]
        );

        $this->add_control(
            'list_layout',
            [
                'label'     => esc_html__('List Layout', 'hnice'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => [
                    '1' => esc_html__('Style 1', 'hnice'),
                    '2' => esc_html__('Style 2', 'hnice'),
                ],
                'condition' => [
                    'product_layout' => 'list'
                ]
            ]
        );
        $this->add_control(
            'show_time_sale',
            [
                'label'     => esc_html__('Show Time Sale', 'hnice'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'product_type'   => 'on_sale',
                    'product_layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'show_deal_sold',
            [
                'label'     => esc_html__('Show Deal Sold', 'hnice'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'product_type'   => 'on_sale',
                    'product_layout' => 'grid'
                ]
            ]
        );

        $this->end_controls_section();


        //Section Query
        $this->start_controls_section(
            'section_product_style',
            [
                'label' => esc_html__('Products', 'hnice'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'product_padding',
            [
                'label'      => esc_html__('Padding', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-block-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .product-block'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_margin',
            [
                'label'      => esc_html__('Margin', 'hnice'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-block-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .product-block'      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'product_background',
                'selector' => '{{WRAPPER}} .product-block-list, {{WRAPPER}} .product-block',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'product_box_shadow',
                'selector' => '{{WRAPPER}} .product-block-list, {{WRAPPER}} .product-block',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'product_border',
                'selector'  => '{{WRAPPER}} .product-block-list, {{WRAPPER}} .product-block, {{WRAPPER}} li.product:not(:first-child) .product-block-list',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        $this->get_controls_column();
        // Carousel Option
        $this->get_control_carousel();
    }


    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
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

    protected function get_product_tags() {
        $tags    = get_terms(array(
                'taxonomy'   => 'product_tag',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $results[$tag->slug] = $tag->name;
            }
        }

        return $results;
    }

    protected function get_product_type($atts, $product_type) {
        switch ($product_type) {
            case 'featured':
                $atts['visibility'] = "featured";
                break;
            case 'on_sale':
                $atts['on_sale'] = true;
                break;
            case 'best_selling':
                $atts['best_selling'] = true;
                break;
            case 'top_rated':
                $atts['top_rated'] = true;
                break;
            default:
                break;
        }

        return $atts;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->woocommerce_default($settings);
    }

    private function woocommerce_default($settings) {
        $type  = 'products';
        $class = '';
        $atts  = [
            'limit'          => $settings['limit'],
            'columns'        => $settings['enable_carousel'] === 'yes' ? 1 : $settings['column'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
            'product_layout' => $settings['product_layout'],
        ];

        $atts['show_time_sale'] = false;
        $atts['show_deal_sold'] = false;

        if ($settings['product_layout'] == 'list') {
            $atts['style'] = 'list-' . $settings['list_layout'];
            $class         .= ' woocommerce-product-list-' . $settings['list_layout'];
        }

        $atts = $this->get_product_type($atts, $settings['product_type']);

        if (isset($atts['on_sale']) && wc_string_to_bool($atts['on_sale'])) {
            $type = 'sale_products';
            if ($settings['show_time_sale']) {
                $atts['show_time_sale'] = true;
            }
            if ($settings['show_deal_sold']) {
                $atts['show_deal_sold'] = true;
            }
        } elseif (isset($atts['best_selling']) && wc_string_to_bool($atts['best_selling'])) {
            $type = 'best_selling_products';
        } elseif (isset($atts['top_rated']) && wc_string_to_bool($atts['top_rated'])) {
            $type = 'top_rated_products';
        }
        if (isset($settings['product_ids']) && !empty($settings['product_ids']) && $settings['product_type'] == 'ids') {
            $atts['ids'] = implode(',', $settings['product_ids']);
        }

        if (!empty($settings['categories'])) {
            $atts['category']     = implode(',', $settings['categories']);
            $atts['cat_operator'] = $settings['cat_operator'];
        }

        if (!empty($settings['tag'])) {
            $atts['tag']          = implode(',', $settings['tag']);
            $atts['tag_operator'] = $settings['tag_operator'];
        }

        // Carousel
        if ($settings['enable_carousel'] === 'yes') {
            $atts['enable_carousel']   = 'yes';
            $atts['carousel_settings'] = $this->get_swiper_navigation_for_product();
            $class                     = ' hnice-swiper-wrapper swiper';
        }
        if ($settings['paginate'] === 'pagination') {
            $atts['paginate'] = 'true';
        }
        $atts['class'] = $class;

        echo (new WC_Shortcode_Products($atts, $type))->get_content(); // WPCS: XSS ok
    }
}

$widgets_manager->register(new Hnice_Elementor_Widget_Products());
