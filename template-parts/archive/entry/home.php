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
		'_display_entry_header'                  => false,
		'_display_eyecatch'                      => false,
		'_display_posts_page_bottom_widget_area' => false,
		'_display_posts_page_top_widget_area'    => false,
		'_entries_layout'                        => 'rich-media',
		'_force_sm_1col'                         => false,
		'_infeed_ads'                            => false,
	]
);
?>

<?php
if ( $args['_display_posts_page_top_widget_area'] ) {
	Helper::get_template_part( 'template-parts/widget-area/posts-page-top' );
}
?>

<div class="c-entry">
	<?php
	if ( $args['_display_entry_header'] ) {
		Helper::get_template_part( 'template-parts/archive/entry/header/header', $args['_name'] );
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( $args['_display_eyecatch'] ) {
			Helper::get_template_part( 'template-parts/archive/eyecatch' );
		}
		?>

		<?php
		Helper::get_template_part(
			'template-parts/archive/entry/content/content',
			$args['_name'],
			[
				'_entries_layout' => $args['_entries_layout'],
				'_force_sm_1col'  => $args['_force_sm_1col'],
				'_infeed_ads'     => $args['_infeed_ads'],
			]
		);
		?>
	</div>
</div>

<?php
if ( $args['_display_posts_page_bottom_widget_area'] ) {
	Helper::get_template_part( 'template-parts/widget-area/posts-page-bottom' );
}

