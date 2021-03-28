<?php

namespace PepyExtra;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Settings
 * @package PepyExtra
 */
class Settings {

	/**
	 * @var null
	 */
	public static $instance;

	/**
	 * @var string
	 */
	private $current_slug = '';

	/**
	 * @return Settings|null
	 */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Settings constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_menu' ], 20 );
		add_action( 'admin_menu', [ $this, 'admin_menu_change_name' ], 200 );
		add_filter( 'admin_body_class', [ $this, 'add_admin_body_class' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
		add_action( PEPY_EXTRA_HOOK_PREFIX . 'panel_action', [ $this, 'main_panel' ] );
	}

	/**
	 * Register admin menu
	 */
	public function register_menu() {
		add_menu_page(
			__( 'pepyExtra - Dashboard', 'pepy-addons-for-elementor' ),
			__( 'pepyExtra', 'pepy-addons-for-elementor' ),
			'manage_options', 
			'pepy-elementor-widgets',
			[ $this, 'settings_template' ],

		);

	}

	/**
	 * Change fist menu item name
	 */
	public function admin_menu_change_name() {
		global $submenu;

		if ( isset( $submenu[ Plugin::instance()->get_slug() ] ) ) {
			$submenu[ Plugin::instance()->get_slug() ][0][0] = __( 'Dashboard', 'pepy-addons-for-elementor' );
		}
	}

	/**
	 * Add body class when on plugin's settings page
	 *
	 * @param $classes
	 *
	 * @return string
	 */
	public function add_admin_body_class( $classes ) {
		if ( isset( $_GET['page'] ) && strpos( $_GET['page'], 'pepy-elementor' ) !== false ) {
			$classes .= ' pepy-elementor-admin-page';
		}

		return $classes;
	}

	/**
	 * Settings template
	 */
	public function settings_template() {
		$site_url      = apply_filters( PEPY_EXTRA_HOOK_PREFIX . 'admin_site_url', 'https://escolaelementor.com/' );
		$wrapper_class = apply_filters( PEPY_EXTRA_HOOK_PREFIX . 'welcome_wrapper_class', [ $this->current_slug ] );
		$menu          = apply_filters( PEPY_EXTRA_HOOK_PREFIX . 'admin_menu', [] );
		$has_pro       = '#';

		if ( ! empty( $menu ) ) {
			usort( $menu, static function ( $a, $b ) {
				return $a['priority'] - $b['priority'];
			} );
		}

		Utils::load_template( 'core/admin/layout', [
			'site_url'      => $site_url,
			'wrapper_class' => $wrapper_class,
			'menu'          => $menu,
			'has_pro'       => $has_pro
		] );
	}

	/**
	 * Main template actions
	 */
	public function main_panel() {
		$current_slug = apply_filters( PEPY_EXTRA_HOOK_PREFIX . 'current_slug', $this->current_slug );

		Utils::load_template( 'core/admin/actions', [
			'current_slug' => $current_slug
		] );
	}

	/**
	 * Load scripts & styles
	 */
	public function admin_scripts() {

		if ( isset( $_GET['page'] ) && strpos( $_GET['page'], PEPY_EXTRA_SLUG_PREFIX ) !== false ) {
			wp_register_style(
				'pepy-addons-tw',
				PEPY_EXTRA_ASSETS_URL . 'css/admin.min.css',
				[],
				PEPY_EXTRA_VERSION,
				'all'
			);

			wp_register_script(
				'pepy-addons-js',
				PEPY_EXTRA_ASSETS_URL . 'js/admin.min.js',
				[ 'jquery' ],
				PEPY_EXTRA_VERSION,
				true
			);

			wp_enqueue_style( 'pepy-addons-tw' );
			wp_enqueue_script( 'pepy-addons-js' );
		}
	}

}

Settings::instance();