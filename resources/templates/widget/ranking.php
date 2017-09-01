<?php
/**
 * @package inc2734/snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

global $post;

$items = explode( ',', $instance['items']);
if ( ! $items ) {
	return;
}

$recent_posts = get_posts( [
	'post_type'      => 'post',
	'posts_per_page' => -1,
	'post__in'       => $items,
] );
?>

<?php echo $args['before_widget']; ?>

	<?php if ( $instance['title'] ) : ?>
		<?php echo $args['before_title']; ?><?php echo esc_html( $instance['title'] ); ?><?php echo $args['after_title']; ?>
	<?php endif; ?>

	<div
		class="wpaw-ranking"
		id="wpaw-ranking-<?php echo esc_attr( $args['widget_id'] ); ?>"
		>

		<ul class="wpaw-ranking__list">
			<?php foreach ( $recent_posts as $post ) : setup_postdata( $post ); ?>
				<li class="wpaw-ranking__item">
					<a href="<?php the_permalink(); ?>">

						<?php if ( $instance['show-thumbnail'] ) : ?>
							<div class="wpaw-recent-posts__figure"
								style="background-image: url(<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'thumbnail' ); ?> )"
							></div>
						<?php endif; ?>

						<div class="wpaw-ranking__body">
							<?php if ( $instance['show-taxonomy'] && $terms = get_the_terms( get_the_ID(), 'category' ) ) : ?>
								<div class="wpaw-ranking__taxonomy">
									<?php foreach ( $terms as $term ) : ?>
										<span class="wpaw-ranking__term"><?php echo esc_html( $term->name ); ?></span>
									<?php break; endforeach; ?>
								</div>
							<?php endif; ?>

							<div class="wpaw-ranking__title">
								<?php
								ob_start();
								the_title();
								$title = wp_trim_words( ob_get_clean(), class_exists( 'multibyte_patch' ) ? 30 : 60 );
								echo esc_html( $title );
								?>
							</div>
							<div class="wpaw-ranking__date"><?php the_time( get_option( 'date_format' ) ); ?></div>
						</div>

					</a>
				</li>
			<?php endforeach; wp_reset_postdata(); ?>
		</ul>
	</div>

<?php echo $args['after_widget']; ?>
