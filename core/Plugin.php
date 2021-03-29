<?php

namespace PepyExtra;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Plugin
 * @package PepyExtra
 */
class Plugin {

	/**
	 * @var null
	 */
	public static $instance;

	/**
	 * @return Plugin|null
	 */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * PepyExtra constructor.
	 */
	public function __construct() {

		require_once PEPY_EXTRA_CORE_PATH . '/Utils.php';
		require_once PEPY_EXTRA_CORE_PATH . '/PepyWidgets.php';
		require_once PEPY_EXTRA_CORE_PATH . '/admin/Settings.php';

		// Admin pages
		require_once PEPY_EXTRA_CORE_PATH . '/admin/pages/Base.php';
		require_once PEPY_EXTRA_CORE_PATH . '/admin/pages/Widgets.php';
	

		// Enhancements
		require_once PEPY_EXTRA_ENH_PATH . '/Accordion.php';
		require_once PEPY_EXTRA_ENH_PATH . '/Counter.php';
		require_once PEPY_EXTRA_ENH_PATH . '/TextEditor.php';
		require_once PEPY_EXTRA_ENH_PATH . '/Helper.php';

		// Extra
		require_once PEPY_EXTRA_EXTRA_PATH . '/Reading_Progress.php';
		require_once PEPY_EXTRA_EXTRA_PATH . '/column-ordering-for-elementor.php';
		
		add_action( 'admin_footer', function () {} );
	}

	/**
	 * Get plugin slug
	 *
	 * @return string
	 */
	public function get_slug() {
		return PEPY_EXTRA_SLUG_PREFIX . 'addons';
	}

	/**
	 * Check if current page is
	 *
	 * @param $page
	 *
	 * @return bool
	 */
	public function is_current_page( $page ) {
		$page = PEPY_EXTRA_SLUG_PREFIX . $page;

		return isset( $_GET['page'] ) && $_GET['page'] === $page;
	}

}

Plugin::instance();
