<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Framework;

use Inc2734\Mimizuku_Core\Utility;

class Helper {

	use Utility\Helper\Helper;
	use Contract\Helper\Page_Header;

	/**
	 * Sets entry content styles
	 *
	 * @param string|array $selector
	 * @return void
	 */
	public static function entry_content_styles( $selectors ) {
		$accent_color = get_theme_mod( 'accent-color' );

		$cfs = \Inc2734\WP_Customizer_Framework\Customizer_Framework::styles();

		$selectors = (array) $selectors;
		foreach ( $selectors as $selector ) {
			$cfs->register(
				$selector . ' > h2',
				'border-color: ' . $accent_color
			);

			$cfs->register(
				$selector . ' > table thead th',
				[
					'background-color: ' . $accent_color,
					'border-right-color: ' . $cfs->light( $accent_color ),
					'border-left-color: ' . $cfs->light( $accent_color ),
				]
			);

			do_action( 'snow_monkey_entry_content_styles', $cfs, $selector );
		}
	}

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
		$breadcrumbs = new \Inc2734\WP_Breadcrumbs\Breadcrumbs();
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
}
