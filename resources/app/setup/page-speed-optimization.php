<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 *
 * This procceses are beta.
 */

use Inc2734\WP_Page_Speed_Optimization\Page_Speed_Optimization;

new Page_Speed_Optimization();

add_filter( 'inc2734_wp_page_speed_optimization_defer_scripts', function( $handles ) {
	return array_merge( $handles, [
		get_template(),
		get_stylesheet(),
	] );
} );

add_filter( 'inc2734_wp_page_speed_optimization_async_scripts', function( $handles ) {
	return array_merge( $handles, [
		'inc2734-wp-seo-google-analytics',
		'fontawesome5',
		'fontawesome5-v4-shims',
		'comment-reply',
		'wp-embed',
		'jquery.easing',
	] );
} );

/**
 * Loads CSS asynchronously
 */
if ( get_theme_mod( 'async-css' ) ) {
	add_action( 'wp_head', function() {
		?>
<style>body{visibility:hidden;}.js-bg-parallax{transition: none;}</style>
		<?php
	} );

	add_filter( 'style_loader_tag', function( $tag, $handle, $src ) {
		if ( is_admin() ) {
			return $tag;
		}
		return str_replace( '\'stylesheet\'', '\'preload\' as="style"', $tag );
	}, 10, 3 );

	add_action( 'wp_footer', function() {
		if ( is_admin() ) {
			return;
		}
		// @codingStandardsIgnoreStart
		?>
<script>
jQuery(function($) {
  $('link[as="style"]').each(function(i, e) {
    $('<link rel="stylesheet" />').attr('href', $(e).attr('href')).appendTo('head');
  });
})();
</script>
		<?php
		// @codingStandardsIgnoreEnd
	}, 99999 );
}
