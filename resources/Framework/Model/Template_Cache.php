<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.10.3
 */

namespace Framework\Model;

use SplFileInfo;
use DirectoryIterator;
use Exception;
use RuntimeException;
use Framework\Helper;

class Template_Cache {

	/**
	 * The directory where the cache is stored
	 *
	 * @var string
	 */
	protected $directory;

	protected static $is_removing = false;

	public function __construct() {
		if ( ! is_writable( get_template_directory() ) ) {
			return;
		}

		$this->directory = path_join( get_template_directory(), 'cache' );

		if ( ! file_exists( $this->directory ) ) {
			wp_mkdir_p( $this->directory );
		}

		add_action( 'customize_save_after', [ $this, 'remove' ] );
		add_action( 'wp_update_nav_menu', [ $this, 'remove' ] );
		add_filter( 'widget_update_callback', [ $this, '_widget_update_callback' ] );

		add_action( 'save_post', [ $this, '_save_post' ] );

		add_action( 'comment_post', [ $this, 'remove' ] );
		add_action( 'wp_set_comment_status', [ $this, 'remove' ] );

		add_action( 'edited_terms', [ $this, 'remove' ] );
	}

	/**
	 * Remove caches when posts are saved
	 *
	 * @return void
	 */
	public function _save_post() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		$this->remove();
	}

	/**
	 * Remove caches when widgets are updated
	 *
	 * @return object
	 */
	public function _widget_update_callback( $instance ) {
		$this->remove();

		return $instance;
	}

	/**
	 * Get the cache
	 *
	 * @param string $sub_directory
	 * @param string $slug
	 * @param string $name
	 * @param array $vars
	 * @return string|null
	 */
	public function get( $sub_directory, $slug, $name, $vars ) {
		$directory = path_join( $this->directory, $sub_directory );
		$filepath  = trailingslashit( $directory ) . $this->_get_cache_filename( $slug, $name, $vars );

		if ( file_exists( $filepath ) ) {
			return sprintf(
				'<!-- Cached: [slug] => %2$s [name] => %3$s -->
				%1$s
				<!-- /Cached: [slug] => %2$ss [name] => %3$s -->',
				file_get_contents( $filepath ),
				esc_html( $slug ),
				esc_html( $name )
			);
		}
	}

	/**
	 * Save the cache
	 *
	 * @param string $sub_directory
	 * @param string $html
	 * @param string $slug
	 * @param string $name
	 * @param array $vars
	 * @return string|null
	 */
	public function save( $sub_directory, $html, $slug, $name, $vars ) {
		$directory = path_join( $this->directory, $sub_directory );
		$filepath  = trailingslashit( $directory ) . $this->_get_cache_filename( $slug, $name, $vars );

		if ( file_exists( $filepath ) ) {
			return;
		}

		if ( is_writable( $this->directory ) ) {
			if ( ! file_exists( $directory ) ) {
				wp_mkdir_p( $directory );
			}

			if ( is_writable( $directory ) ) {
				file_put_contents( $filepath, $html, LOCK_EX );
			}
		}
	}

	/**
	 * Return cache filename
	 *
	 * @param string $slug
	 * @param string $name
	 * @param array $vars
	 * @return string
	 */
	protected function _get_cache_filename( $slug, $name, $vars ) {
		return sha1( $slug . '-' . $name . '-' . json_encode( $vars ) ) . '.html';
	}

	/**
	 * Remove all caches
	 *
	 * @return void
	 */
	public function remove() {
		if ( static::$is_removing ) {
			return;
		}

		static::$is_removing = true;
		$return = $this->_remove_children( $this->directory );
		static::$is_removing = false;
		return $return;
	}

	/**
	 * Remove child caches
	 *
	 * @param string $directory
	 * @return boolean
	 */
	protected function _remove_children( $directory ) {
		$iterator = new DirectoryIterator( $directory );

		try {
			foreach ( $iterator as $fileinfo ) {
				$path = $fileinfo->getPathname();
				if ( $fileinfo->isDot() ) {
					continue;
				} elseif ( $fileinfo->isDir() ) {
					if ( $this->_remove_children( $path ) ) {
						$this->_remove_file( $path );
					}
				} elseif ( $fileinfo->isFile() ) {
					$this->_remove_file( $path );
				}
			}
		} catch ( Exception $e ) {
			error_log( $e->getMessage() );
			return false;
		}

		return true;
	}

	/**
	 * Remove cache file
	 *
	 * @param string $file
	 * @return boolean
	 */
	protected function _remove_file( $file ) {
		$fileinfo = new SplFileInfo( $file );

		if ( $fileinfo->isFile() && is_writable( $file ) ) {
			if ( ! unlink( $file ) ) {
				throw new RuntimeException( sprintf( '[Snow Monkey] Can\'t remove file: %1$s.', $file ) );
			}
		} elseif ( $fileinfo->isDir() && is_writable( $file ) ) {
			if ( ! rmdir( $file ) ) {
				throw new RuntimeException( sprintf( '[Snow Monkey] Can\'t remove directory: %1$s.', $file ) );
			}
		}

		return true;
	}
}
