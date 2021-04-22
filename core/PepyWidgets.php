<?php

namespace PepyExtra;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Plugin;

/**
 * Class PepyWidgets
 * @package PepyExtra
 */
class PepyWidgets {

	/**
	 * @var null
	 */
	public static $instance;

	/**
	 * @return PepyWidgets|null
	 */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * PepyExtra constructor.
	 */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_elementor_category' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_css' ] );
	}

	/**
	 * Get widgets
	 *
	 * @param bool $active
	 * @param bool $withStatus
	 *
	 * @return array
	 */
	public function get_widgets( $active = false, $withStatus = false ) {
		$widgets = [];

		
		$widgets['heading'] = [
			'scope' => 'Heading',
			'name'  => 'Heading',
			'slug'  => 'pepy-el-heading'
		];

		$widgets['read-more'] = [
			'scope' => 'ReadMore',
			'name'  => 'Read More',
			'slug'  => 'pepy-el-read-more'
		];


		$widgets['scroll-top'] = [
			'scope' => 'ScrollTop',
			'name'  => 'Scroll Top',
			'slug'  => 'pepy-el-scroll-top'
		];

		$widgets['reading-progress'] = [
			'scope' => 'ReadingProgress',
			'name'  => 'Reading Progress',
			'slug'  => 'pepy-el-reading-progress'
		];

		$widgets['glassy-columns'] = [
			'scope' => 'GlassyColumns',
			'name'  => 'Glassy Columns',
			'slug'  => 'pepy-el-glassy-columns'
		];
		
		/*
		$widgets['sales-pop'] = [
			'scope' => 'SalesPop',
			'name'  => 'Sales Pop',
			'slug'  => 'pepy-el-sales-pop'
		];		
		
		$widgets['Darkmode'] = [
			'scope' => 'Darkmode',
			'name'  => 'Darkmode',
			'slug'  => 'pepy-el-darkmode'
		];
		
		$widgets['video-extra'] = [
			'scope' => 'VideoExtra',
			'name'  => 'Video Extra',
			'slug'  => 'pepy-el-video-extra'
		];
		   
		    	
		$widgets['share-button'] = [
			'scope' => 'ShareButton',
			'name'  => 'Share Button',
			'slug'  => 'pepy-el-share-button'
		];
		*/
		
		// Remove disabled widgets
		if ( $active && ! $withStatus ) {
			$disabled_widgets = get_option( '_pepy_addons_disabled_widgets', [] );
			foreach ( $widgets as $k => $widget ) {
				if ( isset( $disabled_widgets[ $widget['slug'] ] ) ) {
					unset( $widgets[ $k ] );
				}
			}
		}

		if ( $withStatus ) {
			$disabled_widgets = get_option( '_pepy_addons_disabled_widgets', [] );
			foreach ( $widgets as $k => $widget ) {
				if ( isset( $disabled_widgets[ $widget['slug'] ] ) ) {
					$widgets[ $k ]['status'] = false;
				} else {
					$widgets[ $k ]['status'] = true;
				}
			}
		}

		return $widgets;
	}

	/**
	 * Register Elementor widgets
	 */
	public function register_widgets() {
		// get our own widgets up and running:
		if ( defined( 'ELEMENTOR_PATH' ) && class_exists( Widget_Base::class ) && class_exists( Plugin::class ) && is_callable( Plugin::class, 'instance' ) ) {
			$elementor = \Elementor\Plugin::instance();

			if ( isset( $elementor->widgets_manager ) && method_exists( $elementor->widgets_manager, 'register_widget_type' ) ) {
				// Require Base class for widgets
				require_once PEPY_EXTRA_PATH . '/widgets/Base.php';

				$elements = $this->get_widgets( true );
				foreach ( $elements as $folder => $element ) {
					if ( $widget_file = $this->get_widget_file( $folder ) ) {

						require_once $widget_file;
						$class_name = '\PepyExtra\Widgets\\' . $element['scope'] . '\Component';
						$elementor->widgets_manager->register_widget_type( new $class_name );
					}
				}
			}
		}
	}

	/**
	 * Register new Elementor category
	 */
	public function register_elementor_category() {
		if ( defined( 'ELEMENTOR_PATH' ) && class_exists( Widget_Base::class ) && class_exists( Plugin::class ) && is_callable( Plugin::class, 'instance' ) ) {
			\Elementor\Plugin::instance()->elements_manager->add_category(
				'pepy-elementor',
				[
					'title' => 'pepy Extra',
					'icon'  => 'fa fa-plug'
				]
			);
		}
	}

	/**
	 * Get widget file path
	 *
	 * @param $folder
	 *
	 * @return bool|string
	 */
	public function get_widget_file( $folder ) {
		$template_file = PEPY_EXTRA_WIDGET_PATH . $folder . '/Component.php';

		if ( $template_file && is_readable( $template_file ) ) {
			return $template_file;
		}

		return false;
	}

	
}

PepyWidgets::instance();