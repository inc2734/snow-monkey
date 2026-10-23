<?php
/**
 * License regressions using WordPress HTTP, transient, and registration APIs.
 *
 * @package snow-monkey
 */

use Framework\Controller\Manager;

class LicenseApiTest extends WP_UnitTestCase {

	private $http_response;
	private $requests = array();

	public function set_up() {
		parent::set_up();
		$this->http_response = new WP_Error( 'http_request_failed' );
		add_filter( 'pre_http_request', array( $this, 'mock_http' ), 10, 3 );
	}

	public function tear_down() {
		remove_filter( 'pre_http_request', array( $this, 'mock_http' ), 10 );
		foreach ( array( 'snow-monkey-license-status-', 'snow-monkey-xserver-register-status-' ) as $prefix ) {
			delete_transient( $prefix . 'license-regression-test' );
		}
		foreach ( array( 'snow-monkey-remote-pattern-categories', 'snow-monkey-premium-remote-patterns', 'snow-monkey-free-remote-patterns', 'snow-monkey-remote-styles' ) as $name ) {
			delete_transient( $name );
		}
		parent::tear_down();
	}

	public function mock_http( $preempt, $args, $url ) {
		$this->requests[] = array( $url, $args );
		return $this->http_response;
	}

	public function test_authentication_values_and_expiration() {
		foreach ( array( 'get_license_status', 'get_xserver_register_status' ) as $method ) {
			$prefix = 'get_license_status' === $method ? 'snow-monkey-license-status-' : 'snow-monkey-xserver-register-status-';
			$name   = $prefix . 'license-regression-test';
			foreach ( array(
				array( 200, 'true', 'true', DAY_IN_SECONDS ),
				array( 200, 'false', 'false', DAY_IN_SECONDS ),
				array( 403, '"Failed request."', 'false', DAY_IN_SECONDS ),
				array( 403, '"Blocked."', 'get_license_status' === $method ? 'false' : '403', 'get_license_status' === $method ? DAY_IN_SECONDS : MINUTE_IN_SECONDS ),
				array( 503, 'Unavailable', '503', MINUTE_IN_SECONDS ),
				array( 404, 'Missing', '404', MINUTE_IN_SECONDS ),
				array( 403, '<html>Forbidden</html>', '403', MINUTE_IN_SECONDS ),
				array( 200, '"true"', 'error', MINUTE_IN_SECONDS ),
				array( 200, '{}', 'error', MINUTE_IN_SECONDS ),
			) as list( $code, $body, $expected, $ttl ) ) {
				delete_transient( $name );
				$this->http_response = array( 'response' => array( 'code' => $code ), 'body' => $body );
				$this->assertSame( $expected, Manager::$method( 'license-regression-test' ) );
				$this->assertSame( $expected, get_transient( $name ) );
				$this->assertEqualsWithDelta( time() + $ttl, get_option( '_transient_timeout_' . $name ), 2 );
			}

			$this->http_response = new WP_Error( 'http_request_failed' );
			$this->assertSame( 'error', Manager::$method( 'license-regression-test', true ) );
			$this->assertEqualsWithDelta( time() + MINUTE_IN_SECONDS, get_option( '_transient_timeout_' . $name ), 2 );
			$this->http_response = array( 'response' => array( 'code' => 200 ), 'body' => 'true' );
			set_transient( $name, '503', DAY_IN_SECONDS );
			$this->assertSame( '503', Manager::$method( 'license-regression-test' ) );
			$this->assertSame( 'true', Manager::$method( 'license-regression-test', true ) );
			$this->assertStringContainsString( 'force=1', end( $this->requests )[0] );
		}
	}

	public function test_registration_tolerates_missing_and_malformed_caches_during_outage() {
		update_option( Manager::SETTINGS_NAME, array( 'license-key' => 'license-regression-test' ) );
		set_transient( 'snow-monkey-license-status-license-regression-test', 'error', MINUTE_IN_SECONDS );
		set_transient( 'snow-monkey-remote-pattern-categories', array( false, array() ), WEEK_IN_SECONDS );
		foreach ( array( false, 'broken', array( false, array(), array( 'blockTypes' => false ) ) ) as $cache ) {
			set_transient( 'snow-monkey-remote-styles', $cache, WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-premium-remote-patterns', $cache, WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-free-remote-patterns', $cache, WEEK_IN_SECONDS );
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
		}
		$this->assertSame( array(), $this->requests );
	}
}
