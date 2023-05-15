<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_id' => null,
		'_terms'      => array(),
	)
);

if ( ! $args['_terms'] ) {
	return;
}
?>

<?php foreach ( $args['_terms'] as $_term ) : ?>
	<span class="c-entry-summary__term c-entry-summary__term--<?php echo esc_attr( $_term->taxonomy . '-' . $_term->term_id ); ?> c-entry-summary__term--<?php echo esc_attr( $_term->taxonomy . '-slug-' . urldecode( $_term->slug ) ); ?>">
		<?php echo esc_html( $_term->name ); ?>
	</span>
<?php endforeach; ?>
