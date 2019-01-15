<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Returns page title from Breadcrumbs
 *
 * @return string
 */
function snow_monkey_get_page_title_from_breadcrumbs() {
	$breadcrumbs = new \Inc2734\WP_Breadcrumbs\Breadcrumbs();
	$breadcrumbs = apply_filters( 'snow_monkey_breadcrumbs', $breadcrumbs->get() );
	$title_item  = end( $breadcrumbs );
	return array_key_exists( 'title', $title_item ) ? $title_item['title'] : '';
}
