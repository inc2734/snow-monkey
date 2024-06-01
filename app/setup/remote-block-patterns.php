<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

/**
 * Get remote block pattern categories.
 *
 * @return array
 */
function snow_monkey_get_remote_block_patten_categories() {
	global $wp_version;

	$url = 'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/pattern-categories/';

	$response = wp_remote_get(
		$url,
		array(
			'user-agent' => 'WordPress/' . $wp_version,
			'timeout'    => 30,
			'headers'    => array(
				'Accept-Encoding' => '',
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

	$pattern_categories = json_decode( wp_remote_retrieve_body( $response ), true );

	$new_pattern_categories = array();
	foreach ( $pattern_categories as $pattern_category ) {
		$new_pattern_categories[] = array(
			'name'  => $pattern_category['slug'],
			'label' => $pattern_category['name'],
		);
	}

	return $new_pattern_categories;
}

/**
 * Get remote block patterns.
 *
 * @param string $url API URL.
 * @return array
 */
function _snow_monkney_get_remote_block_patterns( $url ) {
	global $wp_version;

	$response = wp_remote_get(
		$url,
		array(
			'user-agent' => 'WordPress/' . $wp_version,
			'timeout'    => 30,
			'headers'    => array(
				'Accept-Encoding' => '',
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

	$patterns = json_decode( wp_remote_retrieve_body( $response ), true );

	foreach ( $patterns as $key => $pattern ) {
		$patterns[ $key ]['content'] = str_replace(
			'https://snow-monkey.2inc.org/wp-content',
			untrailingslashit( WP_CONTENT_URL ),
			$pattern['content'],
		);

		$patterns[ $key ]['content'] = preg_replace_callback(
			'@' . untrailingslashit( preg_quote( WP_CONTENT_URL ) ) . '[^"\']+?\.(?:jpg|jpeg|png|gif|svg)@ims',
			function ( $matches ) {
				$file_url  = $matches[0];
				$file_path = str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, $file_url );
				if ( ! file_exists( $file_path ) ) {
					return get_theme_file_uri( 'assets/img/dummy.jpg' );
				}
				return $file_url;
			},
			$patterns[ $key ]['content']
		);

		$patterns[ $key ]['viewportWidth'] = 1440;
	}

	return $patterns;
}

/**
 * Get free remote block patterns.
 *
 * @return array
 */
function snow_monkey_get_free_remote_block_pattens() {
	$url = 'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/free-patterns/';

	return _snow_monkney_get_remote_block_patterns( $url );
}

/**
 * Get premium remote block patterns.
 *
 * @return array
 */
function snow_monkey_get_premium_remote_block_pattens() {
	$license_key = \Framework\Controller\Manager::get_option( 'license-key' );

	$url = sprintf(
		'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/patterns/%1$s',
		esc_attr( $license_key )
	);

	return _snow_monkney_get_remote_block_patterns( $url );
}

/**
 * Get premium remote block patterns for Xserver user.
 *
 * @return array
 */
function snow_monkey_get_premium_remote_block_pattens_xserver() {
	$xserver_register_key = \Framework\Controller\Manager::get_option( 'xserver-register-key' );

	$url = sprintf(
		'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/patterns-xserver/%1$s',
		esc_attr( $xserver_register_key )
	);

	return _snow_monkney_get_remote_block_patterns( $url );
}

/**
 * Register remote block patterns.
 * This requires a valid license key.
 */
function snow_monkey_register_remote_block_patterns() {
	$request_uri = wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	if ( $request_uri ) {
		if ( false !== strpos( $request_uri, 'wp-json/snow-monkey-license-manager' ) ) {
			return;
		}
	}

	$transient = get_transient( 'snow-monkey-remote-pattern-categories' );
	if ( false !== $transient ) {
		$remote_block_pattern_categories = $transient;
	} else {
		$remote_block_pattern_categories = snow_monkey_get_remote_block_patten_categories();
		set_transient( 'snow-monkey-remote-pattern-categories', $remote_block_pattern_categories, DAY_IN_SECONDS );
	}
	foreach ( $remote_block_pattern_categories as $remote_block_pattern_category ) {
		register_block_pattern_category(
			$remote_block_pattern_category['name'],
			array(
				'label' => '[Snow Monkey] ' . $remote_block_pattern_category['label'],
			)
		);
	}

	$transient = get_transient( 'snow-monkey-remote-patterns' );
	if ( false !== $transient ) {
		$remote_block_patterns = $transient;
	} else {
		$license_key           = \Framework\Controller\Manager::get_option( 'license-key' );
		$xserver_register_key  = \Framework\Controller\Manager::get_option( 'xserver-register-key' );
		$remote_block_patterns = array();

		if ( $license_key ) {
			$status = \Framework\Controller\Manager::get_license_status( $license_key );
			if ( 'true' === $status ) {
				$remote_block_patterns = snow_monkey_get_premium_remote_block_pattens();
			}
		} elseif ( $xserver_register_key ) {
			$status = \Framework\Controller\Manager::get_xserver_register_status( $xserver_register_key );
			if ( 'true' === $status ) {
				$remote_block_patterns = snow_monkey_get_premium_remote_block_pattens_xserver();
			}
		}

		if ( ! $remote_block_patterns ) {
			$remote_block_patterns = snow_monkey_get_free_remote_block_pattens();
		}

		set_transient( 'snow-monkey-remote-patterns', $remote_block_patterns, DAY_IN_SECONDS );
	}

	$registry = WP_Block_Patterns_Registry::get_instance();

	foreach ( $remote_block_patterns as $pattern ) {
		if ( ! $pattern['title'] || ! $pattern['slug'] || ! $pattern['content'] ) {
			continue;
		}

		$required_plugins = isset( $pattern['requiredPlugins'] ) ? $pattern['requiredPlugins'] : array();
		foreach ( $required_plugins as $required_plugin ) {
			// @todo Some plug-ins have different bootstrap file names.
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
			if ( ! is_plugin_active( $required_plugin . '/' . $required_plugin . '.php' ) ) {
				continue 2;
			}
		}

		$pattern_name = esc_html( $pattern['slug'] );
		// Some patterns might be already registered as core patterns with the `core` prefix.
		$is_registered = $registry->is_registered( $pattern_name ) || $registry->is_registered( $pattern_name );
		if ( ! $is_registered ) {
			register_block_pattern( $pattern_name, (array) $pattern );
		}
	}
}
add_action( 'init', 'snow_monkey_register_remote_block_patterns', 9 );
