<?php

namespace PepyExtra\Widgets\ReadMore;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;
use Elementor\Icons_Manager;

use PepyExtra\Widgets\Base;

class Component extends Base {

	public function __construct( $data = [], $args = null, $resources = false ) {
		parent::__construct( $data, $args, $resources );

		$this->register_widget_resources( [
			'js' => [ 'elementor-frontend' ]
		] );
	}

	public function get_name() {
		return 'pepy-el-read-more';
	}

	public function get_title() {
		return __( 'Read more(Expand text)', 'pepy-addons-for-elementor' );
	}

	public function get_icon() {
		return 'sq-icon-bp_slide-down-more sq-widget-label';
	}

	public function get_keywords() {
		return [ 'text', 'editor', 'more' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Settings', 'pepy-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'editor',
			[
				'label'   => '',
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
			]
		);

		$this->add_control(
			'drop_cap', [
				'label'              => __( 'Drop Cap', 'elementor' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_off'          => __( 'Off', 'elementor' ),
				'label_on'           => __( 'On', 'elementor' ),
				'prefix_class'       => 'elementor-drop-cap-',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'read_more_text', [
				'label'   => __( 'More text', 'pepy-addons-for-elementor' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
			]
		);

		$this->add_control(
			'read_more_label', [
				'label'   => __( 'More Label', 'pepy-addons-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read more',
			]
		);
		$this->add_control(
			'read_more_icon', [
				'label' => __( ' More icon', 'pepy-addons-for-elementor' ),
				'type'  => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'read_more_icon_align',
			[
				'label'     => __( 'Icon Position', 'elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Before', 'elementor' ),
					'right' => __( 'After', 'elementor' ),
				],
				'condition' => [
					'read_more_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'read_less_label', [
				'label'   => __( 'Less Label', 'pepy-addons-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read less',
			]
		);
		$this->add_control(
			'read_less_icon', [
				'label' => __( 'Less icon', 'pepy-addons-for-elementor' ),
				'type'  => Controls_Manager::ICONS,
			]
		);
		$this->add_control(
			'read_less_icon_align',
			[
				'label'     => __( 'Icon Position', 'elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Before', 'elementor' ),
					'right' => __( 'After', 'elementor' ),
				],
				'condition' => [
					'read_less_icon[value]!' => '',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Text Editor', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => __( 'Left', 'elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'   => 'typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		$text_columns     = range( 1, 10 );
		$text_columns     = array_combine( $text_columns, $text_columns );
		$text_columns[''] = __( 'Default', 'elementor' );

		$this->add_responsive_control(
			'text_columns',
			[
				'label'     => __( 'Columns', 'elementor' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'options'   => $text_columns,
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'columns: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label'      => __( 'Columns Gap', 'elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'vw' ],
				'range'      => [
					'px' => [
						'max' => 100,
					],
					'%'  => [
						'max'  => 10,
						'step' => 0.1,
					],
					'vw' => [
						'max'  => 10,
						'step' => 0.1,
					],
					'em' => [
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-text-editor' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_drop_cap',
			[
				'label'     => __( 'Drop Cap', 'elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'drop_cap' => 'yes',
				],
			]
		);

		$this->add_control(
			'drop_cap_view',
			[
				'label'        => __( 'View', 'elementor' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'default' => __( 'Default', 'elementor' ),
					'stacked' => __( 'Stacked', 'elementor' ),
					'framed'  => __( 'Framed', 'elementor' ),
				],
				'default'      => 'default',
				'prefix_class' => 'elementor-drop-cap-view-',
			]
		);

		$this->add_control(
			'drop_cap_primary_color',
			[
				'label'     => __( 'Primary Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap'                                                                 => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap, {{WRAPPER}}.elementor-drop-cap-view-default .elementor-drop-cap' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'drop_cap_secondary_color',
			[
				'label'     => __( 'Secondary Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap'  => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'color: {{VALUE}};',
				],
				'condition' => [
					'drop_cap_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'drop_cap_size',
			[
				'label'     => __( 'Size', 'elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 5,
				],
				'range'     => [
					'px' => [
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-drop-cap' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'drop_cap_view!' => 'default',
				],
			]
		);

		$this->add_control(
			'drop_cap_space',
			[
				'label'     => __( 'Space', 'elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .elementor-drop-cap' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .elementor-drop-cap'       => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'drop_cap_border_radius',
			[
				'label'      => __( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default'    => [
					'unit' => '%',
				],
				'range'      => [
					'%' => [
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-drop-cap' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'drop_cap_border_width', [
				'label'     => __( 'Border Width', 'elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elementor-drop-cap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'drop_cap_view' => 'framed',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'drop_cap_typography',
				'selector' => '{{WRAPPER}} .elementor-drop-cap-letter',
				'exclude'  => [
					'letter_spacing',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'toggle_style',
			[
				'label' => __( 'Toggle', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'read_more_align',
			[
				'label'     => __( 'Alignment', 'elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => __( 'Left', 'elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .read-more-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'toggle_typography',
				'selector' => '{{WRAPPER}} .stx-read-more-toggle',
			]
		);

		$this->add_control(
			'toggle_top_space',
			[
				'label'     => __( 'Top Space', 'elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 0,
				],
				'range'     => [
					'px' => [
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .stx-read-more-toggle' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'text_shadow',
				'selector' => '{{WRAPPER}} .stx-read-more-toggle',
			]
		);

		$this->start_controls_tabs( 'tabs_more_style' );

		$this->start_controls_tab(
			'tab_more_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'more_text_color',
			[
				'label'     => __( 'Text Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .stx-read-more-toggle' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .stx-read-more-toggle' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_more_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Text Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stx-read-more-toggle:hover, {{WRAPPER}} .stx-read-more-toggle:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .stx-read-more-toggle:hover svg, {{WRAPPER}} .stx-read-more-toggle:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'more_background_hover_color',
			[
				'label'     => __( 'Background Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stx-read-more-toggle:hover, {{WRAPPER}} .stx-read-more-toggle:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'more_hover_border_color',
			[
				'label'     => __( 'Border Color', 'elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .stx-read-more-toggle:hover, {{WRAPPER}} .stx-read-more-toggle:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'border',
				'selector'  => '{{WRAPPER}} .stx-read-more-toggle',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .stx-read-more-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'more_box_shadow',
				'selector' => '{{WRAPPER}} .stx-read-more-toggle',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => __( 'Padding', 'elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .stx-read-more-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render text editor widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$editor_content = $this->get_settings_for_display( 'editor' );
		$editor_content = $this->parse_text_editor( $editor_content );

		$editor_more_content = $this->get_settings_for_display( 'read_more_text' );
		$editor_more_content = $this->parse_text_editor( $editor_more_content );

		$this->add_render_attribute( 'editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );
		$this->add_inline_editing_attributes( 'editor', 'advanced' );

		$this->add_render_attribute( 'read_more_text', 'class', [ 'elementor-text-editor', 'read-more-text' ] );
		$this->add_inline_editing_attributes( 'read_more_text', 'advanced' );

		$this->add_render_attribute( 'read_more_wrap', 'class', [ 'read-more-wrap' ] );
		$this->add_render_attribute( 'read_more_toggle', 'class', [ 'stx-read-more-toggle' ] );
		$this->add_render_attribute( 'read_more_toggle', 'href', '#' );
		$this->add_render_attribute( 'read_more_label', 'class', [ 'stx-read-more' ] );
		$this->add_render_attribute( 'read_less_label', 'class', [ 'stx-read-less' ] );

		$this->add_render_attribute( 'read_more_icon_align', 'class', [ 'stx-icon-' . $settings['read_more_icon_align'] ] );
		$this->add_render_attribute( 'read_less_icon_align', 'class', [ 'stx-icon-' . $settings['read_less_icon_align'] ] );


		?>
        <div class="pepy-read-more-editor">
            <div <?php echo $this->get_render_attribute_string( 'editor' ); ?>>
				<?php echo $editor_content; ?>
            </div>

            <div <?php echo $this->get_render_attribute_string( 'read_more_text' ); ?>><?php echo $editor_more_content; ?></div>

            <div <?php echo $this->get_render_attribute_string( 'read_more_wrap' ); ?>>
                <a <?php echo $this->get_render_attribute_string( 'read_more_toggle' ); ?>>
	                <span <?php echo $this->get_render_attribute_string( 'read_more_label' ); ?>>
                        <span <?php echo $this->get_render_attribute_string( 'read_more_icon_align' ); ?>>
		                    <?php Icons_Manager::render_icon( $settings['read_more_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                        <?php echo wp_kses_post( $settings['read_more_label'] ); ?>
	                </span>
                    <span <?php echo $this->get_render_attribute_string( 'read_less_label' ); ?>>
                         <span <?php echo $this->get_render_attribute_string( 'read_less_icon_align' ); ?>>
                            <?php Icons_Manager::render_icon( $settings['read_less_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                         </span>
                        <?php echo wp_kses_post( $settings['read_less_label'] ); ?>
	                </span>
                </a>
            </div>
        </div>

		<?php
	}

	/**
	 * Render text editor widget as plain content.
	 *
	 * Override the default behavior by printing the content without rendering it.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function render_plain_content() {
		// In plain mode, render without shortcode
		echo $this->get_settings( 'editor' ) . $this->get_settings( 'read_more_text' );
	}

	/**
	 * Render text editor widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
        <#
        var iconMore = elementor.helpers.renderIcon( view, settings.read_more_icon, { 'aria-hidden': true }, 'i' , 'object' );
        var iconLess = elementor.helpers.renderIcon( view, settings.read_less_icon, { 'aria-hidden': true }, 'i' , 'object' );

        view.addRenderAttribute( 'editor', 'class', [ 'elementor-text-editor', 'elementor-clearfix' ] );
        view.addInlineEditingAttributes( 'editor', 'advanced' );

        view.addRenderAttribute( 'read_more_wrap', 'class', [ 'read-more-wrap' ] );
        view.addRenderAttribute( 'read_more_toggle', 'class', [ 'stx-read-more-toggle' ] );
        view.addRenderAttribute( 'read_more_toggle','href', '#' );

        view.addRenderAttribute( 'read_more_label','class', [ 'stx-read-more' ] );
        view.addRenderAttribute( 'read_less_label','class', [ 'stx-read-less' ] );

        view.addRenderAttribute( 'read_more_text','class', [ 'elementor-text-editor', 'read-more-text' ] );
        view.addInlineEditingAttributes( 'read_more_text', 'advanced' );

        #>
        <div class="pepy-read-more-editor">
            <div {{{ view.getRenderAttributeString(
            'editor' ) }}}> {{{ settings.editor }}}
        </div>

        <div {{{ view.getRenderAttributeString( 'read_more_text' ) }}}>{{{ settings.read_more_text }}}</div>

        <div {{{ view.getRenderAttributeString( 'read_more_wrap' ) }}}>
        <a {{{ view.getRenderAttributeString( 'read_more_toggle' ) }}}>
        <span {{{ view.getRenderAttributeString( 'read_more_label' ) }}}>
        <# if ( settings.read_more_icon ) { #>
        <span class="stx-icon-{{ settings.read_more_icon_align }}">
						{{{ iconMore.value }}}
					</span>
        <# } #>
        {{{ settings.read_more_label }}}
        </span>

        <span {{{ view.getRenderAttributeString( 'read_less_label' ) }}}>
        <# if ( settings.read_less_icon ) { #>
        <span class="stx-icon-{{ settings.read_less_icon_align }}">
						{{{ iconLess.value }}}
					</span>
        <# } #>
        {{{ settings.read_less_label }}}
        </span>
        </a>
        </div>
        </div>

		<?php
	}

}
