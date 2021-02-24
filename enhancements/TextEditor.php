<?php

namespace PepyExtra\Enhancements;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Controls_Manager;

/**
 * Class TextEditor
 * @package PepyExtra\Enhancements
 */
class TextEditor {

	/**
	 * @var null
	 */
	public static $instance;

	/**
	 * @return TextEditor|null
	 */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'elementor/element/text-editor/section_editor/before_section_end', static function ( $element, $args ) {

			$element->add_control(
				'tiny_scroll', [
					'label'     => __( 'Enable Scroll', 'pepy-addons-for-elementor' ),
					'type'      => Controls_Manager::SWITCHER,
					'label_off' => __( 'Off', 'pepy-addons-for-elementor' ),
					'label_on'  => __( 'On', 'pepy-addons-for-elementor' ),
					'default'   => '',
				]
			);

			$element->add_control(
				'text_height',
				[
					'label'      => __( 'Max Height', 'pepy-addons-for-elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 100,
							'max'  => 1000,
							'step' => 10,
						],

					],
					'default'    => [
						'unit' => 'px',
						'size' => 330,
					],
					'selectors'  => [
						'{{WRAPPER}} .elementor-text-editor' => 'max-height: {{SIZE}}{{UNIT}};overflow: auto;',
					],
					'condition'  => [
						'tiny_scroll' => 'yes',
					],
				]
			);

		}, 10, 3 );
	}

}

TextEditor::instance();
