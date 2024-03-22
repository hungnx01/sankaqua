<?php


if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Hnice_Elementor')) :

    /**
     * The Hnice Elementor Integration class
     */
    class Hnice_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('wp', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Elementor Fix Noitice WooCommerce
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/register', [$this, 'add_icons']);

            // Add Breakpoints
            add_action('wp_enqueue_scripts', 'hnice_elementor_breakpoints', 9999);

            if (!hnice_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/class-custom-css.php';
                require trailingslashit(get_template_directory()) . 'inc/elementor/class-section-sticky.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
            }

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);

        }

        public function additional_fonts($fonts) {
            $fonts["Outfit"] = 'googlefonts';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = esc_html__('Shortcode', 'hnice');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            global $hnice_version;
            wp_enqueue_script('hnice-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $hnice_version);
        }

        public function add_style_editor() {
            global $hnice_version;
            wp_enqueue_style('hnice-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $hnice_version);
        }

        public function add_scripts() {
            global $hnice_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('hnice-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $hnice_version);
            wp_style_add_data('hnice-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/libs/TweenMax.min.js'), array('jquery'), '1.11.1');

            if (hnice_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('tweenmax');
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/libs/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }
        }

        public function register_auto_scripts_frontend() {
            global $hnice_version;
            wp_register_script('hnice-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-image-carousel', get_theme_file_uri('/assets/js/elementor/image-carousel.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-image-gallery', get_theme_file_uri('/assets/js/elementor/image-gallery.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-image-hotspots', get_theme_file_uri('/assets/js/elementor/image-hotspots.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-image-panorama', get_theme_file_uri('/assets/js/elementor/image-panorama.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-link-showcase', get_theme_file_uri('/assets/js/elementor/link-showcase.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-product-categories', get_theme_file_uri('/assets/js/elementor/product-categories.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $hnice_version, true);
            wp_register_script('hnice-elementor-virtual-tour', get_theme_file_uri('/assets/js/elementor/virtual-tour.js'), array('jquery','elementor-frontend'), $hnice_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'hnice-addons',
                array(
                    'title' => esc_html__('Hnice Addons', 'hnice'),
                    'icon'  => 'fa fa-plug',
                ), 1);
        }

        public function add_animations_scroll($animations) {
            $animations['Hnice Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            require 'base_widgets.php';

            $files_custom = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files_custom as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }

            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function woocommerce_fix_notice() {
            if (hnice_is_woocommerce_activated()) {
                remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
                remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"hnice-icon-account":"account","hnice-icon-alarm":"alarm","hnice-icon-amazing-value":"amazing-value","hnice-icon-angle-double-left":"angle-double-left","hnice-icon-angle-double-right":"angle-double-right","hnice-icon-angle-down":"angle-down","hnice-icon-angle-left":"angle-left","hnice-icon-angle-right":"angle-right","hnice-icon-angle-up":"angle-up","hnice-icon-arrow_s":"arrow_s","hnice-icon-arrow-down-o":"arrow-down-o","hnice-icon-arrow-up-o":"arrow-up-o","hnice-icon-basin":"basin","hnice-icon-bathroom":"bathroom","hnice-icon-bathroom2":"bathroom2","hnice-icon-bathtub":"bathtub","hnice-icon-bathtub2":"bathtub2","hnice-icon-box":"box","hnice-icon-breadcrumb":"breadcrumb","hnice-icon-bullet-list-line":"bullet-list-line","hnice-icon-calendar-alt":"calendar-alt","hnice-icon-cash-payment":"cash-payment","hnice-icon-check-o":"check-o","hnice-icon-check-square-solid":"check-square-solid","hnice-icon-clock":"clock","hnice-icon-close-circle-line":"close-circle-line","hnice-icon-delivery":"delivery","hnice-icon-directly":"directly","hnice-icon-facebook-o":"facebook-o","hnice-icon-faucet":"faucet","hnice-icon-featured":"featured","hnice-icon-filters":"filters","hnice-icon-heating":"heating","hnice-icon-help-center":"help-center","hnice-icon-home-1":"home-1","hnice-icon-hours-support":"hours-support","hnice-icon-hurry":"hurry","hnice-icon-instagram-o":"instagram-o","hnice-icon-left-arrow":"left-arrow","hnice-icon-linkedin-in":"linkedin-in","hnice-icon-list-ul":"list-ul","hnice-icon-location":"location","hnice-icon-mail-o":"mail-o","hnice-icon-mail2":"mail2","hnice-icon-map-location-o":"map-location-o","hnice-icon-mobile-shopping":"mobile-shopping","hnice-icon-money-check":"money-check","hnice-icon-movies":"movies","hnice-icon-phonecall":"phonecall","hnice-icon-phonecall2":"phonecall2","hnice-icon-play-circle":"play-circle","hnice-icon-play":"play","hnice-icon-plus-o":"plus-o","hnice-icon-premium":"premium","hnice-icon-quote-left":"quote-left","hnice-icon-reflex":"reflex","hnice-icon-refund":"refund","hnice-icon-repeat-wl":"repeat-wl","hnice-icon-reply-line":"reply-line","hnice-icon-right-arrow-cicrle":"right-arrow-cicrle","hnice-icon-right-arrow":"right-arrow","hnice-icon-search2":"search2","hnice-icon-send-back":"send-back","hnice-icon-setting":"setting","hnice-icon-share-all":"share-all","hnice-icon-shopping-cart2":"shopping-cart2","hnice-icon-shoppingcart-o":"shoppingcart-o","hnice-icon-shower-box":"shower-box","hnice-icon-shower":"shower","hnice-icon-sink":"sink","hnice-icon-sliders-v":"sliders-v","hnice-icon-smartphone":"smartphone","hnice-icon-star-o":"star-o","hnice-icon-support":"support","hnice-icon-system-arrow-right":"system-arrow-right","hnice-icon-th-large-o":"th-large-o","hnice-icon-tile":"tile","hnice-icon-toilet":"toilet","hnice-icon-towel":"towel","hnice-icon-truck":"truck","hnice-icon-twitter-o":"twitter-o","hnice-icon-user-profile":"user-profile","hnice-icon-working-hours":"working-hours","hnice-icon-360":"360","hnice-icon-arrow-down":"arrow-down","hnice-icon-arrow-left":"arrow-left","hnice-icon-arrow-right":"arrow-right","hnice-icon-arrow-up":"arrow-up","hnice-icon-bars":"bars","hnice-icon-caret-down":"caret-down","hnice-icon-caret-left":"caret-left","hnice-icon-caret-right":"caret-right","hnice-icon-caret-up":"caret-up","hnice-icon-cart-empty":"cart-empty","hnice-icon-cart":"cart","hnice-icon-check-square":"check-square","hnice-icon-chevron-down":"chevron-down","hnice-icon-chevron-left":"chevron-left","hnice-icon-chevron-right":"chevron-right","hnice-icon-chevron-up":"chevron-up","hnice-icon-circle":"circle","hnice-icon-cloud-download-alt":"cloud-download-alt","hnice-icon-comment":"comment","hnice-icon-comments":"comments","hnice-icon-compare":"compare","hnice-icon-contact":"contact","hnice-icon-credit-card":"credit-card","hnice-icon-dot-circle":"dot-circle","hnice-icon-edit":"edit","hnice-icon-envelope":"envelope","hnice-icon-expand-alt":"expand-alt","hnice-icon-external-link-alt":"external-link-alt","hnice-icon-file-alt":"file-alt","hnice-icon-file-archive":"file-archive","hnice-icon-filter":"filter","hnice-icon-folder-open":"folder-open","hnice-icon-folder":"folder","hnice-icon-frown":"frown","hnice-icon-gift":"gift","hnice-icon-grip-horizontal":"grip-horizontal","hnice-icon-heart-fill":"heart-fill","hnice-icon-heart":"heart","hnice-icon-history":"history","hnice-icon-home":"home","hnice-icon-info-circle":"info-circle","hnice-icon-instagram":"instagram","hnice-icon-level-up-alt":"level-up-alt","hnice-icon-list":"list","hnice-icon-map-marker-check":"map-marker-check","hnice-icon-meh":"meh","hnice-icon-minus-circle":"minus-circle","hnice-icon-minus":"minus","hnice-icon-mobile-android-alt":"mobile-android-alt","hnice-icon-money-bill":"money-bill","hnice-icon-paper-plane":"paper-plane","hnice-icon-pencil-alt":"pencil-alt","hnice-icon-plus-circle":"plus-circle","hnice-icon-plus":"plus","hnice-icon-quickview":"quickview","hnice-icon-random":"random","hnice-icon-rating-stroke":"rating-stroke","hnice-icon-rating":"rating","hnice-icon-repeat":"repeat","hnice-icon-reply-all":"reply-all","hnice-icon-reply":"reply","hnice-icon-search-plus":"search-plus","hnice-icon-search":"search","hnice-icon-shield-check":"shield-check","hnice-icon-shopping-basket":"shopping-basket","hnice-icon-shopping-cart":"shopping-cart","hnice-icon-sign-out-alt":"sign-out-alt","hnice-icon-smile":"smile","hnice-icon-spinner":"spinner","hnice-icon-square":"square","hnice-icon-star":"star","hnice-icon-store":"store","hnice-icon-sync":"sync","hnice-icon-tachometer-alt":"tachometer-alt","hnice-icon-th-large":"th-large","hnice-icon-th-list":"th-list","hnice-icon-thumbtack":"thumbtack","hnice-icon-ticket":"ticket","hnice-icon-times-circle":"times-circle","hnice-icon-times":"times","hnice-icon-trophy-alt":"trophy-alt","hnice-icon-user-headset":"user-headset","hnice-icon-user-shield":"user-shield","hnice-icon-user":"user","hnice-icon-video":"video","hnice-icon-wishlist-empty":"wishlist-empty","hnice-icon-wishlist":"wishlist","hnice-icon-adobe":"adobe","hnice-icon-amazon":"amazon","hnice-icon-android":"android","hnice-icon-angular":"angular","hnice-icon-apper":"apper","hnice-icon-apple":"apple","hnice-icon-atlassian":"atlassian","hnice-icon-behance":"behance","hnice-icon-bitbucket":"bitbucket","hnice-icon-bitcoin":"bitcoin","hnice-icon-bity":"bity","hnice-icon-bluetooth":"bluetooth","hnice-icon-btc":"btc","hnice-icon-centos":"centos","hnice-icon-chrome":"chrome","hnice-icon-codepen":"codepen","hnice-icon-cpanel":"cpanel","hnice-icon-discord":"discord","hnice-icon-dochub":"dochub","hnice-icon-docker":"docker","hnice-icon-dribbble":"dribbble","hnice-icon-dropbox":"dropbox","hnice-icon-drupal":"drupal","hnice-icon-ebay":"ebay","hnice-icon-facebook-f":"facebook-f","hnice-icon-facebook":"facebook","hnice-icon-figma":"figma","hnice-icon-firefox":"firefox","hnice-icon-google-plus":"google-plus","hnice-icon-google":"google","hnice-icon-grunt":"grunt","hnice-icon-gulp":"gulp","hnice-icon-html5":"html5","hnice-icon-joomla":"joomla","hnice-icon-link-brand":"link-brand","hnice-icon-linkedin":"linkedin","hnice-icon-mailchimp":"mailchimp","hnice-icon-opencart":"opencart","hnice-icon-paypal":"paypal","hnice-icon-pinterest-p":"pinterest-p","hnice-icon-reddit":"reddit","hnice-icon-skype":"skype","hnice-icon-slack":"slack","hnice-icon-snapchat":"snapchat","hnice-icon-spotify":"spotify","hnice-icon-trello":"trello","hnice-icon-twitter":"twitter","hnice-icon-vimeo":"vimeo","hnice-icon-whatsapp":"whatsapp","hnice-icon-wordpress":"wordpress","hnice-icon-yoast":"yoast","hnice-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $hnice_version;
            $tabs['opal-custom'] = [
                'name'          => 'hnice-icon',
                'label'         => esc_html__('Hnice Icon', 'hnice'),
                'prefix'        => 'hnice-icon-',
                'displayPrefix' => 'hnice-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $hnice_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Hnice_Elementor();
