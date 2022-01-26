<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.0.1
 */

namespace Framework;

use Inc2734\WP_Helper;
use Inc2734\WP_Breadcrumbs;
use Inc2734\WP_View_Controller;
use Framework\Model\Setup_Loader;

class Helper {

	use WP_Helper\Contract\Helper;
	use Contract\Helper\Page_Header;
	use Contract\Helper\Term_Thumbnail;
	use Contract\Helper\Homepage_Thumbnail;
	use Contract\Helper\Post_Type_Archive_Thumbnail;
	use Contract\Helper\WooCommerce_Archive_Thumbnail;
	use Contract\Helper\BbPress_Archive_Thumbnail;
	use Contract\Helper\Deprecated;
	use WP_View_Controller\App\Contract\Template_Tag;

	/**
	 * get_template_part php files.
	 *
	 * @param string|array $directory_or_files Target directory (Full path or directory slug) or file slug list.
	 * @param boolean      $exclude_underscore Exclude if true.
	 */
	public static function get_template_parts( $directory_or_files, $exclude_underscore = false ) {
		if ( is_array( $directory_or_files ) ) {
			$files = $directory_or_files;
			if ( $exclude_underscore ) {
				$files = array_filter(
					$files,
					function( $file_slug ) {
						return 0 !== strpos( $file_slug, '_' );
					}
				);
			}
		} else {
			$directory = $directory_or_files;
			$files     = static::get_theme_files( $directory, $exclude_underscore );
			if ( ! $files ) {
				return $files;
			}

			$files = array_map(
				function( $filename ) {
					return str_replace( '.php', '', $filename );
				},
				$files
			);
		}

		foreach ( $files as $file_slug ) {
			WP_View_Controller\Helper::get_template_part( $file_slug );
		}
	}

	/**
	 * Load files.
	 *
	 * @param string  $method             Loading method.
	 * @param string  $directory          Target directory.
	 * @param boolean $exclude_underscore Exclude if true.
	 * @return void
	 */
	public static function load_files( $method, $directory, $exclude_underscore = false ) {
		$setup_loader = new Setup_Loader();
		$setup_loader->load( $method, $directory, $exclude_underscore );
	}

	/**
	 * Return output positions of eyecatch.
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
	 * Return page header alignment choices.
	 *
	 * @return array
	 */
	public static function page_header_align_choices() {
		return [
			'left'   => __( 'Left', 'snow-monkey' ),
			'center' => __( 'Center', 'snow-monkey' ),
			'right'  => __( 'Right', 'snow-monkey' ),
		];
	}

	/**
	 * Return header position choices.
	 *
	 * @return array
	 */
	public static function header_position_choices() {
		return [
			'sticky'                 => __( 'Sticky', 'snow-monkey' ),
			'sticky-overlay'         => __( 'Overlay (Sticky)', 'snow-monkey' ),
			'sticky-overlay-colored' => __( 'Overlay (Sticky / When scrolling, whilte background)', 'snow-monkey' ),
			'overlay'                => __( 'Overlay', 'snow-monkey' ),
			''                       => __( 'Normal', 'snow-monkey' ),
		];
	}

	/**
	 * Returns page title from Breadcrumbs.
	 *
	 * @return string
	 */
	public static function get_page_title_from_breadcrumbs() {
		$breadcrumbs_items = static::get_breadcrumbs_items();
		$title_item        = end( $breadcrumbs_items );
		return array_key_exists( 'title', $title_item ) ? $title_item['title'] : '';
	}


	/**
	 * Return trimed title.
	 *
	 * @param string|null $title The post title.
	 * @return void
	 */
	public static function the_title_trimed( $title = null ) {
		// phpcs:disable WordPress.WP.I18n.MissingArgDomain
		$num_words            = 80;
		$excerpt_length_ratio = 55 / _x( '55', 'excerpt_length' );
		$num_words            = apply_filters( 'snow_monkey_entry_summary_title_num_words', $num_words * $excerpt_length_ratio );
		// phpcs:enable
		if ( $num_words ) {
			if ( is_null( $title ) ) {
				ob_start();
				the_title();
				$title = ob_get_clean();
			}

			$title = wp_trim_words( $title, $num_words );
			echo esc_html( $title );
		} else {
			if ( is_null( $title ) ) {
				the_title();
			} else {
				echo esc_html( $title );
			}
		}
	}

	/**
	 * Get global variable ( For template part ).
	 *
	 * @param string $name The variable name.
	 * @param string $default mixed The default value.
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
		static $breadcrumbs_items = [];
		if ( $breadcrumbs_items ) {
			return $breadcrumbs_items;
		}

		$breadcrumbs       = new WP_Breadcrumbs\Bootstrap();
		$breadcrumbs_items = apply_filters( 'snow_monkey_breadcrumbs', $breadcrumbs->get() );
		return $breadcrumbs_items;
	}

	/**
	 * Return copyright text.
	 *
	 * @return string
	 */
	public static function get_copyright() {
		$theme_link = sprintf(
			'<a href="https://snow-monkey.2inc.org" target="_blank" rel="noreferrer">%s</a>',
			__( 'Snow Monkey', 'snow-monkey' )
		);

		$developer_link = sprintf(
			'<a href="https://2inc.org" target="_blank" rel="noreferrer">%s</a>',
			__( 'Monkey Wrench', 'snow-monkey' )
		);

		$wordpress_link = sprintf(
			'<a href="https://wordpress.org/" target="_blank" rel="noreferrer">%s</a>',
			__( 'WordPress', 'snow-monkey' )
		);

		$theme_by = sprintf(
			/* translators: %1$s: Theme link, %2$s: Developer link */
			__( '%1$s theme by %2$s', 'snow-monkey' ),
			$theme_link,
			$developer_link
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
	 * Return public taxonomy tied to the post.
	 *
	 * @param int|WP_Post $post The Post object.
	 * @return array
	 */
	public static function get_the_public_taxonomy( $post = 0 ) {
		$post = get_post( $post );
		if ( ! $post ) {
			return [];
		}

		$cache_key         = $post->ID;
		$cache_group       = 'snow-monkey/public-taxonomies';
		$public_taxonomies = wp_cache_get( $cache_key, $cache_group );
		if ( is_array( $public_taxonomies ) ) {
			return $public_taxonomies;
		}

		$taxonomies        = get_object_taxonomies( get_post_type( $post ), 'object' );
		$public_taxonomies = [];

		foreach ( $taxonomies as $taxonomy ) {
			if ( ! $taxonomy->public ) {
				continue;
			}

			$public_taxonomies[ $taxonomy->name ] = $taxonomy;
		}

		wp_cache_set( $cache_key, $public_taxonomies, $cache_group );
		return $public_taxonomies;
	}

	/**
	 * Return public terms tied to the post.
	 *
	 * @param int|WP_Post $post The Post object.
	 * @return array
	 */
	public static function get_the_public_terms( $post = 0 ) {
		$post = get_post( $post );
		if ( ! $post ) {
			return [];
		}

		$cache_key    = $post->ID;
		$cache_group  = 'snow-monkey/the-public-terms';
		$public_terms = wp_cache_get( $cache_key, $cache_group );
		if ( is_array( $public_terms ) ) {
			return $public_terms;
		}

		$public_taxonomies = static::get_the_public_taxonomy( $post );
		$public_terms      = [];

		foreach ( $public_taxonomies as $public_taxonomy ) {
			$_terms = get_the_terms( $post, $public_taxonomy->name );
			if ( ! empty( $_terms ) && is_array( $_terms ) && ! is_wp_error( $_terms ) ) {
				$public_terms = array_merge( $public_terms, $_terms );
			}
		}

		wp_cache_set( $cache_key, $public_terms, $cache_group );
		return $public_terms;
	}

	/**
	 * Return specific terms.
	 *
	 * @param array|string $args Array or string of arguments.
	 * @return array
	 */
	public static function get_terms( $args = array() ) {
		if ( ! is_array( $args ) ) {
			$taxonomy         = $args;
			$args             = [];
			$args['taxonomy'] = [ $taxonomy ];
		}

		if ( ! isset( $args['taxonomy'] ) ) {
			return [];
		}

		$taxonomies = $args['taxonomy'];

		$cache_key = 'snow-monkey-all-' . crc32( json_encode( $taxonomies ) );
		$terms     = wp_cache_get( $cache_key );
		if ( is_array( $terms ) ) {
			return $terms;
		}

		$terms = get_terms( $args );
		wp_cache_set( $cache_key, $terms );
		if ( is_array( $terms ) ) {
			return $terms;
		}

		return [];
	}

	/**
	 * Return all users.
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
	 * Return editor color palette settings.
	 *
	 * @return array
	 */
	public static function get_color_palette() {
		return apply_filters(
			'snow_monkey_editor_color_palette',
			[
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
			]
		);
	}

	/**
	 * Return editor font size settings.
	 *
	 * @return array
	 */
	public static function get_font_sizes() {
		$base_font_size_fallback = 16;
		$base_font_size          = get_theme_mod( 'base-font-size' );
		$base_font_size          = $base_font_size ? $base_font_size : $base_font_size_fallback;

		return apply_filters(
			'snow_monkey_editor_font_sizes',
			[
				[
					'name' => _x( 'Small', 'editor-font-sizes', 'snow-monkey' ),
					'slug' => 'sm-small',
					'size' => $base_font_size - 2 . 'px',
				],
				[
					'name' => _x( 'Normal', 'editor-font-sizes', 'snow-monkey' ),
					'slug' => 'sm-normal',
					'size' => $base_font_size . 'px',
				],
				[
					'name' => _x( 'Medium', 'editor-font-sizes', 'snow-monkey' ),
					'slug' => 'sm-medium',
					'size' => $base_font_size + 4 . 'px',
				],
				[
					'name' => _x( 'Large', 'editor-font-sizes', 'snow-monkey' ),
					'slug' => 'sm-large',
					'size' => $base_font_size + 12 . 'px',
				],
				[
					'name' => _x( 'Large', 'editor-font-sizes', 'snow-monkey' ) . ' +',
					'slug' => 'sm-xlarge',
					'size' => $base_font_size + 28 . 'px',
				],
				[
					'name' => _x( 'Large', 'editor-font-sizes', 'snow-monkey' ) . ' ++',
					'slug' => 'sm-xxlarge',
					'size' => $base_font_size + 60 . 'px',
				],
				[
					'name' => _x( 'Large', 'editor-font-sizes', 'snow-monkey' ) . ' +++',
					'slug' => 'sm-xxxlarge',
					'size' => $base_font_size + 124 . 'px',
				],
			]
		);
	}

	/**
	 * Retrun header classes.
	 *
	 * @return array
	 */
	public static function get_header_classes() {
		$header_layout      = get_theme_mod( 'header-layout' );
		$header_position    = get_theme_mod( 'header-position' );
		$header_position_lg = get_theme_mod( 'header-position-lg' );

		if ( is_front_page() && is_page() ) {
			$home_page_header_position = get_theme_mod( 'home-page-header-position' );
			if ( 'inherit' !== $home_page_header_position ) {
				$header_position = $home_page_header_position;
			}

			$home_page_header_position_lg = get_theme_mod( 'home-page-header-position-lg' );
			if ( 'inherit' !== $home_page_header_position_lg ) {
				$header_position_lg = $home_page_header_position_lg;
			}
		}

		$classes = [ 'l-header', 'l-header--' . $header_layout ];

		if ( $header_position ) {
			$classes[] = 'l-header--' . $header_position . '-sm';
		}

		if ( $header_position_lg ) {
			$classes[] = 'l-header--' . $header_position_lg . '-lg';
		}

		return $classes;
	}

	/**
	 * Return true if has the drop-nav.
	 *
	 * @return boolean
	 */
	public static function has_drop_nav() {
		$return = false;

		if ( has_nav_menu( 'global-nav' ) ) {
			$has_drop_nav       = in_array( get_theme_mod( 'header-position' ), [ '', 'overlay' ], true );
			$has_drop_nav_on_pc = in_array( get_theme_mod( 'header-position-lg' ), [ '', 'overlay' ], true );

			if ( $has_drop_nav || $has_drop_nav_on_pc ) {
				$return = true;
			}
		}

		return apply_filters( 'snow_monkey_has_drop_nav', $return );
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
	 * Return true when IE.
	 *
	 * @return boolean
	 */
	public static function is_ie() {
		if ( ! isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
			return false;
		}

		$browser = strtolower( $_SERVER['HTTP_USER_AGENT'] );
		return strstr( $browser, 'trident' ) || strstr( $browser, 'msie' );
	}

	/**
	 * Callback for excerpt_length
	 *
	 * @param null|int $num_words      Number of words.
	 * @param string   $entries_layout Layout of entries.
	 * @param int      $number         The maximum number of words. Default 55.
	 * @return int
	 */
	public static function entry_summary_content_excerpt_length( $num_words, $entries_layout, $number = null ) {
		if ( null !== $num_words ) {
			return $num_words;
		}

		if ( is_null( $number ) ) {
			// phpcs:disable WordPress.WP.I18n.MissingArgDomain
			$number = _x( '55', 'excerpt_length' );
			// phpcs:enable
		}

		if ( in_array( $entries_layout, [ 'rich-media', 'carousel' ], true ) ) {
			$num_words            = 25;
			$excerpt_length_ratio = 55 / $number;
			return $num_words / $excerpt_length_ratio;
		}

		return $number;
	}

	/**
	 * Return font-family selected in the customizer.
	 *
	 * @return string
	 */
	public static function get_font_family() {
		$base_font   = get_theme_mod( 'base-font' );
		$font_family = [];

		if ( 'sans-serif' === $base_font ) {
			$font_family = [ 'system-ui', '-apple-system', 'BlinkMacSystemFont', '"ヒラギノ角ゴ W3"', 'sans-serif' ];
		} elseif ( 'serif' === $base_font ) {
			$font_family = [ 'serif' ];
		} elseif ( 'noto-sans-jp' === $base_font ) {
			$font_family = [ '"Noto Sans JP"', 'sans-serif' ];
		} elseif ( 'noto-serif-jp' === $base_font ) {
			$font_family = [ '"Noto Serif JP"', 'serif' ];
		} elseif ( 'm-plus-1p' === $base_font ) {
			$font_family = [ '"M PLUS 1p"', 'sans-serif' ];
		} elseif ( 'm-plus-rounded-1c' === $base_font ) {
			$font_family = [ '"M PLUS Rounded 1c"', 'sans-serif' ];
		}

		return implode( ',', $font_family );
	}

	/**
	 * bbPress is mypage or not.
	 *
	 * @return boolean
	 */
	public static function is_bbpress_mypage() {
		if ( ! class_exists( '\bbPress' ) ) {
			return false;
		}

		return bbp_is_single_view()
			|| bbp_is_single_user_edit()
			|| bbp_is_single_user()
			|| bbp_is_user_home()
			|| bbp_is_user_home_edit()
			|| bbp_is_favorites()
			|| bbp_is_subscriptions()
			|| bbp_is_topics_created()
			|| bbp_is_replies_created();
	}

	/**
	 * bbPress is single or not.
	 *
	 * @return boolean
	 */
	public static function is_bbpress_single() {
		if ( ! class_exists( '\bbPress' ) ) {
			return false;
		}

		return bbp_is_single_topic()
			|| bbp_is_single_reply()
			|| bbp_is_topic_edit()
			|| bbp_is_topic_merge()
			|| bbp_is_topic_split()
			|| bbp_is_reply_edit()
			|| bbp_is_reply_move();
	}

	/**
	 * bbPress is archive or not.
	 *
	 * @return boolean
	 */
	public static function is_bbpress_archive() {
		if ( ! class_exists( '\bbPress' ) ) {
			return false;
		}

		return bbp_is_topic_tag()
			|| bbp_is_topic_tag_edit()
			|| bbp_is_forum_archive()
			|| bbp_is_topic_archive()
			|| bbp_is_single_forum()
			|| bbp_is_search()
			|| bbp_is_search_results();
	}

	/**
	 * Return block pattern html
	 *
	 * @param string $slug Block pattern slug.
	 * @return string
	 */
	public static function render_block_pattern( $slug ) {
		$path = realpath( get_template_directory() . '/block-patterns/' . $slug . '/pattern.php' );
		if ( ! file_exists( $path ) ) {
			return '';
		}

		ob_start();
		include( $path );
		return preg_replace( '/(\t|\r\n|\r|\n)/ms', '', ob_get_clean() );
	}
}
