<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.7.1
 */

add_action(
	'amp_post_template_css',
	function() {
		$css = file_get_contents( get_theme_file_path( '/assets/css/dependency/amp/amp.min.css' ) );
		$css = str_replace( '!important', '', $css );
		// @codingStandardsIgnoreStart
		echo $css;
		// @codingStandardsIgnoreEnd
	}
);
