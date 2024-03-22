<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}

?>
<li <?php wc_product_class('product', $product); ?>>
    <div class="product-block-list">
        <div class="left">
            <?php
            /**
             * Functions hooked in to hnice_woocommerce_list_item_title action
             *
             * @see hnice_product_label - 5 - woo
             * @see hnice_woocommerce_product_list_image - 10 - woo
             *
             */
            do_action('hnice_woocommerce_list_item_title');
            ?>
        </div>
        <div class="right">
            <?php
            /**
             * Functions hooked in to hnice_woocommerce_list_item_content action
             *
             * @see woocommerce_template_loop_product_title - 10 - woo
             * @see woocommerce_template_loop_rating - 15 - woo
             * @see woocommerce_template_loop_price - 20 - woo
             * @see hnice_stock_label - 25 - woo
             *
             */
            do_action('hnice_woocommerce_list_item_content');
            ?>
        </div>
    </div>
</li>
