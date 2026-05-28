<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 30.0.1
 */

use Framework\Helper;

/**
 * Return quoted font-family name for fontFace.
 *
 * @param string $font_family Font family.
 * @return string
 */
function _snow_monkey_quote_font_face_family( $font_family ) {
	$font_family = trim( $font_family );

	if ( preg_match( '/^".+"$/', $font_family ) || preg_match( "/^'.+'$/", $font_family ) ) {
		return $font_family;
	}

	return '"' . addcslashes( $font_family, '"\\' ) . '"';
}

/**
 * Merge selected customizer font weights into theme.json fontFace data.
 *
 * WordPress prints .wp-fonts-local from theme.json / Font Library data. The Snow Monkey
 * font-weight customizer must therefore extend that data before wp_print_font_faces().
 *
 * @param WP_Theme_JSON_Data $theme_json Theme JSON data.
 * @return WP_Theme_JSON_Data
 */
add_filter(
	'wp_theme_json_data_theme',
	function ( $theme_json ) {
		$base_font = get_theme_mod( 'base-font' );
		if ( ! $base_font ) {
			return $theme_json;
		}

		$font_weights = get_theme_mod( $base_font . '-font-weight' );
		if ( ! $font_weights ) {
			return $theme_json;
		}

		$theme_json_data = $theme_json->get_data();
		$font_families   = isset( $theme_json_data['settings']['typography']['fontFamilies'] )
			? $theme_json_data['settings']['typography']['fontFamilies']
			: array();

		if ( ! is_array( $font_families ) ) {
			return $theme_json;
		}

		$font_family_settings = apply_filters(
			'snow_monkey_font_family_settings',
			Helper::get_font_family_settings_from_font_families( $font_families )
		);

		if ( empty( $font_family_settings[ $base_font ]['variation'] ) ) {
			return $theme_json;
		}

		$selected_weights = is_array( $font_weights )
			? $font_weights
			: explode( ',', $font_weights );
		$selected_weights = array_filter( array_map( 'trim', $selected_weights ) );
		$selected_weights = array_map(
			function ( $weight ) {
				if ( preg_match( '/^\d+/', $weight, $matches ) ) {
					return $matches[0];
				}

				return $weight;
			},
			$selected_weights
		);
		$selected_weights = array_unique( $selected_weights );
		if ( ! $selected_weights ) {
			return $theme_json;
		}

		$updated = false;
		foreach ( $font_families as $index => $font_family ) {
			if ( empty( $font_family['slug'] ) || $base_font !== (string) $font_family['slug'] ) {
				continue;
			}

			if ( empty( $font_families[ $index ]['fontFace'] ) || ! is_array( $font_families[ $index ]['fontFace'] ) ) {
				$font_families[ $index ]['fontFace'] = array();
			}

			$defined_weights = array();
			foreach ( $font_families[ $index ]['fontFace'] as $font_face ) {
				if ( ! empty( $font_face['fontWeight'] ) ) {
					$defined_weight = (string) $font_face['fontWeight'];
					if ( preg_match( '/^\d+/', $defined_weight, $matches ) ) {
						$defined_weight = $matches[0];
					}

					$defined_weights[] = $defined_weight;
				}
			}

			foreach ( $selected_weights as $weight ) {
				if (
					in_array( (string) $weight, $defined_weights, true ) ||
					empty( $font_family_settings[ $base_font ]['variation'][ $weight ]['src'] )
				) {
					continue;
				}

				$font_families[ $index ]['fontFace'][] = array(
					'fontFamily' => _snow_monkey_quote_font_face_family( $font_family_settings[ $base_font ]['name'] ),
					'fontWeight' => (string) $weight,
					'fontStyle'  => 'normal',
					'src'        => array( $font_family_settings[ $base_font ]['variation'][ $weight ]['src'] ),
				);

				$updated = true;
			}

			break;
		}

		if ( ! $updated ) {
			return $theme_json;
		}

		$theme_json->update_with(
			array(
				'version'  => isset( $theme_json_data['version'] ) ? $theme_json_data['version'] : 3,
				'settings' => array(
					'typography' => array(
						'fontFamilies' => $font_families,
					),
				),
			)
		);

		return $theme_json;
	}
);
