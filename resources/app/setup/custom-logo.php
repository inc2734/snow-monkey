<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_action( 'after_setup_theme', function() {
	add_theme_support( 'custom-logo', array(
		'height'      => 160,
		'width'       => 320,
		'flex-height' => true,
		'flex-width'  => true,
	) );
} );

/**
 * Set custom logo size with ratina
 */
add_action( 'wp_head', function() {
	$custom_logo = get_custom_logo();
	if ( ! $custom_logo ) {
		return;
	}
	preg_match( '/height="(\d+?)"/', $custom_logo, $reg );
	if ( ! isset( $reg[1] ) ) {
		return;
	}
	$height = $reg[1];
	preg_match( '/width="(\d+?)"/', $custom_logo, $reg );
	if ( ! isset( $reg[1] ) ) {
		return;
	}
	$width = $reg[1];
	?>
	<style>
	.c-site-branding .custom-logo, .wpaw-site-branding .custom-logo { height: <?php echo absint( $height / 2 ); ?>px; width: <?php echo absint( $width / 2 ); ?>px; }
	</style>
	<?php
} );
