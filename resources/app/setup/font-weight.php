<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.3.0
 */

use Framework\Helper;

add_filter(
	'inc2734_wp_google_fonts_font_weight',
	function( $weight ) {
		$base_font = get_theme_mod( 'base-font' );

		if ( 'noto-sans-jp' === $base_font ) {
			$new_weight = get_theme_mod( 'noto-sans-jp-font-weight' );
			return $new_weight ? $new_weight : $weight;
		} elseif ( 'noto-serif-jp' === $base_font ) {
			$new_weight = get_theme_mod( 'noto-serif-jp-font-weight' );
			return $new_weight ? $new_weight : $weight;
		} elseif ( 'm-plus-1p' === $base_font ) {
			$new_weight = get_theme_mod( 'm-plus-1p-font-weight' );
			return $new_weight ? $new_weight : $weight;
		} elseif ( 'm-plus-rounded-1c' === $base_font ) {
			$new_weight = get_theme_mod( 'm-plus-rounded-1c-font-weight' );
			return $new_weight ? $new_weight : $weight;
		}

		return $weight;
	}
);
