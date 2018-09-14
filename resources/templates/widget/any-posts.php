<?php
/**
 * @package inc2734/wp-awesome-widgets
 * @author inc2734
 * @license GPL-2.0+
 */

$items = explode( ',', $instance['items'] );
if ( ! $items ) {
	return;
}

$any_posts_query = new WP_Query(
	[
		'post_type'           => 'any',
		'posts_per_page'      => count( $items ),
		'post__in'            => $items,
		'orderby'             => 'post__in',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'suppress_filters'    => true,
	]
);
?>

<?php echo wp_kses_post( $args['before_widget'] ); ?>

	<?php if ( $instance['title'] ) : ?>
		<?php echo wp_kses_post( $args['before_title'] ); ?>
			<?php echo esc_html( $instance['title'] ); ?>
		<?php echo wp_kses_post( $args['after_title'] ); ?>
	<?php endif; ?>

	<div
		class="wpaw-any-posts wpaw-any-posts--<?php echo esc_attr( $args['widget_id'] ); ?>"
		id="wpaw-any-posts-<?php echo esc_attr( $args['widget_id'] ); ?>"
		>

		<ul class="wpaw-any-posts__list">
			<?php while ( $any_posts_query->have_posts() ) : ?>
				<?php $any_posts_query->the_post(); ?>
				<li class="wpaw-any-posts__item">
					<a href="<?php the_permalink(); ?>">

						<?php if ( $instance['show-thumbnail'] ) : ?>
							<div class="wpaw-any-posts__figure"
								style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), 'thumbnail' ) ); ?> )"
							></div>
						<?php endif; ?>

						<div class="wpaw-any-posts__body">
							<?php
							$taxonomies = get_post_taxonomies( get_the_ID() );
							$_taxonomy  = ! empty( $taxonomies[0] ) ? $taxonomies[0] : false;
							$terms      = ( $_taxonomy ) ? get_the_terms( get_the_ID(), $_taxonomy ) : [];
							?>
							<?php if ( $instance['show-taxonomy'] && $terms ) : ?>
								<div class="wpaw-any-posts__taxonomy">
									<?php foreach ( $terms as $_term ) : ?>
										<span class="wpaw-any-posts__term wpaw-any-posts__term--category-<?php echo esc_attr( $_term->term_id ); ?>"><?php echo esc_html( $_term->name ); ?></span>
										<?php break; ?>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<div class="wpaw-any-posts__title"><?php the_title(); ?></div>
							<div class="wpaw-any-posts__date"><?php the_time( get_option( 'date_format' ) ); ?></div>
						</div>

					</a>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</div>

<?php echo wp_kses_post( $args['after_widget'] ); ?>
