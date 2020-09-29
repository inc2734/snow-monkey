<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Framework\Helper;

/**
 * Return the child pages.
 *
 * @deprecated
 *
 * @param int $post_id The post ID.
 * @return array
 */
function snow_monkey_get_child_pages( $post_id ) {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 4.3.0',
		'\Framework\Helper::get_child_pages_query()'
	);

	return Helper::get_child_pages_query( $post_id );
}

/**
 * Returns main script handle.
 *
 * @deprecated
 *
 * @return string
 */
function snow_monkey_get_main_script_handle() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 4.3.0',
		'\Framework\Helper::get_main_script_handle()'
	);

	return Helper::get_main_script_handle();
}

/**
 * Returns main style handle.
 *
 * @deprecated
 *
 * @return string
 */
function snow_monkey_get_main_style_handle() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 4.3.0',
		'\Framework\Helper::get_main_style_handle()'
	);

	return Helper::get_main_style_handle();
}

/**
 * Returns public post type objects.
 *
 * @deprecated
 *
 * @return void
 */
function snow_monkey_get_public_post_types() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 4.3.0'
	);
}

/**
 * Return related posts.
 *
 * @deprecated
 *
 * @param int $post_id The post ID.
 * @return array
 */
function snow_monkey_get_related_posts_query( $post_id ) {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 4.3.0',
		'\Framework\Helper::get_related_posts_query()'
	);

	return Helper::get_related_posts_query( $post_id );
}

/**
 * Returns PHP file list.
 *
 * @deprecated
 *
 * @return void
 */
function snow_monkey_glob_recursive() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 4.3.0'
	);
}

/**
 * Display the site logo or the site title
 *
 * @deprecated
 *
 * @return void
 */
function snow_monkey_the_site_branding_title() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 4.3.0',
		'\Framework\Helper::the_site_branding()'
	);

	Helper::the_site_branding();
}

/**
 * Sets entry content styles.
 *
 * @deprecated
 *
 * @return void
 */
function snow_monkey_entry_content_styles() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0'
	);
}

/**
 * Return output positions of eyecatch.
 *
 * @deprecated
 *
 * @return array
 */
function snow_monkey_eyecatch_position_choices() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0',
		'\Framework\Helper::eyecatch_position_choices()'
	);

	return Helper::eyecatch_position_choices();
}

/**
 * Return default header position
 *
 * @deprecated
 *
 * @return string
 */
function snow_monkey_get_default_header_position() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0',
		'\Framework\Helper::get_default_header_position()'
	);

	return Helper::get_default_header_position();
}

/**
 * Return header position
 *
 * @deprecated
 *
 * @return string
 */
function snow_monkey_get_header_position() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0',
		'\Framework\Helper::get_header_position()'
	);

	return Helper::get_header_position();
}

/**
 * Returns page header image url
 *
 * @deprecated
 *
 * @return string
 */
function snow_monkey_get_page_header_image_url() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0',
		'\Framework\Helper::get_page_header_image_url()'
	);

	return Helper::get_page_header_image_url();
}

/**
 * Returns page title from Breadcrumbs
 *
 * @deprecated
 *
 * @return string
 */
function snow_monkey_get_page_title_from_breadcrumbs() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0',
		'\Framework\Helper::get_page_title_from_breadcrumbs()'
	);

	return Helper::get_page_title_from_breadcrumbs();
}

/**
 * Return whether to display the page header title
 *
 * @deprecated
 *
 * @return boolean
 */
function snow_monkey_is_output_page_header_title() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0',
		'\Framework\Helper::is_output_page_header_title()'
	);

	return Helper::is_output_page_header_title();
}

/**
 * Return whether to display the page header
 *
 * @deprecated
 *
 * @return boolean
 */
function snow_monkey_is_output_page_header() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0',
		'\Framework\Helper::display_page_header()'
	);

	return Helper::display_page_header();
}

/**
 * Return trimed title
 *
 * @deprecated
 *
 * @return void
 */
function snow_monkey_the_title_trimed() {
	_deprecated_function(
		__FUNCTION__,
		'Snow Monkey 5.1.0',
		'\Framework\Helper::the_title_trimed()'
	);

	Helper::the_title_trimed();
}
