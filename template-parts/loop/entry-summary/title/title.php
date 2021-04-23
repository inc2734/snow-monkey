<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => 'rich-media',
		'_title_tag'      => 'h2',
	]
);

$title = get_the_title();
if ( ! $title ) {
	return;
}

$title_tag = $args['_title_tag'];
?>

<<?php echo esc_html( $title_tag ); ?> class="c-entry-summary__title">
	<?php
	if ( ! in_array( $args['_entries_layout'], [ 'rich-media', 'carousel' ], true ) ) {
		echo wp_kses_post( $title );
	} else {
		Helper::the_title_trimed( $title );
	}
	?>
</<?php echo esc_html( $title_tag ); ?>>
