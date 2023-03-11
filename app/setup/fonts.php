<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.0.0
 */

use Framework\Helper;

add_action(
	'wp_head',
	function() {
		$base_font = get_theme_mod( 'base-font' );
		if ( ! $base_font ) {
			return;
		}

		$font_weights = get_theme_mod( $base_font . '-font-weight' );
		if ( ! $font_weights ) {
			return;
		}

		$font_family_settings = Helper::get_font_family_settings();

		$font_weights = explode( ',', $font_weights );

		foreach ( $font_weights as $font_weight ) {
			if ( empty( $font_family_settings[ $base_font ][ $font_weight ]['src'] ) ) {
				continue;
			}

			$src = $font_family_settings[ $base_font ][ $font_weight ]['src'];
			?>
			<link rel="preload" href="<?php echo esc_url( $src ); ?>" as="font" type="font/woff2" crossorigin />
			<?php
		}
	}
);

foreach ( array( 'wp_enqueue_scripts', 'enqueue_block_editor_assets' ) as $hook ) {
	add_action(
		$hook,
		function() {
			$base_font = get_theme_mod( 'base-font' );
			if ( ! $base_font ) {
				return;
			}

			$font_weights = get_theme_mod( $base_font . '-font-weight' );
			if ( ! $font_weights ) {
				return;
			}

			$font_weights         = explode( ',', $font_weights );
			$font_family_settings = Helper::get_font_family_settings();

			$css_arr = array();
			foreach ( $font_family_settings as $font_family => $font_family_setting ) {
				if ( empty( $font_family_setting['variation'] ) ) {
					continue;
				}

				foreach ( $font_family_setting['variation'] as $weight => $variation ) {
					if ( ! in_array( (string) $weight, $font_weights, true ) ) {
						continue;
					}

					$css_arr[] = '@font-face { font-family: "' . $font_family_setting['name'] . '"; font-style: normal; font-weight: ' . $weight . '; src: url("' . $variation['src'] . '") format("woff2"); }';
				}
			}

			wp_add_inline_style( Helper::get_main_style_handle(), implode( '', $css_arr ) );
		}
	);
}
