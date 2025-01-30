<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.6.0
 */

namespace Framework\Controller;

class Manager {

	/**
	 * Setting page slug.
	 *
	 * @var string
	 */
	const MENU_SLUG = 'snow-monkey';

	/**
	 * Available settings name.
	 *
	 * @var string
	 */
	const SETTINGS_NAME = 'snow-monkey-settings';

	/**
	 * Default settings.
	 *
	 * @var array
	 */
	const DEFAULT_SETTINGS = array(
		'license-key'          => null,
		'xserver-register-key' => null,
	);

	/**
	 * If a value is stored in License key and XServer register key,
	 * use this value instead, since it is secret.
	 *
	 * @var string
	 */
	const SAVED_VALUE = 'THIS_IS_DUMMY_SAVED_VALUE_BECAUSE_THIS_VALUE_IS_SECRET';

	/**
	 * constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, '_admin_menu' ) );
		add_action( 'admin_init', array( $this, '_init' ) );

		register_uninstall_hook(
			__FILE__,
			array( '\Framework\Controller\Manager', '_uninstall' )
		);
	}

	/**
	 * Add admin menu.
	 */
	public function _admin_menu() {
		add_options_page(
			__( 'Snow Monkey settings', 'snow-monkey' ),
			__( 'Snow Monkey', 'snow-monkey' ),
			'manage_options',
			self::MENU_SLUG,
			function () {
				?>
				<div class="wrap">
					<h1><?php esc_html_e( 'Snow Monkey settings', 'snow-monkey' ); ?></h1>
					<form method="post" action="options.php">
						<?php
						settings_fields( self::MENU_SLUG );
						do_settings_sections( self::MENU_SLUG );
						submit_button();
						?>
					</form>

					<form method="post" action="options.php">
						<input type="hidden" name="<?php echo esc_attr( self::SETTINGS_NAME ); ?>[reset]" value="1">
						<?php
						settings_fields( self::MENU_SLUG );
						submit_button(
							esc_html__( 'Reset settings', 'snow-monkey' ),
							'secondary'
						);
						?>
					</form>

					<hr>

					<form method="post" action="options.php">
						<input type="hidden" name="<?php echo esc_attr( self::SETTINGS_NAME ); ?>[clear-remote-patterns-cache]" value="1">
						<?php
						settings_fields( self::MENU_SLUG );
						submit_button(
							esc_html__( 'Retrieve data from the pattern / style library', 'snow-monkey' ),
							'primary'
						);
						?>
					</form>
				</div>
				<?php
			}
		);
	}

	/**
	 * Initialize available blocks settings.
	 */
	public function _init() {
		if ( ! $this->_is_option_page() && ! $this->_is_options_page() ) {
			return;
		}

		if ( ! get_option( self::SETTINGS_NAME ) ) {
			update_option( self::SETTINGS_NAME, self::DEFAULT_SETTINGS );
		}

		/**
		 * Post proccess.
		 */
		register_setting(
			self::MENU_SLUG,
			self::SETTINGS_NAME,
			function ( $option ) {
				delete_transient( 'snow-monkey-remote-pattern-categories' );
				delete_transient( 'snow-monkey-remote-patterns' );
				delete_transient( 'snow-monkey-remote-styles' );

				if ( isset( $option['clear-remote-patterns-cache'] ) && '1' === $option['clear-remote-patterns-cache'] ) {
					return get_option( self::SETTINGS_NAME );
				}

				if ( isset( $option['reset'] ) && '1' === $option['reset'] ) {
					return array();
				}

				$posted_license_key     = isset( $option['license-key'] ) ? $option['license-key'] : false;
				$is_license_key_through = isset( $posted_license_key ) && static::SAVED_VALUE === $posted_license_key;
				$option['license-key']  = $is_license_key_through ? static::get_option( 'license-key' ) : $posted_license_key;

				if ( static::get_option( 'license-key' ) !== $option['license-key'] ) {
					delete_transient( 'snow-monkey-license-status-' . static::get_option( 'license-key' ) );
				}

				$posted_xserver_register_key    = isset( $option['xserver-register-key'] ) ? $option['xserver-register-key'] : false;
				$is_xserver_register_through    = isset( $posted_xserver_register_key ) && static::SAVED_VALUE === $posted_xserver_register_key;
				$option['xserver-register-key'] = $is_xserver_register_through ? static::get_option( 'xserver-register-key' ) : $posted_xserver_register_key;

				// XServer register key is not validated if a license key is entered.
				if ( static::get_option( 'xserver-register-key' ) !== $option['xserver-register-key'] ) {
					delete_transient( 'snow-monkey-xserver-register-status-' . static::get_option( 'xserver-register-key' ) );

					if ( $option['license-key'] ) {
						$option['xserver-register-key'] = '';
					}
				}

				return $option;
			}
		);

		add_settings_section(
			self::SETTINGS_NAME,
			__( 'Settings', 'snow-monkey' ),
			function () {
			},
			self::MENU_SLUG
		);

		add_settings_field(
			'license-key',
			'<label for="license-key">' . esc_html__( 'License key', 'snow-monkey' ) . '</label>',
			function () {
				$transient = static::get_license_status( static::get_option( 'license-key' ) );

				$button = 'true' === $transient
					? array(
						'label'   => __( 'Enable', 'snow-monkey' ),
						'color'   => '#fff',
						'bgcolor' => '#51cf66',
					)
					: array(
						'label'   => __( 'Disable', 'snow-monkey' ),
						'color'   => '#fff',
						'bgcolor' => '#e03131',
					);
				?>
				<div style="display: flex; align-items: center; gap: .5rem">
					<div style="flex: 1 1 auto">
						<input
							type="password"
							id="license-key"
							class="widefat"
							name="<?php echo esc_attr( self::SETTINGS_NAME ); ?>[license-key]"
							value="<?php echo esc_attr( static::get_option( 'license-key' ) ? static::SAVED_VALUE : '' ); ?>"
						>
					</div>
					<div style="flex: 0 0 auto">
						<span style="background-color: <?php echo esc_attr( $button['bgcolor'] ); ?>; color: <?php echo esc_attr( $button['color'] ); ?>; padding: .25em .5em; display: inline-block; font-size: 14px"><?php echo esc_html( $button['label'] ); ?></span>
					</div>
				</div>
				<p class="description">
					<?php esc_html_e( 'If the license key entered is valid, premium block patterns are available.', 'snow-monkey' ); ?><br>
					<?php esc_html_e( 'If the license key is entered, the XServer register key setting is not saved.', 'snow-monkey' ); ?>
				</p>
				<?php
			},
			self::MENU_SLUG,
			self::SETTINGS_NAME
		);

		add_settings_field(
			'xserver-register-key',
			'<label for="xservser-regiser-key">' . esc_html__( 'XServer register key', 'snow-monkey' ) . '</label>',
			function () {
				$transient = static::get_xserver_register_status( static::get_option( 'xserver-register-key' ) );

				$button = 'true' === $transient
					? array(
						'label'   => __( 'Enable', 'snow-monkey' ),
						'color'   => '#fff',
						'bgcolor' => '#51cf66',
					)
					: array(
						'label'   => __( 'Disable', 'snow-monkey' ),
						'color'   => '#fff',
						'bgcolor' => '#e03131',
					);
				?>
				<div style="display: flex; align-items: center; gap: .5rem">
					<div style="flex: 1 1 auto">
						<input
							type="password"
							id="xserver-register-key"
							class="widefat"
							name="<?php echo esc_attr( self::SETTINGS_NAME ); ?>[xserver-register-key]"
							value="<?php echo esc_attr( static::get_option( 'xserver-register-key' ) ? static::SAVED_VALUE : '' ); ?>"
						>
					</div>
					<div style="flex: 0 0 auto">
						<span style="background-color: <?php echo esc_attr( $button['bgcolor'] ); ?>; color: <?php echo esc_attr( $button['color'] ); ?>; padding: .25em .5em; display: inline-block; font-size: 14px"><?php echo esc_html( $button['label'] ); ?></span>
					</div>
				</div>
				<p class="description">
					<?php esc_html_e( 'If the XServer register key entered is valid, premium block patterns are available.', 'snow-monkey' ); ?><br>
					<?php esc_html_e( 'If you are using XServer integration, enter the XServer register key in the XServer register key entry field without entering anything in the license key entry field.', 'snow-monkey' ); ?>
				</p>
				<?php
			},
			self::MENU_SLUG,
			self::SETTINGS_NAME
		);
	}

	/**
	 * Get license status.
	 *
	 * @param string $license_key The license key.
	 * @return mixed false|'true'|'false'
	 */
	public static function get_license_status( $license_key ) {
		if ( ! $license_key ) {
			return false;
		}

		$transient_name = 'snow-monkey-license-status-' . $license_key;
		$transient      = get_transient( $transient_name );
		if ( false !== $transient && 'false' !== $transient ) {
			return $transient;
		}

		$status = static::_request_license_validate( $license_key );
		set_transient( $transient_name, $status ? $status : 'false', DAY_IN_SECONDS );
		return $status;
	}

	/**
	 * Validate checker.
	 *
	 * @param string $license_key The license key.
	 * @return mixed false|'true'
	 */
	protected static function _request_license_validate( $license_key ) {
		global $wp_version;

		if ( ! $license_key ) {
			return false;
		}

		$response = wp_remote_get(
			'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/validate/?repository=snow-monkey',
			array(
				'user-agent' => 'WordPress/' . $wp_version,
				'timeout'    => 30,
				'headers'    => array(
					'Accept-Encoding'           => '',
					'X-Snow-Monkey-License-key' => $license_key,
					'X-Snow-Monkey-Version'     => wp_get_theme()->get( 'Version' ),
					'X-Snow-Monkey-URL'         => home_url(),
				),
			)
		);

		$status = false;
		if ( $response && ! is_wp_error( $response ) ) {
			$response_code = wp_remote_retrieve_response_code( $response );
			if ( 200 === $response_code ) {
				$status = wp_remote_retrieve_body( $response );
			}
		}

		return $status;
	}

	/**
	 * Get XServer register status.
	 *
	 * @param string $xserver_register_key The license key.
	 * @return mixed false|'true'|'false'
	 */
	public static function get_xserver_register_status( $xserver_register_key ) {
		if ( ! $xserver_register_key ) {
			return false;
		}

		$transient_name = 'snow-monkey-xserver-register-status-' . $xserver_register_key;
		$transient      = get_transient( $transient_name );
		if ( false !== $transient ) {
			return $transient;
		}

		$status = static::_request_license_validate_xserver( $xserver_register_key );
		set_transient( $transient_name, $status ? $status : 'false', DAY_IN_SECONDS );
		return $status;
	}

	/**
	 * Validate checker.
	 *
	 * @param string $xserver_register_key The XServer register key.
	 * @return mixed false|'true'
	 */
	protected static function _request_license_validate_xserver( $xserver_register_key ) {
		global $wp_version;

		if ( ! $xserver_register_key ) {
			return false;
		}

		$response = wp_remote_get(
			'https://snow-monkey.2inc.org/wp-json/snow-monkey-license-manager/v1/validate-xserver/?repository=snow-monkey',
			array(
				'user-agent' => 'WordPress/' . $wp_version,
				'timeout'    => 30,
				'headers'    => array(
					'Accept-Encoding'                    => '',
					'X-Snow-Monkey-XServer-Register-key' => $xserver_register_key,
					'X-Snow-Monkey-Version'              => wp_get_theme()->get( 'Version' ),
					'X-Snow-Monkey-URL'                  => home_url(),
				),
			)
		);

		$status = false;
		if ( $response && ! is_wp_error( $response ) ) {
			$response_code = wp_remote_retrieve_response_code( $response );
			if ( 200 === $response_code ) {
				$status = wp_remote_retrieve_body( $response );
			}
		}

		return $status;
	}

	/**
	 * Uninstall
	 */
	public static function _uninstall() {
		delete_option( self::SETTINGS_NAME );
	}

	/**
	 * Return option.
	 *
	 * @param string $key The option key name.
	 * @return mixed
	 */
	public static function get_option( $key ) {
		$option = get_option( self::SETTINGS_NAME );
		if ( ! $option ) {
			return false;
		}

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}

	/**
	 * Return true is option page.
	 *
	 * @return boolean
	 */
	protected function _is_option_page() {
		$current_url = admin_url( '/options-general.php?page=' . static::MENU_SLUG );
		$current_url = preg_replace( '|^(.+)?(/wp-admin/.*?)$|', '$2', $current_url );
		$request_uri = wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$request_uri = preg_replace( '|^(.+)?(/wp-admin/.*?)$|', '$2', $request_uri );
		return false !== strpos( $request_uri, $current_url );
	}

	/**
	 * Return true is options page.
	 *
	 * @return boolean
	 */
	protected function _is_options_page() {
		$current_url = admin_url( '/options.php' );
		$current_url = preg_replace( '|^(.+)?(/wp-admin/.*?)$|', '$2', $current_url );
		$request_uri = wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		$request_uri = preg_replace( '|^(.+)?(/wp-admin/.*?)$|', '$2', $request_uri );
		return false !== strpos( $request_uri, $current_url );
	}
}
