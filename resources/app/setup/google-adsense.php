<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.6
 */

use Framework\Helper;

/**
 * Enqueue script for Google Adsense
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if ( ! get_option( 'mwt-google-adsense' ) &&
				 ! get_option( 'mwt-google-infeed-ads' ) &&
				 ! get_option( 'mwt-google-matched-content' ) &&
				 ! get_option( 'mwt-google-adsense-auth-code' )
		) {
			return;
		}

		// @codingStandardsIgnoreStart
		wp_enqueue_script(
			'google-adsense',
			'//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js',
			[],
			null,
			false
		);
		// @codingStandardsIgnoreEnd
	},
	1
);

/**
 * Google Adsense auth code
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if ( ! get_option( 'mwt-google-adsense-auth-code' ) ) {
			return;
		}

		wp_add_inline_script(
			'google-adsense',
			get_option( 'mwt-google-adsense-auth-code' ),
			'after'
		);
	}
);

/**
 * Google Auto Ads
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

		add_filter(
			'snow_monkey_google_adsense',
			function( $adsense, $position ) {
				return;
			},
			11,
			2
		);
	}
);

/**
 * Set async
 *
 * @param string $tag
 * @param string handle
 * @param string src
 * @return string
 */
add_filter(
	'script_loader_tag',
	function( $tag, $handle, $src ) {
		if ( 'google-adsense' !== $handle ) {
			return $tag;
		}

		return str_replace( ' src', ' async src', $tag );
	},
	10,
	3
);
