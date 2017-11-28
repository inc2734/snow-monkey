<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( is_singular() ) {
	if ( ! has_post_thumbnail() ) {
		return;
	}
	$thumbnail_id = get_post_thumbnail_id();
} elseif ( ( ! is_front_page() && is_home() ) || is_archive() ) {
	if ( 'page' !== get_option( 'show_on_front' ) ) {
		return;
	}
	$thumbnail_id = get_post_thumbnail_id( get_option( 'page_for_posts' ) );
}

if ( empty( $thumbnail_id ) ) {
	return;
}
?>

<div class="c-page-header js-bg-parallax" style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( $thumbnail_id, 'large' ) ); ?>);"></div>
