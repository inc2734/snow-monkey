<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.1.3
 *
 * renamed: template-parts/infobar.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_content' => get_theme_mod( 'infobar-content' ),
		'_url'     => get_theme_mod( 'infobar-url' ),
	]
);

if ( ! $args['_content'] ) {
	return;
}


$kses_allowed_html                = wp_kses_allowed_html( 'user_description' );
$kses_allowed_html['a']['target'] = true;
$kses_allowed_html['i']           = [
	'class' => true,
];
?>
<div class="p-infobar">
	<?php if ( $args['_url'] ) : ?>

		<a class="p-infobar__inner" href="<?php echo esc_url( $args['_url'] ); ?>">
			<div class="c-container">
				<div class="p-infobar__content">
					<?php
					if ( isset( $kses_allowed_html['a'] ) ) {
						unset( $kses_allowed_html['a'] );
					}

					echo wp_kses(
						$args['_content'],
						$kses_allowed_html
					);
					?>
				</div>
			</div>
		</a>

	<?php else : ?>

		<span class="p-infobar__inner">
			<div class="c-container">
				<div class="p-infobar__content">
					<?php
					echo wp_kses(
						$args['_content'],
						$kses_allowed_html
					);
					?>
				</div>
			</div>
		</span>

	<?php endif; ?>
</div>
