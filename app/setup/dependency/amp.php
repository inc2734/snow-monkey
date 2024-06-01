<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Framework\Model\Filesystem;

add_action(
	'amp_post_template_css',
	function () {
		$css = Filesystem::get_contents( get_theme_file_path( '/assets/css/dependency/amp/app.css' ) );
		if ( ! $css ) {
			return;
		}

		$css = str_replace( '!important', '', $css );
		echo $css; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
);
