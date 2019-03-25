<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$posts_query = Helper::get_var( $_posts_query, null );
if ( ! $posts_query ) {
	return;
}

$widget_area_id = Helper::get_var( $_widget_area_id, null );
$classname      = Helper::get_var( $_classname, null );
$id             = Helper::get_var( $_id, null );
$entries_layout = Helper::get_var( $_entries_layout, 'rich-media' );
$title          = Helper::get_var( $_title, null );
$link_url       = Helper::get_var( $_link_url, null );
$link_text      = Helper::get_var( $_link_text, null );

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
if ( $classname ) {
	$classnames[] = $classname;
}

$title_classname = 'c-widget__title';
if ( in_array( $widget_area_id, $content_widget_areas ) ) {
	$title_classname = 'snow-monkey-posts__title';
}
$title_classnames = [
	$title_classname,
	$classname . '__title',
];

$action_classnames = [
	'snow-monkey-posts__action',
	$classname . '__action',
];

$more_classnames = [
	'snow-monkey-posts__more',
	$classname . '__more',
];
?>

<div
	class="<?php echo esc_attr( join( ' ', $classnames ) ); ?>"
	id="<?php echo esc_attr( $id ); ?>"
	>

	<?php if ( $title ) : ?>
		<h2 class="<?php echo esc_attr( join( ' ', $title_classnames ) ); ?>">
			<?php echo esc_html( $title ); ?>
		</h2>
	<?php endif; ?>

	<ul class="c-entries c-entries--<?php echo esc_attr( $entries_layout ); ?>" data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>">
		<?php while ( $posts_query->have_posts() ) : ?>
			<?php $posts_query->the_post(); ?>
			<li class="c-entries__item">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary',
					get_post_type(),
					[
						'widget_layout' => $entries_layout,
					]
				);
				?>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul>

	<?php if ( ! empty( $link_url ) && ! empty( $link_text ) ) : ?>
		<div class="<?php echo esc_attr( join( ' ', $action_classnames ) ); ?>">
			<a class="<?php echo esc_attr( join( ' ', $more_classnames ) ); ?>" href="<?php echo esc_url( $link_url ); ?>">
				<?php echo esc_html( $link_text ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
