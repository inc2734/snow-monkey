<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 */

use Framework\Helper;

$eyecatch_position    = get_theme_mod( 'archive-eyecatch' );
$display_entry_header = ! is_front_page()
												&& get_theme_mod( 'posts-page-display-title' )
												&& 'title-on-page-header' !== $eyecatch_position;
$display_eyecatch     = 'content-top' === $eyecatch_position;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_posts_page_top_widget_area'    => ! is_paged(),
		'_display_posts_page_bottom_widget_area' => ! is_paged(),
		'_display_description'                   => false,
		'_display_entry_header'                  => $display_entry_header,
		'_display_eyecatch'                      => $display_eyecatch,
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
		Helper::get_template_part( 'template-parts/archive/entry/header/header', 'post' );
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( $args['_display_eyecatch'] ) {
			Helper::get_template_part( 'template-parts/archive/eyecatch' );
		}

		Helper::get_template_part(
			'template-parts/archive/entry/content/content',
			'post',
			[
				'_entries_layout' => get_theme_mod( 'post-entries-layout' ),
				'_force_sm_1col'  => get_theme_mod( 'post-entries-layout-sm-1col' ),
			]
		);
		?>
	</div>
</div>

<?php
if ( $args['_display_posts_page_bottom_widget_area'] ) {
	Helper::get_template_part( 'template-parts/widget-area/posts-page-bottom' );
}
