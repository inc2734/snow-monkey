<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'wp_seo_meta_robots', function( $robots ) {
	$robots_noindex = get_option( 'mwt-robots-noindex' );

	if ( ! $robots_noindex ) {
		return $robots;
	}

	$robots_noindex = explode( ',', $robots_noindex );
	$flipped = array_flip( $robots_noindex );

	if ( is_category() && isset( $flipped['category'] )
		|| is_tag() && isset( $flipped['post_tag'] )
		|| is_author() && isset( $flipped['author'] )
		|| is_year() && isset( $flipped['year'] )
		|| is_month() && isset( $flipped['month'] )
		|| is_day() && isset( $flipped['day'] )
	) {
		$robots = [ 'noindex' ];
	}

	return $robots;
} );
