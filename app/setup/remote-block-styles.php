<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.6.0
 */

use Framework\Controller\Manager;

/**
 * Get remote block styles.
 *
 * @param string $url A URL of the remote styles API.
 * @param array $args An array of request arguments.
 * @return array
 */
function _snow_monkey_get_remote_block_styles( $url, array $args = array() ) {
	global $wp_version;

	$response = wp_remote_get(
		$url,
		array(
			'user-agent' => 'WordPress/' . $wp_version,
			'timeout'    => 30,
			'headers'    => array_merge(
				$args,
				array(
					'Accept-Encoding' => '',
				)
			),
		)
	);

	if ( ! $response || is_wp_error( $response ) ) {
		return array();
	}

	$response_code = wp_remote_retrieve_response_code( $response );
	if ( 200 !== $response_code ) {
		return array();
	}

	$styles = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $styles ) ) {
		return array();
	}

	foreach ( $styles as $key => $style ) {
		$styles[ $key ]['viewportWidth'] = 1440;
	}

	return $styles;
}

/**
 * Register remote block styles.
 * This requires a valid license key.
 */
add_action(
	'init',
	function () {
		$request_uri = filter_input( INPUT_SERVER, 'REQUEST_URI' );
		if ( ! $request_uri ) {
			$request_uri = esc_html( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) ); // @phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		}
		if ( $request_uri && false !== strpos( $request_uri, 'wp-json/snow-monkey-license-manager' ) ) {
			return;
		}

		$transient = get_transient( 'snow-monkey-remote-styles' );

		if ( false !== $transient ) {
			$remote_block_styles = $transient;
		} else {
			$license_key = Manager::get_option( 'license-key' );
			$status      = Manager::get_license_status( $license_key );

			$url = 'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/styles/';

			$remote_block_styles = 'true' === $status
				? _snow_monkey_get_remote_block_styles(
					$url,
					array(
						'X-Snow-Monkey-License-key' => Manager::get_option( 'license-key' ),
						'X-Snow-Monkey-Locale'      => get_locale(),
					)
				)
				: false;

			if ( $remote_block_styles && is_array( $remote_block_styles ) ) {
				set_transient( 'snow-monkey-remote-styles', $remote_block_styles, DAY_IN_SECONDS );
			}
		}

		if ( ! is_array( $remote_block_styles ) ) {
			$remote_block_styles = array();
		}

		$registry = WP_Block_Styles_Registry::get_instance();

		foreach ( $remote_block_styles as $style ) {
			if ( ! $style['name'] || ! $style['label'] || ! $style['blockTypes'] ) {
				continue;
			}

			$block_types = array_filter(
				array_map(
					function ( $block_type ) {
						return str_replace( array( 'core-', 'snow-monkey-blocks-' ), array( 'core/', 'snow-monkey-blocks/' ), $block_type );
					},
					$style['blockTypes']
				)
			);

			if ( in_array( 'core/button', $block_types, true ) ) {
				$block_types[] = 'snow-monkey-blocks/btn';
			}

			register_block_style( array_unique( $block_types ), (array) $style );
		}
	},
	9
);
