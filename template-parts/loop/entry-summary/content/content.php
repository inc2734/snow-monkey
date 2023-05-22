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
		'_entries_id'     => null,
		'_entries_layout' => 'rich-media',
		'_excerpt_length' => null,
	)
);

$args = wp_parse_args(
	$args,
	array(
		'_display_item_excerpt' => in_array( $args['_entries_layout'], array( 'rich-media', 'simple', 'carousel' ), true )
			? true
			: false,
	)
);

if ( ! $args['_display_item_excerpt'] ) {
	return;
}

/**
 * Callback for excerpt_length
 *
 * @global array $args The template part args.
 * @param int $number The maximum number of words. Default 55.
 * @return int
 */
$entry_summary_content_excerpt_length = function( $number = null ) use ( $args ) {
	return Helper::entry_summary_content_excerpt_length(
		$args['_excerpt_length'],
		$args['_entries_layout'],
		$number
	);
};

add_filter( 'excerpt_length', $entry_summary_content_excerpt_length, 100 );
ob_start();
the_excerpt();
$content = wp_strip_all_tags( ob_get_clean() );
remove_filter( 'excerpt_length', $entry_summary_content_excerpt_length, 100 );

if ( ! $content ) {
	return;
}
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $content ); ?>
</div>
