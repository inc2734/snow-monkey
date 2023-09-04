<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.1.4
 *
 * renamed: template-parts/hamburger-btn.php
 */

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_label'      => __( 'MENU', 'snow-monkey' ),
		'_aria_label' => __( 'MENU', 'snow-monkey' ), // Used only when there is no label.
		'_id'         => 'hamburger-btn',
		'_controls'   => 'drawer-nav',
	)
);
?>

<button
	<?php if ( $args['_id'] ) : ?>
		id="<?php echo esc_attr( $args['_id'] ); ?>"
	<?php endif; ?>
	<?php if ( ! $args['_label'] ) : ?>
		aria-label="<?php echo esc_attr( $args['_aria_label'] ); ?>"
	<?php endif; ?>
	class="c-hamburger-btn"
	aria-expanded="false"
	aria-controls="<?php echo esc_attr( $args['_controls'] ); ?>"
>
	<span class="c-hamburger-btn__bars">
		<span class="c-hamburger-btn__bar"></span>
		<span class="c-hamburger-btn__bar"></span>
		<span class="c-hamburger-btn__bar"></span>
	</span>

	<?php if ( $args['_label'] ) : ?>
		<span class="c-hamburger-btn__label">
			<?php echo wp_kses_post( $args['_label'] ); ?>
		</span>
	<?php endif; ?>
</button>
