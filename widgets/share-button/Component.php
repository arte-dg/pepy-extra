<?php

namespace PepyExtra\Widgets\ShareButton;

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

	/*public function __construct( $data = [], $args = null, $resources = false ) {
		parent::__construct( $data, $args, $resources );

		$this->register_widget_resources( [
			'js' => [ 'elementor-frontend' ]
		] );
	}*/

	public function get_name() {
		return 'pepy-el-share-button';
	}

	public function get_title() {
		return __( 'Share Button(Extra)', 'pepy-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-shortcode';
	}

	public function get_keywords() {
		return [ 'text', 'share', 'button' ];
	}
    protected function _register_controls() {

        $this->start_controls_section(
            'social_media_sheres',
            [
                'label' => __( 'Social Shere', 'pepy-addons-for-elemento' ),
            ]
        );
        
            $repeater = new Repeater();

            $repeater->start_controls_tabs('social_content_area_tabs');

                $repeater->start_controls_tab(
                    'social_content_tab',
                    [
                        'label' => __( 'Content', 'pepy-addons-for-elemento' ),
                    ]
                );

                    $repeater->add_control(
                        'htmega_social_media',
                        [
                            'label' => __( 'Social Media', 'pepy-addons-for-elemento' ),
                            'type' => Controls_Manager::SELECT,
                            'default' => 'facebook',
                            'options' => [
                                'facebook'      => __( 'Facebook', 'pepy-addons-for-elemento' ),
                                'twitter'       => __( 'Twitter', 'pepy-addons-for-elemento' ),
                                'pinterest'     => __( 'Pinterest', 'pepy-addons-for-elemento' ),
                                'linkedin'      => __( 'Linkedin', 'pepy-addons-for-elemento' ),
                                'tumblr'        => __( 'tumblr', 'pepy-addons-for-elemento' ),
                                'vkontakte'     => __( 'Vkontakte', 'pepy-addons-for-elemento' ),
                                'odnoklassniki' => __( 'Odnoklassniki', 'pepy-addons-for-elemento' ),
                                'moimir'        => __( 'Moimir', 'pepy-addons-for-elemento' ),
                                'livejournal'   => __( 'Live journal', 'pepy-addons-for-elemento' ),
                                'blogger'       => __( 'Blogger', 'pepy-addons-for-elemento' ),
                                'digg'          => __( 'Digg', 'pepy-addons-for-elemento' ),
                                'evernote'      => __( 'Evernote', 'pepy-addons-for-elemento' ),
                                'reddit'        => __( 'Reddit', 'pepy-addons-for-elemento' ),
                                'delicious'     => __( 'Delicious', 'pepy-addons-for-elemento' ),
                                'stumbleupon'   => __( 'Stumbleupon', 'pepy-addons-for-elemento' ),
                                'pocket'        => __( 'Pocket', 'pepy-addons-for-elemento' ),
                                'surfingbird'   => __( 'Surfingbird', 'pepy-addons-for-elemento' ),
                                'liveinternet'  => __( 'Liveinternet', 'pepy-addons-for-elemento' ),
                                'buffer'        => __( 'Buffer', 'pepy-addons-for-elemento' ),
                                'instapaper'    => __( 'Instapaper', 'pepy-addons-for-elemento' ),
                                'xing'          => __( 'Xing', 'pepy-addons-for-elemento' ),
                                'wordpress'     => __( 'WordPress', 'pepy-addons-for-elemento' ),
                                'baidu'         => __( 'Baidu', 'pepy-addons-for-elemento' ),
                                'renren'        => __( 'Renren', 'pepy-addons-for-elemento' ),
                                'weibo'         => __( 'Weibo', 'pepy-addons-for-elemento' ),
                                'skype'         => __( 'Skype', 'pepy-addons-for-elemento' ),
                                'telegram'      => __( 'Telegram', 'pepy-addons-for-elemento' ),
                                'viber'         => __( 'Viber', 'pepy-addons-for-elemento' ),
                                'whatsapp'      => __( 'Whatsapp', 'pepy-addons-for-elemento' ),
                                'line'          => __( 'Line', 'pepy-addons-for-elemento' ),
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'htmega_social_title',
                        [
                            'label'   => esc_html__( 'Title', 'pepy-addons-for-elemento' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Facebook', 'pepy-addons-for-elemento' ),
                        ]
                    );

                    $repeater->add_control(
                        'htmega_social_icon',
                        [
                            'label'   => esc_html__( 'Icon', 'pepy-addons-for-elemento' ),
                            'type'    => Controls_Manager::ICONS,
                            'default' => [
                                'value'=>'fab fa-facebook-square',
                                'library'=>'brands',
                            ],
                        ]
                    );

                $repeater->end_controls_tab(); // Content tab end

                $repeater->start_controls_tab(
                    'social_rep_style',
                    [
                        'label' => __( 'Style', 'pepy-addons-for-elemento' ),
                    ]
                );

                    $repeater->add_control(
                        'normal_style_heading',
                        [
                            'label' => __( 'Normal Style', 'pepy-addons-for-elemento' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );

                    $repeater->add_control(
                        'social_text_color',
                        [
                            'label'     => __( 'Color', 'pepy-addons-for-elemento' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '#000000',
                            'selectors' => [
                                '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_background',
                            'label' => __( 'Background', 'pepy-addons-for-elemento' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_border',
                            'label' => __( 'Border', 'pepy-addons-for-elemento' ),
                            'selector' => '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}',
                        ]
                    );

                    $repeater->add_control(
                        'hover_style_heading',
                        [
                            'label' => __( 'Hover Style', 'pepy-addons-for-elemento' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );


                    $repeater->add_control(
                        'social_text_hover_color',
                        [
                            'label'     => __( 'Hover color', 'pepy-addons-for-elemento' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_hover_background',
                            'label' => __( 'Background', 'pepy-addons-for-elemento' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}:hover',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_hover_border',
                            'label' => __( 'Border', 'pepy-addons-for-elemento' ),
                            'selector' => '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}:hover',
                        ]
                    );

                $repeater->end_controls_tab();// End Style tab

                // Start Icon tab
                $repeater->start_controls_tab(
                    'social_rep_icon_style',
                    [
                        'label' => __( 'Icon Style', 'pepy-addons-for-elemento' ),
                    ]
                );
                    
                    $repeater->add_control(
                        'normal_style_icon_heading',
                        [
                            'label' => __( 'Normal Style', 'pepy-addons-for-elemento' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );

                    $repeater->add_control(
                        'social_icon_color',
                        [
                            'label'     => __( 'Color', 'pepy-addons-for-elemento' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_icon_background',
                            'label' => __( 'Background', 'pepy-addons-for-elemento' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}} i',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_icon_border',
                            'label' => __( 'Border', 'pepy-addons-for-elemento' ),
                            'selector' => '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}} i',
                        ]
                    );

                    $repeater->add_responsive_control(
                        'social_rep_icon_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'pepy-addons-for-elemento' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}} i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator'=>'after',
                        ]
                    );

                    $repeater->add_control(
                        'hover_style_icon_heading',
                        [
                            'label' => __( 'Hover Style', 'pepy-addons-for-elemento' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );


                    $repeater->add_control(
                        'social_icon_hover_color',
                        [
                            'label'     => __( 'Hover color', 'pepy-addons-for-elemento' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_icon_hover_background',
                            'label' => __( 'Background', 'pepy-addons-for-elemento' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}:hover i',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_icon_hover_border',
                            'label' => __( 'Border', 'pepy-addons-for-elemento' ),
                            'selector' => '{{WRAPPER}} .pepy-social-share {{CURRENT_ITEM}}:hover i',
                        ]
                    );

                $repeater->end_controls_tab();// End icon Style tab

            $repeater->end_controls_tabs();// Repeater Tabs end

            $this->add_control(
                'htmega_socialmedia_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'htmega_social_media' => 'facebook',
                            'htmega_social_title' => __( 'Facebook', 'pepy-addons-for-elemento' ),
                            'htmega_social_icon' => 'fab fa-facebook-square',
                        ],
                        [
                            'htmega_social_media' => 'twitter',
                            'htmega_social_title' => __( 'Twitter', 'pepy-addons-for-elemento' ),
                            'htmega_social_icon' => 'fab fa-twitter-square',
                        ],
                        [
                            'htmega_social_media' => 'googleplus',
                            'htmega_social_title' => __( 'Google Plus', 'pepy-addons-for-elemento' ),
                            'htmega_social_icon' => 'fab fa-google-plus-square',
                        ],
                    ],
                    'title_field' => '{{{ htmega_social_title }}}',
                ]
            );

        $this->end_controls_section();

        // Advance Options
        $this->start_controls_section(
            'social_media_sheres_advance_opt',
            [
                'label' => __( 'Advance Options', 'pepy-addons-for-elemento' ),
            ]
        );
            
            $this->add_control(
                'social_view',
                [
                    'label' => esc_html__( 'View', 'pepy-addons-for-elemento' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'options' => [
                        'icon'       => 'Icon',
                        'title'      => 'Title',
                        'icon-title' => 'Icon & Title',
                    ],
                    'default'      => 'icon',
                ]
            );

            $this->add_control(
                'show_label',
                [
                    'label'        => esc_html__( 'Title', 'pepy-addons-for-elemento' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'pepy-addons-for-elemento' ),
                    'label_off'    => esc_html__( 'Hide', 'pepy-addons-for-elemento' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'social_view' => 'icon-text',
                    ],
                ]
            );

            $this->add_control(
                'show_counter',
                [
                    'label'        => esc_html__( 'Count', 'pepy-addons-for-elemento' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'pepy-addons-for-elemento' ),
                    'label_off'    => esc_html__( 'Hide', 'pepy-addons-for-elemento' ),
                    'return_value' => 'yes',
                    'condition'    => [
                        'social_view!' => 'icon',
                    ],
                ]
            );

        $this->end_controls_section();// End Advance Options

        // Style tab section
        $this->start_controls_section(
            'htmega_socialshere_style_section',
            [
                'label' => __( 'Style', 'pepy-addons-for-elemento' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'social_shere_color',
                [
                    'label'     => __( 'color', 'pepy-addons-for-elemento' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pepy-social-share ul li' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .pepy-social-share ul li span',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'social_shere_background',
                    'label' => __( 'Background', 'pepy-addons-for-elemento' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .pepy-social-share li',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'social_shere_border',
                    'label' => __( 'Border', 'pepy-addons-for-elemento' ),
                    'selector' => '{{WRAPPER}} .pepy-social-share li',
                ]
            );

            $this->add_responsive_control(
                'social_shere_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'pepy-addons-for-elemento' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .pepy-social-share li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_shere_padding',
                [
                    'label' => __( 'Padding', 'pepy-addons-for-elemento' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pepy-social-share ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'social_shere_margin',
                [
                    'label' => __( 'Margin', 'pepy-addons-for-elemento' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .pepy-social-share ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'socialshere_icon_style_section',
            [
                'label' => __( 'Icon', 'pepy-addons-for-elemento' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'social_view' => array( 'icon-title','icon'),
                ]
            ]
        );
            $this->add_control(
                'icon_fontsize',
                [
                    'label' => __( 'Icon Font Size', 'pepy-addons-for-elemento' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pepy-social-share ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pepy-social-share ul li svg' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'social_icon_background',
                    'label' => __( 'Background', 'pepy-addons-for-elemento' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .pepy-social-share li i,{{WRAPPER}} .pepy-social-share li svg',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'social_icon_border',
                    'label' => __( 'Border', 'pepy-addons-for-elemento' ),
                    'selector' => '{{WRAPPER}} .pepy-social-share li i,{{WRAPPER}} .pepy-social-share li svg',
                ]
            );

            $this->add_responsive_control(
                'social_icon_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'pepy-addons-for-elemento' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .pepy-social-share li i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .pepy-social-share li svg' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'icon_height',
                [
                    'label' => __( 'Icon Height', 'pepy-addons-for-elemento' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 42,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pepy-social-share ul li i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pepy-social-share ul li svg' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_width',
                [
                    'label' => __( 'Icon Width', 'pepy-addons-for-elemento' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 42,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .pepy-social-share ul li i' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .pepy-social-share ul li svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'htmega_socialshere', 'class', 'htmega-social-share htmega-social-style-1' );
        if( $settings['social_view'] == 'icon-title' || $settings['social_view'] == 'title' ){
            $this->add_render_attribute( 'htmega_socialshere', 'class', 'htmega-social-view-'.$settings['social_view'] );
        }
             
        ?>
            <div <?php echo $this->get_render_attribute_string( 'htmega_socialshere' ); ?> >
                <ul>
                    <?php foreach ( $settings['htmega_socialmedia_list'] as $socialmedia ) :?>
                        <li class="elementor-repeater-item-<?php echo $socialmedia['_id']; ?>" data-social="<?php echo esc_attr( $socialmedia['htmega_social_media'] ); ?>" > 
                            <?php
                                if( $settings['social_view'] == 'icon' ){
                                    echo HTMega_Icon_manager::render_icon( $socialmedia['htmega_social_icon'], [ 'aria-hidden' => 'true' ] );
                                }elseif( $settings['social_view'] == 'title' ){
                                    echo sprintf('<span>%1$s</span>', $socialmedia['htmega_social_title'] );
                                }else{
                                    echo sprintf('%1$s<span>%2$s</span>', HTMega_Icon_manager::render_icon( $socialmedia['htmega_social_icon'], [ 'aria-hidden' => 'true' ] ), $socialmedia['htmega_social_title'] );
                                }
                                if( $settings['show_counter'] == 'yes' ){
                                    echo '<span class="htmega-share-counter" data-counter="'.$socialmedia['htmega_social_media'].'"></span>';
                                }
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php

    }

}
