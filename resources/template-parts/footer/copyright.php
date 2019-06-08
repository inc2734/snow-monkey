<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 *
 * renamed: template-parts/copyright.php
 */

use Framework\Helper;

$template_args = [
	'copyright' => Helper::get_var( $_copyright, Helper::get_copyright() ),
];

if ( ! $template_args['copyright'] ) {
	return;
}
?>

<div class="c-copyright">
	<div class="c-container">
		<?php echo wp_kses_post( $template_args['copyright'] ); ?>
	</div>
</div>
