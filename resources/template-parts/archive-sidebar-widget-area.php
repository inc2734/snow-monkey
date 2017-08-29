<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! is_active_sidebar( 'archive-sidebar-widget-area' ) ) {
	return;
}
?>

<div class="l-sidebar-widget-area">
	<?php dynamic_sidebar( 'archive-sidebar-widget-area' ); ?>
</div>
