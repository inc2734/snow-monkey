<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.3
 */

namespace Framework\Model\Page_Header;

use Framework\Helper;
use Framework\Contract\Model\Page_Header as Base;

class Archive_Page_Header extends Base {

	/**
	 * Return page header image url.
	 *
	 * @return string|false
	 */
	protected static function _get_image_url() {
		$custom_post_types = Helper::get_custom_post_types();
		if ( is_post_type_archive( $custom_post_types ) ) {
			return in_array( get_theme_mod( 'archive-' . get_post_type() . '-eyecatch' ), static::$image_mods, true )
				? Helper::has_post_type_archive_thumbnail()
					? Helper::get_the_post_type_archive_thumbnail_url()
					: static::_get_default_image_url()
				: false;
		}

		if ( is_home() || is_archive() ) {
			return in_array( get_theme_mod( 'archive-eyecatch' ), static::$image_mods, true )
				? Helper::has_homepage_thumbnail()
					? Helper::get_the_homepage_thumbnail_url( static::_get_thumbnail_size() )
					: static::_get_default_image_url()
				: false;
		}

		return false;
	}

	/**
	 * Return page header title.
	 *
	 * @return string|false
	 */
	protected static function _get_title() {
		$custom_post_types = Helper::get_custom_post_types();
		if ( is_post_type_archive( $custom_post_types ) ) {
			return in_array( get_theme_mod( 'archive-' . get_post_type() . '-eyecatch' ), static::$title_mods, true )
				? \Framework\Helper::get_page_title_from_breadcrumbs()
				: false;
		}

		if ( is_home() || is_archive() ) {
			return in_array( get_theme_mod( 'archive-eyecatch' ), static::$title_mods, true )
				? \Framework\Helper::get_page_title_from_breadcrumbs()
				: false;
		}

		return false;
	}

	/**
	 * Return page header alignment.
	 *
	 * @return string|false
	 */
	protected static function _get_align() {
		$custom_post_types = Helper::get_custom_post_types();
		if ( is_post_type_archive( $custom_post_types ) ) {
			return in_array( get_theme_mod( 'archive-' . get_post_type() . '-eyecatch' ), static::$title_mods, true )
				? get_theme_mod( 'archive-' . get_post_type() . '-page-header-align' )
				: false;
		}

		if ( is_home() || is_archive() ) {
			return in_array( get_theme_mod( 'archive-eyecatch' ), static::$title_mods, true )
				? get_theme_mod( 'archive-page-header-align' )
				: false;
		}

		return false;
	}
}
