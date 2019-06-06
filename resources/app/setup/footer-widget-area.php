<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 4.2.13
 */

add_filter(
	'dynamic_sidebar_params',
	function( $params ) {
		if ( 'footer-widget-area' !== $params[0]['id'] ) {
			return $params;
		}

		$params[0]['before_widget'] = str_replace(
			'c-row__col--lg-1-1',
			'c-row__col--lg-' . get_theme_mod( 'footer-widget-area-column-size' ),
			$params[0]['before_widget']
		);

		return $params;
	}
);
