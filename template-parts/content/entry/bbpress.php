<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.7.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_article_bottom_widget_area'  => false,
		'_display_article_top_widget_area'     => false,
		'_display_contents_bottom_widget_area' => false,
		'_display_entry_header'                => false,
	]
);

if ( $args['_display_entry_header'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_display_title_top_widget_area' => false,
		]
	);
}
?>

<article <?php post_class(); ?>>
	<?php
	if ( $args['_display_entry_header'] ) {
		Helper::get_template_part(
			'template-parts/content/entry/header/header',
			$args['_name'],
			[
				'_display_title_top_widget_area' => $args['_display_title_top_widget_area'],
			]
		);
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( $args['_display_article_top_widget_area'] ) {
			Helper::get_template_part( 'template-parts/widget-area/article-top' );
		}
		?>

		<?php Helper::get_template_part( 'template-parts/content/entry/content/bbpress' ); ?>

		<?php
		if ( $args['_display_article_bottom_widget_area'] ) {
			Helper::get_template_part( 'template-parts/widget-area/article-bottom' );
		}
		?>
	</div>
</article>

<?php
if ( $args['_display_contents_bottom_widget_area'] ) {
	Helper::get_template_part( 'template-parts/widget-area/contents-bottom' );
}
