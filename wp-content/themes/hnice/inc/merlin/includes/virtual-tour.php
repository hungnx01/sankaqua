<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class OSF_Custom_Post_Type_Case_Study
 */
class Hnice_Virtual_Tour {
    public $post_type = 'hnice_virtual_tour';
    public $taxonomy  = 'hnice_virtual_tour_cat';
    static $instance;

    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof Hnice_Virtual_Tour)) {
            self::$instance = new Hnice_Virtual_Tour();
        }

        return self::$instance;
    }

    public function __construct() {
        add_action('init', [$this, 'create_post_type']);
        add_action('init', [$this, 'create_taxonomy']);

    }

    /**
     * @return void
     */
    public function create_post_type() {

        $labels = array(
            'name'               => esc_html__('Virtual Tour', 'hnice'),
            'singular_name'      => esc_html__('Virtual Tour', 'hnice'),
            'add_new'            => esc_html__('Add New Virtual Tour', 'hnice'),
            'add_new_item'       => esc_html__('Add New Virtual Tour', 'hnice'),
            'edit_item'          => esc_html__('Edit Virtual Tour', 'hnice'),
            'new_item'           => esc_html__('New Virtual tour', 'hnice'),
            'view_item'          => esc_html__('View Virtual Tour', 'hnice'),
            'search_items'       => esc_html__('Search Virtual Tour', 'hnice'),
            'not_found'          => esc_html__('No Virtual Tour found', 'hnice'),
            'not_found_in_trash' => esc_html__('No Virtual Tour found in Trash', 'hnice'),
            'parent_item_colon'  => esc_html__('Parent Virtual Tour:', 'hnice'),
            'menu_name'          => esc_html__('Virtual Tour', 'hnice'),
        );

        $labels     = apply_filters('hnice_virtual_tour_labels', $labels);
        $slug_field = apply_filters('hnice_virtual_tour_slug', 'virtual-tour');

        register_post_type($this->post_type,
            array(
                'labels'        => $labels,
                'supports'      => array('title', 'editor', 'thumbnail'),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug_field, 'with_front' => false),
                'menu_position' => 5,
                'categories'    => array(),
            )
        );
    }

    /**
     * @return void
     */
    public function create_taxonomy() {
        $labels = array(
            'name'              => esc_html__('Categories', 'hnice'),
            'singular_name'     => esc_html__('Category', 'hnice'),
            'search_items'      => esc_html__('Search Category', 'hnice'),
            'all_items'         => esc_html__('All Categories', 'hnice'),
            'parent_item'       => esc_html__('Parent Category', 'hnice'),
            'parent_item_colon' => esc_html__('Parent Category:', 'hnice'),
            'edit_item'         => esc_html__('Edit Category', 'hnice'),
            'update_item'       => esc_html__('Update Category', 'hnice'),
            'add_new_item'      => esc_html__('Add New Category', 'hnice'),
            'new_item_name'     => esc_html__('New Category Name', 'hnice'),
            'menu_name'         => esc_html__('Categories', 'hnice'),
        );
        $labels = apply_filters('hnice_virtual_tour_cat_labels', $labels);

        $slug_cat_field = apply_filters('hnice_cat_virtual_tour_slug', 'team-cat');

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_nav_menus' => true,
            'rewrite'           => array('slug' => $slug_cat_field)
        );
        // Now register the taxonomy
        register_taxonomy($this->taxonomy, array($this->post_type), $args);
    }
}

Hnice_Virtual_Tour::getInstance();
