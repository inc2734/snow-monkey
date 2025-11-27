<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.9
 */

namespace Framework\Model;

require_once ABSPATH . 'wp-admin/includes/file.php';

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
			array( '\Framework\Model\Filesystem', '_filesystem_method' )
		);

		WP_Filesystem();

		remove_filter(
			'filesystem_method',
			array( '\Framework\Model\Filesystem', '_filesystem_method' )
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
	 * Checks if a file or directory is writable.
	 *
	 * @param string $filepath The file path.
	 * @return boolean
	 */
	public static function is_writable( $filepath ) {
		if ( ! file_exists( $filepath ) ) {
			return false;
		}

		$filesystem = static::start();
		if ( $filesystem ) {
			$is_writable = $filesystem->is_writable( $filepath );
		}
		static::end();
		return $is_writable;
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
			throw new \RuntimeException( sprintf( '[Snow Monkey] Failed to write to %1$s.', esc_html( $filepath ) ) );
		}

		return $result;
	}

	/**
	 * Remove directory.
	 *
	 * @param string $filepath Path of the directory to be deleted.
	 * @return boolean
	 */
	public static function rmdir( $filepath ) {
		if ( ! file_exists( $filepath ) ) {
			return true;
		}

		$result     = false;
		$filesystem = static::start();

		try {
			if ( ! $filesystem ) {
				throw new \RuntimeException( sprintf( '[Snow Monkey] Failed to initialize WP_Filesystem when removing %1$s.', esc_html( $filepath ) ) );
			}

			$result = $filesystem->rmdir( $filepath, true );

			if ( ! $result && file_exists( $filepath ) ) {
				throw new \RuntimeException( sprintf( '[Snow Monkey] Failed to remove to %1$s.', esc_html( $filepath ) ) );
			}

			$result = true;
		} catch ( \Exception $e ) {
			if ( ! file_exists( $filepath ) ) {
				return true;
			}

			error_log( $e->getMessage() );
			$result = false;
		} finally {
			static::end();
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
		if ( static::is_writable( $target ) ) {
			return true;
		}

		if ( file_exists( $target ) ) {
			return true;
		}

		try {
			if ( ! static::is_writable( dirname( $target ) ) ) {
				throw new \RuntimeException( sprintf( '[Snow Monkey] %1$s is not writable.', dirname( $target ) ) );
			}
		} catch ( \Exception $e ) {
			error_log( $e->getMessage() );
			return false;
		}

		$result = false;

		try {
			$result = wp_mkdir_p( $target );

			if ( ! $result ) {
				throw new \RuntimeException( sprintf( '[Snow Monkey] Failed to mkdir to %1$s.', $target ) );
			}
		} catch ( \Exception $e ) {
			error_log( $e->getMessage() );
		}

		return $result;
	}
}
