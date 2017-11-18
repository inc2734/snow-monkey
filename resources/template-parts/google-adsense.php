<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$google_adsense = get_option( 'mwt-google-adsense' );

if ( ! $google_adsense ) {
	return;
}
?>

<div class="c-google-adsense">
	<?php
	if ( ! function_exists( 'snow_monkey_safe_style_css_display' ) ) {
		function snow_monkey_safe_style_css_display( $styles ) {
			$styles[] = 'display';
			return $styles;
		}
	}

	add_filter( 'safe_style_css', 'snow_monkey_safe_style_css_display' );

	if ( class_exists( 'Jetpack' ) ) {
		// @todo
		// @codingStandardsIgnoreStart
		echo $google_adsense;
		// @codingStandardsIgnoreEnd
	} else {
		echo wp_kses( $google_adsense, [
			'script' => [
				'async' => [],
				'src'   => [],
			],
			'ins' => [
				'class'          => [],
				'style'          => [],
				'data-ad-client' => [],
				'data-ad-slot'   => [],
				'data-ad-format' => [],
			],
		] );
	}

	remove_filter( 'safe_style_css', 'snow_monkey_safe_style_css_display' );
	?>
</div>
