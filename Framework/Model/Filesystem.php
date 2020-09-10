<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.1
 */

namespace Framework\Model;

require_once( ABSPATH . 'wp-admin/includes/file.php' );

class Filesystem {

	protected static $_wp_file_system;

	public static function start() {
		global $wp_filesystem;
		static::$_wp_file_system = $wp_filesystem;
		WP_Filesystem();
		return $wp_filesystem;
	}

	public static function end() {
		global $wp_filesystem;
		$wp_filesystem = static::$_wp_file_system; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	}

	public static function get_contents( $filepath ) {
		$filesystem = static::start();
		if ( $filesystem ) {
			$contents = $filesystem->get_contents( $filepath );
		}
		static::end();
		return isset( $contents ) ? $contents : false;
	}

	public static function put_contents( $filepath, $contents ) {
		$filesystem = static::start();
		if ( $filesystem ) {
			$filesystem->put_contents( $filepath, $contents );
		}
		static::end();
	}

	public static function rmdir( $filepath ) {
		$return = false;
		$filesystem = static::start();
		if ( $filesystem ) {
			$return = $filesystem->rmdir( $filepath, true );
		}
		static::end();
		return $return;
	}
}
