<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$copyright = Helper::get_var( $_copyright, Helper::get_copyright() );

if ( ! $copyright ) {
	return;
}
?>

<div class="c-copyright">
	<div class="c-container">
		<?php echo wp_kses_post( $copyright ); ?>
	</div>
</div>
