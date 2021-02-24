<?php

namespace PepyExtra\Enhancements;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * Class Accordion
 * @package PepyExtra\Enhancements
 */
class Accordion {

	/**
	 * @var null
	 */
	public static $instance;

	/**
	 * @return Accordion|null
	 */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'elementor/element/accordion/section_title_style/before_section_end', static function ( $element, $args ) {
			$element->add_control(
				'hr',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);

			$element->add_control(
				'accordion_item_spacing',
				[
					'label'     => __( 'Item Spacing', 'pepy-addons-for-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-accordion-item'            => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-accordion-item:last-child' => 'margin-bottom: 0;',
					],
				]
			);

			$element->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'accordion_item_border',
					'label'    => __( 'Item Border', 'pepy-addons-for-elementor' ),
					'selector' => '{{WRAPPER}} .elementor-accordion-item',
				]
			);

			$element->add_control(
				'accordion_item_border_radius',
				[
					'label'      => __( 'Item Border Radius', 'pepy-addons-for-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$element->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'accordion_item_shadow',
					'selector' => '{{WRAPPER}} .elementor-accordion-item',
				]
			);
		}, 10, 3 );
	}

}

Accordion::instance();
