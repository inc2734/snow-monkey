<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version <unversion>
 */

use Framework\Helper;

add_action(
	'get_template_part',
	function( $slug, $name, $templates ) {
		if ( ! is_child_theme() ) {
			return;
		}

		if ( ! \Inc2734\WP_View_Controller\Helper::locate_template( $templates, false ) ) {
			$message = sprintf(
				/* translators: 1: Template slug */
				esc_html__( '%1$s is not found. It may have been deleted or moved.', 'snow-monkey' ),
				esc_html( $slug )
			);

			defined( 'WP_DEBUG' ) && WP_DEBUG
				? trigger_error( esc_html( $message ), E_USER_NOTICE )
				: error_log( 'Notice: ' . esc_html( $message ) );

			return;
		}

		foreach ( $templates as $template ) {
			$parent  = get_template_directory() . '/' . $template;
			$located = \Inc2734\WP_View_Controller\Helper::locate_template( $template, false );

			if ( ! $located || ! file_exists( $parent ) ) {
				continue;
			}

			if ( $parent === $located ) {
				$renameds = Helper::get_file_renamed( $parent );
				foreach ( $renameds as $renamed ) {
					$old_template_located = \Inc2734\WP_View_Controller\Helper::locate_template( $renamed, false );
					if ( $old_template_located ) {
						$message = sprintf(
							/* translators: 1: Old template slug, 2: Latest template slug */
							esc_html__( 'The overwrite of %1$s may have failed. The latest position is %2$s.', 'snow-monkey' ),
							esc_html( $renamed ),
							esc_html( $template )
						);

						defined( 'WP_DEBUG' ) && WP_DEBUG
							? trigger_error( esc_html( $message ), E_USER_NOTICE )
							: error_log( 'Notice: ' . esc_html( $message ) );

						return;
					}
				}
			}

			if ( $parent !== $located ) {
				$parent_version = Helper::get_file_version( get_template_directory() . '/' . $template );
				$child_version  = Helper::get_file_version( $located );

				if ( $parent_version && $child_version && version_compare( $parent_version, $child_version, '>' ) ) {
					$message = sprintf(
						/* translators: 1: Template slug, 2: Child template version, 3: Parent template version */
						esc_html__( '%1$s has been overwritten with the old version (%2$s). The latest version is %3$s.', 'snow-monkey' ),
						esc_html( $template ),
						esc_html( $child_version ),
						esc_html( $parent_version )
					);

					defined( 'WP_DEBUG' ) && WP_DEBUG
						? trigger_error( esc_html( $message ), E_USER_NOTICE )
						: error_log( 'Notice: ' . esc_html( $message ) );

					return;
				}
			}
		}
	},
	10,
	3
);
