<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 *
 * renamed: template-parts/hamburger-btn.php
 */

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_label' => __( 'MENU', 'snow-monkey' ),
		'_id'    => 'hamburger-btn',
	]
);
?>

<button
	<?php if ( $args['_id'] ) : ?>
		id="<?php echo esc_attr( $args['_id'] ); ?>"
	<?php endif; ?>
	class="c-hamburger-btn"
	aria-expanded="false"
	aria-controls="drawer-nav"
>
	<div class="c-hamburger-btn__bars">
		<div class="c-hamburger-btn__bar"></div>
		<div class="c-hamburger-btn__bar"></div>
		<div class="c-hamburger-btn__bar"></div>
	</div>

	<?php if ( $args['_label'] ) : ?>
		<div class="c-hamburger-btn__label">
			<?php echo wp_kses_post( $args['_label'] ); ?>
		</div>
	<?php endif; ?>
</button>
