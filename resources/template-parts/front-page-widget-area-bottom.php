<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$sidebar_id = 'front-page-bottom-widget-area';

if ( ! is_active_sidebar( $sidebar_id ) || ! is_registered_sidebar( $sidebar_id ) ) {
	return;
}
?>

<div class="l-front-page-widget-area l-front-page-widget-area--bottom"
	data-is-slim-widget-area="false"
	data-is-content-widget-area="true"
	>

	<?php dynamic_sidebar( $sidebar_id ); ?>
</div>
