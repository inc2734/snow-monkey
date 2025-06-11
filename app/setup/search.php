<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 29.1.0
 */

use Framework\Helper;

add_filter(
	'snow_monkey_layout',
	function ( $layout ) {
		if ( Helper::is_search() ) {
			$_post_type = Helper::get_post_type_for_search();
			$new_layout = get_theme_mod( 'search-' . $_post_type . '-layout' );
			if ( $new_layout ) {
				return $new_layout;
			}
		}
		return $layout;
	},
	9
);

add_filter(
	'snow_monkey_get_template_part_args_template-parts/common/entries/entries',
	function ( $args ) {
		if ( Helper::is_search() ) {
			$_post_type          = Helper::get_post_type_for_search();
			$display_item_author = get_theme_mod( 'search-' . $_post_type . '-entries-display-item-author' );
			if ( 'true' === $display_item_author ) {
				$args['vars']['_display_item_author'] = true;
			} elseif ( 'false' === $display_item_author ) {
				$args['vars']['_display_item_author'] = false;
			}

			$display_item_date_icon = get_theme_mod( 'search-' . $_post_type . '-entries-display-item-date-icon' );
			if ( 'true' === $display_item_date_icon ) {
				$args['vars']['_display_item_date_icon'] = true;
			} elseif ( 'false' === $display_item_author ) {
				$args['vars']['_display_item_date_icon'] = false;
			}

			$display_item_excerpt = get_theme_mod( 'search-' . $_post_type . '-entries-display-item-excerpt' );
			if ( 'true' === $display_item_excerpt ) {
				$args['vars']['_display_item_excerpt'] = true;
			} elseif ( 'false' === $display_item_excerpt ) {
				$args['vars']['_display_item_excerpt'] = false;
			}

			$display_item_modified = get_theme_mod( 'search-' . $_post_type . '-entries-display-item-modified' );
			if ( 'true' === $display_item_modified ) {
				$args['vars']['_display_item_modified'] = true;
			} elseif ( 'false' === $display_item_modified ) {
				$args['vars']['_display_item_modified'] = false;
			}

			$display_item_published = get_theme_mod( 'search-' . $_post_type . '-entries-display-item-published' );
			if ( 'true' === $display_item_published ) {
				$args['vars']['_display_item_published'] = true;
			} elseif ( 'false' === $display_item_published ) {
				$args['vars']['_display_item_published'] = false;
			}

			$entries_gap = get_theme_mod( 'search-' . $_post_type . '-entries-gap' );
			if ( $entries_gap ) {
				$args['vars']['_entries_gap'] = $entries_gap;
			}

			$sm_1col = get_theme_mod( 'search-' . $_post_type . '-entries-layout-sm-1col' );
			if ( 'true' === $sm_1col ) {
				$args['vars']['_force_sm_1col'] = true;
			} elseif ( 'false' === $sm_1col ) {
				$args['vars']['_force_sm_1col'] = false;
			}

			$entries_layout = get_theme_mod( 'search-' . $_post_type . '-entries-layout' );
			if ( $entries_layout ) {
				$args['vars']['_entries_layout'] = $entries_layout;
			}
		}
		return $args;
	},
	9
);
