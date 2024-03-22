<?php

class Hnice_Merlin_Config {

    private $wizard;

    public function __construct() {
        $this->init();
        add_filter('merlin_import_files', [$this, 'import_files']);
        add_action('merlin_after_all_import', [$this, 'after_import_setup'], 10, 1);
        add_filter('merlin_generate_child_functions_php', [$this, 'render_child_functions_php']);
        add_action('import_start', function () {
            add_filter('wxr_importer.pre_process.post_meta', [$this, 'fiximport_elementor'], 10, 1);
        });

        add_action('import_end', function () {
            update_option('elementor_experiment-container', 'active');
            update_option('elementor_experiment-nested-elements', 'active');
        });
    }

    public function fiximport_elementor($post_meta) {
        if ('_elementor_data' === $post_meta['key']) {
            $post_meta['value'] = wp_slash($post_meta['value']);
        }

        return $post_meta;
    }

    public function import_files(){
            return array(
            array(
                'import_file_name'           => 'home 1',
                'home'                       => 'home-1',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-1.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-1/slider-1.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-1.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-1',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 2',
                'home'                       => 'home-2',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-2.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-2/slider-2.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-2.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-2',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 3',
                'home'                       => 'home-3',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-3.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-3/slider-3.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-3.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-3',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 4',
                'home'                       => 'home-4',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-4.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-4/slider-4.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-4.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-4',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 5',
                'home'                       => 'home-5',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-5.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-5/slider-5.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-5.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-5',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 6',
                'home'                       => 'home-6',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-6.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-6/slider-1.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-6.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-6',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 7',
                'home'                       => 'home-7',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-7.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-7/slider-7.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-7.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-7',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 8',
                'home'                       => 'home-8',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-8.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-8/slider-8.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-8.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-8',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),

            array(
                'import_file_name'           => 'home 9',
                'home'                       => 'home-9',
                'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
                'homepage'                   => get_theme_file_path('/dummy-data/homepage/home-9.xml'),
                'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
                'import_rev_slider_file_url' => 'http://source.wpopal.com/hnice/dummy_data/revsliders/home-9/slider-9.zip',
                'import_more_revslider_file_url' => [],
                'import_lookbook_revslider_file_url' => [],
                'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home-9.jpg'),
                'preview_url'                => 'https://demo2.themelexus.com/hnice/home-9',
                'elementor'                  => '{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}',
                'themeoptions'               => '{}',
            ),
            );           
        }

    public function after_import_setup($selected_import) {
        $selected_import = ($this->import_files())[$selected_import];
        $check_oneclick  = get_option('hnice_check_oneclick', []);
        $home = get_page_by_path($selected_import['home']);
        if ($home->ID) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $home->ID);
        }

        $this->set_demo_menus();

        // Setup Options
        $options = $this->get_all_options();
        $theme_options = $options['options'];
        foreach ($theme_options as $key => $option) {
            update_option($key, $option);
        }

        $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
        update_post_meta($active_kit_id, '_elementor_page_settings', json_decode($selected_import['elementor'], true));
        set_theme_mod('custom_logo', $this->get_attachment('_logo'));

        // Header Footer Builder
        $this->reset_header_footer();
        $this->set_hf($selected_import['home']);

        update_option('woocommerce_single_image_width', 800);
        update_option('woocommerce_thumbnail_image_width', 460);

        \Elementor\Plugin::instance()->files_manager->clear_cache();

        $this->update_nav_menu_item();
        $this->remove_quick_table_enable();
    }


    //remove quick_table_enable
    private function remove_quick_table_enable() {
        $qte = get_option('woosc_settings');
        if ($qte['quick_table_enable'] == 'yes') {
            $qte['quick_table_enable'] = 'no';
            update_option('woosc_settings', $qte);
        }
    }

    private function update_nav_menu_item() {
        $params = array(
            'posts_per_page' => -1,
            'post_type'      => [
                'nav_menu_item',
            ],
        );
        $query  = new WP_Query($params);
        while ($query->have_posts()): $query->the_post();
            wp_update_post(array(
                // Update the `nav_menu_item` Post Title
                'ID'         => get_the_ID(),
                'post_title' => get_the_title()
            ));
        endwhile;

    }

    private function get_mailchimp_id() {
        $params = array(
            'post_type'      => 'mc4wp-form',
            'posts_per_page' => 1,
        );
        $post   = get_posts($params);

        return isset($post[0]) ? $post[0]->ID : 0;
    }

    private function get_attachment($key) {
        $params = array(
            'post_type'      => 'attachment',
            'post_status'    => 'inherit',
            'posts_per_page' => 1,
            'meta_key'       => $key,
        );
        $post   = get_posts($params);
        if ($post) {
            return $post[0]->ID;
        }

        return 0;
    }

    private function init() {
        $this->wizard = new Merlin(
            $config = array(
                // Location / directory where Merlin WP is placed in your theme.
                'merlin_url'         => 'merlin',
                // The wp-admin page slug where Merlin WP loads.
                'parent_slug'        => 'themes.php',
                // The wp-admin parent page slug for the admin menu item.
                'capability'         => 'manage_options',
                // The capability required for this menu to be displayed to the user.
                'dev_mode'           => true,
                // Enable development mode for testing.
                'license_step'       => false,
                // EDD license activation step.
                'license_required'   => false,
                // Require the license activation step.
                'license_help_url'   => '',
                'directory'          => '/inc/merlin',
                // URL for the 'license-tooltip'.
                'edd_remote_api_url' => '',
                // EDD_Theme_Updater_Admin remote_api_url.
                'edd_item_name'      => '',
                // EDD_Theme_Updater_Admin item_name.
                'edd_theme_slug'     => '',
                // EDD_Theme_Updater_Admin item_slug.
            ),
            $strings = array(
                'admin-menu'          => esc_html__('Theme Setup', 'hnice'),

                /* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
                'title%s%s%s%s'       => esc_html__('%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'hnice'),
                'return-to-dashboard' => esc_html__('Return to the dashboard', 'hnice'),
                'ignore'              => esc_html__('Disable this wizard', 'hnice'),

                'btn-skip'                 => esc_html__('Skip', 'hnice'),
                'btn-next'                 => esc_html__('Next', 'hnice'),
                'btn-start'                => esc_html__('Start', 'hnice'),
                'btn-no'                   => esc_html__('Cancel', 'hnice'),
                'btn-plugins-install'      => esc_html__('Install', 'hnice'),
                'btn-child-install'        => esc_html__('Install', 'hnice'),
                'btn-content-install'      => esc_html__('Install', 'hnice'),
                'btn-import'               => esc_html__('Import', 'hnice'),
                'btn-license-activate'     => esc_html__('Activate', 'hnice'),
                'btn-license-skip'         => esc_html__('Later', 'hnice'),

                /* translators: Theme Name */
                'license-header%s'         => esc_html__('Activate %s', 'hnice'),
                /* translators: Theme Name */
                'license-header-success%s' => esc_html__('%s is Activated', 'hnice'),
                /* translators: Theme Name */
                'license%s'                => esc_html__('Enter your license key to enable remote updates and theme support.', 'hnice'),
                'license-label'            => esc_html__('License key', 'hnice'),
                'license-success%s'        => esc_html__('The theme is already registered, so you can go to the next step!', 'hnice'),
                'license-json-success%s'   => esc_html__('Your theme is activated! Remote updates and theme support are enabled.', 'hnice'),
                'license-tooltip'          => esc_html__('Need help?', 'hnice'),

                /* translators: Theme Name */
                'welcome-header%s'         => esc_html__('Welcome to %s', 'hnice'),
                'welcome-header-success%s' => esc_html__('Hi. Welcome back', 'hnice'),
                'welcome%s'                => esc_html__('This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'hnice'),
                'welcome-success%s'        => esc_html__('You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'hnice'),

                'child-header'         => esc_html__('Install Child Theme', 'hnice'),
                'child-header-success' => esc_html__('You\'re good to go!', 'hnice'),
                'child'                => esc_html__('Let\'s build & activate a child theme so you may easily make theme changes.', 'hnice'),
                'child-success%s'      => esc_html__('Your child theme has already been installed and is now activated, if it wasn\'t already.', 'hnice'),
                'child-action-link'    => esc_html__('Learn about child themes', 'hnice'),
                'child-json-success%s' => esc_html__('Awesome. Your child theme has already been installed and is now activated.', 'hnice'),
                'child-json-already%s' => esc_html__('Awesome. Your child theme has been created and is now activated.', 'hnice'),

                'plugins-header'         => esc_html__('Install Plugins', 'hnice'),
                'plugins-header-success' => esc_html__('You\'re up to speed!', 'hnice'),
                'plugins'                => esc_html__('Let\'s install some essential WordPress plugins to get your site up to speed.', 'hnice'),
                'plugins-success%s'      => esc_html__('The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'hnice'),
                'plugins-action-link'    => esc_html__('Advanced', 'hnice'),

                'import-header'      => esc_html__('Import Content', 'hnice'),
                'import'             => esc_html__('Let\'s import content to your website, to help you get familiar with the theme.', 'hnice'),
                'import-action-link' => esc_html__('Advanced', 'hnice'),

                'ready-header'      => esc_html__('All done. Have fun!', 'hnice'),

                /* translators: Theme Author */
                'ready%s'           => esc_html__('Your theme has been all set up. Enjoy your new theme by %s.', 'hnice'),
                'ready-action-link' => esc_html__('Extras', 'hnice'),
                'ready-big-button'  => esc_html__('View your website', 'hnice'),
                'ready-link-1'      => sprintf('<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__('Explore WordPress', 'hnice')),
                'ready-link-2'      => sprintf('<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__('Get Theme Support', 'hnice')),
                'ready-link-3'      => sprintf('<a href="%1$s">%2$s</a>', admin_url('customize.php'), esc_html__('Start Customizing', 'hnice')),
            )
        );
        if (hnice_is_elementor_activated()) {
            add_action('widgets_init', [$this, 'widgets_init']);
        }
        if (class_exists('Monster_Widget')) {
            add_action('widgets_init', [$this, 'widget_monster']);
        }
    }

    public function widget_monster() {
        unregister_widget('Monster_Widget');
        require_once get_parent_theme_file_path('/inc/merlin/includes/monster-widget.php');
        register_widget('Hnice_Monster_Widget');
    }

    public function widgets_init() {
        require_once get_parent_theme_file_path('/inc/merlin/includes/recent-post.php');
        register_widget('Hnice_WP_Widget_Recent_Posts');
        if (hnice_is_woocommerce_activated()) {
            require_once get_parent_theme_file_path('/inc/merlin/includes/class-wc-widget-layered-nav.php');
            register_widget('Hnice_Widget_Layered_Nav');
        }
    }

    private function get_all_header_footer() {
        return [
            'home-1' => [
                'header' => [
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                    ]
                ]
            ],
            'home-2' => [
                'header' => [
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                    ],
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                    ]
                ]
            ],
            'home-3' => [
                'header' => [
                    [
                        'slug'                         => 'header-2',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-24']],
                    ],
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-24']],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                    ]
                ]
            ],
            'home-4' => [
                'header' => [
                    [
                        'slug'                         => 'header-3',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-26']],
                    ],
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-26']],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-2',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-26']],
                    ],
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-26']],
                    ]
                ]
            ],
            'home-5' => [
                'header' => [
                    [
                        'slug'                         => 'header-4',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-28']],
                    ],
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-28']],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                    ]
                ]
            ],
            'home-6' => [
                'header' => [
                    [
                        'slug'                         => 'header-5',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-30']],
                    ],
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-30']],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                    ]
                ]
            ],
            'home-7' => [
                'header' => [
                    [
                        'slug'                         => 'header-6',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-32']],
                    ],
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-32']],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-4',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-32']],
                    ],
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-32']],
                    ]
                ]
            ],
            'home-8' => [
                'header' => [
                    [
                        'slug'                         => 'header-7',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-34']],
                    ],
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-34']],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-4',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-34']],
                    ],
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-34']],
                    ]
                ]
            ],
            'home-9' => [
                'header' => [
                    [
                        'slug'                         => 'header-8',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-36']],
                    ],
                    [
                        'slug'                         => 'header-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-36']],
                    ]
                ],
                'footer' => [
                    [
                        'slug'                         => 'footer-3',
                        'ehf_target_include_locations' => ['rule' => ['specifics'], 'specific' => ['post-36']],
                    ],
                    [
                        'slug'                         => 'footer-1',
                        'ehf_target_include_locations' => ['rule' => ['basic-global'], 'specific' => []],
                        'ehf_target_exclude_locations' => ['rule' => ['specifics'], 'specific' => ['post-36']],
                    ]
                ]
            ],
        ];
    }

    private function reset_header_footer() {
        $footer_args = array(
            'post_type'      => 'elementor-hf',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => 'ehf_template_type',
                    'compare' => 'IN',
                    'value'   => ['type_footer', 'type_header']
                ),
            )
        );
        $footer      = new WP_Query($footer_args);
        while ($footer->have_posts()) : $footer->the_post();
            update_post_meta(get_the_ID(), 'ehf_target_include_locations', []);
            update_post_meta(get_the_ID(), 'ehf_target_exclude_locations', []);
        endwhile;
        wp_reset_postdata();
    }

    public function set_demo_menus() {
        $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

        set_theme_mod(
            'nav_menu_locations',
            array(
                'primary'  => $main_menu->term_id,
                'handheld' => $main_menu->term_id,
            )
        );
    }

    private function set_hf($home) {
        $all_hf = $this->get_all_header_footer();
        $datas  = $all_hf[$home];
        foreach ($datas as $item) {
            foreach ($item as $object) {
                $hf = get_page_by_path($object['slug'], OBJECT, 'elementor-hf');
                if ($hf) {
                    update_post_meta($hf->ID, 'ehf_target_include_locations', $object['ehf_target_include_locations']);
                    if (isset($object['ehf_target_exclude_locations'])) {
                        update_post_meta($hf->ID, 'ehf_target_exclude_locations', $object['ehf_target_exclude_locations']);
                    }
                }
            }
        }
    }

    public function render_child_functions_php() {
        $output
            = "<?php
/**
 * Theme functions and definitions.
 */
		 ";

        return $output;
    }

    public function get_all_options(){
        $options = [];
        $options['options']   = json_decode('{"hnice_options_wocommerce_row_laptop":"4","hnice_options_woocommerce_archive_sidebar":"right","hnice_options_single_product_content_meta":"<ul class=\"custom-list\">\n<li><i class=\"hnice-icon-box\"></i> Free returns</li>\n<li><i class=\"hnice-icon-truck\"></i> Free shipping via DHL, fully insured</li>\n<li><i class=\"hnice-icon-check-square\"></i> All taxes and customs duties included </li>\n</ul>","hnice_options_wocommerce_row_tablet":"3","hnice_options_wocommerce_row_mobile":"2"}', true);
        $options['elementor']   = json_decode('{"system_colors":[{"_id":"primary","title":"Primary","color":"#E6AF5D"},{"_id":"secondary","title":"Secondary(Heading)","color":"#332F2C"},{"_id":"text","title":"Text","color":"#8D9396"},{"_id":"accent","title":"Accent","color":"#332F2C"},{"_id":"lighter","title":"Lighter","color":"#8D9396"},{"_id":"dark","title":"Dark","color":"#000000"},{"_id":"border","title":"Border","color":"#EAEAEA"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"secondary","title":"Secondary(Heading)","typography_typography":"custom","typography_font_family":"Marcellus","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Hnice","typography_font_weight":"700"},{"_id":"special","title":"Special","typography_typography":"custom"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Hnice","site_description":"Modern Funiture WooCommerce Theme","page_title_selector":"h1.entry-title","activeItemIndex":1,"active_breakpoints":["viewport_mobile","viewport_mobile_extra","viewport_tablet","viewport_tablet_extra","viewport_laptop"],"viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1410,"sizes":[]},"space_between_widgets":{"unit":"px","size":0,"sizes":[]},"body_background_background":"classic","body_background_color":"#fff"}', true);
        return $options;
    } // end get_all_options
}

return new Hnice_Merlin_Config();
