<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_terms' => [],
	]
);

if ( ! $args['_terms'] ) {
	return;
}
?>

<?php foreach ( $args['_terms'] as $_term ) : ?>
	<span class="c-entry-summary__term c-entry-summary__term--<?php echo esc_attr( $_term->taxonomy . '-' . $_term->term_id ); ?>">
		<?php echo esc_html( $_term->name ); ?>
	</span>
<?php endforeach; ?>
