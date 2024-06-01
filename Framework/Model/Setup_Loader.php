<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

namespace Framework\Model;

use Framework\Model\Filesystem;
use Framework\Model\Cache;
use Framework\Helper;

class Setup_Loader {

	/**
	 * The template directory path.
	 *
	 * @var null|string
	 */
	protected $template_directory = null;

	/**
	 * The stylesheet directory path.
	 *
	 * @var null|string
	 */
	protected $stylesheet_directory = null;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->template_directory   = realpath( get_template_directory() );
		$this->stylesheet_directory = realpath( get_stylesheet_directory() );
	}

	/**
	 * Load files.
	 *
	 * @param string  $method             Loading method.
	 * @param string  $directory          Target directory.
	 * @param boolean $exclude_underscore Exclude if true.
	 */
	public function load( $method, $directory, $exclude_underscore = false ) {
		$directory = realpath( $directory );
		if ( -1 === strpos( $directory, $this->template_directory ) ) {
			return false;
		}

		$directory_slug = ltrim( str_replace( $this->template_directory, '', $directory ), DIRECTORY_SEPARATOR );
		$files          = $this->_load_file_list( $directory_slug );

		switch ( $this->_get_loading_method( $method, $directory, $directory_slug ) ) {
			case 'get_template_parts':
				$directory_or_files = ! empty( $files ) ? $files : $directory;
				Helper::get_template_parts( $directory_or_files, $exclude_underscore );
				break;
			case 'load_theme_files':
				$theme_files        = $this->_file_list_to_theme_file_path( $files, $directory_slug );
				$directory_or_files = ! empty( $theme_files ) && is_array( $theme_files ) ? $theme_files : $directory;
				Helper::load_theme_files( $directory_or_files, $exclude_underscore );
				break;
			case 'concat':
				$included = Cache::load( 'concat', $directory_slug, null, array(), 'php' );
				if ( $included ) {
					break;
				}

				if ( empty( $files ) || ! is_array( $files ) ) {
					break;
				}

				$theme_files = $this->_file_list_to_theme_file_path( $files );
				if ( empty( $theme_files ) || ! is_array( $theme_files ) ) {
					break;
				}

				$result = $this->_concat( $theme_files, $directory_slug );
				if ( $result ) {
					Cache::load( 'concat', $directory_slug, null, array(), 'php' );
				}
				break;
			default:
				$directory_or_files = ! empty( $files ) && is_array( $files ) ? $this->_file_list_to_filepath( $files ) : $directory;
				Helper::include_files( $directory_or_files, $exclude_underscore );
		}
	}

	/**
	 * Convert file list to file paths.
	 *
	 * @param array  $files Array of files path.
	 * @return array
	 */
	protected function _file_list_to_filepath( $files ) {
		return array_map(
			function ( $slug ) {
				return trailingslashit( $this->template_directory ) . $slug . '.php';
			},
			$files
		);
	}

	/**
	 * Convert file list to theme file paths.
	 *
	 * @param array  $files Array of files path.
	 * @return array
	 */
	protected function _file_list_to_theme_file_path( $files ) {
		if ( empty( $files ) || ! is_array( $files ) ) {
			return false;
		}

		return array_map(
			function ( $slug ) {
				return $slug . '.php';
			},
			$files
		);
	}

	/**
	 * Concat and save.
	 *
	 * @param string $theme_files    The filepath relative to the theme.
	 * @param string $directory_slug The directory slug.
	 * @return boolean
	 */
	protected function _concat( $theme_files, $directory_slug ) {
		$data = '';

		foreach ( $theme_files as $theme_file ) {
			$located_template = get_theme_file_path( $theme_file );
			if ( ! file_exists( $located_template ) ) {
				continue;
			}

			$_data = Filesystem::get_contents( $located_template );
			if ( false === $_data ) {
				continue;
			}

			$_data = preg_replace( '|^<\?php|', '', $_data );

			preg_match_all( '|^use [^;]+;|m', $_data, $matches );
			$uses = array();
			if ( $matches[0] ) {
				foreach ( $matches[0] as $match ) {
					$uses[] = $match;
					$_data  = str_replace( $match, '', $_data );
				}
			}
			$_data = "call_user_func( function() {\n" . $_data . "} );\n";
			if ( $uses ) {
				$_data = implode( "\n", $uses ) . "\n\n" . $_data;
			}

			if ( preg_match( '|^(namespace [^;]+);|ms', $_data, $match ) ) {
				$_data = str_replace( $match[0], '', $_data );
				$_data = $match[1] . "{\n" . $_data . "\n}";
			} else {
				$_data = "namespace {\n" . $_data . "\n}\n\n";
			}
			$data = $data . $_data;
		}

		$data = $data ? "<?php\n" . $data : $data;
		return Cache::save( 'concat', $data, $directory_slug, null, array(), 'php' );
	}

	/**
	 * Return loading method.
	 *
	 * @param string $method         Loading method.
	 * @param string $path           Target directory.
	 * @param string $directory_slug The directory slug.
	 * @return string
	 */
	protected function _get_loading_method( $method, $path, $directory_slug ) {
		return apply_filters( 'snow_monkey_loading_method', $method, $path, $directory_slug );
	}

	/**
	 * Load file list.
	 *
	 * @param string $directory_slug The directory slug.
	 * @return string|false
	 */
	protected function _load_file_list( $directory_slug ) {
		$file_list_directory = $this->template_directory . '/assets/load-files-target';
		$bundle_file         = $file_list_directory . DIRECTORY_SEPARATOR . sha1( $directory_slug ) . '.php';

		if ( ! file_exists( $bundle_file ) ) {
			return false;
		}

		return include $bundle_file;
	}
}
