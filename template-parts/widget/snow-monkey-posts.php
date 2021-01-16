<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_classname'           => null,
		'_entries_layout'      => 'rich-media',
		'_excerpt_length'      => null,
		'_force_sm_1col'       => false,
		'_infeed_ads'          => get_option( 'mwt-google-infeed-ads' ),
		'_item_thumbnail_size' => 'medium_large',
		'_item_title_tag'      => 'h3',
		'_link_text'           => null,
		'_link_url'            => null,
		'_posts_query'         => null,
		'_title'               => null,
		'_vertical'            => false,
		'_widget_area_id'      => null,
	]
);

if ( ! $args['_posts_query'] ) {
	return;
}

$content_widget_areas = [
	'front-page-top-widget-area',
	'front-page-bottom-widget-area',
	'posts-page-top-widget-area',
	'posts-page-bottom-widget-area',
	'archive-top-widget-area',
];

$classnames   = [];
$classnames[] = 'snow-monkey-posts';
if ( $args['_classname'] ) {
	$classnames[] = $args['_classname'];
}

$title_classname = 'c-widget__title';
if ( in_array( $args['_widget_area_id'], $content_widget_areas, true ) ) {
	$title_classname = 'snow-monkey-posts__title';
}
$title_classnames = [
	$title_classname,
	$args['_classname'] . '__title',
];

$action_classnames = [
	'snow-monkey-posts__action',
	$args['_classname'] . '__action',
];

$more_classnames = [
	'snow-monkey-posts__more',
	$args['_classname'] . '__more',
];

$posts_per_page = $args['_posts_query']->get( 'posts_per_page' );
$loop_count     = 0;

$force_sm_1col = $args['_force_sm_1col'] ? 'true' : 'false';
?>

<div class="<?php echo esc_attr( join( ' ', $classnames ) ); ?>">
	<?php if ( $args['_title'] ) : ?>
		<h2 class="<?php echo esc_attr( join( ' ', $title_classnames ) ); ?>">
			<?php echo wp_kses_post( $args['_title'] ); ?>
		</h2>
	<?php endif; ?>

	<?php
	$_post_types  = $args['_posts_query']->get( 'post_type' );
	$_post_type   = isset( $_post_types[0] ) ? $_post_types[0] : null;
	$archive_view = $_post_type ? get_theme_mod( $_post_type . '-archive-view' ) : null;

	Helper::get_template_part(
		'template-parts/common/entries',
		$archive_view,
		[
			'_context'             => $args['_context'],
			'_entries_layout'      => $args['_entries_layout'],
			'_excerpt_length'      => $args['_excerpt_length'],
			'_force_sm_1col'       => $args['_force_sm_1col'],
			'_infeed_ads'          => $args['_infeed_ads'],
			'_item_thumbnail_size' => $args['_item_thumbnail_size'],
			'_item_title_tag'      => $args['_item_title_tag'],
			'_posts_query'         => $args['_posts_query'],
		]
	);
	?>

	<?php if ( $args['_link_url'] && $args['_link_text'] ) : ?>
		<div class="<?php echo esc_attr( join( ' ', $action_classnames ) ); ?>">
			<a class="<?php echo esc_attr( join( ' ', $more_classnames ) ); ?>" href="<?php echo esc_url( $args['_link_url'] ); ?>">
				<?php echo esc_html( $args['_link_text'] ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
