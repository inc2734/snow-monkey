<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/sidebar-sticky-widget-area.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'sidebar-sticky-widget-area' ) ) {
	return;
}
?>

<div class="l-sidebar-sticky-widget-area"
	data-is-slim-widget-area="true"
	data-is-content-widget-area="false"
	>

	<?php dynamic_sidebar( 'sidebar-sticky-widget-area' ); ?>
</div>
