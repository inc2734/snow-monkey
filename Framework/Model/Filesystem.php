<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.15.1
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
	 * @return string|false
	 */
	public static function get_contents( $filepath ) {
		if ( ! file_exists( $filepath ) ) {
			return false;
		}

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
	 * @return boolean
	 * @throws \RuntimeException If the file fails to write.
	 */
	public static function put_contents( $filepath, $contents ) {
		$result = false;

		$filesystem = static::start();
		if ( $filesystem ) {
			$result = $filesystem->put_contents( $filepath, $contents );
		}
		static::end();

		if ( ! $result ) {
			throw new \RuntimeException( sprintf( '[Snow Monkey] Failed to write to %1$s.', $filepath ) );
		}

		return $result;
	}

	/**
	 * Remove directory.
	 *
	 * @param string $filepath Path of the directory to be deleted.
	 * @return boolean
	 * @throws \RuntimeException If the file deletion fails.
	 */
	public static function rmdir( $filepath ) {
		$result = false;

		$filesystem = static::start();
		if ( $filesystem ) {
			$result = $filesystem->rmdir( $filepath, true );
		}
		static::end();

		if ( ! $result ) {
			throw new \RuntimeException( sprintf( '[Snow Monkey] Failed to remove to %1$s.', $filepath ) );
		}

		return $result;
	}

	/**
	 * Recursive directory creation based on full path.
	 *
	 * @param string $target Full path to attempt to create.
	 * @return boolean Whether the path was created. True if path already exists.
	 * @throws \RuntimeException If the creation of the directory fails.
	 */
	public static function mkdir( $target ) {
		if ( is_writable( $target ) ) {
			return true;
		}

		if ( file_exists( $target ) ) {
			return true;
		}

		$result = false;

		if ( ! file_exists( $target ) && is_writable( dirname( $target ) ) ) {
			$result = wp_mkdir_p( $target );
		}

		if ( ! $result ) {
			throw new \RuntimeException( sprintf( '[Snow Monkey] Failed to mkdir to %1$s.', $target ) );
		}

		return $result;
	}
}
