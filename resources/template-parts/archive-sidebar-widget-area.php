<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use \Inc2734\WP_Page_Speed_Optimization\Page_Speed_Optimization;

$sidebar_id = 'archive-sidebar-widget-area';

if ( ! is_active_sidebar( $sidebar_id ) || ! is_registered_sidebar( $sidebar_id ) ) {
	return;
}
?>

<div class="l-sidebar-widget-area"
	data-is-slim-widget-area="true"
	data-is-content-widget-area="false"
	>


	<?php Page_Speed_Optimization::dynamic_sidebar( $sidebar_id ); ?>
</div>
