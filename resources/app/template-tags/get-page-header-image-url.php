<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Returns page header image url
 *
 * @return string
 */
function snow_monkey_get_page_header_image_url() {
	$header_image = '';

	if ( is_singular() ) {
		if ( has_post_thumbnail() ) {
			$thumbnail_id = get_post_thumbnail_id();
		}
	} elseif ( is_home() || ( is_archive() && ! is_post_type_archive() ) ) {
		if ( 'page' === get_option( 'show_on_front' ) ) {
			$thumbnail_id = get_post_thumbnail_id( get_option( 'page_for_posts' ) );
		}

		if ( is_category() ) {
			$term = get_queried_object();
			$header_image = get_theme_mod( 'category-' . $term->term_id . '-header-image' );
		}
	}

	if ( empty( $header_image ) ) {
		if ( ! empty( $thumbnail_id ) ) {
			$page_header_thumbnail_size = apply_filters( 'snow_monkey_page_header_thumbnail_size', 'large' );
			$header_image = wp_get_attachment_image_url( $thumbnail_id, $page_header_thumbnail_size );
		}
	}

	return $header_image;
}
