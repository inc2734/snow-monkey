<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\app;

use Inc2734\Mimizuku_Core\Utility;
use Snow_Monkey\app\model\Page_Header_Image_Url;

class Helper {

	use Utility\Helper\Helper;

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
	 * Returns page header image url
	 *
	 * @return string
	 */
	public static function get_page_header_image_url() {
		$url = apply_filters( 'snow_monkey_pre_page_header_image_url', null );
		if ( $url ) {
			return $url;
		}

		$url = Page_Header_Image_Url::get();

		return apply_filters( 'snow_monkey_page_header_image_url', $url );
	}

	/**
	 * Returns page title from Breadcrumbs
	 *
	 * @return string
	 */
	public static function get_page_title_from_breadcrumbs() {
		$breadcrumbs = new \Inc2734\WP_Breadcrumbs\Breadcrumbs();
		$breadcrumbs = $breadcrumbs->get();
		$title_item  = end( $breadcrumbs );
		return array_key_exists( 'title', $title_item ) ? $title_item['title'] : '';
	}

	/**
	 * Return whether to display the page header title
	 *
	 * @return boolean
	 */
	public static function is_output_page_header_title() {
		$return = false;

		if ( is_page() && 'title-on-page-header' === get_theme_mod( 'page-eyecatch' ) ) {
			$return = true;
		} elseif ( is_singular( 'post' ) && 'title-on-page-header' === get_theme_mod( 'post-eyecatch' ) ) {
			$return = true;
		}

		return apply_filters( 'snow_monkey_is_output_page_header_title', $return );
	}

	/**
	 * Return whether to display the page header
	 *
	 * @return boolean
	 */
	public static function is_output_page_header() {
		$return    = false;
		$image_url = Page_Header_Image_Url::get();
		$valid_choices = [ 'page-header', 'title-on-page-header' ];

		if ( is_front_page() ) {
			$return = false;
		} elseif ( static::is_output_page_header_title() ) {
			$return = true;
		} elseif ( $image_url ) {
			if ( is_singular( 'post' ) && in_array( get_theme_mod( 'post-eyecatch' ), $valid_choices ) ) {
				$return = true;
			} elseif ( is_page() && in_array( get_theme_mod( 'page-eyecatch' ), $valid_choices ) ) {
				$return = true;
			} elseif ( ! is_singular() ) {
				$return = true;
			}
		}

		return apply_filters( 'snow_monkey_is_output_page_header', $return );
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
