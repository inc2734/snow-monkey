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

$post_type_sidebar_id = $post_type . '-post-type-sidebar-sticky-widget-area';
$sidebar_id = 'sidebar-sticky-widget-area';

// @deprecated {$post_type}-post-type-sidebar-sticky-widget-area
if ( ! is_active_sidebar( $post_type_sidebar_id ) || ! is_registered_sidebar( $post_type_sidebar_id ) ) {
	if ( ! is_active_sidebar( $sidebar_id ) || ! is_registered_sidebar( $sidebar_id ) ) {
		return;
	}
}
?>

<div class="l-sidebar-sticky-widget-area"
	data-is-slim-widget-area="true"
	data-is-content-widget-area="false"
	>

	<?php dynamic_sidebar( $sidebar_id ); ?>
	<?php dynamic_sidebar( $post_type_sidebar_id ); ?>
</div>
