<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.3.0
 */

use Framework\Helper;

add_action(
	'get_template_part',
	function( $slug, $name, $templates ) {
		if ( ! is_child_theme() ) {
			return;
		}

		foreach ( $templates as $template ) {
			$parent  = get_template_directory() . '/' . $template;
			$located = \Inc2734\WP_View_Controller\Helper::locate_template( $template, false );

			if ( ! $located || ! file_exists( $parent ) ) {
				continue;
			}

			// もしテンプレート階層が変わって、なおかつ子テーマに古いテンプレートが存在している場合
			if ( $parent === $located ) {
				$renameds = Helper::get_file_renamed( $parent );
				foreach ( $renameds as $renamed ) {
					$old_template_located = \Inc2734\WP_View_Controller\Helper::locate_template( $renamed, false );
					if ( $old_template_located ) {
						ob_start();
						trigger_error(
							sprintf(
								'%1$sは古い配置です。最新の配置は%2$sです。',
								esc_html( $renamed ),
								esc_html( $template )
							),
							E_USER_NOTICE
						);
						ob_end_clean();
						return;
					}
				}
			}

			// バージョンが古い場合
			if ( $parent !== $located ) {
				$parent_version = Helper::get_file_version( get_template_directory() . '/' . $template );
				$child_version  = Helper::get_file_version( $located );

				$is_old_template = version_compare( $parent_version, $child_version, '>' );
				if ( $is_old_template ) {
					ob_start();
					trigger_error(
						sprintf(
							'このテンプレート（%1$s）は古いです。最新のバージョンは%2$sです。',
							esc_html( $child_version ),
							esc_html( $parent_version )
						),
						E_USER_WARNING
					);
					ob_end_clean();
					return;
				}
			}
		}
	},
	10,
	3
);
