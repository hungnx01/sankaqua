<?php


/**
 * Class Hnice_Elementor_Custom_Shapes
 *
 * Main Plugin class
 * @since 0.0.1
 */
class Hnice_Elementor_Custom_Shapes {
    /**
     * Instance
     *
     * @since 0.0.1
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;
    private        $prefix    = 'remove';

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return Plugin An instance of the class.
     * @since 0.0.1
     * @access public
     *
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Get custom shapes
     *
     * @since 0.0.1
     * @access public
     */
    public function get_custom_shapes() {
        $shapes_cpt        = new \WP_Query([
            'post_type'      => 'ele_custom_shapes',
            'posts_per_page' => 50, //safe
            'post_status'    => 'publish',
        ]);
        $additional_shapes = [];
        if ($shapes_cpt->have_posts()) {
            while ($shapes_cpt->have_posts()) {
                $shapes_cpt->the_post();
                global $post;
                $shape_thumbnail_id = get_post_thumbnail_id($post->ID);
                if (!empty($shape_thumbnail_id)) {
                    $shape_thumbnail_path = get_attached_file($shape_thumbnail_id);
                    $shape_thumbnail_url  = wp_get_attachment_url($shape_thumbnail_id);
                    if ($shape_thumbnail_path && $shape_thumbnail_url && $post->post_name && $post->post_title) {
                        $additional_shapes[$post->post_name] = [
                            'title'        => $post->post_title,
                            'path'         => $shape_thumbnail_path, // used in front
                            'url'          => $shape_thumbnail_url, // used in editor
                            'has_flip'     => true,
                            'has_negative' => false
                        ];

                    }
                }
            }
            wp_reset_postdata();
        }
        return $additional_shapes;
    }

    /**
     * Register custom Shapes
     *
     * @since 0.0.1
     * @access public
     */
    public function register_custom_shapes($additional_shapes) {
        $additional_shapes = $this->get_custom_shapes();
        return $additional_shapes;
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 0.0.1
     * @access public
     */
    public function __construct() {
        add_action('init', [$this, 'ecs_register_cpt'], 0);
        if (is_admin()) {
            add_action('admin_menu', [$this, 'ecs_register_admin_menu'], 60);
            add_filter('wp_handle_upload_prefilter', [$this, 'ecs_handle_upload_prefilter']);
            add_filter('wp_handle_upload', [$this, 'ecs_handle_upload']);
        }
        add_action('elementor/shapes/additional_shapes', [$this, 'register_custom_shapes']);
    }

    public function ecs_register_cpt() {

        $labels = array(
            'name'                  => _x('Custom shapes', 'Post Type General Name', 'hnice'),
            'singular_name'         => _x('Custom shape', 'Post Type Singular Name', 'hnice'),
            'menu_name'             => __('Custom shapes', 'hnice'),
            'name_admin_bar'        => __('Custom shape', 'hnice'),
            'archives'              => __('Item Archives', 'hnice'),
            'attributes'            => __('Item Attributes', 'hnice'),
            'parent_item_colon'     => __('Parent Item:', 'hnice'),
            'all_items'             => __('All Items', 'hnice'),
            'add_new_item'          => __('Add New Item', 'hnice'),
            'add_new'               => __('Add New', 'hnice'),
            'new_item'              => __('New Item', 'hnice'),
            'edit_item'             => __('Edit Item', 'hnice'),
            'update_item'           => __('Update Item', 'hnice'),
            'view_item'             => __('View Item', 'hnice'),
            'view_items'            => __('View Items', 'hnice'),
            'search_items'          => __('Search Item', 'hnice'),
            'not_found'             => __('Not found', 'hnice'),
            'not_found_in_trash'    => __('Not found in Trash', 'hnice'),
            'featured_image'        => __('Featured Image', 'hnice'),
            'set_featured_image'    => __('Set featured image', 'hnice'),
            'remove_featured_image' => __('Remove featured image', 'hnice'),
            'use_featured_image'    => __('Use as featured image', 'hnice'),
            'insert_into_item'      => __('Insert into item', 'hnice'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'hnice'),
            'items_list'            => __('Items list', 'hnice'),
            'items_list_navigation' => __('Items list navigation', 'hnice'),
            'filter_items_list'     => __('Filter items list', 'hnice'),
        );
        $args   = array(
            'label'               => __('Custom shape', 'hnice'),
            'description'         => __('Custom shapes', 'hnice'),
            'labels'              => $labels,
            'supports'            => array('title', 'thumbnail'),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'show_in_admin_bar'   => false,
            'show_in_nav_menus'   => false,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'capability_type'     => 'post',
        );
        register_post_type('ele_custom_shapes', $args);

    }

    /**
     * Add CPT link to admin menu
     * @since 0.0.1
     */
    public function ecs_register_admin_menu() {
        $menu_title = _x('Custom Shapes', 'Elementor Custom Shapes', 'hnice');
        add_submenu_page(
            'elementor',
            $menu_title,
            $menu_title,
            'manage_options',
            'edit.php?post_type=ele_custom_shapes'
        );
    }

    /**
     * Customize upload folder
     * @since 0.0.1
     * inspired by https://stackoverflow.com/a/13391519
     */
    public function ecs_handle_upload_prefilter($file) {
        add_filter('upload_dir', [$this, 'ecs_custom_upload_dir']);
        return $file;
    }

    public function ecs_handle_upload($fileinfo) {
        $function_to_call = $this->prefix . '_filter';
        $function_to_call('upload_dir', [$this, 'ecs_custom_upload_dir']);
        return $fileinfo;
    }

    public function ecs_custom_upload_dir($param) {
        // Check if uploading from inside a post/page/cpt - if not, default Upload folder is used
        $use_default_dir = (isset($_REQUEST['post_id']) && $_REQUEST['post_id'] == 0) ? true : false;
        if (!empty($param['error']) || $use_default_dir)
            return $param;

        // Check if correct post type
        if ('ele_custom_shapes' != get_post_type($_REQUEST['post_id']))
            return $param;

        $customdir = '/ele-custom-shapes';

        $param['path'] = $param['basedir'] . $customdir;
        $param['url']  = $param['baseurl'] . $customdir;

        return $param;
    }

}

// Instantiate Plugin Class
Hnice_Elementor_Custom_Shapes::instance();