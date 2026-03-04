<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.13
 */

use Inc2734\WP_GitHub_Theme_Updater\Bootstrap;
use Framework\Controller\Manager;

new Bootstrap(
	get_template(),
	'inc2734',
	'snow-monkey',
	array(
		'homepage' => 'https://snow-monkey.2inc.org/category/update-info/',
	)
);

/**
 * There is a case that comes back to GitHub's zip url.
 * In that case it returns false because it is illegal.
 *
 * @param string $url
 * @return string|false
 */
add_filter(
	'inc2734_github_theme_updater_zip_url_inc2734/snow-monkey',
	function ( $url ) {
		if ( 0 !== strpos( $url, 'https://snow-monkey.2inc.org/' ) ) {
			return false;
		}
		return $url;
	}
);

/**
 * Customize request URL that for updating
 *
 * @return string
 */
add_filter(
	'inc2734_github_theme_updater_request_url_inc2734/snow-monkey',
	function ( $url, $user_name, $repository, $version ) {
		$xserver_register_key    = Manager::get_option( 'xserver-register-key' );
		$xserver_register_status = Manager::get_xserver_register_status( $xserver_register_key );

		if ( 'true' === $xserver_register_status ) {
			return add_query_arg(
				array(
					'repository' => 'snow-monkey',
					'version'    => (string) $version,
				),
				'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/update-xserver/'
			);
		}

		$license_key    = Manager::get_option( 'license-key' );
		$license_status = Manager::get_license_status( $license_key );

		if ( 'true' === $license_status ) {
			return add_query_arg(
				array(
					'repository' => 'snow-monkey',
					'version'    => (string) $version,
				),
				'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/update/'
			);
		}

		return '';
	},
	10,
	4
);

add_filter(
	'inc2734_github_theme_updater_requester_args',
	function ( $args, $url, $user_name, $repository ) {
		if ( 'inc2734' !== $user_name || 'snow-monkey' !== $repository ) {
			return $args;
		}

		$api_base_url = trailingslashit( 'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1' );

		if ( 0 === strpos( $url, $api_base_url . 'update-xserver/' ) ) {
			$xserver_register_key = Manager::get_option( 'xserver-register-key' );
			if ( ! $xserver_register_key ) {
				return $args;
			}

			$args['headers'] = array_merge(
				isset( $args['headers'] ) && is_array( $args['headers'] ) ? $args['headers'] : array(),
				array(
					'Accept-Encoding'                    => '',
					'X-Snow-Monkey-Xserver-Register-Key' => $xserver_register_key,
				)
			);
		} elseif ( 0 === strpos( $url, $api_base_url . 'update/' ) ) {
			$license_key = Manager::get_option( 'license-key' );
			if ( ! $license_key ) {
				return $args;
			}

			$args['headers'] = array_merge(
				isset( $args['headers'] ) && is_array( $args['headers'] ) ? $args['headers'] : array(),
				array(
					'Accept-Encoding'           => '',
					'X-Snow-Monkey-License-Key' => $license_key,
				)
			);
		}

		return $args;
	},
	10,
	4
);
