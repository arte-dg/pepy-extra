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
			'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNTM2IDE1MzYiPjxkZWZzPjxzdHlsZT4uYXtmaWxsOiNmZmY7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT5icDwvdGl0bGU+PHBhdGggY2xhc3M9ImEiIGQ9Ik04MTUuMTQsMjgwLjU0Yy0xMS0xMS42OS0yNy42My0xOC40LTQ1LjUxLTE4LjRhNzAuNTksNzAuNTksMCwwLDAtMzYuNzUsMTAuMTdMNTEyLDQwNi44OGMtMTQuNzQsOS0yNC4zNywyMi44OS0yNi40MiwzOC4xOC0xLjg4LDE0LDIuNjMsMjcuNjEsMTIuNjksMzguMjcsMTEuMzcsMTIsMjguMjksMTguMzEsNDUuNjcsMTguMzFhNzAuNTIsNzAuNTIsMCwwLDAsMzYuNTgtMTAuMDloMEw4MDEuNDEsMzU3YzE0Ljc0LTksMjQuMzYtMjIuODksMjYuNDEtMzguMThDODI5LjcxLDMwNC43OCw4MjUuMiwyOTEuMTksODE1LjE0LDI4MC41NFoiLz48cGF0aCBjbGFzcz0iYSIgZD0iTTExNDIuMzMsNjAyLjI0YTcwLjM0LDcwLjM0LDAsMCwwLTk3LjQyLTI2LjM3TDc3Myw3MzcuNjYsNTAxLjA3LDU3NS44OGE3MC4zLDcwLjMsMCwwLDAtOTcuNDIsMjYuMzYsNzEuNzUsNzEuNzUsMCwwLDAtNi44Nyw1My4yN0E3MC45Miw3MC45MiwwLDAsMCw0MjkuMyw2OTlsMjczLDE2Mi40MXYzMjUuNDJjMCwzOS40LDMxLjcyLDcxLjQ0LDcwLjcxLDcxLjQ0czcwLjcxLTMyLDcwLjcxLTcxLjQ0Vjg2MS40MWwyNzMtMTYyLjQxYTcwLjksNzAuOSwwLDAsMCwzMi41My00My40OUE3MS43NCw3MS43NCwwLDAsMCwxMTQyLjMzLDYwMi4yNFoiLz48cGF0aCBjbGFzcz0iYSIgZD0iTTEzNjguNTMsNzIzLjUyYTgwLDgwLDAsMCwwLDc5LjktODBWNDU2LjhhMTQzLDE0MywwLDAsMC03MS4xOC0xMjMuNDlsLTUzOC0zMTEuMTlhMTQyLjUzLDE0Mi41MywwLDAsMC0xNDIuNTEsMGwtNTM4LDMxMS4xOUExNDMuMDYsMTQzLjA2LDAsMCwwLDg3LjU3LDQ1Ni44djYyMi4zOWExNDMsMTQzLDAsMCwwLDcxLjE4LDEyMy40OWw1MzgsMzExLjJhMTQyLjY0LDE0Mi42NCwwLDAsMCwxNDIuNSwwbDUzOC0zMTEuMTloMGExNDMsMTQzLDAsMCwwLDcxLjE4LTEyMy40OVY4ODUuMjhhNzkuOTEsNzkuOTEsMCwxLDAtMTU5LjgxLDB2MTg0TDc2OCwxMzcwLjM3LDI0Ny4zOCwxMDY5LjIzVjQ2Ni43OEw3NjgsMTY1LjY0bDUyMC42MiwzMDEuMTRWNjQzLjU1QTgwLDgwLDAsMCwwLDEzNjguNTMsNzIzLjUyWiIvPjwvc3ZnPg==',
			'58.7'
		);

		/*add_submenu_page(
			Plugin::instance()->get_slug(),
			__( 'STAX Elementor - Widgets', 'pepy-addons-for-elementor' ),
			__( 'Widgets', 'pepy-addons-for-elementor' ),
			'manage_options',
			'pepy-elementor-widgets',
			[ $this, 'settings_template' ]
		);

		add_submenu_page(
			Plugin::instance()->get_slug(),
			__( 'STAX Elementor - Plugins', 'pepy-addons-for-elementor' ),
			__( 'Plugins', 'pepy-addons-for-elementor' ),
			'manage_options',
			'pepy-elementor-plugins',
			[ $this, 'settings_template' ]
		);

		add_submenu_page(
			Plugin::instance()->get_slug(),
			__( 'STAX Elementor - Templates', 'pepy-addons-for-elementor' ),
			__( 'Templates', 'pepy-addons-for-elementor' ),
			'manage_options',
			'pepy-elementor-templates',
			[ $this, 'settings_template' ]
		);

		add_submenu_page(
			Plugin::instance()->get_slug(),
			__( 'STAX Elementor - Modules', 'pepy-addons-for-elementor' ),
			__( 'Modules', 'pepy-addons-for-elementor' ),
			'manage_options',
			'pepy-elementor-modules',
			[ $this, 'settings_template' ]
		);

		add_submenu_page(
			Plugin::instance()->get_slug(),
			__( 'STAX Elementor - Help', 'pepy-addons-for-elementor' ),
			__( 'Help', 'pepy-addons-for-elementor' ),
			'manage_options',
			'pepy-elementor-help',
			[ $this, 'settings_template' ]
		);*/

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
		$site_url      = apply_filters( PEPY_EXTRA_HOOK_PREFIX . 'admin_site_url', 'https://pepy.link/' );
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
