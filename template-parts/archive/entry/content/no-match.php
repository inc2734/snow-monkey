<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 *
 * renamed: template-parts/archive/entry/content/content-no-match.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_display_search_form' => true,
		'_message'             => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'snow-monkey' ),
	)
);
?>

<?php do_action( 'snow_monkey_before_archive_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<?php do_action( 'snow_monkey_prepend_archive_entry_content' ); ?>

	<?php if ( $args['_message'] ) : ?>
		<p>
			<?php echo wp_kses_post( $args['_message'] ); ?>
		</p>
	<?php endif; ?>

	<?php
	if ( $args['_display_search_form'] ) {
		Helper::get_template_part( 'template-parts/common/search-form', 'no-match' );
	}
	?>

	<?php do_action( 'snow_monkey_append_archive_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_archive_entry_content' ); ?>
