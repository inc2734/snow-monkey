<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 *
 * renamed: template-parts/loop/entry-summary/content/content-rss.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_item'           => false,
		'_entries_layout' => 'rich-media',
		'_excerpt_length' => null,
	]
);

if ( ! $args['_item'] || ! is_a( $args['_item'], 'SimplePie_Item' ) ) {
	return;
}

$description    = $args['_item']->get_description();
$excerpt_length = Helper::entry_summary_content_excerpt_length( $args['_excerpt_length'], $args['_entries_layout'] );
$excerpt_more   = apply_filters( 'excerpt_more', ' [&hellip;]' );
$description    = wp_strip_all_tags( wp_trim_words( $description, $excerpt_length, $excerpt_more ) );
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $description ); ?>
</div>
