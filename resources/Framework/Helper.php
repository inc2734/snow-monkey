<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <unversion>
 */

namespace Framework;

use Inc2734\Mimizuku_Core;

class Helper {

	use Mimizuku_Core\App\Contract\Helper\Helper;
	use Contract\Helper\Page_Header;

	/**
	 * Return output positions of eyecatch
	 *
	 * @return array
	 */
	public static function eyecatch_position_choices() {
		return [
			'page-header'          => __( 'Page header', 'snow-monkey' ),
			'title-on-page-header' => __( 'Title on page header', 'snow-monkey' ),
			'content-top'          => __( 'Top of contents', 'snow-monkey' ),
			'none'                 => __( 'None', 'snow-monkey' ),
		];
	}

	/**
	 * Return default header position
	 *
	 * @return string
	 */
	public static function get_default_header_position() {
		return get_theme_mod( 'header-position' );
	}

	/**
	 * Return header position
	 *
	 * @return string
	 */
	public static function get_header_position() {
		if ( ! wp_is_mobile() && get_theme_mod( 'header-position-only-mobile' ) ) {
			return;
		}

		return static::get_default_header_position();
	}

	/**
	 * Returns page title from Breadcrumbs
	 *
	 * @return string
	 */
	public static function get_page_title_from_breadcrumbs() {
		$breadcrumbs = new \Inc2734\WP_Breadcrumbs\Bootstrap();
		$breadcrumbs = apply_filters( 'snow_monkey_breadcrumbs', $breadcrumbs->get() );
		$title_item  = end( $breadcrumbs );
		return array_key_exists( 'title', $title_item ) ? $title_item['title'] : '';
	}

	/**
	 * Return trimed title
	 *
	 * @return void
	 */
	public static function the_title_trimed() {
		$num_words = apply_filters( 'snow_monkey_entry_summary_title_num_words', class_exists( 'multibyte_patch' ) ? 40 : 80 );
		if ( $num_words ) {
			ob_start();
			the_title();
			$title = wp_trim_words( ob_get_clean(), $num_words );
			echo esc_html( $title );
		} else {
			the_title();
		}
	}

	/**
	 * Get global variable ( For template part )
	 */
	public static function get_var( &$name, $default = null ) {
		return isset( $name ) ? $name : $default;
	}

	/**
	 * Return bread crumbs items of current page
	 *
	 * @return array
	 *   @var string $title
	 *   @var string $link
	 */
	public static function get_breadcrumbs_items() {
		$breadcrumbs = new \Inc2734\WP_Breadcrumbs\Bootstrap();
		return apply_filters( 'snow_monkey_breadcrumbs', $breadcrumbs->get() );
	}

	/**
	 * Return copyright text
	 *
	 * @return string
	 */
	public static function get_copyright() {
		$theme_link = sprintf(
			'<a href="https://2inc.org" target="_blank">%s</a>',
			__( 'Monkey Wrench', 'snow-monkey' )
		);

		$wordpress_link = sprintf(
			'<a href="https://wordpress.org/" target="_blank">%s</a>',
			__( 'WordPress', 'snow-monkey' )
		);

		$theme_by = sprintf(
			/* translators: %s: Theme link */
			__( 'Snow Monkey theme by %s', 'snow-monkey' ),
			$theme_link
		);

		$powered_by = sprintf(
			/* translators: %s: WordPress link */
			__( 'Powered by %s', 'snow-monkey' ),
			$wordpress_link
		);

		$copyright = $theme_by . ' ' . $powered_by;

		return apply_filters( 'snow_monkey_copyright', $copyright );
	}

	/**
	 * Return true when the sidebar is registerd and active
	 *
	 * @param string $sidebar_id
	 * @return boolean
	 */
	public static function is_active_sidebar( $sidebar_id ) {
		return is_active_sidebar( $sidebar_id ) && is_registered_sidebar( $sidebar_id );
	}

	/**
	 * Return file header
	 *
	 * @see https://developer.wordpress.org/reference/functions/get_file_data/
	 * @param string $file Full file path
	 * @return string
	 */
	protected static function _get_file_data( $file ) {
		// We don't need to write to the file, so just open for reading.
		$file_pointer = fopen( $file, 'r' );

		// Pull only the first 8kiB of the file in.
		$file_data = fread( $file_pointer, 8192 );

		// PHP will close file handle, but we are good citizens.
		fclose( $file_pointer );

		// Make sure we catch CR-only line endings.
		return str_replace( "\r", "\n", $file_data );
	}

	/**
	 * Return @version data
	 *
	 * @param string $file Full file path
	 * @return string|null
	 */
	public static function get_file_version( $file ) {
		// Make sure we catch CR-only line endings.
		$file_data = static::_get_file_data( $file );

		if ( preg_match( '/^[ \t\/*#@]*@version(.*)$/mi', $file_data, $match ) && $match[1] ) {
			return _cleanup_header_comment( $match[1] );
		}
	}

	/**
	 * Return renamed: data
	 *
	 * @param string $file Full file path
	 * @return array
	 */
	public static function get_file_renamed( $file ) {
		// Make sure we catch CR-only line endings.
		$file_data = static::_get_file_data( $file );

		if ( preg_match_all( '/^[ \t\/*#@]*renamed:(.*)$/mi', $file_data, $match ) && $match[1] ) {
			return array_map( '_cleanup_header_comment', $match[1] );
		}

		return [];
	}

	/**
	 * Return public taxonomy tied to the post
	 *
	 * @param int|WP_Post $post
	 * @return array
	 */
	public static function get_the_public_taxonomy( $post = 0 ) {
		$post = get_post( $post );

		$taxonomies = get_object_taxonomies( get_post_type( $post ), 'object' );
		$public_taxonomies = [];

		foreach ( $taxonomies as $taxonomy ) {
			if ( ! $taxonomy->public ) {
				continue;
			}

			$public_taxonomies[ $taxonomy->name ] = $taxonomy;
		}

		return $public_taxonomies;
	}
}
