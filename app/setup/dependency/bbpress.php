<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.7.0
 */

use Framework\Helper;

if ( ! class_exists( '\bbPress' ) ) {
	return;
}

add_filter(
	'bbp_template_include',
	function( $template ) {
		if ( Helper::is_bbpress_mypage() ) {
			$ext_template = get_theme_file_path( 'bbpress/mypage.php' );
		} elseif ( Helper::is_bbpress_single() ) {
			$ext_template = get_theme_file_path( 'bbpress/single.php' );
		} elseif ( Helper::is_bbpress_archive() ) {
			$ext_template = get_theme_file_path( 'bbpress/archive.php' );
		}

		return ! empty( $ext_template ) && file_exists( $ext_template )
			? $ext_template
			: $template;
	}
);
