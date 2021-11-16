<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.15.0
 */

/**
 * Customize for search result.
 *
 * @param array $title {
 *     The document title parts.
 *     @type string $title   Title of the viewed page.
 *     @type string $page    Optional. Page number if paginated.
 *     @type string $tagline Optional. Site description when on home page.
 *     @type string $site    Optional. Site title when not on home page.
 */
add_filter(
	'document_title_parts',
	function( $title ) {
		if ( is_search() && ! get_search_query() ) {
			$title['title'] = __( 'Search results', 'snow-monkey' );
		}
		return $title;
	}
);
