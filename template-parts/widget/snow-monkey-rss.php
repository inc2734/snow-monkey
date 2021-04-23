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
		'_classname'      => null,
		'_entries_layout' => 'rich-media',
		'_excerpt_length' => null,
		'_force_sm_1col'  => false,
		'_infeed_ads'     => false,
		'_item_title_tag' => 'h3',
		'_items'          => [],
		'_link_text'      => null,
		'_link_url'       => null,
		'_title'          => null,
		'_widget_area_id' => null,
		'_arrows'         => false,
		'_dots'           => true,
		'_interval'       => 0,
	]
);

if ( ! $args['_items'] ) {
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
?>

<div class="<?php echo esc_attr( join( ' ', $classnames ) ); ?>">
	<?php if ( $args['_title'] ) : ?>
		<h2 class="<?php echo esc_attr( join( ' ', $title_classnames ) ); ?>">
			<?php echo wp_kses_post( $args['_title'] ); ?>
		</h2>
	<?php endif; ?>

	<?php
	Helper::get_template_part(
		'template-parts/common/entries/rss',
		null,
		[
			'_context'        => $args['_context'],
			'_entries_layout' => $args['_entries_layout'],
			'_excerpt_length' => $args['_excerpt_length'],
			'_force_sm_1col'  => $args['_force_sm_1col'],
			'_infeed_ads'     => $args['_infeed_ads'],
			'_item_title_tag' => $args['_item_title_tag'],
			'_items'          => $args['_items'],
			'_arrows'         => $args['_arrows'],
			'_dots'           => $args['_dots'],
			'_interval'       => $args['_interval'],
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
