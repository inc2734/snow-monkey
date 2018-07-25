<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use \Inc2734\WP_Page_Speed_Optimization\Page_Speed_Optimization;

$post_type = get_post_type();
if ( ! $post_type ) {
	$post_type = 'page';
}

$post_type_sidebar_id = $post_type . '-post-type-title-top-widget-area';
$sidebar_id = 'title-top-widget-area';

// @deprecated {$post_type}-post-type-title-top-widget-area
if ( ! is_active_sidebar( $post_type_sidebar_id ) || ! is_registered_sidebar( $post_type_sidebar_id ) ) {
	if ( ! is_active_sidebar( $sidebar_id ) || ! is_registered_sidebar( $sidebar_id ) ) {
		return;
	}
}
?>

<div class="l-title-top-widget-area"
	data-is-slim-widget-area="false"
	data-is-content-widget-area="false"
	>

	<?php Page_Speed_Optimization::dynamic_sidebar( $sidebar_id ); ?>
	<?php Page_Speed_Optimization::dynamic_sidebar( $post_type_sidebar_id ); ?>
</div>
