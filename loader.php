<?php
/**
 * Plugin Name: pepyExtra
 * Description: Elementos Complementares ao ElementorPRO para otimizar as conversões de suas páginas
 * Plugin URI: https://pepy.link/extra
 * Author: Douglas G Alves
 * Version: 0.7
 * Author URI: https://douglasgaspar.com/
 * Text Domain: pepy-extra
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PEPY_EXTRA_VERSION', '0.7' );
define( 'PEPY_EXTRA_DOMAIN', 'pepy-extra' );
define( 'PEPY_EXTRA_HOOK_PREFIX', 'pepy_el_' );
define( 'PEPY_EXTRA_SLUG_PREFIX', 'pepy-elementor-' );
define( 'PEPY_EXTRA_FILE', __FILE__ );
define( 'PEPY_EXTRA_PLUGIN_BASE', plugin_basename( PEPY_EXTRA_FILE ) );
define( 'PEPY_EXTRA_PATH', plugin_dir_path( PEPY_EXTRA_FILE ) );
define( 'PEPY_EXTRA_URL', plugins_url( '/', PEPY_EXTRA_FILE ) );
define( 'PEPY_EXTRA_CORE_PATH', PEPY_EXTRA_PATH . 'core/' );
define( 'PEPY_EXTRA_WIDGET_PATH', PEPY_EXTRA_PATH . 'widgets/' );
define( 'PEPY_EXTRA_ENH_PATH', PEPY_EXTRA_PATH . 'enhancements/' );
define( 'PEPY_EXTRA_EXTRA_PATH', PEPY_EXTRA_PATH . 'extra/' );
define( 'PEPY_EXTRA_WIDGET_URL', PEPY_EXTRA_URL . 'widgets/' );
define( 'PEPY_EXTRA_ASSETS_URL', PEPY_EXTRA_URL . 'assets/' );


/*
 * Localization
 */
function pepy_elementor_load_plugin_textdomain() {
	load_plugin_textdomain( 'pepy-addons-for-elementor', false, basename( __DIR__ ) . '/languages/' );
}

add_action( 'plugins_loaded', 'pepy_elementor_load_plugin_textdomain' );

// Init plugin
require_once PEPY_EXTRA_CORE_PATH . 'Plugin.php';

