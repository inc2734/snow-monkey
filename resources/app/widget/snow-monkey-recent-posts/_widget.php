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

	<?php if ( $instance['title'] ) : ?>
		<?php echo wp_kses_post( $args['before_title'] ); ?>
			<?php echo esc_html( $instance['title'] ); ?>
		<?php echo wp_kses_post( $args['after_title'] ); ?>
	<?php endif; ?>

	<div
		class="snow-monkey-recent-posts"
		id="snow-monkey-recent-posts-<?php echo esc_attr( $args['widget_id'] ); ?>"
		>

		<ul class="c-entries c-entries--<?php echo esc_attr( $instance['layout'] ); ?>">
			<?php foreach ( $recent_posts as $post ) : ?>
				<?php setup_postdata( $post ); ?>
				<li class="c-entries__item">
					<?php get_template_part( 'template-parts/entry-summary' ); ?>
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
