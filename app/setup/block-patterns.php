<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.18.0
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
			[
				'name'  => 'sm-features',
				'label' => __( 'Features', 'snow-monkey' ),
			],
			[
				'name'  => 'sm-text-with-image',
				'label' => __( 'Text with image', 'snow-monkey' ),
			],
			[
				'name'  => 'sm-gallery',
				'label' => __( 'Gallery', 'snow-monkey' ),
			],
			[
				'name'  => 'sm-columns',
				'label' => __( 'Columns', 'snow-monkey' ),
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

		$block_patterns = [
			'snow-monkey/header-1'          => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 1 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-1' ),
			],
			'snow-monkey/header-2'          => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 2 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-2' ),
			],
			'snow-monkey/header-3'          => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 3 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-3' ),
			],
			'snow-monkey/header-4'          => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 4 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-4' ),
			],
			'snow-monkey/header-5'          => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 5 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-5' ),
			],
			'snow-monkey/header-6'          => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 6 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-6' ),
			],
			'snow-monkey/header-7'          => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 7 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-7' ),
			],
			'snow-monkey/header-8'          => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Header %1$s', 'snow-monkey' ), 8 ),
				'categories' => [ 'sm-headers' ],
				'content'    => Helper::render_block_pattern( 'header-8' ),
			],
			'snow-monkey/feature-1'         => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Feature %1$s', 'snow-monkey' ), 1 ),
				'categories' => [ 'sm-features' ],
				'content'    => Helper::render_block_pattern( 'feature-1' ),
			],
			'snow-monkey/feature-2'         => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Feature %1$s', 'snow-monkey' ), 2 ),
				'categories' => [ 'sm-features' ],
				'content'    => Helper::render_block_pattern( 'feature-2' ),
			],
			'snow-monkey/feature-3'         => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Feature %1$s', 'snow-monkey' ), 3 ),
				'categories' => [ 'sm-features' ],
				'content'    => Helper::render_block_pattern( 'feature-3' ),
			],
			'snow-monkey/text-with-image-1' => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Text with image %1$s', 'snow-monkey' ), 1 ),
				'categories' => [ 'sm-text-with-image' ],
				'content'    => Helper::render_block_pattern( 'text-with-image-1' ),
			],
			'snow-monkey/text-with-image-2' => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Text with image %1$s', 'snow-monkey' ), 2 ),
				'categories' => [ 'sm-text-with-image' ],
				'content'    => Helper::render_block_pattern( 'text-with-image-2' ),
			],
			'snow-monkey/text-with-image-3' => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Text with image %1$s', 'snow-monkey' ), 3 ),
				'categories' => [ 'sm-text-with-image' ],
				'content'    => Helper::render_block_pattern( 'text-with-image-3' ),
			],
			'snow-monkey/gallery-1'         => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Gallery %1$s', 'snow-monkey' ), 1 ),
				'categories' => [ 'sm-gallery' ],
				'content'    => Helper::render_block_pattern( 'gallery-1' ),
			],
			'snow-monkey/gallery-2'         => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Gallery %1$s', 'snow-monkey' ), 2 ),
				'categories' => [ 'sm-gallery' ],
				'content'    => Helper::render_block_pattern( 'gallery-2' ),
			],
			'snow-monkey/gallery-3'         => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Gallery %1$s', 'snow-monkey' ), 3 ),
				'categories' => [ 'sm-gallery' ],
				'content'    => Helper::render_block_pattern( 'gallery-3' ),
			],
			'snow-monkey/columns-1'         => [
				// translators: %1$s: number
				'title'      => sprintf( __( 'Columns %1$s', 'snow-monkey' ), 1 ),
				'categories' => [ 'sm-columns' ],
				'content'    => Helper::render_block_pattern( 'columns-1' ),
			],
		];

		foreach ( $block_patterns as $block_pattern_name => $block_pattern_properties ) {
			register_block_pattern(
				$block_pattern_name,
				$block_pattern_properties
			);
		}
	}
);
