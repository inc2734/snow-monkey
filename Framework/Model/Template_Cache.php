<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.4.0
 */

namespace Framework\Model;

use Framework\Helper;
use Framework\Model\Filesystem;
use Framework\Model\Cache;

class Template_Cache {

	/**
	 * The directory where the cache is stored
	 *
	 * @var string
	 */
	protected $directory;

	/**
	 * True when removing.
	 *
	 * @var boolean
	 */
	protected static $is_removing = false;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->directory = Cache::get_base_directory();
		if ( ! $this->directory ) {
			return;
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
	 * Remove caches when widgets are updated.
	 *
	 * @param array $instance The current widget instance's settings.
	 * @return object
	 */
	public function _widget_update_callback( $instance ) {
		$this->remove();

		return $instance;
	}

	/**
	 * Get the cache.
	 *
	 * @param string $sub_directory The directory where the cache is stored.
	 * @param string $slug The template slug.
	 * @param string $name The template name.
	 * @param array  $vars The template $args.
	 * @return string|null
	 */
	public function get( $sub_directory, $slug, $name, $vars ) {
		return Cache::get( $sub_directory, $slug, $name, $vars );
	}

	/**
	 * Save the cache.
	 *
	 * @param string $sub_directory The directory where the cache is stored.
	 * @param string $html The template HTML.
	 * @param string $slug The template slug.
	 * @param string $name The template name.
	 * @param array  $vars The template $args.
	 * @return boolean
	 */
	public function save( $sub_directory, $html, $slug, $name, $vars ) {
		return Cache::save( $sub_directory, $html, $slug, $name, $vars );
	}

	/**
	 * Remove all caches.
	 *
	 * @return void
	 */
	public function remove() {
		if ( static::$is_removing ) {
			return;
		}

		static::$is_removing = true;
		$return              = Filesystem::rmdir( $this->directory );
		static::$is_removing = false;
		return $return;
	}
}
