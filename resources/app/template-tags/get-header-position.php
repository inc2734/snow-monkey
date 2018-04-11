<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return header position
 *
 * @return string
 */
function snow_monkey_get_header_position() {
	if ( ! wp_is_mobile() && get_theme_mod( 'header-position-only-mobile' ) ) {
		return;
	}

	return snow_monkey_get_default_header_position();
}
