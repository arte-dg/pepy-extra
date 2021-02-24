<?php

namespace PepyExtra\Widgets\IntervalImage;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use DateInterval;
use DateTime;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

use PepyExtra\Widgets\Base;

/**
 * Class Component
 * @package PepyExtra\Widgets\IntervalImage
 */
class Component extends Base {

	public function get_name() {
		return 'pepy-el-interval-image';
	}

	public function get_title() {
		return esc_html__( 'Interval Image', 'pepy-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-image sq-widget-label';
	}

	public function get_keywords() {
		return [ 'image', 'logo' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'general_section',
			[
				'label' => esc_html__( 'General', 'pepy-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'important_note',
			[
				'label'           => esc_html__( 'Current System Time', 'pepy-addons-for-elementor' ),
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => '<div style="padding: 10px 0; font-weight: bold;">' .
				                     ( new DateTime( 'now' ) )->format( 'Y-m-d H:i' ) .
				                     '</div>' .
				                     esc_html__( 'This Widget allows you to show a different image by different date intervals and also define a default image.', 'pepy-addons-for-elementor' ),
				'content_classes' => '',
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'fallback_image',
			[
				'label' => __( 'Choose Image', 'pepy-addons-for-elementor' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'fallback_image',
				'default' => 'large',
			]
		);

		$this->add_control(
			'fallback_link',
			[
				'label'         => __( 'Link', 'pepy-addons-for-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'pepy-addons-for-elementor' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$this->add_control(
			'hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'pepy-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Default title', 'pepy-addons-for-elementor' ),
				'placeholder' => __( 'Type your title here', 'pepy-addons-for-elementor' ),
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'pepy-addons-for-elementor' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'image',
				'default' => 'large',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'         => __( 'Link', 'pepy-addons-for-elementor' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'pepy-addons-for-elementor' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$repeater->add_control(
			'date_start',
			[
				'label'          => __( 'Date Start', 'pepy-addons-for-elementor' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat'  => 'Y-m-d H:i',
					'time_24hr'   => true,
					'allowInput'  => true,
					'defaultHour' => 00
				]
			]
		);

		$repeater->add_control(
			'date_end',
			[
				'label'          => __( 'Date End', 'pepy-addons-for-elementor' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat'  => 'Y-m-d H:i',
					'time_24hr'   => true,
					'allowInput'  => true,
					'defaultHour' => 00
				]
			]
		);

		$repeater->add_control(
			'repeat',
			[
				'label'        => __( 'Repeat Every Year', 'pepy-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'pepy-addons-for-elementor' ),
				'label_off'    => __( 'No', 'pepy-addons-for-elementor' ),
				'return_value' => 'yes',
				'default'      => '',
				'description'      => esc_html__( 'Apply the above condition to upcoming years too.', 'pepy-addons-for-elementor' ),
			]
		);


		$this->add_control(
			'images_list',
			[
				'label'       => __( 'Image List', 'pepy-addons-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'hr3',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'repeat_general',
			[
				'label'        => __( 'Repeat All Every Year', 'pepy-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'pepy-addons-for-elementor' ),
				'label_off'    => __( 'No', 'pepy-addons-for-elementor' ),
				'return_value' => 'yes',
				'default'      => '',
				'description'      => esc_html__( 'Apply the above conditions to upcoming years too.', 'pepy-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$data = [];

		$repeat = false;

		if ( $settings['repeat_general'] ) {
			$repeat = true;
		}

		foreach ( $settings['images_list'] as $item ) {
			if ( ! empty( $data ) ) {
				continue;
			}

			if ( ! $item['date_start'] || ! $item['date_end'] ) {
				continue;
			}

			if ( ! $repeat && $item['repeat'] ) {
				$repeat = true;
			}

			try {
				$start = new DateTime( $item['date_start'] );
				$end   = new DateTime( $item['date_end'] );
				$now   = new DateTime( 'now' );

				if ( $repeat ) {
					$startYear = $start->format( 'Y' );
					$endYear   = $end->format( 'Y' );
					$nowYear   = $now->format( 'Y' );

					$addStarYear = $nowYear - $startYear;
					$addEndYear  = $nowYear - $endYear;

					if ( $addStarYear > 0 ) {
						$start->add( new DateInterval( 'P' . $addStarYear . 'Y' ) );
					}

					if ( $addEndYear > 0 ) {
						$end->add( new DateInterval( 'P' . $addEndYear . 'Y' ) );
					}
				}

				if ( $start <= $now && $end >= $now ) {
					$data = $item;
				}
			} catch ( \Exception $e ) {

			}
		}

		if ( empty( $data ) ) {
			$data['image']      = $settings['fallback_image'];
			$data['link']       = $settings['fallback_link'];
			$data['image_size'] = $settings['fallback_image_size'];
			if ( isset( $settings['fallback_image_custom_dimensions'] ) ) {
				$data['image_custom_dimensions'] = $settings['fallback_image_custom_dimensions'];
			}
		}

		if ( ! empty( $data ) ) {
			if ( $data['link']['url'] ) {
				$link_extra = '';

				if ( $data['link']['external'] ) {
					$link_extra .= 'target=_blank';
				}

				if ( $data['link']['nofollow'] ) {
					$link_extra .= ' rel=nofollow';
				}
				?>
                <a href="<?php echo esc_url( $data['link']['url'] ); ?>" <?php echo esc_attr( $link_extra ); ?>>
				<?php
			}
			echo Group_Control_Image_Size::get_attachment_image_html( $data );
			if ( $data['link']['url'] ) {
				?>
                </a>
				<?php
			}
		}
	}

}
