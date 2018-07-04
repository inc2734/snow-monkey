<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

global $post;

$widget_id = explode( '-', $args['widget_id'] );
$widget_id = end( $widget_id );

$query_args = [
	'post_type'      => 'post',
	'posts_per_page' => $instance['posts-per-page'],
];
$query_args = apply_filters( 'snow_monkey_recent_posts_widget_args', $query_args );
$query_args = apply_filters( 'snow_monkey_recent_posts_widget_args_' . $widget_id, $query_args );

$recent_posts = get_posts( $query_args );

if ( ! $recent_posts ) {
	return;
}
?>

<?php echo wp_kses_post( $args['before_widget'] ); ?>

	<div
		class="snow-monkey-recent-posts"
		id="snow-monkey-recent-posts-<?php echo esc_attr( $args['widget_id'] ); ?>"
		>

		<?php
		$infeed_ads      = get_option( 'mwt-google-infeed-ads' );
		$data_infeed_ads = ( $infeed_ads ) ? 'true' : 'false';
		$archive_layout  = $instance['layout'];
		?>

		<?php if ( $instance['title'] ) : ?>
			<?php
			$title_class = 'c-widget__title';
			$content_widget_areas = [
				'front-page-top-widget-area',
				'front-page-bottom-widget-area',
				'posts-page-top-widget-area',
				'posts-page-bottom-widget-area',
				'archive-top-widget-area',
			];
			if ( in_array( $args['id'], $content_widget_areas ) ) {
				$title_class = 'snow-monkey-recent-posts__title';
			}
			?>
			<h2 class="<?php echo esc_attr( $title_class ); ?>">
				<?php echo esc_html( $instance['title'] ); ?>
			</h2>
		<?php endif; ?>

		<ul class="c-entries c-entries--<?php echo esc_attr( $archive_layout ); ?>" data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>">
			<?php foreach ( $recent_posts as $post ) : ?>
				<?php setup_postdata( $post ); ?>
				<li class="c-entries__item">
					<?php
					wpvc_get_template_part( 'template-parts/entry-summary', [
						'widget_layout' => $instance['layout'],
					] );
					?>
				</li>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
		</ul>

		<?php if ( ! empty( $instance['link-url'] ) && ! empty( $instance['link-text'] ) ) : ?>
			<div class="snow-monkey-recent-posts__action">
				<a class="snow-monkey-recent-posts__more" href="<?php echo esc_url( $instance['link-url'] ); ?>"><?php echo esc_html( $instance['link-text'] ); ?></a>
			</div>
		<?php endif; ?>
	</div>

<?php echo wp_kses_post( $args['after_widget'] ); ?>
