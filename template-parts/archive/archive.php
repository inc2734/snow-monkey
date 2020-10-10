<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_post_type' => get_post_type() ? get_post_type() : 'post',
	]
);

$default_entries_layout = $args['_post_type']
	? get_theme_mod( $args['_post_type'] . '-entries-layout' )
	: 'rich-media';

$default_force_sm_1col = $args['_post_type']
	? get_theme_mod( $args['_post_type'] . '-entries-layout-sm-1col' )
	: false;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => $default_entries_layout,
		'_infeed_ads'     => false,
		'_force_sm_1col'  => $default_force_sm_1col,
	]
);
?>

<div class="p-archive">
	<?php
	Helper::get_template_part(
		'template-parts/common/entries',
		$args['_post_type'],
		[
			'_post_type'      => $args['_post_type'],
			'_entries_layout' => $args['_entries_layout'],
			'_infeed_ads'     => $args['_infeed_ads'],
			'_force_sm_1col'  => $args['_force_sm_1col'],
		]
	);
	?>
</div>
