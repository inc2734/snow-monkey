<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.4
 */

/**
 * Sets up charset and viewport
 *
 * @see https://github.com/joshbuchea/head#recommended-minimum
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, viewport-fit=cover">
		<?php
	},
	0.9
);

/**
 * Sets up content of the head element
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		?>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php
	},
	2
);
