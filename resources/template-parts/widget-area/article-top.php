<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'article-top-widget-area' ) ) {
	return;
}
?>

<div class="l-article-top-widget-area"
	data-is-slim-widget-area="false"
	data-is-content-widget-area="false"
	>

	<?php dynamic_sidebar( 'article-top-widget-area' ); ?>
</div>
