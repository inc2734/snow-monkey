<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Core;

/**
* Uses composer autoloader
*/
require_once( get_theme_file_path( '/vendor/autoload.php' ) );

/**
 * Make theme available for translation
 *
 * @return void
 */
load_theme_textdomain( 'snow-monkey', get_template_directory() . '/languages' );

/**
 * Loads snow-monkey Bootstrap
 */
new Core();

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = apply_filters( 'snow_monkey_content_width', 1152 );
}

/**
 * Loads theme setup files
 */
$includes = [
	'/app/setup',
	'/app/widget/*',
];
foreach ( $includes as $include ) {
	foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
		if ( 0 === strpos( basename( $file ), '_' ) ) {
			continue;
		}

		$template_name = str_replace( array( trailingslashit( __DIR__ ), '.php' ), '', $file );
		get_template_part( $template_name );
	}
}

/**
 * Loads customizer
 */
$includes = [
	'/app/customizer/*',
	'/app/customizer/*/sections/*',
	'/app/customizer/*/sections/*/controls',
	'/app/customizer/*/controls',
];
foreach ( $includes as $include ) {
	foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
		$template_name = str_replace( array( trailingslashit( __DIR__ ), '.php' ), '', $file );
		get_template_part( $template_name );
	}
}

/**
 * Output comment for get_template_part()
 */
if ( defined( 'WP_DEBUG' ) && WP_DEBUG && ! is_customize_preview() ) {
	$slugs = [];
	$files = snow_monkey_glob_recursive( get_template_directory() );
	if ( is_child_theme() ) {
		$files = array_merge( $files, snow_monkey_glob_recursive( get_stylesheet_directory() ) );
	}

	foreach ( $files as $file ) {
		$slug = str_replace( [ get_template_directory() . '/', get_stylesheet_directory() . '/', '.php' ], '', $file );
		$slugs[ $slug ] = $slug;
	}

	foreach ( $slugs as $slug ) {
		add_action( 'get_template_part_' . $slug, function( $slug, $name ) {
			if ( $name ) {
				$slug = $slug . '-' . $name;
			}

			printf( "\n" . '<!-- Start : %1$s -->' . "\n", esc_html( $slug ) );
		}, 10, 2 );
	}
}

/**
 * Returns array of page templates for layout selector in customizer
 *
 * @return array
 *           @var string Template slug  e.g. right-sidebar
 *           @var string Template name  e.g. Right Sidebar
 */
function snow_monkey_get_page_templates() {
	$wrappers = [];

	foreach ( wpvc_config( 'layout' ) as $wrapper_dirs ) {
		foreach ( glob( get_theme_file_path( $wrapper_dirs . '/*' ) ) as $file ) {
			$name = rtrim( basename( $file ), '.php' );
			if ( 'blank' === $name || 'wrapper' === $name ) {
				continue;
			}

			$page_template_path = null;
			$template_name = wpvc_locate_template( (array) wpvc_config( 'page-templates' ), $name );
			if ( $template_name ) {
				$page_template_path = get_theme_file_path( $template_name . '.php' );

				$page_template_data = get_file_data( $page_template_path, [
					'template-name' => 'Template Name',
				] );
			}

			$template_name = $name;
			if ( ! empty( $page_template_data ) && ! empty( $page_template_data['template-name'] ) ) {
				$template_name = $page_template_data['template-name'];
			}

			// @codingStandardsIgnoreStart
			$wrappers[ $name ] = __( $template_name, 'snow-monkey' );
			// @codingStandardsIgnoreEnd
		}
	}

	return $wrappers;
}

/**
 * Returns public post type objects
 *
 * @return array
 */
function snow_monkey_get_public_post_types() {
	$_post_types = get_post_types( [
		'public' => true,
	] );
	unset( $_post_types['attachment'] );

	$post_types = [];
	foreach ( $_post_types as $post_type ) {
		$post_types[ $post_type ] = get_post_type_object( $post_type );
	}

	return $post_types;
}

/**
 * Returns PHP file list
 *
 * @param string Directory path
 * @return array PHP file list
 */
function snow_monkey_glob_recursive( $path ) {
	$files = [];
	if ( preg_match( '/\\' . DIRECTORY_SEPARATOR . 'vendor$/', $path ) ) {
		return $files;
	}

	foreach ( glob( $path . '/*' ) as $file ) {
		if ( is_dir( $file ) ) {
			$files = array_merge( $files, snow_monkey_glob_recursive( $file ) );
		} elseif ( preg_match( '/\.php$/', $file ) ) {
			$files[] = $file;
		}
	}

	return $files;
}

/**
 * Return output positions of eyecatch
 *
 * @return array
 */
function snow_monkey_eyecatch_position_choices() {
	return [
		'page-header'          => __( 'Page header', 'snow-monkey' ),
		'title-on-page-header' => __( 'Title on page header', 'snow-monkey' ),
		'content-top'          => __( 'Top of content', 'snow-monkey' ),
		'none'                 => __( 'None', 'snow-monkey' ),
	];
}

/**
 * Return whether to display the page header
 *
 * @return boolean
 */
function snow_monkey_is_output_page_header() {
	if ( is_page() && 'page-header' === get_theme_mod( 'page-eyecatch' ) ) {
		return true;
	} elseif ( is_singular( 'post' ) && 'page-header' === get_theme_mod( 'post-eyecatch' ) ) {
		return true;
	} elseif ( snow_monkey_is_output_page_header_title() ) {
		return true;
	} elseif ( ! is_singular() ) {
		return true;
	}

	return false;
}

/**
 * Return whether to display the page header title
 *
 * @return boolean
 */
function snow_monkey_is_output_page_header_title() {
	if ( is_page() && 'title-on-page-header' === get_theme_mod( 'page-eyecatch' ) ) {
		return true;
	} elseif ( is_singular( 'post' ) && 'title-on-page-header' === get_theme_mod( 'post-eyecatch' ) ) {
		return true;
	}

	return false;
}

/**
 * Return the child pages
 *
 * @var int $post_id
 * @return array
 */
function snow_monkey_get_child_pages( $post_id ) {
	return get_children( [
		'post_parent'    => $post_id,
		'post_type'      => 'page',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	] );
}
