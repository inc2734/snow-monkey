<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/archive-top-widget-area.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'archive-top-widget-area' ) ) {
	return;
}
?>

<div class="l-archive-top-widget-area"
	data-is-slim-widget-area="false"
	data-is-content-widget-area="true"
	>

	<?php dynamic_sidebar( 'archive-top-widget-area' ); ?>
</div>
