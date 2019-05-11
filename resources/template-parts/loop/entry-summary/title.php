<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$layout = Helper::get_var( $_layout, null );
?>

<h2 class="c-entry-summary__title">
	<?php
	if ( 'rich-media' === $layout ) {
		Helper::the_title_trimed();
	} else {
		the_title();
	}
	?>
</h2>
