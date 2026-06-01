<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 30.0.2
 */

use Framework\Helper;

/**
 * Normalize a font family name for duplicate checks.
 *
 * @param string $font_family Font family.
 * @return string
 */
function _snow_monkey_normalize_font_family_name( $font_family ) {
	$font_family = trim( (string) $font_family );
	$font_family = preg_replace( '/,\s*.+$/', '', $font_family );
	$font_family = trim( $font_family, " \t\n\r\0\x0B\"'" );
	$font_family = strtolower( $font_family );

	return $font_family;
}

/**
 * Return comparable keys for a font family.
 *
 * @param array $font_family Font family data.
 * @return array
 */
function _snow_monkey_get_font_family_keys( $font_family ) {
	$keys = array();

	foreach ( array( 'name', 'fontFamily' ) as $key ) {
		if ( empty( $font_family[ $key ] ) ) {
			continue;
		}

		$normalized = _snow_monkey_normalize_font_family_name( $font_family[ $key ] );
		if ( $normalized ) {
			$keys[] = $normalized;
		}
	}

	return array_values( array_unique( $keys ) );
}

/**
 * Return a comparable key for a font face.
 *
 * @param array $font_face Font face data.
 * @return string
 */
function _snow_monkey_get_font_face_key( $font_face ) {
	$font_weight = isset( $font_face['fontWeight'] ) ? (string) $font_face['fontWeight'] : '';
	if ( preg_match( '/^\d+/', $font_weight, $matches ) ) {
		$font_weight = $matches[0];
	}

	$font_style   = isset( $font_face['fontStyle'] ) ? (string) $font_face['fontStyle'] : 'normal';
	$font_stretch = isset( $font_face['fontStretch'] ) ? (string) $font_face['fontStretch'] : '';

	return implode( '|', array( $font_style, $font_weight, $font_stretch ) );
}

/**
 * Merge font faces without duplicating style/weight combinations.
 *
 * @param array $base_font_faces Base font faces.
 * @param array $additional_font_faces Additional font faces.
 * @return array
 */
function _snow_monkey_merge_font_faces( $base_font_faces, $additional_font_faces ) {
	$base_font_faces       = is_array( $base_font_faces ) ? $base_font_faces : array();
	$additional_font_faces = is_array( $additional_font_faces ) ? $additional_font_faces : array();

	$defined_font_faces = array();
	foreach ( $base_font_faces as $font_face ) {
		if ( is_array( $font_face ) ) {
			$defined_font_faces[] = _snow_monkey_get_font_face_key( $font_face );
		}
	}

	foreach ( $additional_font_faces as $font_face ) {
		if ( ! is_array( $font_face ) ) {
			continue;
		}

		$font_face_key = _snow_monkey_get_font_face_key( $font_face );
		if ( in_array( $font_face_key, $defined_font_faces, true ) ) {
			continue;
		}

		$base_font_faces[]    = $font_face;
		$defined_font_faces[] = $font_face_key;
	}

	return $base_font_faces;
}

/**
 * Merge same-name Font Library font faces into theme font families and remove duplicate custom families.
 *
 * Gutenberg looks up font faces by the first matching fontFamily string.
 * When the same font is present in both theme and custom origins, keep the
 * theme slug for compatibility and merge custom font faces into that entry
 * for the editor UI.
 *
 * @param array $font_families Font families grouped by origin.
 * @return array
 */
function _snow_monkey_merge_duplicate_font_families( $font_families ) {
	if (
		empty( $font_families['theme'] ) ||
		! is_array( $font_families['theme'] ) ||
		empty( $font_families['custom'] ) ||
		! is_array( $font_families['custom'] )
	) {
		return $font_families;
	}

	$custom_family_indexes = array();
	foreach ( $font_families['custom'] as $index => $font_family ) {
		if ( ! is_array( $font_family ) ) {
			continue;
		}

		foreach ( _snow_monkey_get_font_family_keys( $font_family ) as $font_family_key ) {
			$custom_family_indexes[ $font_family_key ][] = $index;
		}
	}

	$duplicated_custom_indexes = array();
	foreach ( $font_families['theme'] as $theme_index => $theme_font_family ) {
		if ( ! is_array( $theme_font_family ) ) {
			continue;
		}

		$matched_custom_indexes = array();
		foreach ( _snow_monkey_get_font_family_keys( $theme_font_family ) as $font_family_key ) {
			if ( empty( $custom_family_indexes[ $font_family_key ] ) ) {
				continue;
			}

			$matched_custom_indexes = array_merge(
				$matched_custom_indexes,
				$custom_family_indexes[ $font_family_key ]
			);
		}

		$matched_custom_indexes = array_values( array_unique( $matched_custom_indexes ) );
		if ( ! $matched_custom_indexes ) {
			continue;
		}

		if (
			empty( $font_families['theme'][ $theme_index ]['fontFace'] ) ||
			! is_array( $font_families['theme'][ $theme_index ]['fontFace'] )
		) {
			$font_families['theme'][ $theme_index ]['fontFace'] = array();
		}

		foreach ( $matched_custom_indexes as $custom_index ) {
			if (
				empty( $font_families['custom'][ $custom_index ]['fontFace'] ) ||
				! is_array( $font_families['custom'][ $custom_index ]['fontFace'] )
			) {
				continue;
			}

			$font_families['theme'][ $theme_index ]['fontFace'] = _snow_monkey_merge_font_faces(
				$font_families['theme'][ $theme_index ]['fontFace'],
				$font_families['custom'][ $custom_index ]['fontFace']
			);
		}

		$duplicated_custom_indexes = array_merge( $duplicated_custom_indexes, $matched_custom_indexes );
	}

	$duplicated_custom_indexes = array_unique( $duplicated_custom_indexes );
	if ( ! $duplicated_custom_indexes ) {
		return $font_families;
	}

	$font_families['custom'] = array_values(
		array_filter(
			$font_families['custom'],
			function ( $font_family, $index ) use ( $duplicated_custom_indexes ) {
				return ! in_array( $index, $duplicated_custom_indexes, true );
			},
			ARRAY_FILTER_USE_BOTH
		)
	);

	return $font_families;
}

/**
 * Merge font family settings while preserving labels added by plugins.
 *
 * @param array $base_settings Base settings.
 * @param array $additional_settings Additional settings.
 * @return array
 */
function _snow_monkey_merge_font_family_settings( $base_settings, $additional_settings ) {
	if ( ! is_array( $base_settings ) || ! is_array( $additional_settings ) ) {
		return $base_settings;
	}

	foreach ( $additional_settings as $slug => $additional_setting ) {
		if ( ! is_array( $additional_setting ) ) {
			continue;
		}

		if ( empty( $base_settings[ $slug ] ) || ! is_array( $base_settings[ $slug ] ) ) {
			$base_settings[ $slug ] = $additional_setting;
			continue;
		}

		foreach ( $additional_setting as $key => $value ) {
			if ( 'variation' === $key || isset( $base_settings[ $slug ][ $key ] ) ) {
				continue;
			}

			$base_settings[ $slug ][ $key ] = $value;
		}

		if ( empty( $additional_setting['variation'] ) || ! is_array( $additional_setting['variation'] ) ) {
			continue;
		}

		if ( empty( $base_settings[ $slug ]['variation'] ) || ! is_array( $base_settings[ $slug ]['variation'] ) ) {
			$base_settings[ $slug ]['variation'] = array();
		}

		foreach ( $additional_setting['variation'] as $weight => $variation ) {
			if ( empty( $base_settings[ $slug ]['variation'][ $weight ] ) ) {
				$base_settings[ $slug ]['variation'][ $weight ] = $variation;
				continue;
			}

			if ( ! empty( $variation['src'] ) ) {
				$base_settings[ $slug ]['variation'][ $weight ]['src'] = $variation['src'];
			}

			if (
				empty( $base_settings[ $slug ]['variation'][ $weight ]['label'] ) &&
				! empty( $variation['label'] )
			) {
				$base_settings[ $slug ]['variation'][ $weight ]['label'] = $variation['label'];
			}
		}

		ksort( $base_settings[ $slug ]['variation'] );
	}

	return $base_settings;
}

/**
 * Return font family settings declared by WordPress font faces.
 *
 * @return array
 */
function _snow_monkey_get_declared_font_family_settings() {
	$global_settings = wp_get_global_settings();
	$font_families   = isset( $global_settings['typography']['fontFamilies'] ) && is_array( $global_settings['typography']['fontFamilies'] )
		? $global_settings['typography']['fontFamilies']
		: array();

	if ( ! $font_families ) {
		return array();
	}

	$font_families = _snow_monkey_merge_duplicate_font_families( $font_families );

	$global_font_families = array();
	foreach ( array( 'default', 'theme', 'custom' ) as $origin ) {
		if ( ! empty( $font_families[ $origin ] ) && is_array( $font_families[ $origin ] ) ) {
			$global_font_families = array_merge( $global_font_families, $font_families[ $origin ] );
		}
	}

	return Helper::get_font_family_settings_from_font_families( $global_font_families );
}

/**
 * Return font family settings with same-name Font Library font faces merged.
 *
 * @param array $font_family_settings Font family settings.
 * @return array
 */
add_filter(
	'snow_monkey_font_family_settings',
	function ( $font_family_settings ) {
		$additional_font_family_settings = _snow_monkey_get_declared_font_family_settings();

		return _snow_monkey_merge_font_family_settings(
			$font_family_settings,
			$additional_font_family_settings
		);
	}
);

/**
 * Return selected font weights in the customizer.
 *
 * @param string $base_font Base font slug.
 * @return array
 */
function _snow_monkey_get_selected_font_weights( $base_font ) {
	$font_weights = get_theme_mod( $base_font . '-font-weight' );
	if ( ! $font_weights ) {
		return array();
	}

	$font_weights = is_array( $font_weights )
		? $font_weights
		: explode( ',', $font_weights );
	$font_weights = array_filter( array_map( 'trim', $font_weights ) );
	$font_weights = array_map(
		function ( $weight ) {
			if ( preg_match( '/^\d+/', $weight, $matches ) ) {
				return $matches[0];
			}

			return $weight;
		},
		$font_weights
	);

	return array_values( array_unique( $font_weights ) );
}

/**
 * Preload selected base font weights.
 */
add_action(
	'wp_head',
	function () {
		$base_font = get_theme_mod( 'base-font' );
		if ( ! $base_font ) {
			return;
		}

		$selected_weights = _snow_monkey_get_selected_font_weights( $base_font );
		if ( ! $selected_weights ) {
			return;
		}

		$font_family_settings = Helper::get_font_family_settings();
		if ( empty( $font_family_settings[ $base_font ]['variation'] ) ) {
			return;
		}

		$preloaded_urls = array();
		foreach ( $selected_weights as $weight ) {
			if ( empty( $font_family_settings[ $base_font ]['variation'][ $weight ]['src'] ) ) {
				continue;
			}

			$src = $font_family_settings[ $base_font ]['variation'][ $weight ]['src'];
			if ( in_array( $src, $preloaded_urls, true ) ) {
				continue;
			}

			$preloaded_urls[] = $src;

			printf(
				'<link rel="preload" href="%1$s" as="font" type="font/woff2" crossorigin>' . "\n",
				esc_url( $src )
			);
		}
	},
	1
);

/**
 * Merge same-name Font Library font faces into the editor font family list.
 *
 * @param array $editor_settings Default editor settings.
 * @return array
 */
add_filter(
	'block_editor_settings_all',
	function ( $editor_settings ) {
		if ( empty( $editor_settings['__experimentalFeatures']['typography']['fontFamilies'] ) ) {
			return $editor_settings;
		}

		$font_families = $editor_settings['__experimentalFeatures']['typography']['fontFamilies'];
		if ( ! is_array( $font_families ) ) {
			return $editor_settings;
		}

		$editor_settings['__experimentalFeatures']['typography']['fontFamilies'] = _snow_monkey_merge_duplicate_font_families(
			$font_families
		);

		return $editor_settings;
	}
);
