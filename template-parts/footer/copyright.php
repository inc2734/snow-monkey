<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/copyright.php
 */

use Framework\Helper;

$args = wp_parse_args(
	$args,
	[
		'_copyright' => Helper::get_copyright(),
	]
);

if ( ! $args['_copyright'] ) {
	return;
}

$footer_alignfull = get_theme_mod( 'footer-alignfull' );
$container_class  = $footer_alignfull ? 'c-fluid-container' : 'c-container';
?>

<div class="c-copyright">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<?php echo wp_kses_post( $args['_copyright'] ); ?>
	</div>
</div>
