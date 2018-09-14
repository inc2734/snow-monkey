<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_OEmbed_Blog_Card\OEmbed_Blog_Card;

new OEmbed_Blog_Card();

/**
 * oEmbed container customization
 *
 * @param mixed $cache
 * @param string $url
 * @param array $attr
 * @param int $post_id
 */
add_filter(
	'embed_oembed_html',
	function( $cache, $url, $attr, $post_id ) {
		global $wp_query;
		if ( is_object( $wp_query ) && is_null( $wp_query->query ) && ! empty( $_GET['url'] ) && function_exists( 'is_gutenberg_page' ) ) {
			// @codingStandardsIgnoreStart
			$cache .= sprintf(
				'<link rel="stylesheet" href="%1$s">',
				esc_url_raw( get_theme_file_uri( '/assets/css/gutenberg-oembed.min.css' ) )
			);
			// @codingStandardsIgnoreEnd
		}

		return $cache;
	},
	10,
	4
);

/**
 * Add stylesheets for oEmbed Blog Card on Gutenberg
 *
 * @param string $html
 * @param string $url
 * @return string
 */
add_filter(
	'wp_oembed_blog_card_gutenberg_template',
	function( $html, $url ) {
		// @codingStandardsIgnoreStart
		$html .= sprintf(
			'<link rel="stylesheet" href="%1$s">',
			esc_url_raw( get_theme_file_uri( '/assets/css/gutenberg-oembed-blog-card.min.css' ) )
		);
		$html .= sprintf(
			'<link rel="stylesheet" href="%1$s">',
			esc_url_raw( get_template_directory_uri() . '/vendor/inc2734/wp-oembed-blog-card/src/assets/css/wp-oembed-blog-card.min.css' )
		);
		// @codingStandardsIgnoreEnd

		return $html;
	},
	10,
	2
);
