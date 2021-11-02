<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.13.0
 *
 * renamed: template-parts/copyright.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_copyright' => Helper::get_copyright(),
		'_container' => true,
		'_inverse'   => true,
	]
);

if ( $args['_container'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_container-fluid' => false,
		]
	);
}

if ( ! $args['_copyright'] ) {
	return;
}

$classes = [ 'c-copyright' ];
if ( $args['_inverse'] ) {
	$classes[] = 'c-copyright--inverse';
}
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php if ( $args['_container'] ) : ?>

		<?php
		$container_class = $args['_container-fluid'] ? 'c-fluid-container' : 'c-container';
		?>
		<div class="<?php echo esc_attr( $container_class ); ?>">
			<?php echo wp_kses_post( $args['_copyright'] ); ?>
		</div>

	<?php else : ?>

		<?php echo wp_kses_post( $args['_copyright'] ); ?>

	<?php endif; ?>
</div>
