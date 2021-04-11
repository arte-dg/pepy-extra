<?php

namespace PepyExtra\Widgets\GlassyColumns;

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
		return 'pepy-el-glassy-columns';
	}

	public function get_title() {
		return __( 'Glassy Columns', 'pepy' );
	}

	public function get_icon() {
    return 'eicon-column';
	}
  

	protected function _register_controls()
	{	
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Elemento Glassy Columns', 'pepy-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => __( '', 'pepy-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( '<div style="background-color:#5c6069; padding: 15px 10px; border-left: solid 2px orange;">Important Note: Elementor Glassy Effect uses a css property called "backdrop-filter", which is not supported yet by firefox and IE.<br><a href="wirenomads.com">Read more</a></div>', 'elementor-glassy-columns' ),
				
			]
		);

		$this->add_control(
			'show_glassy',
			[
				'label' => __( 'Activate', 'pepy-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'pepy-addons-for-elementor' ),
				'label_off' => __( 'Hide', 'pepy-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'blur',
			[
				'label' => __( 'Blur', 'pepy-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 0.1,
					]					
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				]				
			]
		);
		$this->add_control(
			'background',
			[
				'label'     => __( 'Background Color', 'pepy-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.pepy_glassy_style' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'pepy-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.pepy_glassy_style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
	protected function render()	{

		$settings = $this->get_settings_for_display();

		$id = $this->get_id();
		
		?>
			<style>

				.pepy_eglassy_wrapper {
					display: none;
				}

				.pepy_glassy_style {
					/* background: rgba( 255, 255, 255, 0.25 );
					 box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);	 */
					border: 0px solid rgba( 255, 255, 255, 0.18 );
				}

			</style>
			
				<div id="<?php echo esc_attr($id); ?>" class="pepy_eglassy_wrapper"></div>

				<script>
					var wn_elementor_element = jQuery('#<?php echo esc_attr($id); ?>').parent().parent();
					var wn_column = jQuery('#<?php echo esc_attr($id); ?>').parent().parent().parent().parent();
					if ('<?php echo esc_attr($settings['show_glassy']); ?>' == 'yes') {						
						jQuery(wn_column).addClass('pepy_glassy_style');					
						jQuery(wn_column).css('backdrop-filter', 'blur(<?php echo esc_attr($settings['blur']['size'] . 'px'); ?>)');
						jQuery(wn_column).css('-webkit-backdrop-filter', 'blur(<?php echo esc_attr($settings['blur']['size'] . 'px'); ?>)');
						
					}
					else {
						jQuery(wn_column).removeClass('wn_glassy_style');
						jQuery(wn_column).css('backdrop-filter', '');
						jQuery(wn_column).css('-webkit-backdrop-filter', '');						
					}
					jQuery(wn_elementor_element).css('margin-bottom', '0px');

				</script>
			
		

		<?php
	}
	protected function _content_template()
	{
		
	}
}
