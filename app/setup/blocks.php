<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

/**
 * Register block styles.
 */
add_action(
	'init',
	function () {
		register_block_style(
			'core/heading',
			array(
				'name'  => 'plain',
				'label' => __( 'Plain', 'snow-monkey' ),
			)
		);
	}
);
