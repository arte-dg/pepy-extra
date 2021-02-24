<?php

namespace PepyExtra;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Help
 * @package PepyExtra
 */
class Help extends Base {

	/**
	 * Settings constructor.
	 */
	public function __construct() {
		$this->current_slug = 'help';

		if ( Plugin::instance()->is_current_page( $this->current_slug ) ) {
			add_filter( PEPY_EXTRA_HOOK_PREFIX . 'current_slug', [ $this, 'set_page_slug' ] );
			add_filter( PEPY_EXTRA_HOOK_PREFIX . 'welcome_wrapper_class', [ $this, 'set_wrapper_classes' ] );
			add_action( PEPY_EXTRA_HOOK_PREFIX . $this->current_slug . '_page_content', [ $this, 'panel_content' ] );
		}

		add_filter( PEPY_EXTRA_HOOK_PREFIX . 'admin_menu', [ $this, 'add_menu_item' ] );
	}

	public function panel_content() {
		Utils::load_template( 'core/admin/pages/templates/help' );
	}

	public function add_menu_item( $menu ) {
		$menu[] = [
			'name'     => __( 'Help', 'pepy-addons-for-elementor' ),
			'link'     => admin_url( 'admin.php?page=' . PEPY_EXTRA_SLUG_PREFIX . $this->current_slug ),
			'priority' => 6
		];

		return $menu;
	}

}

Help::instance();
