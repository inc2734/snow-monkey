<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Awesome_Components\Awesome_Components;

new Awesome_Components();

add_filter(
	'the_content',
	function( $content ) {
		return str_replace( 'wpac-section__container', 'c-container', $content );
	}
);
