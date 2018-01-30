<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! is_active_sidebar( 'archive-top-widget-area' ) ) {
	return;
}
?>

<div class="l-archive-top-widget-area">
	<?php dynamic_sidebar( 'archive-top-widget-area' ); ?>
</div>
