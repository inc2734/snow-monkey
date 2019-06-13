<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.2
 */

use Inc2734\WP_OEmbed_Blog_Card\Bootstrap;

new Bootstrap();

add_filter(
	'wp_oembed_blog_card_loading_template',
	function( $html ) {
		return str_replace(
			'class="js-wp-oembed-blog-card"',
			'class="js-wp-oembed-blog-card wp-oembed-blog-card"',
			$html
		);
	}
);

add_filter(
	'wp_oembed_blog_card_url_template',
	function( $html ) {
		return str_replace(
			'class="wp-oembed-blog-card-url-template"',
			'class="wp-oembed-blog-card-url-template wp-oembed-blog-card"',
			$html
		);
	}
);
