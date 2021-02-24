<?php

namespace PepyExtra\Widgets\ScrollTop;

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
		return 'pepy-el-scroll-top';
	}

	public function get_title() {
		return __( 'Scroll Top', 'pepy-addons-for-elementor' );
	}

	public function get_icon() {
		return 'sq-icon-up sq-widget-label';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button', 'pepy-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'scroll_speed',
			[
				'label'   => __( 'Scroll Speed (ms)', 'pepy-addons-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 5000,
				'step'    => 10,
				'default' => 800,
			]
		);

		$this->add_control(
			'show_offset',
			[
				'label'       => __( 'Show Top Offset', 'pepy-addons-for-elementor' ),
				'description' => __( 'Show button when top offset is grated than the set value.', 'pepy-addons-for-elementor' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 5
					]
				],
				'default'     => [
					'unit' => 'px',
					'size' => 0
				]
			]
		);

		$this->add_control(
			'size',
			[
				'label'          => __( 'Size', 'elementor' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'sm',
				'options'        => [
					'xs' => __( 'Extra Small', 'elementor' ),
					'sm' => __( 'Small', 'elementor' ),
					'md' => __( 'Medium', 'elementor' ),
					'lg' => __( 'Large', 'elementor' ),
					'xl' => __( 'Extra Large', 'elementor' ),
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'       => __( 'Icon', 'pepy-addons-for-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-angle-up',
					'library' => 'solid',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'pepy-addons-for-elementor' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'button_css_id',
			[
				'label'       => __( 'Button ID', 'pepy-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => '',
				'title'       => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'pepy-addons-for-elementor' ),
				'label_block' => false,
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'pepy-addons-for-elementor' ),
				'separator'   => 'before',

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'pepy-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'pepy-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Text Color', 'pepy-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} a.stx-btn, {{WRAPPER}} .stx-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'pepy-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.stx-btn, {{WRAPPER}} .stx-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .stx-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'pepy-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Text Color', 'pepy-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.stx-btn:hover, {{WRAPPER}} .stx-btn:hover, {{WRAPPER}} a.stx-btn:focus, {{WRAPPER}} .stx-btn:focus'                 => 'color: {{VALUE}};',
					'{{WRAPPER}} a.stx-btn:hover svg, {{WRAPPER}} .stx-btn:hover svg, {{WRAPPER}} a.stx-btn:focus svg, {{WRAPPER}} .stx-btn:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => __( 'Background Color', 'pepy-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.stx-btn:hover, {{WRAPPER}} .stx-btn:hover, {{WRAPPER}} a.stx-btn:focus, {{WRAPPER}} .stx-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'pepy-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.stx-btn:hover, {{WRAPPER}} .stx-btn:hover, {{WRAPPER}} a.stx-btn:focus, {{WRAPPER}} .stx-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .stx-btn:hover',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'pepy-addons-for-elementor' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'border',
				'selector'  => '{{WRAPPER}} .stx-btn',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'pepy-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.stx-btn, {{WRAPPER}} .stx-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => __( 'Padding', 'pepy-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.stx-btn, {{WRAPPER}} .stx-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();
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
