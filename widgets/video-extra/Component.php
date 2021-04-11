<?php

namespace PepyExtra\Widgets\VideoExtra;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
Use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Controls_Manager as Controls_Manager;
use Elementor\Modules\DynamicTags\Module as TagsModule;

use PepyExtra\Widgets\Base;

class Component extends Base {

	/*public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_script('elemenda-plyr', PEPY_EXTRA_ASSETS_URL . '/js/plyr.js', ['jquery', 'elementor-frontend', 'elemenda-js'], '4.0.12', false);

    }

    public function get_script_depends()
    {
        return ['elemenda-plyr'];
    }*/

	public function get_name() {
        return "video-extra";
    }

    public function get_title() {
        return esc_html__( "Video Player", 'elemenda' );
    }

    public function get_icon() {
        return 'az_icon eicon-youtube';
    }

	

}