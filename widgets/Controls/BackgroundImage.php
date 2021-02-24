<?php

namespace PepyExtra\Controls;

use \Elementor\Controls_Manager;
use \Elementor\Controls_Stack;
use \Elementor\Group_Control_Base;

class Group_Control_EL_Background_Image extends Group_Control_Base
{
    protected static $fields;


    public static function get_type()
    {
        return 'el_background_image';
    }


    protected function init_fields()
    {
        $fields = [];

        $fields['image'] = [
            'label' => _x('Image', 'Background Control', 'elementor'),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => [
                'active' => true,
            ],

            'title' => _x('Background Image', 'Background Control', 'elementor'),
            'selectors' => [
                '{{SELECTOR}}' => 'background-image: url("{{URL}}");',
            ],
            'render_type' => 'template',
        ];

        $fields['position'] = [
            'label' => _x('Position', 'Background Control', 'elementor'),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'responsive' => true,
            'options' => [
                '' => _x('Default', 'Background Control', 'elementor'),
                'center center' => _x('Center Center', 'Background Control', 'elementor'),
                'center left' => _x('Center Left', 'Background Control', 'elementor'),
                'center right' => _x('Center Right', 'Background Control', 'elementor'),
                'top center' => _x('Top Center', 'Background Control', 'elementor'),
                'top left' => _x('Top Left', 'Background Control', 'elementor'),
                'top right' => _x('Top Right', 'Background Control', 'elementor'),
                'bottom center' => _x('Bottom Center', 'Background Control', 'elementor'),
                'bottom left' => _x('Bottom Left', 'Background Control', 'elementor'),
                'bottom right' => _x('Bottom Right', 'Background Control', 'elementor'),
                'initial' => _x('Custom', 'Background Control', 'elementor'),

            ],
            'selectors' => [
                '{{SELECTOR}}' => 'background-position: {{VALUE}};',
            ],
            'condition' => [
                'image[url]!' => '',
            ],
        ];

        $fields['xpos'] = [
            'label' => _x('X Position', 'Background Control', 'elementor'),
            'type' => Controls_Manager::SLIDER,
            'responsive' => true,
            'size_units' => ['px', 'em', '%', 'vw'],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -800,
                    'max' => 800,
                ],
                'em' => [
                    'min' => -100,
                    'max' => 100,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
                'vw' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
            ],
            'condition' => [
                'position' => ['initial'],
                'image[url]!' => '',
            ],
            'required' => true,
            'device_args' => [
                Controls_Stack::RESPONSIVE_TABLET => [
                    'selectors' => [
                        '{{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_tablet.SIZE}}{{ypos_tablet.UNIT}}',
                    ],
                    'condition' => [
                        'position_tablet' => ['initial'],
                    ],
                ],
                Controls_Stack::RESPONSIVE_MOBILE => [
                    'selectors' => [
                        '{{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_mobile.SIZE}}{{ypos_mobile.UNIT}}',
                    ],
                    'condition' => [
                        'position_mobile' => ['initial'],
                    ],
                ],
            ],
        ];


        $fields['ypos'] = [
            'label' => _x('Y Position', 'Background Control', 'elementor'),
            'type' => Controls_Manager::SLIDER,
            'responsive' => true,
            'size_units' => ['px', 'em', '%', 'vh'],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'tablet_default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'mobile_default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -800,
                    'max' => 800,
                ],
                'em' => [
                    'min' => -100,
                    'max' => 100,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
                'vh' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'background-position: {{xpos.SIZE}}{{xpos.UNIT}} {{SIZE}}{{UNIT}}',
            ],
            'condition' => [

                'position' => ['initial'],
                'image[url]!' => '',
            ],
            'required' => true,
            'device_args' => [
                Controls_Stack::RESPONSIVE_TABLET => [
                    'selectors' => [
                        '{{SELECTOR}}' => 'background-position: {{xpos_tablet.SIZE}}{{xpos_tablet.UNIT}} {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'background' => ['classic'],
                        'position_tablet' => ['initial'],
                    ],
                ],
                Controls_Stack::RESPONSIVE_MOBILE => [
                    'selectors' => [
                        '{{SELECTOR}}' => 'background-position: {{xpos_mobile.SIZE}}{{xpos_mobile.UNIT}} {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [

                        'position_mobile' => ['initial'],
                    ],
                ],
            ],
        ];


        $fields['attachment'] = [
            'label' => _x('Attachment', 'Background Control', 'elementor'),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => _x('Default', 'Background Control', 'elementor'),
                'scroll' => _x('Scroll', 'Background Control', 'elementor'),
                'fixed' => _x('Fixed', 'Background Control', 'elementor'),
            ],
            'selectors' => [
                '(desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
            ],
            'condition' => [
                'image[url]!' => '',
            ],
        ];

        $fields['attachment_alert'] = [
            'type' => Controls_Manager::RAW_HTML,
            'content_classes' => 'elementor-control-field-description',
            'raw' => esc_attr('Note: Attachment Fixed works only on desktop.', 'elementor'),
            'separator' => 'none',
            'condition' => [
                'image[url]!' => '',
                'attachment' => 'fixed',
            ],
        ];

        $fields['repeat'] = [
            'label' => _x('Repeat', 'Background Control', 'elementor'),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'responsive' => true,
            'options' => [
                '' => _x('Default', 'Background Control', 'elementor'),
                'no-repeat' => _x('No-repeat', 'Background Control', 'elementor'),
                'repeat' => _x('Repeat', 'Background Control', 'elementor'),
                'repeat-x' => _x('Repeat-x', 'Background Control', 'elementor'),
                'repeat-y' => _x('Repeat-y', 'Background Control', 'elementor'),
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'background-repeat: {{VALUE}};',
            ],
            'condition' => [
                'image[url]!' => '',
            ],
        ];

        $fields['size'] = [
            'label' => _x('Size', 'Background Control', 'elementor'),
            'type' => Controls_Manager::SELECT,
            'responsive' => true,
            'default' => '',
            'options' => [
                '' => _x('Default', 'Background Control', 'elementor'),
                'auto' => _x('Auto', 'Background Control', 'elementor'),
                'cover' => _x('Cover', 'Background Control', 'elementor'),
                'contain' => _x('Contain', 'Background Control', 'elementor'),
                'initial' => _x('Custom', 'Background Control', 'elementor'),
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'background-size: {{VALUE}};',
            ],
            'condition' => [
                'image[url]!' => '',
            ],
        ];


        $fields['bg_width'] = [
            'label' => _x('Width', 'Background Control', 'elementor'),
            'type' => Controls_Manager::SLIDER,
            'responsive' => true,
            'size_units' => ['px', 'em', '%', 'vw'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'vw' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 100,
                'unit' => '%',
            ],
            'required' => true,
            'selectors' => [
                '{{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',

            ],
            'condition' => [
                'background' => ['classic'],
                'size' => ['initial'],
                'image[url]!' => '',
            ],
            'device_args' => [
                Controls_Stack::RESPONSIVE_TABLET => [
                    'selectors' => [
                        '{{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
                    ],
                    'condition' => [
                        'background' => ['classic'],
                        'size_tablet' => ['initial'],
                    ],
                ],
                Controls_Stack::RESPONSIVE_MOBILE => [
                    'selectors' => [
                        '{{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
                    ],
                    'condition' => [
                        'size_mobile' => ['initial'],
                    ],
                ],
            ],
        ];
        return $fields;
    }

    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }

}
