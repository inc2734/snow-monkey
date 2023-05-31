<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.2.0
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

add_filter(
	'inc2734_wp_oembed_blog_card_cache_directory',
	function( $directory ) {
		return apply_filters( 'snow_monkey_oembed_blog_card_cache_directory', $directory );
	}
);

add_filter(
	'inc2734_wp_oembed_blog_card_block_editor_styles',
	function( $styles ) {
		$styles[] = get_template_directory_uri() . '/assets/css/app/app.css?ver=' . filemtime( get_template_directory() . '/assets/css/app/app.css' );
		$styles[] = get_template_directory_uri() . '/assets/css/app/app-theme.css?ver=' . filemtime( get_template_directory() . '/assets/css/app/app-theme.css' );
		return $styles;
	}
);
