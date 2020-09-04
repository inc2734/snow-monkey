<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/front-page-widget-area-top.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'front-page-top-widget-area' ) ) {
	return;
}
?>

<div class="l-front-page-widget-area l-front-page-widget-area--top"
	data-is-slim-widget-area="false"
	data-is-content-widget-area="true"
	>

	<?php dynamic_sidebar( 'front-page-top-widget-area' ); ?>
</div>
