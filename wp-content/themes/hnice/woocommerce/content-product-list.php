<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('product-list', $product); ?>>
    <?php
    /**
     * Functions hooked in to hnice_woocommerce_before_shop_loop_item action
     *
     */
    do_action('hnice_woocommerce_before_shop_loop_item');

    ?>
    <div class="product-image">
        <?php
        /**
         * Functions hooked in to hnice_woocommerce_before_shop_loop_item_image action
         *
         * @see hnice_product_label - 10 - woo
         * @see woocommerce_template_loop_product_thumbnail - 15 - woo
         * @see hnice_woocommerce_product_loop_action_start - 20 - woo
         * @see hnice_quickview_button - 30 - woo
         * @see hnice_woocommerce_product_loop_action_close - 40 - woo
         */
        do_action('hnice_woocommerce_before_shop_loop_item_image');
        ?>
    </div>
    <div class="product-caption">
        <?php
        /**
         * Functions hooked in to hnice_woocommerce_shop_loop_item_caption action
         *
         * @see hnice_woocommerce_get_product_category - 5 - woo
         * @see woocommerce_template_loop_product_title - 10 - woo
         * @see hnice_single_product_extra_label - 15 - woo
         * @see woocommerce_template_loop_price - 20 - woo
         * @see hnice_woocommerce_get_product_description - 25 - woo
         * @see woocommerce_template_loop_add_to_cart - 30 - woo
         * @see hnice_wishlist_button - 35 - woo
         * @see hnice_compare_button - 35 - woo
         */
        do_action('hnice_woocommerce_shop_loop_item_caption');
        ?>
    </div>
    <?php
    /**
     * Functions hooked in to hnice_woocommerce_after_shop_loop_item action
     *
     */
    do_action('hnice_woocommerce_after_shop_loop_item');
    ?>
</li>
