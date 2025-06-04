<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.0.2
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
			return sprintf(
				'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/update-xserver/%1$s?repository=snow-monkey&version=%2$s',
				esc_attr( $xserver_register_key ),
				esc_attr( $version )
			);
		}

		$license_key    = Manager::get_option( 'license-key' );
		$license_status = Manager::get_license_status( $license_key );

		if ( 'true' === $license_status ) {
			return sprintf(
				'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/update/%1$s?repository=snow-monkey&version=%2$s',
				esc_attr( $license_key ),
				esc_attr( $version )
			);
		}

		return '';
	},
	10,
	4
);
