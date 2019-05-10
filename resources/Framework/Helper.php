<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
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

		$theme_by   = sprintf( __( 'Snow Monkey theme by %s', 'snow-monkey' ), $theme_link );
		$powered_by = sprintf( __( 'Powered by %s', 'snow-monkey' ), $wordpress_link );
		$copyright  = $theme_by . ' ' . $powered_by;

		return apply_filters( 'snow_monkey_copyright', $copyright );
	}
}
