<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class OSF_Custom_Post_Type_Case_Study
 */
class Hnice_Team {
    public $post_type = 'hnice_team';
    public $taxonomy  = 'hnice_team_cat';
    static $instance;

    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof Hnice_Team)) {
            self::$instance = new Hnice_Team();
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
            'name'               => esc_html__('Teams', 'hnice'),
            'singular_name'      => esc_html__('Team', 'hnice'),
            'add_new'            => esc_html__('Add New Team', 'hnice'),
            'add_new_item'       => esc_html__('Add New Team', 'hnice'),
            'edit_item'          => esc_html__('Edit Team', 'hnice'),
            'new_item'           => esc_html__('New Team', 'hnice'),
            'view_item'          => esc_html__('View Team', 'hnice'),
            'search_items'       => esc_html__('Search Teams', 'hnice'),
            'not_found'          => esc_html__('No Teams found', 'hnice'),
            'not_found_in_trash' => esc_html__('No Teams found in Trash', 'hnice'),
            'parent_item_colon'  => esc_html__('Parent Team:', 'hnice'),
            'menu_name'          => esc_html__('Teams', 'hnice'),
        );

        $labels     = apply_filters('hnice_team_labels', $labels);
        $slug_field = apply_filters('hnice_team_slug', 'team');

        register_post_type($this->post_type,
            array(
                'labels'        => $labels,
                'supports'      => array('title', 'editor', 'thumbnail'),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug_field),
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
        $labels = apply_filters('hnice_team_cat_labels', $labels);

        $slug_cat_field = apply_filters('hnice_cat_team_slug', 'team-cat');

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

Hnice_Team::getInstance();
