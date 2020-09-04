<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

add_action(
	'wp_body_open',
	function() {
		?>
		<div id="page-start"></div>
		<?php
	},
	1
);
