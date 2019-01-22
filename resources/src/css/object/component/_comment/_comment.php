<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

$accent_color = get_theme_mod( 'accent-color' );

Style::register(
	'.c-comment .comment-reply-link',
	'background-color: ' . $accent_color
);

Style::register(
	[
		'.c-comment .comment-reply-link:hover',
		'.c-comment .comment-reply-link:active',
		'.c-comment .comment-reply-link:focus',
	],
	'background-color: ' . Color::darken( $accent_color, 0.05 ),
	'@media (min-width: 64em)'
);
