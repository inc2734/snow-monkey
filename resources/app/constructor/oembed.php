<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.0.0
 */

/**
 * Customize template for block editor
 *
 * @param string $template
 * @param string $url
 * @return string
 */
add_filter(
	'inc2734_wp_oembed_blog_card_block_editor_template',
	function( $template, $url ) {
		return apply_filters( 'snow_monkey_oembed_blog_card_block_editor_template', $template, $url );
	},
	10,
	2
);

/**
 * Customize template for loading
 *
 * @param string $template
 * @param string $url
 * @return string
 */
add_filter(
	'inc2734_wp_oembed_blog_card_loading_template',
	function( $template, $url ) {
		return apply_filters( 'snow_monkey_oembed_blog_card_loading_template', $template, $url );
	},
	10,
	2
);

/**
 * Customize url template
 *
 * @param string $template
 * @param string $url
 * @return string
 */
add_filter(
	'inc2734_wp_oembed_blog_card_url_template',
	function( $template, $url ) {
		return apply_filters( 'snow_monkey_oembed_blog_card_url_template', $template, $url );
	},
	10,
	2
);

/**
 * Customize blog card template
 *
 * @param string $template
 * @param array $cache
 * @return string
 */
add_filter(
	'inc2734_wp_oembed_blog_card_blog_card_template',
	function( $template, $cache ) {
		return apply_filters( 'snow_monkey_oembed_blog_card_template', $template, $cache );
	},
	10,
	2
);
