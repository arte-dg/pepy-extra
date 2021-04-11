<?php

namespace PepyExtra\Widgets\ReadingProgress;

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
		return 'pepy-el-reading-progress';
	}

	public function get_title() {
		return __( 'Reading Progress', 'pepy' );
	}

	public function get_icon() {
    return 'eicon-barcode';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Bar', 'pepy-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'bar',
			[
				'label'   => __( 'Select', 'pepy-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'top'     => 'top',
					'bottom'   => 'bottom',
					
				],
				'selectors' => [
					'.progress-container' => '{{VALUE}}: 0px',
				],
				'default' => 'Topo',
			]
		);
		$this->add_control(
			'height',
			[
				'label' => __( 'height', 'pepy-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'.progress-bar, .progress-container' => 'height: {{VALUE}}px;',
				],
				
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General', 'pepy-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_color', [
				'label' => __( 'Cor da Barra', 'pepy-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.progress-bar' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'color_fundo', [
				'label'     => __( 'Cor do Fundo', 'pepy-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.progress-container' => 'background: {{VALUE}};',
				],
			]
		);
	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'progress-bar', 'progress-container' );
		
		?>
	    <div class="progress-container" style="'{{{settings.bar}}}':0;">
		    <div class="progress-bar" id="myBar"></div>
		</div>  

			
	<?php	
    } 
}