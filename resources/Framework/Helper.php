<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <version>
 */

namespace Framework;

use Inc2734\Mimizuku_Core;
use Inc2734\WP_Breadcrumbs;

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
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_default_header_position() {
		return get_theme_mod( 'header-position' );
	}

	/**
	 * Return header position
	 *
	 * @deprecated
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
	 * Return header-position-fixed
	 *
	 * @deprecated
	 *
	 * @return string
	 */
	public static function get_header_position_fixed() {
		$fixed           = get_theme_mod( 'header-position-fixed' );
		$header_position = get_theme_mod( 'header-position' );

		if ( 'overlay' !== $header_position ) {
			return null;
		}

		return $fixed ? 'true' : 'false';
	}

	/**
	 * Return scrolling-header-colored
	 *
	 * @return string
	 */
	public static function get_scrolling_header_colored() {
		$scrolling_colored = get_theme_mod( 'scrolling-header-colored' );
		$header_position   = get_theme_mod( 'header-position' );

		if ( 'overlay' !== $header_position ) {
			return null;
		}

		return $scrolling_colored ? 'true' : 'false';
	}

	/**
	 * Returns page title from Breadcrumbs
	 *
	 * @return string
	 */
	public static function get_page_title_from_breadcrumbs() {
		$breadcrumbs = new WP_Breadcrumbs\Bootstrap();
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
		$breadcrumbs = new WP_Breadcrumbs\Bootstrap();
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

	/**
	 * Return specific terms
	 *
	 * @param string $taxonomy
	 * @return array
	 */
	public static function get_terms( $taxonomy ) {
		$terms = wp_cache_get( 'snow-monkey-all-' . $taxonomy );
		if ( is_array( $terms ) ) {
			return $terms;
		}

		$terms = get_terms( [ $taxonomy ] );
		wp_cache_set( 'snow-monkey-all-' . $taxonomy, $terms );
		if ( is_array( $terms ) ) {
			return $terms;
		}

		return [];
	}

	/**
	 * Return all users
	 *
	 * @return array
	 */
	public static function get_users() {
		$users = wp_cache_get( 'snow-monkey-all-users' );
		if ( is_array( $users ) ) {
			return $users;
		}

		$users = get_users();
		wp_cache_set( 'snow-monkey-all-users', $users );
		if ( is_array( $users ) ) {
			return $users;
		}

		return [];
	}

	/**
	 * Return editor color palette settings
	 *
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 *
	 * @return array
	 */
	public static function get_color_palette() {
		return apply_filters(
			'snow_monkey_editor_color_palette',
			[
				[
					'name'  => __( 'White', 'snow-monkey' ),
					'slug'  => 'white',
					'color' => '#fff',
				],
				[
					'name'  => __( 'Black', 'snow-monkey' ),
					'slug'  => 'black',
					'color' => '#000',
				],
				[
					'name'  => __( 'Text color', 'snow-monkey' ),
					'slug'  => 'text-color',
					'color' => '#333',
				],
				[
					'name'  => __( 'Dark gray', 'snow-monkey' ),
					'slug'  => 'dark-gray',
					'color' => '#999',
				],
				[
					'name'  => __( 'Gray', 'snow-monkey' ),
					'slug'  => 'gray',
					'color' => '#ccc',
				],
				[
					'name'  => __( 'Light gray', 'snow-monkey' ),
					'slug'  => 'very-light-gray',
					'color' => '#eee',
				],
				[
					'name'  => __( 'Lightest gray', 'snow-monkey' ),
					'slug'  => 'lightest-grey',
					'color' => '#f7f7f7',
				],
				[
					'name'  => __( 'Accent color', 'snow-monkey' ),
					'slug'  => 'accent-color',
					'color' => get_theme_mod( 'accent-color', '#cd162c' ), // On after_setup_theme, default value not set yet.
				],
				[
					'name'  => __( 'Sub accent color', 'snow-monkey' ),
					'slug'  => 'sub-accent-color',
					'color' => get_theme_mod( 'sub-accent-color', '#707593' ), // On after_setup_theme, default value not set yet.
				],
				[
					'name'     => __( 'Pale pink', 'snow-monkey' ),
					'slug'     => 'pale-pink',
					'color'    => '#f78da7',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Vivid red', 'snow-monkey' ),
					'slug'     => 'vivid-red',
					'color'    => '#cf2e2e',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Luminous vivid orange', 'snow-monkey' ),
					'slug'     => 'luminous-vivid-orange',
					'color'    => '#ff6900',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Luminous vivid amber', 'snow-monkey' ),
					'slug'     => 'luminous-vivid-amber',
					'color'    => '#fcb900',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Light green cyan', 'snow-monkey' ),
					'slug'     => 'light-green-cyan',
					'color'    => '#7bdcb5',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Vivid green cyan', 'snow-monkey' ),
					'slug'     => 'vivid-green-cyan',
					'color'    => '#00d084',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Pale cyan blue', 'snow-monkey' ),
					'slug'     => 'pale-cyan-blue',
					'color'    => '#8ed1fc',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Vivid cyan blue', 'snow-monkey' ),
					'slug'     => 'vivid-cyan-blue',
					'color'    => '#0693e3',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Cyan bluish gray', 'snow-monkey' ),
					'slug'     => 'cyan-bluish-gray',
					'color'    => '#abb8c3',
					'_builtin' => true,
				],
				[
					'name'     => __( 'Very dark gray', 'snow-monkey' ),
					'slug'     => 'very-dark-gray',
					'color'    => '#313131',
					'_builtin' => true,
				],
			]
		);
	}

	/**
	 * Retrun header classes
	 *
	 * @return array
	 */
	public static function get_header_classes() {
		$header_position = get_theme_mod( 'header-position' );
		$classes = [ 'l-header' ];

		if ( ! $header_position ) {
			return $classes;
		}

		$classes[] = 'l-header--' . $header_position . '-sm';
		$classes[] = ! get_theme_mod( 'header-position-only-mobile' ) ? 'l-header--' . $header_position . '-lg' : null;

		if ( 'sticky-overlay' === $header_position ) {
			$colored = get_theme_mod( 'scrolling-header-colored' );
			if ( $colored ) {
				$classes[] = 'l-header--' . $header_position . '-sm--colored';
				$classes[] = ! get_theme_mod( 'header-position-only-mobile' ) ? 'l-header--' . $header_position . '-lg--colored' : null;
			}
		}

		return array_filter( $classes );
	}

	/**
	 * Return true if has the drop-nav
	 *
	 * @return boolean
	 */
	public static function has_drop_nav() {
		if ( has_nav_menu( 'global-nav' ) ) {
			$has_drop_nav       = in_array( get_theme_mod( 'header-position' ), [ 'normal', 'overlay' ] );
			$has_drop_nav_on_pc = get_theme_mod( 'header-position-only-mobile' );

			if ( $has_drop_nav || $has_drop_nav_on_pc ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Return hooked value of snow_monkey_use_auto_custom_logo_size.
	 * If return true, the logo size setting in customizer is applyed.
	 *
	 * @return boolean
	 */
	public static function use_auto_custom_logo_size() {
		return apply_filters( 'snow_monkey_use_auto_custom_logo_size', true );
	}

	/**
	 * The overlay header and the ticky overlay has infobar in the header.
	 *
	 * @return boolean
	 */
	public static function should_infobar_in_header() {
		return in_array( get_theme_mod( 'header-position' ), [ 'overlay', 'sticky-overlay' ] );
	}
}
