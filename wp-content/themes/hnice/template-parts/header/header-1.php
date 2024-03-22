<header id="masthead" class="site-header header-1" role="banner">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                hnice_site_branding();
                if (hnice_is_woocommerce_activated()) {
                    ?>
                    <div class="site-header-cart header-cart-mobile">
                        <?php hnice_cart_link(); ?>
                    </div>
                    <?php
                }
                ?>
                <?php hnice_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php hnice_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    hnice_header_account();
                    if (hnice_is_woocommerce_activated()) {
                        hnice_header_wishlist();
                        hnice_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
