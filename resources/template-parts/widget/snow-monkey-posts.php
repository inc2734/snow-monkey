<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.0
 */

use Framework\Helper;

$template_args = [
	'posts_query'         => Helper::get_var( $_posts_query, null ),
	'widget_area_id'      => Helper::get_var( $_widget_area_id, null ),
	'classname'           => Helper::get_var( $_classname, null ),
	'entries_layout'      => Helper::get_var( $_entries_layout, 'rich-media' ),
	'force_sm_1col'       => Helper::get_var( $_force_sm_1col, false ),
	'title'               => Helper::get_var( $_title, null ),
	'item_title_tag'      => Helper::get_var( $_item_title_tag, 'h3' ),
	'item_thumbnail_size' => Helper::get_var( $_item_thumbnail_size, 'medium_large' ),
	'link_url'            => Helper::get_var( $_link_url, null ),
	'link_text'           => Helper::get_var( $_link_text, null ),
	'excerpt_length'      => Helper::get_var( $_excerpt_length, null ),
];

if ( ! $template_args['posts_query'] ) {
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
if ( $template_args['classname'] ) {
	$classnames[] = $template_args['classname'];
}

$title_classname = 'c-widget__title';
if ( in_array( $template_args['widget_area_id'], $content_widget_areas ) ) {
	$title_classname = 'snow-monkey-posts__title';
}
$title_classnames = [
	$title_classname,
	$template_args['classname'] . '__title',
];

$action_classnames = [
	'snow-monkey-posts__action',
	$template_args['classname'] . '__action',
];

$more_classnames = [
	'snow-monkey-posts__more',
	$template_args['classname'] . '__more',
];

$posts_per_page = $template_args['posts_query']->get( 'posts_per_page' );
$loop_count = 0;

$force_sm_1col = $template_args['force_sm_1col'] ? 'true' : 'false';
?>

<div class="<?php echo esc_attr( join( ' ', $classnames ) ); ?>">
	<?php if ( $template_args['title'] ) : ?>
		<h2 class="<?php echo esc_attr( join( ' ', $title_classnames ) ); ?>">
			<?php echo wp_kses_post( $template_args['title'] ); ?>
		</h2>
	<?php endif; ?>

	<ul class="c-entries c-entries--<?php echo esc_attr( $template_args['entries_layout'] ); ?>" data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>" data-force-sm-1col="<?php echo esc_attr( $force_sm_1col ); ?>">
		<?php while ( $template_args['posts_query']->have_posts() ) : ?>
			<?php
			$template_args['posts_query']->the_post();
			$loop_count ++;
			if ( $loop_count > $posts_per_page ) {
				break;
			}

			$_post_type   = get_post_type();
			$archive_view = get_theme_mod( $_post_type . '-archive-view' );
			?>
			<li class="c-entries__item">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary',
					$archive_view ? $archive_view : $_post_type,
					[
						'_title_tag'      => $template_args['item_title_tag'],
						'_thumbnail_size' => $template_args['item_thumbnail_size'],
						'_entries_layout' => $template_args['entries_layout'],
						'_excerpt_length' => $template_args['excerpt_length'],
					]
				);
				?>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul>

	<?php if ( $template_args['link_url'] && $template_args['link_text'] ) : ?>
		<div class="<?php echo esc_attr( join( ' ', $action_classnames ) ); ?>">
			<a class="<?php echo esc_attr( join( ' ', $more_classnames ) ); ?>" href="<?php echo esc_url( $template_args['link_url'] ); ?>">
				<?php echo esc_html( $template_args['link_text'] ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
