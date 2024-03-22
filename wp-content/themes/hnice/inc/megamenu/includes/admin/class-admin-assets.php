<?php

defined( 'ABSPATH' ) || exit();

/**
 * Hnice_Megamenu_Walker
 *
 * extends Walker_Nav_Menu
 */
class Hnice_Admin_Megamenu_Assets {

	public static function init() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( __CLASS__, 'add_scripts_editor' ) );
	}

	public static function add_scripts_editor() {
		global $hnice_version;
		if ( isset( $_REQUEST['hnice-menu-editable'] ) && $_REQUEST['hnice-menu-editable'] ) {
			wp_register_script( 'hnice-elementor-menu', get_template_directory_uri() . '/inc/megamenu/assets/js/editor.js', [], $hnice_version );
			wp_enqueue_script( 'hnice-elementor-menu' );
		}
	}

	/**
	 * enqueue scripts
	 */
	public static function enqueue_scripts( $page ) {
		global $hnice_version;
		if ( $page === 'nav-menus.php' ) {
			wp_enqueue_script( 'backbone' );
			wp_enqueue_script( 'underscore' );

			$suffix = '.min';
			wp_register_script(
				'jquery-elementor-select2',
				ELEMENTOR_ASSETS_URL . 'lib/e-select2/js/e-select2.full' . $suffix . '.js',
				[
					'jquery',
				],
				'4.0.6-rc.1',
				true
			);
			wp_enqueue_script( 'jquery-elementor-select2' );
			wp_register_style(
				'elementor-select2',
				ELEMENTOR_ASSETS_URL . 'lib/e-select2/css/e-select2' . $suffix . '.css',
				[],
				'4.0.6-rc.1'
			);
			wp_enqueue_style( 'elementor-select2' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_register_script( 'hnice-megamenu', get_template_directory_uri() . '/inc/megamenu/assets/js/admin.js', array(
				'jquery',
				'backbone',
				'underscore'
			), $hnice_version, true );
			wp_localize_script( 'hnice-megamenu', 'hnice_memgamnu_params', apply_filters( 'hnice_admin_megamenu_localize_scripts', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'i18n'    => array(
					'close' => esc_html__( 'Close', 'hnice' ),
					'submit' => esc_html__( 'Save', 'hnice' )
				),
				'nonces'  => array(
					'load_menu_data' => wp_create_nonce( 'hnice-menu-data-nonce' )
				)
			) ) );
			wp_enqueue_script( 'hnice-megamenu' );

			wp_enqueue_style( 'hnice-megamenu', get_template_directory_uri() . '/inc/megamenu/assets/css/admin.css', [], $hnice_version );
			wp_enqueue_style( 'hnice-elementor-custom-icon', get_theme_file_uri( '/assets/css/admin/elementor/icons.css' ), [], $hnice_version );
		}

	}

}

Hnice_Admin_Megamenu_Assets::init();
