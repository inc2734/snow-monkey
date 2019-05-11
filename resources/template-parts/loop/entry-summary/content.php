<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$content = Helper::get_var( $_content, [] );

if ( ! $content ) {
	return;
}
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $content ); ?>
</div>
