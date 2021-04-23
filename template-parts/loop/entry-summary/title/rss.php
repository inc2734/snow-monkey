<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 *
 * renamed: template-parts/loop/entry-summary/title/title-rss.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => 'rich-media',
		'_title_tag'      => 'h2',
		'_item'           => false,
	]
);

if ( ! $args['_item'] || ! is_a( $args['_item'], 'SimplePie_Item' ) ) {
	return;
}

$title = $args['_item']->get_title();
if ( ! $title ) {
	return;
}

$title_tag = $args['_title_tag'];
?>

<<?php echo esc_html( $title_tag ); ?> class="c-entry-summary__title">
	<?php
	if ( ! in_array( $args['_entries_layout'], [ 'rich-media', 'carousel' ], true ) ) {
		echo esc_html( $title );
	} else {
		Helper::the_title_trimed( $title );
	}
	?>
</<?php echo esc_html( $title_tag ); ?>>
