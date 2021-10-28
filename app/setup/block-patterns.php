<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.12.0
 */

use Framework\Helper;

if ( ! defined( 'SNOW_MONKEY_BLOCKS_DIR_PATH' ) || ! defined( 'SNOW_MONKEY_EDITOR_PATH' ) ) {
	return;
}

add_action(
	'init',
	function() {
		$block_pattern_categories = [
			[
				'name'  => 'sm-headers',
				'label' => __( 'Headers', 'snow-monkey' ),
			],
		];

		foreach ( $block_pattern_categories as $block_pattern_categorie ) {
			register_block_pattern_category(
				$block_pattern_categorie['name'],
				[
					'label' => '[Snow Monkey] ' . $block_pattern_categorie['label'],
				]
			);
		}

		register_block_pattern(
			'snow-monkey/header-1',
			[
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 1 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-1' ),
			]
		);

		register_block_pattern(
			'snow-monkey/header-2',
			[
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 2 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-2' ),
			]
		);

		register_block_pattern(
			'snow-monkey/header-3',
			[
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 3 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-3' ),
			]
		);

		register_block_pattern(
			'snow-monkey/header-4',
			[
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 4 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-4' ),
			]
		);

		register_block_pattern(
			'snow-monkey/header-5',
			[
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 5 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-5' ),
			]
		);

		register_block_pattern(
			'snow-monkey/header-6',
			[
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 6 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-6' ),
			]
		);
	}
);
