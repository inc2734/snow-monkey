<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.4.0
 */

namespace Framework\Model;

use Framework\Model\Filesystem;

class Cache {

	/**
	 * Return cache base directory.
	 *
	 * @return string|false
	 */
	public static function get_base_directory() {
		$parent_directory = apply_filters( 'snow_monkey_template_cache_directory', get_template_directory() );
		$cache_directory  = path_join( $parent_directory, 'cache' );

		return Filesystem::mkdir( $cache_directory )
			? $cache_directory
			: false;
	}

	/**
	 * Return cache filename.
	 *
	 * @param string $slug The template slug.
	 * @param string $name The template name.
	 * @param array  $vars The template $args.
	 * @param string $ext  Cache file extention.
	 * @return string
	 */
	public static function get_filename( $slug, $name = '', $vars = [], $ext = 'html' ) {
		$base = $slug;

		if ( $name ) {
			$base = $base . '-' . $name;
		}

		if ( $vars ) {
			$base = $base . '-' . json_encode( $vars );
		}

		return sha1( $base ) . '.' . $ext;
	}

	/**
	 * Include cache filename.
	 *
	 * @param string $directory Name of the directory for storing the cache.
	 * @param string $slug      The template slug.
	 * @param string $name      The template name.
	 * @param array  $vars      The template $args.
	 * @param string $ext       Cache file extention.
	 * @return string
	 */
	public static function load( $directory, $slug, $name = '', $vars = [], $ext = 'html' ) {
		$base_directory  = static::get_base_directory();
		$cache_flename   = static::get_filename( $slug, $name, $vars, $ext );
		$cache_directory = $directory ? path_join( $base_directory, $directory ) : $base_directory;
		$cache_filepath  = trailingslashit( $cache_directory ) . $cache_flename;

		if ( ! file_exists( $cache_filepath ) ) {
			return false;
		}

		include( $cache_filepath );

		return true;
	}

	/**
	 * Return cache filename.
	 *
	 * @param string $directory Name of the directory for storing the cache.
	 * @param string $slug      The template slug.
	 * @param string $name      The template name.
	 * @param array  $vars      The template $args.
	 * @param string $ext       Cache file extention.
	 * @return string
	 */
	public static function get( $directory, $slug, $name = '', $vars = [], $ext = 'html' ) {
		$base_directory  = static::get_base_directory();
		$cache_flename   = static::get_filename( $slug, $name, $vars, $ext );
		$cache_directory = $directory ? path_join( $base_directory, $directory ) : $base_directory;
		$cache_filepath  = trailingslashit( $cache_directory ) . $cache_flename;

		$cache = Filesystem::get_contents( $cache_filepath );
		if ( false === $cache ) {
			return null;
		}

		return sprintf(
			'<!-- Cached: [slug] => %2$s [name] => %3$s -->
			%1$s
			<!-- /Cached: [slug] => %2$s [name] => %3$s -->',
			$cache,
			esc_html( $slug ),
			esc_html( $name )
		);
	}

	/**
	 * Save the cache.
	 *
	 * @param string $directory The directory where the cache is stored.
	 * @param string $data      The template HTML.
	 * @param string $slug      The template slug.
	 * @param string $name      The template name.
	 * @param array  $vars      The template $args.
	 * @param string $ext       Cache file extention.
	 * @return boolean
	 */
	public static function save( $directory, $data, $slug, $name = '', $vars = [], $ext = 'html' ) {
		$base_directory  = static::get_base_directory();
		$cache_flename   = static::get_filename( $slug, $name, $vars, $ext );
		$cache_directory = $directory ? path_join( $base_directory, $directory ) : $base_directory;
		$cache_filepath  = trailingslashit( $cache_directory ) . $cache_flename;

		if ( file_exists( $cache_filepath ) ) {
			return true;
		}

		if ( ! file_exists( $cache_directory ) ) {
			Filesystem::mkdir( $cache_directory );
		}

		return is_writable( $cache_directory )
			? Filesystem::put_contents( $cache_filepath, $data )
			: false;
	}
}
