<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/title-top-widget-area.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'title-top-widget-area' ) ) {
	return;
}
?>

<div class="l-title-top-widget-area"
	data-is-slim-widget-area="false"
	data-is-content-widget-area="false"
	>

	<?php dynamic_sidebar( 'title-top-widget-area' ); ?>
</div>
