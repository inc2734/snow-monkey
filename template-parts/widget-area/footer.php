<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.13.0
 *
 * renamed: template-parts/footer-widget-area.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'footer-widget-area' ) ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_container' => true,
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
?>

<div class="l-footer-widget-area"
	data-is-slim-widget-area="true"
	data-is-content-widget-area="false"
	>
	<?php if ( $args['_container'] ) : ?>

		<?php
		if ( $args['_container'] ) {
			$container_class = $args['_container-fluid'] ? 'c-fluid-container' : 'c-container';
		}
		?>
		<div class="<?php echo esc_attr( $container_class ); ?>">
			<div class="c-row c-row--margin c-row--lg-margin-l">
				<?php dynamic_sidebar( 'footer-widget-area' ); ?>
			</div>
		</div>

	<?php else : ?>

		<div class="c-row c-row--margin c-row--lg-margin-l">
			<?php dynamic_sidebar( 'footer-widget-area' ); ?>
		</div>

	<?php endif; ?>
</div>
