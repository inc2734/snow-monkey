<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework\Model;

class Styles {

	/**
	 * Selectors
	 *
	 * @var array
	 */
	protected static $selectors = [];

	/**
	 * Set selectors. Styles of these selectors output like extend of Sass.
	 *
	 * @param string $extend_id
	 * @param array $selectors
	 * @return void
	 */
	public static function extend( $extend_id, array $selectors ) {
		if ( ! isset( static::$selectors[ $extend_id ] ) ) {
			static::$selectors[ $extend_id ] = [];
		}

		static::$selectors[ $extend_id ] = array_merge(
			static::$selectors[ $extend_id ],
			$selectors
		);
	}

	/**
	 * Register styles.
	 * You use \Inc2734\WP_Customizer_Framework\Customizer_Framework->register method in $callback.
	 *
	 * @param string $extend_id
	 * @param function $callback
	 * @return void
	 */
	public static function register( $extend_id, $callback ) {
		add_action(
			'snow_monkey_load_customizer_styles',
			function() use ( $extend_id, $callback ) {
				if ( ! isset( static::$selectors[ $extend_id ] ) ) {
					return;
				}

				$callback( static::$selectors[ $extend_id ] );
			},
			11
		);
	}
}
