<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! get_theme_mod( 'display-page-top' ) ) {
	return;
}
?>

<div class="c-page-top" aria-hidden="true">
	<a href="#body">
		<span class="fas fa-chevron-up" aria-hidden="true" title="<?php esc_html_e( 'Scroll up', 'snow-monkey' ); ?>"></span>
	</a>
</div>
