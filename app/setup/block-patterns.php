<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Framework\Helper;

if ( ! defined( 'SNOW_MONKEY_BLOCKS_DIR_PATH' ) || ! defined( 'SNOW_MONKEY_EDITOR_PATH' ) ) {
	return;
}

add_action(
	'init',
	function() {
		$block_pattern_categories = array(
			array(
				'name'  => 'sm-headers',
				'label' => __( 'Headers', 'snow-monkey' ),
			),
			array(
				'name'  => 'sm-sections',
				'label' => __( 'Sections', 'snow-monkey' ),
			),
			array(
				'name'  => 'sm-pricing',
				'label' => __( 'Pricing', 'snow-monkey' ),
			),
			array(
				'name'  => 'sm-faq',
				'label' => __( 'FAQ', 'snow-monkey' ),
			),
			array(
				'name'  => 'sm-gallery',
				'label' => __( 'Gallery', 'snow-monkey' ),
			),
		);

		foreach ( $block_pattern_categories as $block_pattern_categorie ) {
			register_block_pattern_category(
				$block_pattern_categorie['name'],
				array(
					'label' => '[Snow Monkey] ' . $block_pattern_categorie['label'],
				)
			);
		}
	}
);
