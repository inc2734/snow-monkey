<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.4
 */

use Framework\Helper;
?>

<header class="c-entry__header">
	<h1 class="c-entry__title">
		<?php
		add_filter( 'the_title', 'wc_page_endpoint_title' );
		the_title();
		?>
	</h1>
</header>
