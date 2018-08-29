<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_action( 'wp_footer', function() {
	get_template_part( 'template-parts/overlay-search-box' );
} );
