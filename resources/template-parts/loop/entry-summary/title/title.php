<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$layout = get_theme_mod( get_post_type() . '-entries-layout' );
?>

<h2 class="c-entry-summary__title">
	<?php
	if ( 'rich-media' !== $layout ) {
		the_title();
	} else {
		Helper::the_title_trimed();
	}
	?>
</h2>
