<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.0.0
 *
 * renamed: template-parts/entry-tags.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_terms' => get_the_terms( get_the_ID(), 'post_tag' ),
	]
);

if ( ! $args['_terms'] || ! is_array( $args['_terms'] ) ) {
	return;
}
?>

<div class="c-entry-tags">
	<?php foreach ( $args['_terms'] as $_term ) : ?>
		<a class="tag-cloud-link tag-link-<?php echo esc_attr( $_term->term_id ); ?>" href="<?php echo esc_url( get_term_link( $_term ) ); ?>">
			<?php echo esc_html( $_term->name ); ?>
		</a>
	<?php endforeach; ?>
</div>
