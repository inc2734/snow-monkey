<?php
/**
 * Run with `php tests/license-api.php`. No WordPress installation or network is used.
 *
 * @package snow-monkey
 */

// phpcs:disable -- Minimal WordPress stand-ins for isolated regression tests.
namespace Inc2734\WP_GitHub_Theme_Updater {
	class Bootstrap {
		public function __construct( ...$args ) {}
	}
}

namespace {
	use Framework\Controller\Manager;

	const MINUTE_IN_SECONDS = 60;
	const DAY_IN_SECONDS = 86400;
	const WEEK_IN_SECONDS = 604800;
	define( 'ABSPATH', dirname( __DIR__, 4 ) . '/' );
	define( 'WP_CONTENT_URL', 'https://example.test/wp-content' );
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
	$wp_version = '7.1';
	$state = array();
	$hooks = array();
	$assertions = 0;

	class WP_Error {
		public $code;
		public $message;
		public $data;
		public function __construct( $code = '', $message = '', $data = null ) { $this->code = $code; $this->message = $message; $this->data = $data; }
		public function get_error_code() { return $this->code; }
		public function get_error_data() { return $this->data; }
	}
	class WP_Block_Styles_Registry { public static function get_instance() { return new self(); } }
	class WP_Block_Patterns_Registry {
		public static function get_instance() { return new self(); }
		public function is_registered( $name ) { return false; }
	}
	function __( $text, $domain = '' ) { return $text; }
	function add_action( $hook, $callback, $priority = 10, $accepted = 1 ) { $GLOBALS['hooks'][ $hook ][ $priority ][] = $callback; }
	function add_filter( ...$args ) { add_action( ...$args ); }
	function do_action( $hook ) { apply_filters( $hook, null ); }
	function apply_filters( $hook, $value, ...$args ) {
		$callbacks = $GLOBALS['hooks'][ $hook ] ?? array();
		ksort( $callbacks );
		foreach ( $callbacks as $items ) {
			foreach ( $items as $callback ) { $value = $callback( $value, ...$args ); }
		}
		return $value;
	}
	function register_uninstall_hook( ...$args ) {}
	function register_setting( $group, $name, $callback ) { $GLOBALS['sanitize_settings'] = $callback; }
	function add_settings_section( ...$args ) {}
	function add_settings_field( $id, $label, $callback, ...$args ) { $GLOBALS['fields'][ $id ] = $callback; }
	function add_settings_error( $setting, $code, $message, $type = 'error' ) { $GLOBALS['state']['errors'][] = array( $code, $message, $type ); }
	function get_option( $name, $default = false ) { return $GLOBALS['state']['options'][ $name ] ?? $default; }
	function update_option( $name, $value ) { $GLOBALS['state']['options'][ $name ] = $value; }
	function admin_url( $path = '' ) { return 'https://example.test/wp-admin/' . ltrim( $path, '/' ); }
	function esc_attr( $value ) { return htmlspecialchars( $value, ENT_QUOTES ); }
	function esc_html_e( $value, $domain = '' ) { echo esc_html( $value ); }
	function esc_html__( $value, $domain = '' ) { return esc_html( $value ); }
	function wp_admin_notice( $message, $args ) { $GLOBALS['state']['notices'][] = array( $message, $args ); }
	function get_current_screen() { return (object) array( 'id' => 'dashboard' ); }
	function wp_date( $format, ...$args ) { return '2026-10-23'; }
	function untrailingslashit( $value ) { return rtrim( $value, '/' ); }
	function get_theme_file_uri( $path ) { return 'https://example.test/theme/' . $path; }
	function is_multisite() { return false; }
	function snow_monkey_test_get_styles( &$success = null ) { return _snow_monkey_get_remote_block_styles( 'https://example.test/styles/', array(), $success ); }

	function current_user_can( $cap ) { return $GLOBALS['state']['allowed']; }
	function wp_unslash( $value ) { return $value; }
	function esc_html( $value ) { return $value; }
	function sanitize_key( $value ) { return $value; }
	function trailingslashit( $value ) { return rtrim( $value, '/' ) . '/'; }
	function is_admin() { return $GLOBALS['state']['admin']; }
	function wp_should_load_block_assets_on_demand() { return true; }
	function wp_get_theme( $template = '' ) { return new class { public function get( $name ) { return '28.9.1'; } }; }
	function get_template() { return 'snow-monkey'; }
	function home_url() { return 'https://example.test'; }
	function get_locale() { return 'ja'; }
	function add_query_arg( $args, $url ) { return $url . '?' . http_build_query( $args ); }
	function is_wp_error( $value ) { return $value instanceof WP_Error; }
	function wp_remote_retrieve_body( $response ) { return $response['body']; }
	function wp_remote_retrieve_response_code( $response ) { return $response['code']; }
	function wp_remote_get( $url, $args ) {
		$GLOBALS['state']['requests'][] = array( $url, $args );
		return '' === $url ? new WP_Error( 'http_request_failed' ) : call_user_func( $GLOBALS['state']['http'], $url );
	}
	function wp_remote_head( $url, $args ) { return array( 'code' => 200, 'body' => '' ); }
	function get_transient( $name ) {
		$entry = $GLOBALS['state']['cache'][ $name ] ?? null;
		return $entry && $entry['until'] > $GLOBALS['state']['now'] ? $entry['value'] : false;
	}
	function set_transient( $name, $value, $ttl ) {
		$GLOBALS['state']['cache'][ $name ] = array( 'value' => $value, 'until' => $GLOBALS['state']['now'] + $ttl, 'ttl' => $ttl );
		return true;
	}
	function delete_transient( $name ) { unset( $GLOBALS['state']['cache'][ $name ] ); return true; }
	function register_block_style( $types, $style ) { $GLOBALS['state']['styles'][] = $style; $GLOBALS['state']['style_types'][] = $types; }
	function register_block_pattern( $name, $pattern ) { $GLOBALS['state']['patterns'][] = $pattern; }
	function register_block_pattern_category( $name, $category ) { $GLOBALS['state']['categories'][] = $category; }

	$root = dirname( __DIR__ );
	$original_display = ini_get( 'display_errors' );
	$original_reporting = error_reporting();
	$original_logging = ini_get( 'log_errors' );
	require $root . '/Framework/Controller/Manager.php';
	require $root . '/app/setup/remote-block-styles.php';
	require $root . '/app/setup/remote-block-patterns.php';
	require $root . '/vendor/inc2734/wp-github-theme-updater/src/App/Model/Requester.php';
	require $root . '/vendor/inc2734/wp-github-theme-updater/src/App/Model/GitHubReleases.php';
	require $root . '/app/constructor/updater.php';
	require $root . '/app/constructor/manager.php';

	$reset = static function () use ( &$state ) {
		$state = array(
			'now' => 1000, 'cache' => array(), 'requests' => array(), 'styles' => array(), 'patterns' => array(), 'categories' => array(),
			'admin' => true, 'allowed' => true,
			'http' => static function ( $url ) { return array( 'code' => 200, 'body' => false !== strpos( $url, '/validate' ) ? 'true' : '[]' ); },
		);
		$state['options'] = array( Manager::SETTINGS_NAME => array( 'license-key' => 'test-key', 'xserver-register-key' => '' ), 'active_plugins' => array( 'example/example.php' ) );
		$state['errors'] = $state['notices'] = array();
		$_SERVER['REQUEST_URI'] = '/wp-admin/options.php';
	};
	$equal = static function ( $expected, $actual ) use ( &$assertions ) {
		++$assertions;
		if ( $expected !== $actual ) { throw new RuntimeException( 'Expected ' . var_export( $expected, true ) . ', got ' . var_export( $actual, true ) ); }
	};
	$fail_on_warning = static function ( $severity, $message, $file, $line ) { throw new ErrorException( $message, 0, $severity, $file, $line ); };
	set_error_handler( $fail_on_warning );

	try {
		// Normal decisions last a day; transport, HTTP, and payload failures last one minute.
		foreach ( array(
			array( 200, 'true', 'true', DAY_IN_SECONDS ), array( 200, " false\n", 'false', DAY_IN_SECONDS ),
			array( 403, '"Blocked."', 'false', DAY_IN_SECONDS ), array( 403, '"Failed request."', 'false', DAY_IN_SECONDS ),
			array( 503, 'Unavailable', '503', MINUTE_IN_SECONDS ), array( 500, 'Error', '500', MINUTE_IN_SECONDS ),
			array( 404, 'Missing', '404', MINUTE_IN_SECONDS ), array( 429, 'Slow down', '429', MINUTE_IN_SECONDS ), array( 403, 'Forbidden', '403', MINUTE_IN_SECONDS ),
			array( 403, '<html>Forbidden</html>', '403', MINUTE_IN_SECONDS ), array( 403, '"Forbidden"', '403', MINUTE_IN_SECONDS ),
			array( 200, '<html>Error</html>', 'error', MINUTE_IN_SECONDS ), array( 200, '"true"', 'error', MINUTE_IN_SECONDS ),
			array( 200, 'null', 'error', MINUTE_IN_SECONDS ), array( 200, '{}', 'error', MINUTE_IN_SECONDS ),
			array( 200, '0', 'error', MINUTE_IN_SECONDS ),
		) as list( $code, $body, $expected, $ttl ) ) {
			$reset();
			$state['http'] = static function () use ( $code, $body ) { return array( 'code' => $code, 'body' => $body ); };
			$equal( $expected, Manager::get_license_status( 'test-key' ) );
			$cache_name = 'snow-monkey-license-status-test-key';
			$equal( $ttl, $state['cache'][ $cache_name ]['ttl'] );
			$equal( $expected, get_transient( $cache_name ) );
			$equal( array( $cache_name ), array_keys( $state['cache'] ) );
			$equal( $expected, Manager::get_license_status( 'test-key' ) );
			$equal( 1, count( $state['requests'] ) );
		}
		$reset();
		$state['http'] = static function () { return new WP_Error( 'timeout' ); };
		$equal( 'error', Manager::get_license_status( 'test-key' ) );
		$equal( MINUTE_IN_SECONDS, $state['cache']['snow-monkey-license-status-test-key']['ttl'] );
		$equal( 'false', Manager::get_license_status( '' ) );
		$equal( 1, count( $state['requests'] ) );
		$state['http'] = static function () { return array( 'code' => 200, 'body' => 'true' ); };
		$equal( 'error', Manager::get_license_status( 'test-key' ) );
		$state['now'] += 61;
		$equal( 1, count( $state['requests'] ) );
		$equal( 'true', Manager::get_license_status( 'test-key' ) );
		$equal( 'true', get_transient( 'snow-monkey-license-status-test-key' ) );

		// Preserve existing cache values; explicit reauthentication also bypasses old day-long errors.
		foreach ( array( 'true', 'false', '503' ) as $legacy ) {
			$reset();
			set_transient( 'snow-monkey-license-status-test-key', $legacy, DAY_IN_SECONDS );
			$equal( $legacy, Manager::get_license_status( 'test-key' ) );
			$equal( 0, count( $state['requests'] ) );
			$equal( 'true', Manager::get_license_status( 'test-key', true ) );
		}
		$reset();
		set_transient( 'snow-monkey-license-status-test-key', 'false', DAY_IN_SECONDS );
		$equal( 'true', Manager::get_license_status( 'test-key', true ) );
		$equal( true, false !== strpos( $state['requests'][0][0], 'force=1' ) );
		$equal( 'true', get_transient( 'snow-monkey-license-status-test-key' ) );
		$reset();
		set_transient( 'snow-monkey-license-status-test-key', 'error', MINUTE_IN_SECONDS );
		$equal( 'true', Manager::get_license_status( 'test-key', true ) );
		$equal( 'true', get_transient( 'snow-monkey-license-status-test-key' ) );

		// Failed libraries use their existing cache keys for one minute, including empty results.
		foreach ( array( 'true', 'false' ) as $status ) {
			$reset();
			set_transient( 'snow-monkey-license-status-test-key', $status, DAY_IN_SECONDS );
			$state['http'] = static function () { return array( 'code' => 503, 'body' => 'Unavailable' ); };
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
			$names = array( 'snow-monkey-remote-pattern-categories', 'true' === $status ? 'snow-monkey-premium-remote-patterns' : 'snow-monkey-free-remote-patterns' );
			if ( 'true' === $status ) { $names[] = 'snow-monkey-remote-styles'; }
			foreach ( $names as $name ) {
				$equal( array(), get_transient( $name ) );
				$equal( MINUTE_IN_SECONDS, $state['cache'][ $name ]['ttl'] );
			}
			$equal( count( $names ) + 1, count( $state['cache'] ) );
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
			$equal( count( $names ), count( $state['requests'] ) );
			$state['now'] += 61;
			$equal( count( $names ), count( $state['requests'] ) );
			$state['http'] = static function () { return array( 'code' => 200, 'body' => '[]' ); };
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
			$equal( count( $names ) * 2, count( $state['requests'] ) );
			foreach ( $names as $name ) {
				$equal( array(), get_transient( $name ) );
				$equal( WEEK_IN_SECONDS, $state['cache'][ $name ]['ttl'] );
			}
		}

		// Both registration branches tolerate missing and malformed caches during an outage.
		foreach ( array( true, false ) as $admin ) {
			$reset();
			$state['admin'] = $admin;
			set_transient( 'snow-monkey-license-status-test-key', 'error', MINUTE_IN_SECONDS );
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
			$equal( array(), $state['styles'] );
			$equal( array(), $state['patterns'] );
			set_transient( 'snow-monkey-remote-styles', array( false, 'broken', array( 'name' => 'bad', 'blockTypes' => 'core-paragraph' ) ), WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-premium-remote-patterns', array( false, 'broken', array() ), WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-remote-pattern-categories', array( false, 'broken', array() ), WEEK_IN_SECONDS );
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
			$equal( array(), $state['styles'] );
			$equal( array(), $state['patterns'] );
		}
		$reset();
		$style = array( 'name' => 'test', 'label' => 'Test', 'inline_style' => 'color:red;', 'blockTypes' => array( 'core-paragraph' ) );
		$pattern = array( 'slug' => 'test', 'title' => 'Test', 'content' => '<!-- wp:paragraph --><p>Test</p><!-- /wp:paragraph -->' );
		set_transient( 'snow-monkey-license-status-test-key', 'error', MINUTE_IN_SECONDS );
		set_transient( 'snow-monkey-remote-styles', array( $style ), WEEK_IN_SECONDS );
		set_transient( 'snow-monkey-premium-remote-patterns', array( $pattern ), WEEK_IN_SECONDS );
		set_transient( 'snow-monkey-remote-pattern-categories', array(), WEEK_IN_SECONDS );
		snow_monkey_register_remote_block_styles();
		snow_monkey_register_remote_block_patterns();
		$equal( array( $style ), $state['styles'] );
		$equal( array( $pattern ), $state['patterns'] );
		$equal( 0, count( $state['requests'] ) );

		// Successful requests still register data and cache it for a week.
		$reset();
		$state['http'] = static function ( $url ) use ( $style, $pattern ) {
			if ( false !== strpos( $url, '/validate/' ) ) { return array( 'code' => 200, 'body' => 'true' ); }
			if ( false !== strpos( $url, '/styles/' ) ) { $data = array( $style ); }
			elseif ( false !== strpos( $url, '/pattern-categories/' ) ) { $data = array( array( 'slug' => 'test', 'name' => 'Test' ) ); }
			else { $data = array( $pattern ); }
			return array( 'code' => 200, 'body' => json_encode( $data ) );
		};
		snow_monkey_register_remote_block_styles();
		snow_monkey_register_remote_block_patterns();
		$equal( 1440, $state['styles'][0]['viewportWidth'] );
		$equal( 1440, $state['patterns'][0]['viewportWidth'] );
		$equal( '[Snow Monkey] Test', $state['categories'][0]['label'] );
		$equal( WEEK_IN_SECONDS, $state['cache']['snow-monkey-remote-styles']['ttl'] );
		$equal( WEEK_IN_SECONDS, $state['cache']['snow-monkey-premium-remote-patterns']['ttl'] );
		$equal( 4, count( $state['requests'] ) );

		$reset();
		set_transient( 'snow-monkey-license-status-test-key', 'false', DAY_IN_SECONDS );
		set_transient( 'snow-monkey-premium-remote-patterns', array( $pattern ), WEEK_IN_SECONDS );
		snow_monkey_register_remote_block_styles();
		snow_monkey_register_remote_block_patterns();
		$equal( array(), $state['styles'] );
		$equal( false, get_transient( 'snow-monkey-premium-remote-patterns' ) );

		// Existing PHP getters always return arrays, including failures and malformed responses.
		foreach ( array( 'false', 'null', '<html>Error</html>', '["broken"]', '[{}]' ) as $body ) {
			$reset();
			$state['http'] = static function () use ( $body ) { return array( 'code' => 200, 'body' => $body ); };
			foreach ( array( 'snow_monkey_test_get_styles', 'snow_monkey_get_premium_remote_block_pattens', 'snow_monkey_get_free_remote_block_pattens', 'snow_monkey_get_remote_block_patten_categories' ) as $getter ) {
				$equal( array(), $getter() );
			}
			$equal( array(), _snow_monkey_get_remote_block_styles( 'https://example.test/styles' ) );
			$equal( array(), _snow_monkney_get_remote_block_patterns( 'https://example.test/patterns' ) );
			foreach ( array( 'snow_monkey_test_get_styles', 'snow_monkey_get_premium_remote_block_pattens', 'snow_monkey_get_free_remote_block_pattens', 'snow_monkey_get_remote_block_patten_categories' ) as $getter ) {
				$success = true;
				$equal( array(), $getter( $success ) );
				$equal( false, $success );
			}
		}
		foreach ( array( '[]', '{}' ) as $body ) {
			$reset();
			$state['http'] = static function () use ( $body ) { return array( 'code' => 200, 'body' => $body ); };
			foreach ( array( 'snow_monkey_test_get_styles', 'snow_monkey_get_premium_remote_block_pattens', 'snow_monkey_get_free_remote_block_pattens', 'snow_monkey_get_remote_block_patten_categories' ) as $getter ) {
				$success = false;
				$equal( array(), $getter( $success ) );
				$equal( true, $success );
			}
		}
		$reset();
		$state['http'] = static function () { return array( 'code' => 503, 'body' => 'Unavailable' ); };
		$equal( array(), snow_monkey_test_get_styles() );
		$equal( array(), snow_monkey_get_premium_remote_block_pattens() );
		$equal( array(), snow_monkey_get_free_remote_block_pattens() );
		$equal( array(), snow_monkey_get_remote_block_patten_categories() );

		// Keep valid entries and their collection keys when malformed entries are mixed in.
		$reset();
		$state['http'] = static function ( $url ) use ( $style, $pattern ) {
			if ( false !== strpos( $url, '/validate/' ) ) { return array( 'code' => 200, 'body' => 'true' ); }
			if ( false !== strpos( $url, '/styles/' ) ) { $data = array( 'bad' => array( 'name' => 'bad' ), 'valid' => $style ); }
			elseif ( false !== strpos( $url, '/pattern-categories/' ) ) { $data = array( false, array( 'slug' => 'test', 'name' => 'Test' ), array() ); }
			else { $data = array( 'bad' => array( 'slug' => 'bad', 'content' => '' ), 'valid' => $pattern ); }
			return array( 'code' => 200, 'body' => json_encode( $data ) );
		};
		snow_monkey_register_remote_block_styles();
		snow_monkey_register_remote_block_patterns();
		$equal( 1, count( $state['styles'] ) );
		$equal( 1, count( $state['patterns'] ) );
		$equal( 1, count( $state['categories'] ) );
		$equal( 'test', $state['styles'][0]['name'] );
		$equal( 'test', $state['patterns'][0]['slug'] );
		$equal( array( 'valid' ), array_keys( get_transient( 'snow-monkey-remote-styles' ) ) );
		$equal( array( 'valid' ), array_keys( get_transient( 'snow-monkey-premium-remote-patterns' ) ) );
		$equal( WEEK_IN_SECONDS, $state['cache']['snow-monkey-remote-styles']['ttl'] );

		// Entirely malformed libraries are briefly cached as failures, not as valid empty libraries.
		$reset();
		set_transient( 'snow-monkey-license-status-test-key', 'true', DAY_IN_SECONDS );
		$state['http'] = static function () { return array( 'code' => 200, 'body' => '[{}]' ); };
		snow_monkey_register_remote_block_styles();
		snow_monkey_register_remote_block_patterns();
		foreach ( array( 'snow-monkey-remote-styles', 'snow-monkey-remote-pattern-categories', 'snow-monkey-premium-remote-patterns' ) as $name ) {
			$equal( array(), get_transient( $name ) );
			$equal( MINUTE_IN_SECONDS, $state['cache'][ $name ]['ttl'] );
		}

		// Explicit denials disable premium data; an unrelated proxy's 403 preserves existing data.
		foreach ( array( '"Blocked."', '"Failed request."', '<html>Forbidden</html>' ) as $body ) {
			$reset();
			$state['http'] = static function () use ( $body ) { return array( 'code' => 403, 'body' => $body ); };
			set_transient( 'snow-monkey-remote-styles', array( $style ), WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-premium-remote-patterns', array( $pattern ), WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-remote-pattern-categories', array(), WEEK_IN_SECONDS );
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
			$unknown = '<html>Forbidden</html>' === $body;
			$equal( $unknown ? array( $style ) : array(), $state['styles'] );
			$equal( $unknown ? array( $pattern ) : array(), $state['patterns'] );
			$equal( $unknown ? array( $pattern ) : false, get_transient( 'snow-monkey-premium-remote-patterns' ) );
		}

		// Cached collections and fetched collections share the same item validation.
		foreach ( array( true, false ) as $admin ) {
			foreach ( array( null, 42, 'broken', (object) array(), array( false, 'broken', array() ) ) as $bad_cache ) {
				$reset();
				$state['admin'] = $admin;
				set_transient( 'snow-monkey-license-status-test-key', 'error', MINUTE_IN_SECONDS );
				set_transient( 'snow-monkey-remote-styles', $bad_cache, WEEK_IN_SECONDS );
				set_transient( 'snow-monkey-premium-remote-patterns', $bad_cache, WEEK_IN_SECONDS );
				set_transient( 'snow-monkey-free-remote-patterns', $bad_cache, WEEK_IN_SECONDS );
				set_transient( 'snow-monkey-remote-pattern-categories', array( false, 'broken', array() ), WEEK_IN_SECONDS );
				snow_monkey_register_remote_block_styles();
				snow_monkey_register_remote_block_patterns();
				$equal( array(), $state['styles'] );
				$equal( array(), $state['patterns'] );
				$equal( 0, count( $state['requests'] ) );
			}
			$reset();
			$state['admin'] = $admin;
			set_transient( 'snow-monkey-license-status-test-key', 'error', MINUTE_IN_SECONDS );
			set_transient( 'snow-monkey-remote-styles', array( false, $style, array( 'blockTypes' => array( array() ) ) ), WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-premium-remote-patterns', array( null, $pattern, array_merge( $pattern, array( 'requiredPlugins' => false ) ) ), WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-remote-pattern-categories', array( false, array( 'name' => 'test', 'label' => 'Test' ), array( 'label' => array() ) ), WEEK_IN_SECONDS );
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
			$equal( array( $style ), $state['styles'] );
			$equal( array( $pattern ), $state['patterns'] );
			$equal( 1, count( $state['categories'] ) );
			$equal( 0, count( $state['requests'] ) );
		}

		// Snow Monkey retains its button aliases, image conversion, and free-category exclusion.
		$reset();
		set_transient( 'snow-monkey-license-status-test-key', 'true', DAY_IN_SECONDS );
		set_transient( 'snow-monkey-remote-styles', array( array_merge( $style, array( 'blockTypes' => array( 'core-button', 'snow-monkey-blocks-box' ) ) ) ), WEEK_IN_SECONDS );
		snow_monkey_register_remote_block_styles();
		$equal( array( 'core/button', 'snow-monkey-blocks/box', 'snow-monkey-blocks/btn' ), $state['style_types'][0] );
		$state['http'] = static function () { return array( 'code' => 200, 'body' => '[{"slug":"free","name":"Free"}]' ); };
		$equal( array(), snow_monkey_get_remote_block_patten_categories( $success ) );
		$equal( true, $success );
		$state['http'] = static function () use ( $pattern ) { return array( 'code' => 200, 'body' => json_encode( array( array_merge( $pattern, array( 'content' => '<img src="https://snow-monkey.2inc.org/wp-content/uploads/missing.jpg">' ) ) ) ) ); };
		$data = snow_monkey_get_premium_remote_block_pattens( $success );
		$equal( '<img src="https://example.test/theme/assets/img/dummy.jpg">', $data[0]['content'] );
		$equal( true, $success );
		foreach ( array( 'requiredPlugins', 'categories', 'keywords', 'blockTypes', 'postTypes', 'templateTypes' ) as $key ) {
			$equal( false, _snow_monkey_is_valid_remote_block_pattern( array_merge( $pattern, array( $key => array( array() ) ) ) ) );
		}

		// XServer licenses enable premium patterns, while styles continue to require a regular key.
		foreach ( array( 'true', 'false', 'error' ) as $status ) {
			$reset();
			update_option( Manager::SETTINGS_NAME, array( 'license-key' => '', 'xserver-register-key' => 'xserver-key' ) );
			set_transient( 'snow-monkey-xserver-register-status-xserver-key', $status, DAY_IN_SECONDS );
			set_transient( 'snow-monkey-premium-remote-patterns', array( $pattern ), WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-free-remote-patterns', array(), WEEK_IN_SECONDS );
			set_transient( 'snow-monkey-remote-pattern-categories', array(), WEEK_IN_SECONDS );
			snow_monkey_register_remote_block_styles();
			snow_monkey_register_remote_block_patterns();
			$equal( array(), $state['styles'] );
			$equal( 'false' === $status ? array() : array( $pattern ), $state['patterns'] );
			$equal( 'false' === $status ? false : array( $pattern ), get_transient( 'snow-monkey-premium-remote-patterns' ) );
		}
		$reset();
		update_option( Manager::SETTINGS_NAME, array( 'xserver-register-key' => 'xserver-key' ) );
		snow_monkey_register_remote_block_patterns();
		$equal( true, false !== strpos( $state['requests'][0][0], '/validate-xserver/' ) );
		$equal( 'xserver-key', $state['requests'][0][1]['headers']['X-Snow-Monkey-Xserver-Register-Key'] );
		$equal( true, false !== strpos( $state['requests'][2][0], '/patterns-xserver/' ) );
		$equal( 'xserver-key', $state['requests'][2][1]['headers']['X-Snow-Monkey-Xserver-Register-Key'] );

		// Settings API recovery keeps options editable during an outage and validates both credentials.
		$reset();
		( new Manager() )->_init();
		$save = static function ( $values ) {
			$result = $GLOBALS['sanitize_settings']( $values );
			update_option( Manager::SETTINGS_NAME, $result );
			return $result;
		};
		$library_names = array( 'snow-monkey-remote-pattern-categories', 'snow-monkey-remote-patterns', 'snow-monkey-premium-remote-patterns', 'snow-monkey-free-remote-patterns', 'snow-monkey-remote-styles' );
		foreach ( array( 'license-key', 'xserver-register-key' ) as $credential ) {
			$method = 'license-key' === $credential ? 'get_license_status' : 'get_xserver_register_status';
			$prefix = 'license-key' === $credential ? 'snow-monkey-license-status-' : 'snow-monkey-xserver-register-status-';
			foreach ( array(
				array( 200, 'true', 'true', DAY_IN_SECONDS ), array( 200, 'false', 'false', DAY_IN_SECONDS ),
				array( 403, '"Failed request."', 'false', DAY_IN_SECONDS ),
				array( 403, '"Blocked."', 'license-key' === $credential ? 'false' : '403', 'license-key' === $credential ? DAY_IN_SECONDS : MINUTE_IN_SECONDS ),
				array( 403, '<html>Forbidden</html>', '403', MINUTE_IN_SECONDS ), array( 404, 'Missing', '404', MINUTE_IN_SECONDS ),
				array( 503, 'Unavailable', '503', MINUTE_IN_SECONDS ), array( 200, '"true"', 'error', MINUTE_IN_SECONDS ),
				array( 200, 'null', 'error', MINUTE_IN_SECONDS ), array( 200, '{}', 'error', MINUTE_IN_SECONDS ),
			) as list( $code, $body, $expected, $ttl ) ) {
				$reset();
				$state['http'] = static function () use ( $code, $body ) { return array( 'code' => $code, 'body' => $body ); };
				$equal( $expected, Manager::$method( 'test-key' ) );
				$equal( $ttl, $state['cache'][ $prefix . 'test-key' ]['ttl'] );
				$equal( $expected, Manager::$method( 'test-key' ) );
				$equal( 1, count( $state['requests'] ) );
			}
			$reset();
			$state['http'] = static function () { return new WP_Error( 'timeout' ); };
			$equal( 'error', Manager::$method( 'test-key' ) );
			$equal( 'false', Manager::$method( array() ) );
			set_transient( $prefix . 'test-key', array( 'bad' ), DAY_IN_SECONDS );
			$equal( 'error', Manager::$method( 'test-key' ) );

			$reset();
			update_option( Manager::SETTINGS_NAME, array( $credential => 'test-key' ) );
			foreach ( $library_names as $name ) { set_transient( $name, array( 'existing' ), WEEK_IN_SECONDS ); }
			set_transient( $prefix . 'test-key', '503', DAY_IN_SECONDS );
			$save( array( $credential => Manager::SAVED_VALUE ) );
			$equal( 'test-key', Manager::get_option( $credential ) );
			$equal( 'true', get_transient( $prefix . 'test-key' ) );
			$equal( true, false !== strpos( $state['requests'][0][0], 'force=1' ) );
			foreach ( $library_names as $name ) { $equal( false, get_transient( $name ) ); }

			// A changed key is saved even if verification fails, without discarding usable data.
			foreach ( $library_names as $name ) { set_transient( $name, array( 'existing' ), WEEK_IN_SECONDS ); }
			set_transient( $prefix . 'new-key', '503', DAY_IN_SECONDS );
			$state['http'] = static function () { return new WP_Error( 'timeout' ); };
			$save( array( $credential => 'new-key' ) );
			$equal( 'new-key', Manager::get_option( $credential ) );
			$equal( false, get_transient( $prefix . 'test-key' ) );
			$equal( 'error', get_transient( $prefix . 'new-key' ) );
			$equal( MINUTE_IN_SECONDS, $state['cache'][ $prefix . 'new-key' ]['ttl'] );
			foreach ( $library_names as $name ) { $equal( array( 'existing' ), get_transient( $name ) ); }
			$equal( 'warning', end( $state['errors'] )[2] );

			// Manual deletion and reset are local operations, even during a server outage.
			$state['requests'] = array();
			$save( array( 'clear-remote-patterns-cache' => '1' ) );
			$equal( 'new-key', Manager::get_option( $credential ) );
			foreach ( $library_names as $name ) { $equal( false, get_transient( $name ) ); }
			$equal( 0, count( $state['requests'] ) );
			$save( array( 'reset' => '1' ) );
			$equal( array(), get_option( Manager::SETTINGS_NAME ) );
			$equal( false, get_transient( $prefix . 'new-key' ) );
			$equal( 0, count( $state['requests'] ) );

			// Malformed settings remain retryable; successful retry clears library caches.
			$reset();
			$before = get_option( Manager::SETTINGS_NAME );
			$equal( $before, $save( array( $credential => array() ) ) );
			$equal( 'Invalid license key.', end( $state['errors'] )[1] );
			$save( array( $credential => 'recovered' ) );
			$equal( 'recovered', Manager::get_option( $credential ) );
			$equal( 'true', get_transient( $prefix . 'recovered' ) );
		}

		$reset();
		update_option( Manager::SETTINGS_NAME, array( 'xserver-register-key' => 'old-xserver' ) );
		set_transient( 'snow-monkey-xserver-register-status-old-xserver', 'true', DAY_IN_SECONDS );
		$save( array( 'license-key' => 'new-key', 'xserver-register-key' => Manager::SAVED_VALUE ) );
		$equal( false, get_transient( 'snow-monkey-xserver-register-status-old-xserver' ) );
		$equal( '', Manager::get_option( 'xserver-register-key' ) );
		$equal( 'true', get_transient( 'snow-monkey-license-status-new-key' ) );

		// Unknown verification is rendered separately from the ordinary enabled/disabled state.
		foreach ( array( 'license-key', 'xserver-register-key' ) as $credential ) {
			$reset();
			update_option( Manager::SETTINGS_NAME, array( $credential => 'test-key' ) );
			$state['http'] = static function () { return new WP_Error( 'timeout' ); };
			ob_start(); $fields[ $credential ](); $html = ob_get_clean();
			$equal( true, false !== strpos( $html, 'Could not verify the license. Please try again shortly.' ) );
			$equal( false, false !== strpos( $html, '>Disable</span>' ) );
			do_action( 'admin_notices' );
			$equal( 'warning', $state['notices'][0][1]['type'] );
			$equal( 'Could not verify the license. Please try again shortly.', $state['notices'][0][0] );
		}

		// The update client converts authentication and response failures into WP_Error.
		foreach ( array( 'false', 'error', '503' ) as $status ) {
			$reset();
			set_transient( 'snow-monkey-license-status-test-key', $status, MINUTE_IN_SECONDS );
			$client = new \Inc2734\WP_GitHub_Theme_Updater\App\Model\GitHubReleases( 'snow-monkey', 'inc2734', 'snow-monkey' );
			$equal( true, is_wp_error( $client->get() ) );
		}
		foreach ( array( array( 503, 'Unavailable' ), array( 200, 'false' ), array( 200, '<html>Error</html>' ) ) as list( $code, $body ) ) {
			$reset();
			set_transient( 'snow-monkey-license-status-test-key', 'true', DAY_IN_SECONDS );
			$state['http'] = static function () use ( $code, $body ) { return array( 'code' => $code, 'body' => $body ); };
			$client = new \Inc2734\WP_GitHub_Theme_Updater\App\Model\GitHubReleases( 'snow-monkey', 'inc2734', 'snow-monkey' );
			$equal( true, is_wp_error( $client->get() ) );
		}

		// Update URL and header contracts stay unchanged for both kinds of credentials.
		foreach ( array( 'license-key', 'xserver-register-key' ) as $credential ) {
			$reset();
			update_option( Manager::SETTINGS_NAME, array( $credential => 'test-key' ) );
			$prefix = 'license-key' === $credential ? 'snow-monkey-license-status-' : 'snow-monkey-xserver-register-status-';
			$endpoint = 'license-key' === $credential ? '/update/' : '/update-xserver/';
			$header = 'license-key' === $credential ? 'X-Snow-Monkey-License-Key' : 'X-Snow-Monkey-Xserver-Register-Key';
			set_transient( $prefix . 'test-key', 'true', DAY_IN_SECONDS );
			$state['http'] = static function () { return array( 'code' => 200, 'body' => '{"tag_name":"1.0","assets":[{"browser_download_url":"https://snow-monkey.2inc.org/theme.zip"}]}' ); };
			$client = new \Inc2734\WP_GitHub_Theme_Updater\App\Model\GitHubReleases( 'snow-monkey', 'inc2734', 'snow-monkey' );
			$result = $client->get();
			$equal( 'https://snow-monkey.2inc.org/theme.zip', $result->package );
			$equal( true, false !== strpos( $state['requests'][0][0], $endpoint ) );
			$equal( 'test-key', $state['requests'][0][1]['headers'][ $header ] );
		}
		foreach ( array( null, false, array(), (object) array(), 123, 'https://github.com/theme.zip' ) as $url ) {
			$equal( false, apply_filters( 'inc2734_github_theme_updater_zip_url_inc2734/snow-monkey', $url ) );
		}

		// Source-level guards must not alter PHP error display or reporting for any request.
		$equal( false, function_exists( 'snow_monkey_is_rest_api_request' ) );
		do_action( 'after_setup_theme' );
		$equal( $original_display, ini_get( 'display_errors' ) );
		$equal( $original_reporting, error_reporting() );
		$equal( $original_logging, ini_get( 'log_errors' ) );

		echo 'License/API regressions passed (' . $assertions . " assertions).\n";
	} finally {
		restore_error_handler();
	}
}
