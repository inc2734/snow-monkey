<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$cfs = Customizer_Framework::styles();

$accent_color = get_theme_mod( 'accent-color' );

$cfs->register(
	'.c-comment .comment-reply-link',
	"background-color: " . $accent_color
);

$cfs->register(
	[
		'.c-comment .comment-reply-link:hover',
		'.c-comment .comment-reply-link:active',
		'.c-comment .comment-reply-link:focus',
	],
	"background-color: " . $cfs->darken( $accent_color, 0.05 )
);
