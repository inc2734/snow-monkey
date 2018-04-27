<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 *
 * This procceses are beta.
 */

/**
 * Add defer
 *
 * @param string $tag
 * @param string handle
 * @param string src
 * @return string
 */
add_filter('script_loader_tag', function( $tag, $handle, $src ) {
	$handles = [
		get_template(),
		get_stylesheet(),
		'fontawesome5',
		'fontawesome5-v4-shims',
	];

	if ( ! in_array( $handle, $handles ) ) {
		return $tag;
	}

	return str_replace( ' src', ' defer="defer" src', $tag );
}, 10, 3 );

/**
 * Add async
 *
 * @param string $tag
 * @param string handle
 * @param string src
 * @return string
 */
add_filter('script_loader_tag', function( $tag, $handle, $src ) {
	$handles = [
		'inc2734-wp-seo-google-analytics',
	];

	if ( ! in_array( $handle, $handles ) ) {
		return $tag;
	}

	return str_replace( ' src', ' async="async" src', $tag );
}, 10, 3 );

/**
 * Add preload in header
 */
function snow_monkey_http2_server_push_enqueues( $wp_dependences, $type ) {
	$registerd = $wp_dependences->registered;
	$wp_dependences->all_deps( $wp_dependences->queue );

	foreach ( $wp_dependences->to_do as $handle ) {
		if ( ! isset( $registerd[ $handle ] ) ) {
			continue;
		}

		$src = $registerd[ $handle ]->src;
		if ( preg_match( '/^\/[^\/]/', $src ) || 0 === strpos( $src, home_url() ) ) {
			header( sprintf( 'Link: <%s>; rel=preload; as=%s', esc_url_raw( $src ), $type ), false );
		}
	}
}

add_action( 'wp_enqueue_scripts', function() {
	snow_monkey_http2_server_push_enqueues( wp_styles(), 'style' );
	snow_monkey_http2_server_push_enqueues( wp_scripts(), 'script' );
}, 99999 );

/**
 * Add preload in header
 *
 * @param string $tag
 * @param string handle
 * @param string src
 * @return string
 */
add_filter( 'style_loader_tag', function( $tag, $handle, $src ) {
	return str_replace( '\'stylesheet\'', '\'preload\' as="style"', $tag );
}, 10, 3 );

add_action( 'wp_head', function() {
	?>
<script>
(function() {
var links = document.getElementsByTagName('link');
for (var i = 0; i < links.length; i++) {
	if ('preload' === links[i].rel) {
		links[i].rel = 'stylesheet';
	}
}
})();
</script>
	<?php
}, 99999 );
