<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return output positions of eyecatch
 *
 * @return array
 */
function snow_monkey_eyecatch_position_choices() {
	return [
		'page-header'          => __( 'Page header', 'snow-monkey' ),
		'title-on-page-header' => __( 'Title on page header', 'snow-monkey' ),
		'content-top'          => __( 'Top of content', 'snow-monkey' ),
		'none'                 => __( 'None', 'snow-monkey' ),
	];
}
