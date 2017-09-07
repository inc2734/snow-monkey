<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

class Snow_Monkey_Customizer_Styles {

	protected $styles = [];

	public function __construct() {
		add_filter( 'tiny_mce_before_init', function( $mceInit ) {
			if ( ! isset( $mceInit['content_style'] ) ) {
				$mceInit['content_style'] = '';
			}
			return $mceInit;
		}, 9 );

		add_action( 'wp_print_styles', function() {
			echo '<style>';
			foreach ( $this->styles as $style ) {
				foreach ( $style['selectors'] as $i => $selector ) {
					$style['selectors'][ $i ] = 'body ' . $selector;
				}

				$selectors  = implode( ',', $style['selectors'] );
				$properties = implode( ';', $style['properties'] );

				printf(
					'%1$s { %2$s }',
					$selectors,
					$properties
				);
			}
			echo '</style>';
		} );

		add_filter( 'tiny_mce_before_init', function( $mceInit ) {
			foreach ( $this->styles as $style ) {
				foreach ( $style['selectors'] as $i => $selector ) {
					$style['selectors'][ $i ] = '.mce-content-body.wp-editor ' . $selector;
				}

				$selectors  = esc_js( implode( ',', $style['selectors'] ) );
				$properties = esc_js( implode( ';', $style['properties'] ) );

				$mceInit['content_style'] .= "{$selectors} { {$properties} }";
			}
			return $mceInit;
		} );
	}

	public function register( $selectors, $properties ) {
		if ( ! is_array( $selectors ) ) {
			$selectors = explode( ',', $selectors );
		}

		if ( ! is_array( $properties ) ) {
			$properties = explode( ';', $properties );
		}

		$this->styles[] = [
			'selectors'  => $selectors,
			'properties' => $properties,
		];
	}

	public function light( $hex ) {
		return $this->_color_luminance( $hex, 0.2 );
	}

	public function lighter( $hex ) {
		return $this->_color_luminance( $hex, 0.335 );
	}

	public function lightest( $hex ) {
		return $this->_color_luminance( $hex, 0.37 );
	}

	public function dark( $hex ) {
		return $this->_color_luminance( $hex, -0.2 );
	}

	public function darker( $hex ) {
		return $this->_color_luminance( $hex, -0.335 );
	}

	public function darkest( $hex ) {
		return $this->_color_luminance( $hex, -0.37 );
	}

	public function lighten( $hex, $percent ) {
		return $this->_color_luminance( $hex, $percent );
	}

	public function darken( $hex, $percent ) {
		return $this->_color_luminance( $hex, $percent * -1 );
	}

	protected function _color_luminance( $hex, $percent ) {
		$hex = $this->_hex_normalization( $hex );
		$new_hex = '#';

		for ($i = 0; $i < 3; $i++) {
			$dec = hexdec( substr( $hex, $i * 2, 2 ) );
			$dec = min( max( 0, $dec + $dec * $percent ), 255 );
			$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
		}

		return $new_hex;
	}

	public function rgba( $hex, $percent ) {
		$hex = $this->_hex_normalization( $hex );
		$rgba = [];

		for ($i = 0; $i < 3; $i++) {
			$dec = hexdec( substr( $hex, $i * 2, 2 ) );
			$rgba[] = $dec;
		}

		$rgba = implode( ',', $rgba );
		$rgba = "rgba({$rgba}, $percent)";

		return $rgba;
	}

	protected function _hex_normalization( $hex ) {
		$hex = preg_replace( '/[^0-9a-f]/i', '', ltrim( $hex, '#' ) );

		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}

		return $hex;
	}
}

add_action( 'wp_loaded', function() {
	$Customizer_Styles = new Snow_Monkey_Customizer_Styles( get_stylesheet() );
	$accent_color = get_theme_mod( 'accent-color' );

	/**
	 * Accent color
	 */
	$Customizer_Styles->register(
		'a',
		"color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.c-btn',
		"background-color: " . $accent_color
	);
	$Customizer_Styles->register(
		'.c-btn:hover, .c-btn:active, .c-btn:focus',
		"background-color: " . $Customizer_Styles->darken( $accent_color, 0.05 )
	);

	$Customizer_Styles->register(
		'.c-comment .comment-reply-link',
		"background-color: " . $accent_color
	);
	$Customizer_Styles->register(
		'.c-comment .comment-reply-link:hover, .c-comment .comment-reply-link:active, .c-comment .comment-reply-link:focus',
		"background-color: " . $Customizer_Styles->darken( $accent_color, 0.05 )
	);

	$Customizer_Styles->register(
		'.c-drawer',
		"background-color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.c-entry-summary__figure::after',
		[
			"background-color: " . $Customizer_Styles->rgba( $accent_color, .4 ),
			"background-image: radial-gradient(" . $Customizer_Styles->rgba( $accent_color, .9) . " 33%, transparent 33%)",
		]
	);

	$Customizer_Styles->register(
		'.c-entry-summary__term',
		"background-color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.c-entry__content > h2::after',
		"background-color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.c-entry__content > table thead th',
		[
			"background-color: " . $accent_color,
			"border-right-color: " . $Customizer_Styles->light( $accent_color ),
			"border-left-color: " . $Customizer_Styles->light( $accent_color ),
		]
	);

	$Customizer_Styles->register(
		'.c-page-top',
		"background-color: " . $accent_color
	);
	$Customizer_Styles->register(
		'.c-page-top:hover, .c-page-top:active, .c-page-top:focus',
		"background-color: " . $Customizer_Styles->darken( $accent_color, 0.05 )
	);

	$Customizer_Styles->register(
		'.c-pagination__item',
		"background-color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.c-prev-next-nav__item > a::before',
		[
			"background-color: " . $Customizer_Styles->rgba( $accent_color, 0.4 ),
			"background-image: radial-gradient(" . $Customizer_Styles->rgba( $accent_color, 0.9 ) . " 33%, transparent 33%)"
		]
	);

	$Customizer_Styles->register(
		'.c-section__title::after',
		"background-color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.widget_tag_cloud a::before',
		"color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.wpaw-recent-posts__term, .wpaw-ranking__term',
		"background-color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.wpac-btn',
		"background-color: " . $accent_color
	);
	$Customizer_Styles->register(
		'.wpac-btn:hover, .wpac-btn:active, .wpac-btn:focus',
		"background-color: " . $Customizer_Styles->darken( $accent_color, 0.05 )
	);

	$Customizer_Styles->register(
		'.p-global-nav .c-navbar__item[class*="current_"] > a, .p-global-nav .c-navbar__item[class*="current-"] > a',
		"color: " . $accent_color
	);
	$Customizer_Styles->register(
		'.p-global-nav .c-navbar__item:hover > a, .p-global-nav .c-navbar__item:active > a, .p-global-nav .c-navbar__item:focus > a',
		"color: " . $accent_color
	);
	$Customizer_Styles->register(
		'.p-global-nav .c-navbar__item > .c-navbar__submenu::before',
		"border-bottom-color: " . $accent_color
	);
	$Customizer_Styles->register(
		'.p-global-nav .c-navbar__submenu',
		"background-color: " . $accent_color
	);

	$Customizer_Styles->register(
		'.p-main-visual__item-more:hover, .p-main-visual__item-more:active, .p-main-visual__item-more:focus',
		[
			"background-color: " . $accent_color,
			"border-color: " . $accent_color,
		]
	);

	$Customizer_Styles->register(
		'.p-main-visual .slick-arrow',
		"background-color: " . $accent_color
	);
	$Customizer_Styles->register(
		'.p-main-visual .slick-arrow:hover, .p-main-visual .slick-arrow:active, .p-main-visual .slick-arrow:focus',
		"background-color: " . $Customizer_Styles->darken( $accent_color, 0.05 )
	);
} );





/**
 * Footer columns size
 */
add_action( 'wp_enqueue_scripts', function() {
	$footer_widgets_area_size = get_theme_mod( 'footer-widget-area-column-size' );
	$footer_widgets_area_size = explode( '-', $footer_widgets_area_size );
	$footer_widgets_area_size = array_filter( $footer_widgets_area_size );
	if ( isset( $footer_widgets_area_size[0] ) ) {
		$footer_widgets_area_size = $footer_widgets_area_size[0] / $footer_widgets_area_size[1] * 100;
	} else {
		$footer_widgets_area_size = 33.33333;
	}

	wp_add_inline_style( get_stylesheet(), "@media (min-width: 64em) { .l-footer-widget-area__item { -ms-flex: 0 1 {$footer_widgets_area_size}%; flex: 0 1 {$footer_widgets_area_size}%; max-width: {$footer_widgets_area_size}%; } }" );
} );
