<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 *
 * renamed: template-parts/posts-page-widget-area-bottom.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'posts-page-bottom-widget-area' ) ) {
	return;
}
?>

<div class="l-posts-page-widget-area l-posts-page-widget-area--bottom"
	data-is-slim-widget-area="false"
	data-is-content-widget-area="true"
	>

	<?php dynamic_sidebar( 'posts-page-bottom-widget-area' ); ?>
</div>
