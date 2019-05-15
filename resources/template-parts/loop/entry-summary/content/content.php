<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

ob_start();
the_excerpt();
$content = wp_strip_all_tags( ob_get_clean() );
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $content ); ?>
</div>
