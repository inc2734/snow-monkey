<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	$args,
	[
		'_items'          => false,
		'_widget_area_id' => null,
		'_classname'      => null,
		'_entries_layout' => 'rich-media',
		'_force_sm_1col'  => false,
		'_title'          => null,
		'_item_title_tag' => 'h3',
		'_link_url'       => null,
		'_link_text'      => null,
		'_excerpt_length' => null,
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

$infeed_ads      = get_option( 'mwt-google-infeed-ads' );
$data_infeed_ads = ( $infeed_ads ) ? 'true' : 'false';

$classnames[] = 'snow-monkey-posts';
if ( $args['_classname'] ) {
	$classnames[] = $args['_classname'];
}

$title_classname = 'c-widget__title';
if ( in_array( $args['_widget_area_id'], $content_widget_areas ) ) {
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

$force_sm_1col = $args['_force_sm_1col'] ? 'true' : 'false';
?>

<div class="<?php echo esc_attr( join( ' ', $classnames ) ); ?>">
	<?php if ( $args['_title'] ) : ?>
		<h2 class="<?php echo esc_attr( join( ' ', $title_classnames ) ); ?>">
			<?php echo wp_kses_post( $args['_title'] ); ?>
		</h2>
	<?php endif; ?>

	<ul class="c-entries c-entries--<?php echo esc_attr( $args['_entries_layout'] ); ?>" data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>" data-force-sm-1col="<?php echo esc_attr( $force_sm_1col ); ?>">
		<?php foreach ( $args['_items'] as $item ) : ?>
			<?php
			if ( ! $item || ! is_a( $item, 'SimplePie_Item' ) ) {
				continue;
			}
			?>
			<li class="c-entries__item">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary',
					'rss',
					[
						'_item'           => $item,
						'_title_tag'      => $args['_item_title_tag'],
						'_entries_layout' => $args['_entries_layout'],
						'_excerpt_length' => $args['_excerpt_length'],
					]
				);
				?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php if ( $args['_link_url'] && $args['_link_text'] ) : ?>
		<div class="<?php echo esc_attr( join( ' ', $action_classnames ) ); ?>">
			<a class="<?php echo esc_attr( join( ' ', $more_classnames ) ); ?>" href="<?php echo esc_url( $args['_link_url'] ); ?>">
				<?php echo esc_html( $args['_link_text'] ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
