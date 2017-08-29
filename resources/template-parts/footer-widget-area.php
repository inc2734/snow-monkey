<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! is_active_sidebar( 'footer-widget-area' ) ) {
	return;
}
?>

<div class="l-footer-widget-area">
	<div class="c-container">
		<div class="c-row c-row--margin c-row--lg-margin-l">
			<?php dynamic_sidebar( 'footer-widget-area' ); ?>
		</div>
	</div>
</div>
