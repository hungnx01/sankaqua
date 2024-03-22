<?php

if (!function_exists('hnice_get_settings_product_caroseul')) {
    function hnice_get_settings_product_caroseul() {
        $items       = wc_get_loop_prop('columns');
        $laptop      = hnice_get_theme_option('wocommerce_row_laptop', 3);
        $tablet      = hnice_get_theme_option('wocommerce_row_tablet', 3);
        $mobile      = hnice_get_theme_option('wocommerce_row_mobile', 2);
        $breakpoints = [
            'desktop'      => [
                'value'  => 1366,
                'column' => $items,
            ],
            'laptop'       => [
                'value'  => 1200,
                'column' => $laptop,
            ],
            'tablet'       => [
                'value'  => 767,
                'column' => $tablet,
            ],
            'mobile'       => [
                'value'  => 0,
                'column' => $mobile,
            ],
        ];

        if (hnice_is_elementor_activated()) {
            $elementor_breakpoints = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();
            foreach (array_reverse($elementor_breakpoints) as $breakpoint) {
                if ($breakpoint->is_enabled()) {
                    if ($breakpoint->get_name() == 'laptop') {
                        $breakpoints['desktop']['value'] = $breakpoint->get_value();
                    }
                    if ($breakpoint->get_name() == 'tablet') {
                        $breakpoints['laptop']['value'] = $breakpoint->get_value();
                    }
                    if ($breakpoint->get_name() == 'mobile') {
                        $breakpoints['tablet']['value'] = $breakpoint->get_value();
                    }
                }
            }
        }

        $settings = array(
            'breakpoints'          => $breakpoints,
            "column"               => $items,
            "navigation"           => "arrows",
            "column_spacing"       => 30,
            "swiper_overflow"      => "none",
            "autoplay"             => "yes",
            "pause_on_hover"       => "yes",
            "pause_on_interaction" => "yes",
            "autoplay_speed"       => 5000,
            "infinite"             => "yes",
            "speed"                => 500,
            "prevEl"               => ".elementor-swiper-button-prev",
            "nextEl"               => ".elementor-swiper-button-next",
            "paginationEl"         => ".swiper-pagination",
        );

        return $settings;
    }
}
if (!function_exists('hnice_woocommerce_before_shop_loop')) {
    /**
     * woocommerce_before_shop_loop
     */
    function hnice_woocommerce_before_shop_loop() {
        $layout = isset($_GET['layout']) ? $_GET['layout'] : apply_filters('hnice_shop_layout', 'grid');
        $class  = 'hnice-products-grid';
        $class  .= ' elementor-grid-' . ($layout == 'list' ? 1 : wc_get_loop_prop('columns', 4));
        $class  .= ' elementor-grid-laptop-' . ($layout == 'list' ? 1 : hnice_get_theme_option('wocommerce_row_laptop', 3));
        $class  .= ' elementor-grid-tablet-' . ($layout == 'list' ? 1 : hnice_get_theme_option('wocommerce_row_tablet', 2));
        $class  .= ' elementor-grid-mobile-' . ($layout == 'list' ? 1 : hnice_get_theme_option('wocommerce_row_mobile', 1));

        echo '<div class="' . esc_attr($class) . '">';
    }
}


if (!function_exists('hnice_woocommerce_product_loop_end')) {
    /**
     * woocommerce_product_loop_end
     */
    function hnice_woocommerce_product_loop_end() {
        echo '</div>';
    }
}

/**
 * Checks if the current page is a product archive
 *
 * @return boolean
 */
function hnice_is_product_archive() {
    if (is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag()) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $product WC_Product
 */
function hnice_product_get_image($product) {
    return $product->get_image();
}

/**
 * @param $product WC_Product
 */
function hnice_product_get_price_html($product) {
    return $product->get_price_html();
}

/**
 * Retrieves the previous product.
 *
 * @param bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
function hnice_get_previous_product($in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat') {
    $product = new Hnice_WooCommerce_Adjacent_Products($in_same_term, $excluded_terms, $taxonomy, true);
    return $product->get_product();
}

/**
 * Retrieves the next product.
 *
 * @param bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
function hnice_get_next_product($in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat') {
    $product = new Hnice_WooCommerce_Adjacent_Products($in_same_term, $excluded_terms, $taxonomy);
    return $product->get_product();
}


function hnice_is_woocommerce_extension_activated($extension = 'WC_Bookings') {
    if ($extension == 'YITH_WCQV') {
        return class_exists($extension) && class_exists('YITH_WCQV_Frontend') ? true : false;
    }

    return class_exists($extension) ? true : false;
}

function hnice_woocommerce_pagination_args($args) {
    $args['prev_text'] = '<i class="hnice-icon hnice-icon-angle-double-left"></i>Previous<span>' . '</span>';
    $args['next_text'] = '<span>' . '</span>Next<i class="hnice-icon hnice-icon-angle-double-right"></i>';
    return $args;
}

add_filter('woocommerce_pagination_args', 'hnice_woocommerce_pagination_args', 10, 1);


function hnice_unsupported_theme_remove_review_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}

/**
 * Check if a product is a deal
 *
 * @param int|object $product
 *
 * @return bool
 */
function hnice_woocommerce_is_deal_product($product) {
    $product = is_numeric($product) ? wc_get_product($product) : $product;

    // It must be a sale product first
    if (!$product->is_on_sale()) {
        return false;
    }

    if (!$product->is_in_stock()) {
        return false;
    }

    // Only support product type "simple" and "external"
    if (!$product->is_type('simple') && !$product->is_type('external')) {
        return false;
    }

    $deal_quantity = get_post_meta($product->get_id(), '_deal_quantity', true);

    if ($deal_quantity > 0) {
        return true;
    }

    return false;
}


if (!function_exists('hnice_template_loop_product_thumbnail')) {
    function hnice_template_loop_product_thumbnail($size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0) {
        echo hnice_get_loop_product_thumbnail();

    }
}
if (!function_exists('hnice_get_loop_product_thumbnail')) {
    function hnice_get_loop_product_thumbnail($size = 'woocommerce_thumbnail', $attr = array(), $placeholder = true) {
        global $product;
        if (!$product) {
            return '';
        }
        $gallery    = $product->get_gallery_image_ids();
        $hover_skin = apply_filters('single_product_archive_thumbnail_hover', 'fade');
        $image_size = apply_filters('single_product_archive_thumbnail_size', $size);

        if ($hover_skin == '0' || count($gallery) <= 0) {
            echo '<div class="product-image">' . $product->get_image($image_size, $attr, $placeholder) . '</div>';
            return '';
        }
        $image_featured = '<div class="product-image">' . $product->get_image($image_size, $attr, $placeholder) . '</div>';
        $image_featured .= '<div class="product-image second-image">' . wp_get_attachment_image($gallery[0], $image_size) . '</div>';

        echo <<<HTML
<div class="product-img-wrap {$hover_skin}">
    <div class="inner">
        {$image_featured}
    </div>
</div>
HTML;
    }
}

function woocommerce_template_loop_rating() {
    global $product;
    $count = $product->get_review_count();
    if (!wc_review_ratings_enabled()) {
        return;
    }
    $text = esc_html(_nx(' review', ' reviews', $count, ' review count', 'hnice'));
    if ($rating_html = wc_get_rating_html($product->get_average_rating())) {
        echo apply_filters('hnice_woocommerce_rating_html', '<div class="count-review">' . $rating_html . '<span></span></div>');
    } else {
        echo '<div class="count-review"><div class="star-rating"></div><span></span></div>';
    }
}

if (!function_exists('hnice_check_quantity_product')) {
    function hnice_check_quantity_product() {
        global $product;
        $quantity = get_post_meta($product->get_id(), '_sold_individually', true);
        if ($quantity == 'yes' || $product->get_stock_status() == 'outofstock' || $product->is_type('variable') || $product->is_type('grouped')) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('hnice_ajax_search_products')) {
    function hnice_ajax_search_products() {
        global $woocommerce;
        $search_keyword = $_REQUEST['query'];

        $ordering_args = $woocommerce->query->get_catalog_ordering_args('date', 'desc');
        $suggestions   = array();

        $args = array(
            's'                   => apply_filters('hnice_ajax_search_products_search_query', $search_keyword),
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'orderby'             => $ordering_args['orderby'],
            'order'               => $ordering_args['order'],
            'posts_per_page'      => apply_filters('hnice_ajax_search_products_posts_per_page', 8),

        );

        $args['tax_query']['relation'] = 'AND';

        if (!empty($_REQUEST['product_cat'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => strip_tags($_REQUEST['product_cat']),
                'operator' => 'IN'
            );
        }

        $products = get_posts($args);

        if (!empty($products)) {
            foreach ($products as $post) {
                $product       = wc_get_product($post);
                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()));

                $suggestions[] = apply_filters('hnice_suggestion', array(
                    'id'    => $product->get_id(),
                    'value' => strip_tags($product->get_title()),
                    'url'   => $product->get_permalink(),
                    'img'   => esc_url($product_image[0]),
                    'price' => $product->get_price_html(),
                ), $product);
            }
        } else {
            $suggestions[] = array(
                'id'    => -1,
                'value' => esc_html__('No results', 'hnice'),
                'url'   => '',
            );
        }
        wp_reset_postdata();

        echo json_encode($suggestions);
        die();
    }
}

add_action('wp_ajax_hnice_ajax_search_products', 'hnice_ajax_search_products');
add_action('wp_ajax_nopriv_hnice_ajax_search_products', 'hnice_ajax_search_products');

function hnice_wc_track_product_view() {
    if (!is_singular('product') || is_active_widget(false, false, 'woocommerce_recently_viewed_products', true)) {
        return;
    }

    global $post;

    if (empty($_COOKIE['woocommerce_recently_viewed'])) { // @codingStandardsIgnoreLine.
        $viewed_products = array();
    } else {
        $viewed_products = wp_parse_id_list((array)explode('|', wp_unslash($_COOKIE['woocommerce_recently_viewed']))); // @codingStandardsIgnoreLine.
    }

    // Unset if already in viewed products list.
    $keys = array_flip($viewed_products);

    if (isset($keys[$post->ID])) {
        unset($viewed_products[$keys[$post->ID]]);
    }

    $viewed_products[] = $post->ID;

    if (count($viewed_products) > 15) {
        array_shift($viewed_products);
    }

    // Store for session only.
    wc_setcookie('woocommerce_recently_viewed', implode('|', $viewed_products));
}

add_action('template_redirect', 'hnice_wc_track_product_view', 20);