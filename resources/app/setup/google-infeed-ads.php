<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_action( 'get_template_part_template-parts/loop/entry-summary', function( $slug, $name ) {
	if ( is_singular() && ! is_front_page() ) {
		return;
	}

	if ( 'post' !== $name ) {
		return;
	}

	$infeed_ads = get_option( 'mwt-google-infeed-ads' );
	if ( ! $infeed_ads ) {
		return;
	}

	static $counter = 0;

	$counter ++;
	if ( 0 !== $counter % 4 ) {
		return;
	}

	\Inc2734\WP_Awesome_Widgets\inc2734_wpaw_display_adsense_code( $infeed_ads );
	?>
	</li>
	<li class="c-entries__item">
	<?php
}, 10, 2 );
