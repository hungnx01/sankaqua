<?php
$theme       = wp_get_theme('hnice');
$hnice_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 980; /* pixels */
}
require get_theme_file_path('inc/class-tgm-plugin-activation.php');
$hnice = (object)array(
    'version' => $hnice_version,
    /**
     * Initialize all the things.
     */
    'main'    => require 'inc/class-main.php',
);

require get_theme_file_path('inc/functions.php');
require get_theme_file_path('inc/template-hooks.php');
require get_theme_file_path('inc/template-functions.php');

require_once get_theme_file_path('inc/merlin/vendor/autoload.php');
require_once get_theme_file_path('inc/merlin/class-merlin.php');
require_once get_theme_file_path('inc/merlin-config.php');

require_once get_theme_file_path('inc/class-customize.php');
require get_theme_file_path('inc/merlin/includes/class-age-verification.php');

if (hnice_is_woocommerce_activated()) {
    $hnice->woocommerce = require get_theme_file_path('inc/woocommerce/class-woocommerce.php');

    require get_theme_file_path('inc/woocommerce/class-woocommerce-adjacent-products.php');
    require get_theme_file_path('inc/woocommerce/woocommerce-functions.php');
    require get_theme_file_path('inc/woocommerce/woocommerce-template-functions.php');
    require get_theme_file_path('inc/woocommerce/woocommerce-template-hooks.php');
    require get_theme_file_path('inc/woocommerce/template-hooks.php');
    require get_theme_file_path('inc/woocommerce/class-woocommerce-settings.php');
    require get_theme_file_path('inc/woocommerce/class-woocommerce-brand.php');
    require get_theme_file_path('inc/woocommerce/class-woocommerce-extra.php');
    require get_theme_file_path('inc/merlin/includes/class-wc-widget-product-brands.php');
    require get_theme_file_path('inc/merlin/includes/product-360-view.php');
}

if (hnice_is_elementor_activated()) {
    require get_theme_file_path('inc/elementor/functions-elementor.php');
    if (!defined('ELEMENTOR_PRO_VERSION') && version_compare( ELEMENTOR_VERSION, '3.18.0', '>=' )) {
        require get_theme_file_path('inc/elementor/class-fix-elementor.php');
    }

    $hnice->elementor = require get_theme_file_path('inc/elementor/class-elementor.php');
    //====start_premium
    $hnice->megamenu = require get_theme_file_path('inc/megamenu/megamenu.php');
    //====end_premium
    $hnice->parallax = require get_theme_file_path('inc/elementor/class-section-parallax.php');

    require get_theme_file_path('inc/merlin/includes/team.php');
    require get_theme_file_path('inc/merlin/includes/virtual-tour.php');

    if (defined('ELEMENTOR_PRO_VERSION')) {
        require get_theme_file_path('inc/elementor/functions-elementor-pro.php');
    }

    if (function_exists('hfe_init')) {
        require get_theme_file_path('inc/header-footer-elementor/class-hfe.php');
        require get_theme_file_path('inc/merlin/includes/breadcrumb.php');
        require get_theme_file_path('inc/merlin/includes/class-custom-shapes.php');
    }

    if (hnice_is_woocommerce_activated()) {
        require_once get_theme_file_path('inc/elementor/elementor-control/class-elementor-control.php');
    }
}

if (!is_user_logged_in()) {
    require get_theme_file_path('inc/modules/class-login.php');
}