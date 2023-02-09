<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.1.0
 */
return;

add_action(
	'wp_head',
	function() {
		$base_font = get_theme_mod( 'base-font' );
		if ( ! $base_font ) {
			return;
		}

		$font_map = array(
			'noto-sans-jp-100'      => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSansJP-Thin.woff2' ),
			),
			'noto-sans-jp-300'      => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSansJP-Light.woff2' ),
			),
			'noto-sans-jp-400'      => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSansJP-Regular.woff2' ),
			),
			'noto-sans-jp-500'      => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSansJP-Medium.woff2' ),
			),
			'noto-sans-jp-700'      => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSansJP-Bold.woff2' ),
			),
			'noto-sans-jp-900'      => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSansJP-Black.woff2' ),
			),
			'noto-serif-jp-200'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSerifJP-ExtraLight.woff2' ),
			),
			'noto-serif-jp-300'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSerifJP-Light.woff2' ),
			),
			'noto-serif-jp-400'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSerifJP-Regular.woff2' ),
			),
			'noto-serif-jp-500'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSerifJP-Medium.woff2' ),
			),
			'noto-serif-jp-600'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSerifJP-SemiBold.woff2' ),
			),
			'noto-serif-jp-700'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSerifJP-Bold.woff2' ),
			),
			'noto-serif-jp-900'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/NotoSerifJP-Black.woff2' ),
			),
			'm-plus-1p-100'         => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUS1p-Thin.woff2' ),
			),
			'm-plus-1p-300'         => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUS1p-Light.woff2' ),
			),
			'm-plus-1p-400'         => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUS1p-Regular.woff2' ),
			),
			'm-plus-1p-500'         => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUS1p-Medium.woff2' ),
			),
			'm-plus-1p-700'         => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUS1p-Bold.woff2' ),
			),
			'm-plus-1p-800'         => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUS1p-ExtraBold.woff2' ),
			),
			'm-plus-1p-900'         => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUS1p-Black.woff2' ),
			),
			'm-plus-rounded-1c-100' => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUSRounded1c-Thin.woff2' ),
			),
			'm-plus-rounded-1c-300' => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUSRounded1c-Light.woff2' ),
			),
			'm-plus-rounded-1c-400' => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUSRounded1c-Regular.woff2' ),
			),
			'm-plus-rounded-1c-500' => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUSRounded1c-Medium.woff2' ),
			),
			'm-plus-rounded-1c-700' => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUSRounded1c-Bold.woff2' ),
			),
			'm-plus-rounded-1c-800' => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUSRounded1c-ExtraBold.woff2' ),
			),
			'm-plus-rounded-1c-900' => array(
				'src' => get_theme_file_uri( '/assets/fonts/MPLUSRounded1c-Black.woff2' ),
			),
			'biz-udpgothic-400'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/BIZUDPGothic-Regular.woff2' ),
			),
			'biz-udpgothic-700'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/BIZUDPGothic-Bold.woff2' ),
			),
			'biz-udpmincho-400'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/BIZUDPMincho-Regular.woff2' ),
			),
			'biz-udpmincho-700'     => array(
				'src' => get_theme_file_uri( '/assets/fonts/BIZUDPMincho-Bold.woff2' ),
			),
		);

		$font_weights = get_theme_mod( $base_font . '-font-weight' );
		$font_weights = explode( ',', $font_weights );

		foreach ( $font_weights as $font_weight ) {
			$key = $base_font . '-' . $font_weight;
			$src = isset( $font_map[ $key ] ) ? $font_map[ $key ]['src'] : false;
			if ( ! $src ) {
				continue;
			}
			?>
			<link rel="preload" href="<?php echo esc_url( $src ); ?>" as="font" type="font/woff2" crossorigin />
			<?php
		}
	}
);
