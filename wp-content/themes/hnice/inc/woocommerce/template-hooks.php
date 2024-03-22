<?php
/**
 * =================================================
 * Hook hnice_page
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_single_post
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_single_post_bottom
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_loop_post
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_footer
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_after_footer
 * =================================================
 */
add_action('hnice_after_footer', 'hnice_sticky_single_add_to_cart', 999);

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'hnice_render_woocommerce_shop_canvas', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_content_top
 * =================================================
 */
add_action('hnice_content_top', 'hnice_shop_messages', 10);

/**
 * =================================================
 * Hook hnice_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_sidebar
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_loop_after
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_page_after
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_woocommerce_list_item_title
 * =================================================
 */
add_action('hnice_woocommerce_list_item_title', 'hnice_product_label', 5);
add_action('hnice_woocommerce_list_item_title', 'hnice_woocommerce_product_list_image', 10);

/**
 * =================================================
 * Hook hnice_woocommerce_list_item_content
 * =================================================
 */
add_action('hnice_woocommerce_list_item_content', 'woocommerce_template_loop_product_title', 10);
add_action('hnice_woocommerce_list_item_content', 'woocommerce_template_loop_rating', 15);
add_action('hnice_woocommerce_list_item_content', 'woocommerce_template_loop_price', 20);
add_action('hnice_woocommerce_list_item_content', 'hnice_stock_label', 25);

/**
 * =================================================
 * Hook hnice_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_woocommerce_before_shop_loop_item_image
 * =================================================
 */
add_action('hnice_woocommerce_before_shop_loop_item_image', 'hnice_product_label', 10);
add_action('hnice_woocommerce_before_shop_loop_item_image', 'woocommerce_template_loop_product_thumbnail', 15);
add_action('hnice_woocommerce_before_shop_loop_item_image', 'hnice_woocommerce_product_loop_action_start', 20);
add_action('hnice_woocommerce_before_shop_loop_item_image', 'hnice_quickview_button', 30);
add_action('hnice_woocommerce_before_shop_loop_item_image', 'hnice_woocommerce_product_loop_action_close', 40);

/**
 * =================================================
 * Hook hnice_woocommerce_shop_loop_item_caption
 * =================================================
 */
add_action('hnice_woocommerce_shop_loop_item_caption', 'hnice_woocommerce_get_product_category', 5);
add_action('hnice_woocommerce_shop_loop_item_caption', 'woocommerce_template_loop_product_title', 10);
add_action('hnice_woocommerce_shop_loop_item_caption', 'hnice_single_product_extra_label', 15);
add_action('hnice_woocommerce_shop_loop_item_caption', 'woocommerce_template_loop_price', 20);
add_action('hnice_woocommerce_shop_loop_item_caption', 'hnice_woocommerce_get_product_description', 25);
add_action('hnice_woocommerce_shop_loop_item_caption', 'woocommerce_template_loop_add_to_cart', 30);
add_action('hnice_woocommerce_shop_loop_item_caption', 'hnice_wishlist_button', 35);
add_action('hnice_woocommerce_shop_loop_item_caption', 'hnice_compare_button', 35);

/**
 * =================================================
 * Hook hnice_woocommerce_after_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_product_list_start
 * =================================================
 */

/**
 * =================================================
 * Hook hnice_product_list_image
 * =================================================
 */
add_action('hnice_product_list_image', 'hnice_woocommerce_product_list_image', 10);

/**
 * =================================================
 * Hook hnice_product_list_content
 * =================================================
 */
add_action('hnice_product_list_content', 'woocommerce_template_loop_product_title', 10);
add_action('hnice_product_list_content', 'hnice_single_product_extra_label', 15);
add_action('hnice_product_list_content', 'woocommerce_template_loop_price', 20);

/**
 * =================================================
 * Hook hnice_product_list_end
 * =================================================
 */
