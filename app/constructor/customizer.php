<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Inc2734\WP_Customizer_Framework\Bootstrap;
use Framework\Helper;

new Bootstrap(
	array(
		'handle' => Helper::get_main_style_handle(),
	)
);
