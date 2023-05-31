<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.2.0
 */

use Inc2734\WP_OEmbed_Blog_Card\Bootstrap;
use Framework\Helper;

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

add_action(
	'enqueue_block_assets',
	function() {
		$variation = get_theme_mod( 'wp-oembed-blog-card-variation' );
		if ( $variation ) {
			$slug = 'assets/css/wp-oembed-blog-card-variations/' . $variation . '.css';
			if ( file_exists( get_theme_file_path( $slug ) ) ) {
				wp_enqueue_style(
					'wp-oembed-blog-card-variation',
					get_theme_file_uri( $slug ),
					array( Helper::get_main_style_handle() ),
					filemtime( get_theme_file_path( $slug ) )
				);
			}
		}
	}
);
