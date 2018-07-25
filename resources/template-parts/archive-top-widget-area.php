<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use \Inc2734\WP_Page_Speed_Optimization\Page_Speed_Optimization;

$sidebar_id = 'archive-top-widget-area';

if ( ! is_active_sidebar( $sidebar_id ) || ! is_registered_sidebar( $sidebar_id ) ) {
	return;
}
?>

<div class="l-archive-top-widget-area"
	data-is-slim-widget-area="false"
	data-is-content-widget-area="true"
	>

	<?php Page_Speed_Optimization::dynamic_sidebar( $sidebar_id ); ?>
</div>
