<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_GitHub_Theme_Updater\Bootstrap;

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
		return ! $version
			? 'https://snow-monkey.2inc.org/github-api/response.json'
			: sprintf(
				'https://snow-monkey.2inc.org/github-api/packages/%1$s/response.json',
				$version
			);
	},
	10,
	4
);
