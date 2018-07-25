<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use \Inc2734\WP_Page_Speed_Optimization\Page_Speed_Optimization;

$sidebar_id = 'footer-widget-area';

if ( ! is_active_sidebar( $sidebar_id ) || ! is_registered_sidebar( $sidebar_id ) ) {
	return;
}
?>

<div class="l-footer-widget-area"
	data-is-slim-widget-area="true"
	data-is-content-widget-area="false"
	>

	<div class="c-container">
		<div class="c-row c-row--margin c-row--lg-margin-l">
			<?php Page_Speed_Optimization::dynamic_sidebar( $sidebar_id ); ?>
		</div>
	</div>
</div>
