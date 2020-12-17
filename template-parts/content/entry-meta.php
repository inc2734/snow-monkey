<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.1.0
 *
 * renamed: template-parts/entry-meta.php
 */

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_terms' => false,
	]
);

if ( false !== $args['_terms'] && is_array( $args['_terms'] ) ) {
	remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_categories', 40 );
}
?>

<ul class="c-meta">
	<?php do_action( 'snow_monkey_entry_meta_items' ); ?>

	<?php if ( false !== $args['_terms'] && is_array( $args['_terms'] ) ) : ?>
		<?php foreach ( $args['_terms'] as $_term ) : ?>
			<li class="c-meta__item c-meta__item--<?php echo esc_attr( $_term->taxonomy ); ?>">
				<i class="fas fa-folder" aria-hidden="true"></i>
				<a href="<?php echo esc_url( get_term_link( $_term ) ); ?>"><?php echo esc_html( $_term->name ); ?></a>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>
