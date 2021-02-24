<?php

namespace PepyExtra;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Templates
 * @package PepyExtra
 */
class Templates extends Base {

	/**
	 * Settings constructor.
	 */
	public function __construct() {
		$this->current_slug = 'templates';

		if ( Plugin::instance()->is_current_page( $this->current_slug ) ) {
			add_filter( PEPY_EXTRA_HOOK_PREFIX . 'current_slug', [ $this, 'set_page_slug' ] );
			add_filter( PEPY_EXTRA_HOOK_PREFIX . 'welcome_wrapper_class', [ $this, 'set_wrapper_classes' ] );
			add_action( PEPY_EXTRA_HOOK_PREFIX . $this->current_slug . '_page_content', [ $this, 'panel_content' ] );
		}

		add_filter( PEPY_EXTRA_HOOK_PREFIX . 'admin_menu', [ $this, 'add_menu_item' ] );
	}

	public function panel_content() {
		Utils::load_template( 'core/admin/pages/templates/templates', [
			'templates' => []
		] );
	}

	public function add_menu_item( $menu ) {
		$menu[] = [
			'name'     => __( 'Templates', 'pepy-addons-for-elementor' ),
			'link'     => admin_url( 'admin.php?page=' . PEPY_EXTRA_SLUG_PREFIX . $this->current_slug ),
			'priority' => 4
		];

		return $menu;
	}

}

Templates::instance();
