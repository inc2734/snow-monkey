<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! is_active_sidebar( 'footer-widget-area' ) ) {
	return;
}

add_filter( 'dynamic_sidebar_params', function( $params ) {
	if ( 'footer-widget-area' !== $params[0]['id'] ) {
		return $params;
	}

	$params[0]['before_widget'] = str_replace(
		'c-row__col--lg-1-1',
		'c-row__col--lg-' . get_theme_mod( 'footer-widget-area-column-size' ),
		$params[0]['before_widget']
	);

	return $params;
} );
?>

<div class="l-footer-widget-area">
	<div class="c-container">
		<div class="c-row c-row--margin c-row--lg-margin-l">
			<?php dynamic_sidebar( 'footer-widget-area' ); ?>
		</div>
	</div>
</div>
