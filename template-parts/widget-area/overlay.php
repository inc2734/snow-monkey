<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.1.2
 *
 * renamed: template-parts/overlay-widget-area.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'overlay-widget-area' ) ) {
	return;
}
?>

<div id="sm-overlay-widget-area" class="p-overlay-widget-area c-overlay-container">
	<div class="p-overlay-widget-area__inner c-overlay-container__inner">
		<div class="l-overlay-widget-area"
			data-is-slim-widget-area="<?php echo esc_attr( get_theme_mod( 'overlay-widget-area-max-width' ) ); ?>"
			data-is-content-widget-area="false"
			>

			<?php dynamic_sidebar( 'overlay-widget-area' ); ?>
		</div>
	</div>

	<a href="#_" class="p-overlay-widget-area__close-btn c-overlay-container__close-btn">
		<i class="fas fa-times" aria-label="<?php esc_html_e( 'Close', 'snow-monkey' ); ?>"></i>
	</a>
	<a href="#_" class="p-overlay-widget-area__bg c-overlay-container__bg"></a>
</div>
