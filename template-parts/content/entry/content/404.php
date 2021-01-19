<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 *
 * renamed: template-parts/content/entry/content/content-404.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_message' => __( 'Woops! Page not found.', 'snow-monkey' ) . '<br>' .
									__( 'The page you are looking for may be moved or deleted.', 'snow-monkey' ) . '<br>' .
									__( 'Please search this search box.', 'snow-monkey' ),
	]
);
?>

<?php do_action( 'snow_monkey_before_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<?php do_action( 'snow_monkey_prepend_entry_content' ); ?>

	<?php if ( $args['_message'] ) : ?>
		<p>
			<?php echo wp_kses_post( $args['_message'] ); ?>
		</p>
	<?php endif; ?>

	<?php Helper::get_template_part( 'template-parts/common/search-form', '404' ); ?>

	<?php do_action( 'snow_monkey_append_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_entry_content' ); ?>
