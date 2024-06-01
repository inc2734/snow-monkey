<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Framework\Helper;

if ( ! defined( 'SNOW_MONKEY_MEMBER_POST_PATH' ) ) {
	return;
}

/**
 * Output CSS in head
 */
add_action(
	'after_setup_theme',
	function () {
		if ( ! get_theme_mod( 'output-head-style' ) ) {
			return;
		}

		add_filter(
			'inc2734_wp_page_speed_optimization_output_head_styles',
			function ( $handles ) {
				return array_merge(
					$handles,
					array(
						'snow-monkey-member-post',
					)
				);
			}
		);
	}
);
