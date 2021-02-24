<?php

namespace PepyExtra\Widgets\Testimonial;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use PepyExtra\Widgets\Base;

class Component extends Base {

	public function get_name() {
		return 'pepy-el-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'pepy-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-post-slider sq-widget-label';
	}

	protected function _register_controls() {
	}

	protected function render() {
		$this->enqueue_resources();

		$settings = $this->get_settings_for_display();
	}

}
