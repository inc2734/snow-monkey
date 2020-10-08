<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.7
 */

use Inc2734\WP_Customizer_Framework\Bootstrap;
use Framework\Helper;

new Bootstrap(
	[
		'handle' => Helper::get_main_style_handle(),
	]
);
