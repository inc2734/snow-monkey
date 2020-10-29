<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

namespace Framework\Model;

require_once( ABSPATH . 'wp-admin/includes/file.php' );

class Filesystem {

	/**
	 * WP_Filesystem object.
	 *
	 * @var WP_Filesystem
	 */
	protected static $_wp_file_system;

	/**
	 * Start filesystem proccess.
	 *
	 * @return WP_Filesystem
	 */
	public static function start() {
		global $wp_filesystem;
		static::$_wp_file_system = $wp_filesystem;

		add_filter(
			'filesystem_method',
			[ '\Framework\Model\Filesystem', '_filesystem_method' ]
		);

		WP_Filesystem();

		remove_filter(
			'filesystem_method',
			[ '\Framework\Model\Filesystem', '_filesystem_method' ]
		);

		return $wp_filesystem;
	}

	/**
	 * End filesystem proccess.
	 */
	public static function end() {
		global $wp_filesystem;
		$wp_filesystem = static::$_wp_file_system; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	}

	/**
	 * Set WP_Filesystem_Direct to $wp_filesystem.
	 *
	 * @return string
	 */
	public static function _filesystem_method() {
		return 'direct';
	}

	/**
	 * Read the contents of $filepath.
	 *
	 * @param string $filepath The file path.
	 * @return string
	 */
	public static function get_contents( $filepath ) {
		$filesystem = static::start();
		if ( $filesystem ) {
			$contents = $filesystem->get_contents( $filepath );
		}
		static::end();
		return isset( $contents ) ? $contents : false;
	}

	/**
	 * Write contents to the $filepath.
	 *
	 * @param string $filepath The file path.
	 * @param string $contents Writing Content.
	 * @return void
	 */
	public static function put_contents( $filepath, $contents ) {
		$filesystem = static::start();
		if ( $filesystem ) {
			$filesystem->put_contents( $filepath, $contents );
		}
		static::end();
	}

	/**
	 * Remove directory.
	 *
	 * @param string $filepath Path of the directory to be deleted.
	 * @return boolean
	 */
	public static function rmdir( $filepath ) {
		$return     = false;
		$filesystem = static::start();
		if ( $filesystem ) {
			$return = $filesystem->rmdir( $filepath, true );
		}
		static::end();
		return $return;
	}
}
