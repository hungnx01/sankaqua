<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Hnice_Customize')) {

    class Hnice_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        public function get_banner() {
            global $post;

            $options[''] = esc_html__('Select Banner', 'hnice');
            if (!hnice_is_elementor_activated()) {
                return;
            }
            $args = array(
                'post_type'      => 'elementor_library',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                's'              => 'Banner ',
                'order'          => 'ASC',
            );

            $query1 = new WP_Query($args);
            while ($query1->have_posts()) {
                $query1->the_post();
                $options[$post->post_name] = $post->post_title;
            }

            wp_reset_postdata();
            return $options;
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function tesst($wp_customize) {
            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    'dav_bgImage',
                    array(
                        'label'    => esc_attr__('Background image', 'hnice'),
                        'section'  => 'dav_display_options',
                        'settings' => 'dav_bgImage',
                        'priority' => 8
                    )
                )
            );
        }

        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_hnice_blog($wp_customize);
            $this->hnice_register_theme_customizer($wp_customize);


            if (hnice_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }

            do_action('hnice_customize_register', $wp_customize);
        }

        function hnice_register_theme_customizer($wp_customize) {

        } // end hnice_register_theme_customizer

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_hnice_blog($wp_customize) {

            $wp_customize->add_panel('hnice_blog', array(
                'title' => esc_html__('Blog', 'hnice'),
            ));

            // =========================================
            // Blog Archive
            // =========================================
            $wp_customize->add_section('hnice_blog_archive', array(
                'title'      => esc_html__('Archive', 'hnice'),
                'panel'      => 'hnice_blog',
                'capability' => 'edit_theme_options',
            ));

            $wp_customize->add_setting('hnice_options_blog_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_blog_sidebar', array(
                'section' => 'hnice_blog_archive',
                'label'   => esc_html__('Sidebar Position', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    'none'  => esc_html__('None', 'hnice'),
                    'left'  => esc_html__('Left', 'hnice'),
                    'right' => esc_html__('Right', 'hnice'),
                ),
            ));

            $wp_customize->add_setting('hnice_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_blog_style', array(
                'section' => 'hnice_blog_archive',
                'label'   => esc_html__('Blog style', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'hnice'),
                    'list'     => esc_html__('Blog List', 'hnice'),
                    'style-1'  => esc_html__('Blog Grid', 'hnice'),
                ),
            ));

            $wp_customize->add_setting('hnice_options_blog_columns', array(
                'type'              => 'option',
                'default'           => 3,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_blog_columns', array(
                'section' => 'hnice_blog_archive',
                'label'   => esc_html__('Colunms', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'hnice'),
                    2 => esc_html__('2', 'hnice'),
                    3 => esc_html__('3', 'hnice'),
                    4 => esc_html__('4', 'hnice'),
                ),
            ));

            $wp_customize->add_setting('hnice_options_blog_columns_laptop', array(
                'type'              => 'option',
                'default'           => 3,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_blog_columns_laptop', array(
                'section' => 'hnice_blog_archive',
                'label'   => esc_html__('Colunms Laptop', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'hnice'),
                    2 => esc_html__('2', 'hnice'),
                    3 => esc_html__('3', 'hnice'),
                    4 => esc_html__('4', 'hnice'),
                ),
            ));

            $wp_customize->add_setting('hnice_options_blog_columns_tablet', array(
                'type'              => 'option',
                'default'           => 2,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_blog_columns_tablet', array(
                'section' => 'hnice_blog_archive',
                'label'   => esc_html__('Colunms Tablet', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'hnice'),
                    2 => esc_html__('2', 'hnice'),
                    3 => esc_html__('3', 'hnice'),
                    4 => esc_html__('4', 'hnice'),
                ),
            ));

            $wp_customize->add_setting('hnice_options_blog_columns_mobile', array(
                'type'              => 'option',
                'default'           => 1,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_blog_columns_mobile', array(
                'section' => 'hnice_blog_archive',
                'label'   => esc_html__('Colunms Mobile', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'hnice'),
                    2 => esc_html__('2', 'hnice'),
                    3 => esc_html__('3', 'hnice'),
                    4 => esc_html__('4', 'hnice'),
                ),
            ));

            // =========================================
            // Blog Single
            // =========================================
            $wp_customize->add_section('hnice_blog_single', array(
                'title'      => esc_html__('Singular', 'hnice'),
                'panel'      => 'hnice_blog',
                'capability' => 'edit_theme_options',
            ));
            $wp_customize->add_setting('hnice_options_blog_single_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_blog_single_sidebar', array(
                'section' => 'hnice_blog_single',
                'label'   => esc_html__('Sidebar Position', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    'none'  => esc_html__('None', 'hnice'),
                    'left'  => esc_html__('Left', 'hnice'),
                    'right' => esc_html__('Right', 'hnice'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */


        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'hnice'),
            ));

            $wp_customize->add_section('hnice_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'hnice'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            if (hnice_is_elementor_activated()) {
                $wp_customize->add_setting('hnice_options_shop_banner', array(
                    'type'              => 'option',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control('hnice_options_shop_banner', array(
                    'section'     => 'hnice_woocommerce_archive',
                    'label'       => esc_html__('Banner', 'hnice'),
                    'type'        => 'select',
                    'description' => __('Banner will take templates name prefix is "Banner"', 'hnice'),
                    'choices'     => $this->get_banner()
                ));

                $wp_customize->add_setting('hnice_options_shop_banner_position', array(
                    'type'              => 'option',
                    'default'           => 'top',
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control('hnice_options_shop_banner_position', array(
                    'section' => 'hnice_woocommerce_archive',
                    'label'   => esc_html__('Banner Position', 'hnice'),
                    'type'    => 'select',
                    'choices' => array(
                        'top'     => __('top', 'hnice'),
                        'content' => __('Before Products', 'hnice'),
                    ),
                ));

            }

            $wp_customize->add_setting('hnice_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_woocommerce_archive_layout', array(
                'section' => 'hnice_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    'default' => esc_html__('Sidebar', 'hnice'),
                    //====start_premium
                    'canvas'  => esc_html__('Canvas Filter', 'hnice'),
                    //====end_premium
                ),
            ));

            $wp_customize->add_setting('hnice_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_woocommerce_archive_sidebar', array(
                'section' => 'hnice_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'hnice'),
                    'right' => esc_html__('Right', 'hnice'),

                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('hnice_woocommerce_single', array(
                'title'      => esc_html__('Singular', 'hnice'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('hnice_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('hnice_options_single_product_gallery_layout', array(
                'section' => 'hnice_woocommerce_single',
                'label'   => esc_html__('Style', 'hnice'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal' => esc_html__('Horizontal', 'hnice'),
                    //====start_premium
                    'vertical'   => esc_html__('Vertical', 'hnice'),
                    'gallery'    => esc_html__('Gallery', 'hnice'),
                    'sticky'     => esc_html__('Sticky', 'hnice'),
                    //====end_premium
                ),
            ));

            $wp_customize->add_setting(
                'hnice_options_single_product_content_meta',
                array(
                    /* translators: %s privacy policy page name and link */
                    'type'              => 'option',
                    'sanitize_callback' => 'wp_kses_post',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'postMessage',
                )
            );

            $wp_customize->add_control(
                'hnice_options_single_product_content_meta',
                array(

                    'label'    => esc_html__('Single extra description', 'hnice'),
                    'section'  => 'hnice_woocommerce_single',
                    'settings' => 'hnice_options_single_product_content_meta',
                    'type'     => 'textarea',
                )
            );

            // =========================================
            // Product
            // =========================================
            $wp_customize->add_setting('hnice_options_wocommerce_row_laptop', array(
                'type'              => 'option',
                'default'           => 3,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_wocommerce_row_laptop', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row Laptop', 'hnice'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('hnice_options_wocommerce_row_tablet', array(
                'type'              => 'option',
                'default'           => 2,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_wocommerce_row_tablet', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row tablet', 'hnice'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('hnice_options_wocommerce_row_mobile', array(
                'type'              => 'option',
                'default'           => 1,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('hnice_options_wocommerce_row_mobile', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row mobile', 'hnice'),
                'type'    => 'number',
            ));

        }
    }
}
return new Hnice_Customize();
