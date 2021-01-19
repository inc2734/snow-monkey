<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_context'        => 'archive',
		'_entries_layout' => 'rich-media',
		'_force_sm_1col'  => false,
		'_infeed_ads'     => false,
		'_posts_query'    => false,
	]
);

if ( ! $args['_posts_query'] ) {
	return;
}
?>

<div class="p-archive">
	<?php
	Helper::get_template_part(
		'template-parts/common/entries/entries',
		$args['_name'],
		[
			'_context'        => $args['_context'],
			'_entries_layout' => $args['_entries_layout'],
			'_force_sm_1col'  => $args['_force_sm_1col'],
			'_infeed_ads'     => $args['_infeed_ads'],
			'_posts_query'    => $args['_posts_query'],
		]
	);
	?>
</div>
