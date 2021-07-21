<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 */

use Framework\Helper;

/**
 * Enqueue script for Google Adsense
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if (
			! get_option( 'mwt-google-adsense' )
			&& ! get_option( 'mwt-google-infeed-ads' )
			&& ! get_option( 'mwt-google-matched-content' )
			&& ! get_option( 'mwt-google-auto-ads' )
		) {
			return;
		}

		// @see https://github.com/inc2734/snow-monkey/issues/616
		if ( is_customize_preview() ) {
			return;
		}

		wp_enqueue_script(
			'google-adsense',
			'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js',
			[],
			null,
			false
		);
	},
	1
);

/**
 * Google Auto Ads (Old version)
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$google_adsense = apply_filters( 'snow_monkey_google_adsense', get_option( 'mwt-google-adsense' ), 'auto-ads' );
		if ( ! $google_adsense ) {
			return;
		}

		if ( preg_match( '/<ins /s', $google_adsense ) ) {
			return;
		}

		wp_add_inline_script(
			'google-adsense',
			$google_adsense,
			'after'
		);

		add_filter( 'snow_monkey_google_adsense', '__return_false' );
	}
);

/**
 * Set async
 *
 * @param string $tag
 * @param string handle
 * @return string
 */
add_filter(
	'script_loader_tag',
	function( $tag, $handle ) {
		if ( 'google-adsense' !== $handle ) {
			return $tag;
		}

		return str_replace( ' src', ' async src', $tag );
	},
	10,
	2
);

/**
 * Set data-ad-client for Auto ads.
 */
add_filter(
	'script_loader_tag',
	function( $tag, $handle ) {
		if ( 'google-adsense' !== $handle ) {
			return $tag;
		}

		$google_auto_ads = get_option( 'mwt-google-auto-ads' );
		if ( ! $google_auto_ads ) {
			return $tag;
		}

		return str_replace( ' src', ' data-ad-client="' . esc_attr( $google_auto_ads ) . '" src', $tag );
	},
	10,
	2
);

/**
 * Display dummy advertisement when customize preview screen
 *
 * @param string $code
 * @return string
 */
add_filter(
	'inc2734_wp_adsense_the_adsense_code',
	function( $code ) {
		if ( ! is_customize_preview() && ! is_preview() ) {
			return $code;
		}

		ob_start();
		Helper::get_template_part( 'template-parts/common/dummy-ad' );
		return wp_kses_post( ob_get_clean() );
	}
);

/**
 * Add google adsense to sidebar
 *
 * @return void
 */
function snow_monkey_sidebar_add_google_adsense() {
	if ( get_option( 'mwt-google-adsense' ) ) {
		$vars = [
			'_position' => 'sidebar-top',
		];
		Helper::get_template_part( 'template-parts/common/google-adsense', null, $vars );
	}
}
add_action( 'snow_monkey_sidebar', 'snow_monkey_sidebar_add_google_adsense', 10 );
