<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

add_action(
	'wp_footer',
	function () {
		?>
		<div id="page-end"></div>
		<?php
	},
	10000
);
