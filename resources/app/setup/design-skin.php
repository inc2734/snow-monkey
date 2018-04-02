<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$active_plugins = get_option( 'active_plugins' );
foreach ( $active_plugins as $plugin ) {
	if ( 0 !== strpos( $plugin, 'snow-monkey-design-skin-' ) ) {
		continue;
	}

	$plugin_data = get_file_data(
		trailingslashit( WP_PLUGIN_DIR ) . $plugin,
		[
			'label' => 'Plugin Name',
		],
		'plugin'
	);

	$plugin_data = array_merge( $plugin_data, [
		'path'  => $plugin,
	] );

	add_filter( 'snow_monkey_design_skin_choices', function( $choices ) use( $plugin_data ) {
		$choices[ dirname( $plugin_data['path'] ) ] = $plugin_data['label'];
		return $choices;
	} );
}

add_action( 'wp_enqueue_scripts', function() {
	$design_skin = get_theme_mod( 'design-skin' );
	$skin_path = trailingslashit( WP_PLUGIN_DIR ) . $design_skin . '/skin.css';
	$skin_url  = plugins_url( 'skin.css', $skin_path );
	if ( file_exists( $skin_path ) ) {
		wp_enqueue_style( $design_skin, $skin_url, [ get_template() ], filemtime( $skin_path ) );
	}
} );
