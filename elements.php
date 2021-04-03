<?php

function elemenda_all_elements(){
	return apply_filters('elemenda/all_elements', [
		'widgets'    => [
			/*'image-masker' =>[
				'class'=> '\Themeid_Elemenda\Widgets\ImageMasker',
				'dependency' => [
					'css' => [
						ELEMENDA_PLUGIN_PATH . 'assets/front-end/css/background-masking/index.css',
					],
					'js' => [


					],
				],
			],

			'share-buttons' =>[
				'class'=> '\Themeid_Elemenda\Widgets\Buttons\ShareButtons',
				'dependency' => [
					'css' => [
						ELEMENDA_PLUGIN_PATH . 'assets/front-end/css/button/index.css',
						ELEMENDA_PLUGIN_PATH . 'assets/front-end/css/share-buttons/index.css',
					],
					'js' => [
						ELEMENDA_PLUGIN_PATH . 'assets/front-end/js/share-buttons/index.js',

					],
				],

			],*/

			'video-player' =>[
				'class'=> '\Themeid_Elemenda\Widgets\VideoPlayer',
				'dependency' => [
					'css' => [
						ELEMENDA_PLUGIN_PATH . 'assets/front-end/css/video-player/index.css',

					],
					'js' => [
						ELEMENDA_PLUGIN_PATH . 'assets/front-end/js/video-player/index.js',

					],
				],
				'module' =>[
					'css' => [

					],
					'js' =>[

					]
				]
			],
			
		],
	/*	'extensions' => [
			'background-overlay' => [
				'class'      => '\Themeid_Elemenda\Extensions\Background_Overlay',
				'dependency' => [
					'css' => [


					],
					'js'  => [

					],
				],

			],
			'custom-css' => [
				'class'      => '\Themeid_Elemenda\Extensions\Custom_CSS',
				'dependency' => [
					'css' => [
					],
					'js'  => [

					],
				],

			],
		]
	]);*/

}





