<?php

namespace PepyExtra\Widgets\NomeWidget;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

use PepyExtra\Widgets\Base;

class Component extends Base {

	public function get_name() {
		return 'pepy-el-name';
	}

	public function get_title() {
		return __( 'Name', 'pepy' );
	}

	public function get_icon() {
    return 'eicon-arrow-up';
	}



	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'icon', 'class', 'stx-btn-icon' );
		$this->add_render_attribute( 'button', 'data-speed', $settings['scroll_speed'] );
		$this->add_render_attribute( 'button', 'data-offset', $settings['show_offset']['size'] );
		$this->add_render_attribute( 'button', 'data-offset-unit', $settings['show_offset']['unit'] );
		$this->add_render_attribute( 'button', 'class', 'stx-btn' );
		$this->add_render_attribute( 'button', 'class', 'stx-btn-hidden' );
		$this->add_render_attribute( 'button', 'class', 'stx-btn-' . $settings['size'] );
		$this->add_render_attribute( 'button', 'class', 'stx-scroll-top' );
		$this->add_render_attribute( 'button', 'href', '#' );
		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
		}

		?>

        <div class="stx-btn-wrapper">
            <a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
		        <span class="stx-btn-content-wrapper">
			        <span <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
                        <?php if ( $settings['selected_icon']['value'] ) : ?>
	                        <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php endif; ?>
                    </span>
		        </span>
            </a>
        </div>

		<?php
	}

}
