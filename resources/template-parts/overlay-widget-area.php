<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$sidebar_id = 'overlay-widget-area';

if ( ! is_active_sidebar( $sidebar_id ) || ! is_registered_sidebar( $sidebar_id ) ) {
	return;
}
?>

<div id="sm-overlay-widget-area" class="p-overlay-widget-area c-overlay-container">
	<a href="#_" class="p-overlay-widget-area__bg c-overlay-container__bg"></a>
	<a href="#_" class="p-overlay-widget-area__close-btn c-overlay-container__close-btn">
		<i class="fas fa-times" aria-label="<?php esc_html_e( 'Close', 'snow-monkey' ); ?>"></i>
	</a>

	<div class="p-overlay-widget-area__inner c-overlay-container__inner">
		<div class="l-overlay-widget-area"
			data-is-slim-widget-area="false"
			data-is-content-widget-area="false"
			>

			<?php dynamic_sidebar( $sidebar_id ); ?>
		</div>
	</div>
</div>
