<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

/**
 * Get remote block patterns.
 *
 * @return array
 */
function snow_monkey_get_remote_block_pattens() {
	global $wp_version;

	$license_key          = \Framework\Controller\Manager::get_option( 'license-key' );
	$xserver_register_key = \Framework\Controller\Manager::get_option( 'xserver-register-key' );

	$url = 'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/free-patterns/';
	if ( $license_key ) {
		$url = sprintf(
			'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/patterns/%1$s',
			esc_attr( $license_key )
		);
	} elseif ( $xserver_register_key ) {
		$url = sprintf(
			'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/patterns-xserver/%1$s',
			esc_attr( $xserver_register_key )
		);
	}

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
			WP_CONTENT_URL,
			$pattern['content'],
		);

		$patterns[ $key ]['viewportWidth'] = 1440;
	}

	return $patterns;
}

/**
 * Register remote block patterns.
 * This requires a valid license key.
 */
function snow_monkey_register_remote_block_patterns() {
	if ( ! empty( $_SERVER['REQUEST_URI'] ) ) {
		if ( false !== strpos( $_SERVER['REQUEST_URI'], 'wp-json/snow-monkey-license-manager' ) ) {
			return;
		}
	}

	$transient_name = 'snow-monkey-remote-patterns';
	$transient      = get_transient( $transient_name );
	$transient = false;
	if ( false !== $transient ) {
		$remote_block_patterns = $transient;
	} else {
		$remote_block_patterns = snow_monkey_get_remote_block_pattens();
		set_transient( $transient_name, $remote_block_patterns, 60 * 10 );
	}

	$registry = WP_Block_Patterns_Registry::get_instance();

	foreach ( $remote_block_patterns as $pattern ) {
		if ( ! $pattern['title'] || ! $pattern['slug'] || ! $pattern['content'] ) {
			continue;
		}

		$pattern_name = esc_html( $pattern['slug'] );
		// Some patterns might be already registered as core patterns with the `core` prefix.
		$is_registered = $registry->is_registered( $pattern_name ) || $registry->is_registered( $pattern_name );
		if ( ! $is_registered ) {
			register_block_pattern( $pattern_name, (array) $pattern );
		}
	}
}
add_action( 'init', 'snow_monkey_register_remote_block_patterns' );
