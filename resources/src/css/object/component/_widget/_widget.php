<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$cfs = Customizer_Framework::styles();

$accent_color = get_theme_mod( 'accent-color' );

/**
 * Tag cloud
 */
$cfs->register(
	'.widget_tag_cloud a::before',
	'color: ' . $accent_color
);

/**
 * PR Box
 */
$cfs->register(
	'.wpaw-pr-box__more',
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.wpaw-pr-box__more:hover',
		'.wpaw-pr-box__more:active',
		'.wpaw-pr-box__more:focus',
	],
	'background-color: ' . $cfs->darken( $accent_color, 0.05 )
);

/**
 * Showcase
 */
$cfs->register(
	'.wpaw-showcase__more',
	'background-color: ' . $accent_color
);

$cfs->register(
	[
		'.wpaw-showcase__more:hover',
		'.wpaw-showcase__more:active',
		'.wpaw-showcase__more:focus',
	],
	'background-color: ' . $cfs->darken( $accent_color, 0.05 )
);

/**
 * Recent posts, Ranking, Any posts
 */
$cfs->register(
	[
		'.wpaw-recent-posts__term',
		'.wpaw-any-posts__term',
		'.wpaw-ranking__term',
	],
	'background-color: ' . $accent_color
);
