<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 28.0.8
 */

add_action(
	'wp_body_open',
	function () {
		?>
		<a class="c-skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to main content', 'snow-monkey' ); ?></a>
		<?php
	},
	1
);
