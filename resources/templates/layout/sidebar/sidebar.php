<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

wpvc_get_template_part( 'template-parts/google-adsense', [
	'position' => 'sidebar-top',
] );

if ( ( ! is_front_page() && is_home() ) || is_archive() || is_search() ) {
	get_template_part( 'template-parts/archive-sidebar-widget-area' );
} else {
	get_template_part( 'template-parts/sidebar-widget-area' );
	get_template_part( 'template-parts/sidebar-sticky-widget-area' );
}
