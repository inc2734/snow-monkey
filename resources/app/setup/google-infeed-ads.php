<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.0
 */

use Inc2734\WP_Adsense;
use Framework\Helper;

if ( is_singular() && ! is_front_page() ) {
	return $html;
}

$infeed_ads = get_option( 'mwt-google-infeed-ads' );
if ( ! $infeed_ads ) {
	return;
}

if ( ! function_exists( 'snow_monkey_insert_infeed_ads' ) ) {
	function snow_monkey_insert_infeed_ads( $html, $post_types, $entries_layout ) {
		$infeed_ads = get_option( 'mwt-google-infeed-ads' );
		if ( ! $infeed_ads ) {
			return;
		}

		$post_types = (array) $post_types;
		if ( ! in_array( 'post', $post_types ) ) {
			return $html;
		}

		if ( ! in_array( $entries_layout, [ 'rich-media', 'panel' ] ) ) {
			return $html;
		}

		$count = 0;

		return preg_replace_callback(
			'|(<li class="c-entries__item)|s',
			function( $matches ) use ( &$count, $infeed_ads ) {
				$count ++;
				if ( 0 !== $count % 4 ) {
					return $matches[0];
				}

				ob_start();
				?>
				<li class="c-entries__item">
					<?php WP_Adsense\Helper::the_adsense_code( $infeed_ads ); ?>
				</li>
				<?php
				return ob_get_clean() . $matches[0];
			},
			$html
		);
	}
}

add_filter(
	'snow_monkey_template_part_render',
	function( $html, $slug ) {
		if ( 'template-parts/archive/entry/content/content' !== $slug ) {
			return $html;
		}

		$post_type      = get_post_type() ? get_post_type() : 'post';
		$post_type      = is_home() ? 'post' : $post_type;
		$entries_layout = get_theme_mod( $post_type . '-entries-layout' );

		return snow_monkey_insert_infeed_ads( $html, $post_type, $entries_layout );
	},
	10,
	2
);

add_filter(
	'snow_monkey_template_part_render',
	function( $html, $slug, $name, $args ) {
		if ( 'template-parts/widget/snow-monkey-posts' !== $slug ) {
			return $html;
		}

		return snow_monkey_insert_infeed_ads( $html, $args['_posts_query']->get( 'post_type' ), $args['_entries_layout'] );
	},
	10,
	4
);
