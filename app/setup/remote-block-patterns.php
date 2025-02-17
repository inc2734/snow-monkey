<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 28.0.4
 */

use Framework\Controller\Manager;

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
	if ( ! is_array( $pattern_categories ) ) {
		return array();
	}

	$new_pattern_categories = array();
	foreach ( $pattern_categories as $pattern_category ) {
		if ( 'free' === $pattern_category['slug'] ) {
			continue;
		}

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
 * @param array $args An array of request arguments.
 * @return array
 */
function _snow_monkney_get_remote_block_patterns( $url, array $args = array() ) {
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
				),
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
	if ( ! is_array( $patterns ) ) {
		return array();
	}

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
	$url = 'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/patterns/';

	return _snow_monkney_get_remote_block_patterns(
		$url,
		array(
			'X-Snow-Monkey-License-key' => Manager::get_option( 'license-key' ),
		)
	);
}

/**
 * Get premium remote block patterns for XServer user.
 *
 * @return array
 */
function snow_monkey_get_premium_remote_block_pattens_xserver() {
	$url = 'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/patterns-xserver/';

	return _snow_monkney_get_remote_block_patterns(
		$url,
		array(
			'X-Snow-Monkey-XServer-Register-key' => Manager::get_option( 'xserver-register-key' ),
		)
	);
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

	$license_key          = Manager::get_option( 'license-key' );
	$xserver_register_key = Manager::get_option( 'xserver-register-key' );
	$status               = 'false';

	if ( $license_key ) {
		$status = Manager::get_license_status( $license_key );
	} elseif ( $xserver_register_key ) {
		$status = Manager::get_xserver_register_status( $xserver_register_key );
	}

	// Get categofies.
	$block_pattern_categories_transient_name = 'snow-monkey-remote-pattern-categories';
	$block_pattern_categories                = get_transient( $block_pattern_categories_transient_name );
	if ( false === $block_pattern_categories || ! is_array( $block_pattern_categories ) ) {
		$new_block_pattern_categories = snow_monkey_get_remote_block_patten_categories();
		$block_pattern_categories     = is_array( $new_block_pattern_categories )
			? $new_block_pattern_categories
			: array();
		set_transient( $block_pattern_categories_transient_name, $block_pattern_categories, WEEK_IN_SECONDS );
	}

	// Get patterns.
	$premium_block_patterns_transient_name = 'snow-monkey-premium-remote-patterns';
	$premium_block_patterns                = get_transient( $premium_block_patterns_transient_name );
	$free_block_patterns_transient_name    = 'snow-monkey-free-remote-patterns';
	$free_block_patterns                   = get_transient( $free_block_patterns_transient_name );
	$block_patterns                        = array();
	$registry                              = WP_Block_Patterns_Registry::get_instance();

	if ( 'true' === $status ) { // Get premium pattens.
		if ( false === $premium_block_patterns || ! is_array( $premium_block_patterns ) ) {
			$premium_block_patterns = array();

			if ( $license_key ) {
				$premium_block_patterns = snow_monkey_get_premium_remote_block_pattens();
			} elseif ( $xserver_register_key ) {
				$premium_block_patterns = snow_monkey_get_premium_remote_block_pattens_xserver();
			}

			if ( ! is_array( $premium_block_patterns ) ) {
				$premium_block_patterns = array();
			}

			set_transient( $premium_block_patterns_transient_name, $premium_block_patterns, WEEK_IN_SECONDS );
		}

		$block_patterns = $premium_block_patterns;
	} elseif ( 'false' === $status ) { // Get free pattens.
		delete_transient( $premium_block_patterns_transient_name );

		if ( false === $free_block_patterns || ! is_array( $free_block_patterns ) ) {
			$free_block_patterns = snow_monkey_get_free_remote_block_pattens();

			if ( ! is_array( $free_block_patterns ) ) {
				$free_block_patterns = array();
			}

			set_transient( $free_block_patterns_transient_name, $free_block_patterns, WEEK_IN_SECONDS );
		}

		$block_patterns = $free_block_patterns;
	} elseif ( ! empty( $premium_block_patterns ) && is_array( $premium_block_patterns ) ) { // Server error.
		$block_patterns = $premium_block_patterns;
	} elseif ( ! empty( $free_block_patterns ) && is_array( $free_block_patterns ) ) { // Server error.
		$block_patterns = $free_block_patterns;
	}

	// Register pattern categories.
	foreach ( $block_pattern_categories as $block_pattern_category ) {
		register_block_pattern_category(
			$block_pattern_category['name'],
			array(
				'label' => '[Snow Monkey] ' . $block_pattern_category['label'],
			)
		);
	}

	// Register patterns.
	foreach ( $block_patterns as $pattern ) {
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
		$is_registered = $registry->is_registered( $pattern_name );
		if ( ! $is_registered ) {
			register_block_pattern( $pattern_name, (array) $pattern );
		}
	}
}
add_action( 'init', 'snow_monkey_register_remote_block_patterns', 9 );
