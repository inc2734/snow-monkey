<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_context'           => 'archive',
		'_entries_layout'    => 'rich-media',
		'_entries_gap'       => null,
		'_force_sm_1col'     => false,
		'_infeed_ads'        => false,
		'_posts_query'       => false,
		'_display_item_meta' => false,
	)
);

if ( ! $args['_posts_query'] ) {
	return;
}

$args = wp_parse_args(
	$args,
	array(
		'_display_item_author'    => $args['_display_item_meta'],
		'_display_item_published' => $args['_display_item_meta'],
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
?>

<div class="p-archive">
	<?php
	Helper::get_template_part(
		'template-parts/common/entries/entries',
		$args['_name'],
		array(
			'_context'                => $args['_context'],
			'_entries_layout'         => $args['_entries_layout'],
			'_entries_gap'            => $args['_entries_gap'],
			'_force_sm_1col'          => $args['_force_sm_1col'],
			'_infeed_ads'             => $args['_infeed_ads'],
			'_posts_query'            => $args['_posts_query'],
			'_display_item_meta'      => $args['_display_item_meta'],
			'_display_item_author'    => $args['_display_item_author'],
			'_display_item_published' => $args['_display_item_published'],
			'_display_item_excerpt'   => $args['_display_item_excerpt'],
		)
	);
	?>
</div>
