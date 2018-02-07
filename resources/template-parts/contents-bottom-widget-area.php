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

// @deprecated {$post_type}-post-type-contents-bottom-widget-area
if ( ! is_active_sidebar( $post_type . '-post-type-contents-bottom-widget-area' ) && ! is_active_sidebar( 'contents-bottom-widget-area' ) ) {
	return;
}
?>

<div class="l-contents-bottom-widget-area">
	<?php dynamic_sidebar( 'contents-bottom-widget-area' ); ?>
	<?php dynamic_sidebar( $post_type . '-post-type-contents-bottom-widget-area' ); ?>
</div>
