<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$header_content = get_theme_mod( 'header-content' );

if ( ! $header_content ) {
	return;
}
?>

<div id="js-selective-refresh-header-content">
	<?php echo wp_kses_post( $header_content ); ?>
</div>
