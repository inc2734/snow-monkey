<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$post_type = get_post_type();
if ( ! $post_type ) {
	$post_type = 'page';
}

if ( ! is_active_sidebar( $post_type . '-post-type-sidebar-sticky-widget-area' ) ) {
	return;
}
?>

<div class="l-sidebar-sticky-widget-area">
	<?php dynamic_sidebar( $post_type . '-post-type-sidebar-sticky-widget-area' ); ?>
</div>
