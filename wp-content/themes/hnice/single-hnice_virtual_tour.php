<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php
    /**
     * Functions hooked in to wp_head action
     *
     * @see hnice_pingback_header - 1
     */
    wp_head();

    ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action('hnice_before_site'); ?>

<div id="page" class="hfeed site">
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <?php
                    while (have_posts()) :
                        the_post();
                        the_content();
                    endwhile; // End of the loop.

                    ?>

                </main><!-- #main -->
            </div><!-- #primary -->

        </div><!-- .col-full -->
    </div><!-- #content -->

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see hnice_template_account_dropdown    - 1
 * @see hnice_mobile_nav - 1
 * @see hnice_render_woocommerce_shop_canvas - 1 - woo
 */

wp_footer();
?>
</body>
</html>

