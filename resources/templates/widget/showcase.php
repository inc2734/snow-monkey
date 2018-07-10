<?php
/**
 * @package inc2734/wp-awesome-widgets
 * @author inc2734
 * @license GPL-2.0+
 */
?>

<?php echo wp_kses_post( $args['before_widget'] ); ?>
	<style>
	.wpaw-showcase--<?php echo esc_html( $args['widget_id'] ); ?> .wpaw-showcase__lead,
	.wpaw-showcase--<?php echo esc_html( $args['widget_id'] ); ?> .wpaw-showcase__title {
		color: <?php echo esc_attr( $instance['color'] ); ?>;
	}
	</style>

	<?php
	$bg_image_size = apply_filters( 'inc2734_wp_awesome_widgets_showcase_backgroud_image_size', 'large', wp_is_mobile(), $args['widget_id'] );
	$bgimage       = wp_get_attachment_image_url( $instance['bg-image'], $bg_image_size );
	$is_block_link = ! empty( $instance['link-url'] ) && empty( $instance['link-text'] );
	$wrapper_tag   = $is_block_link ? 'a' : 'div';
	?>

	<<?php echo esc_attr( $wrapper_tag ); ?>
		<?php if ( $is_block_link ) : ?>
			href="<?php echo esc_url( $instance['link-url'] ); ?>"
		<?php endif; ?>
		class="wpaw-showcase wpaw-showcase--<?php echo esc_attr( $instance['format'] ); ?> wpaw-showcase--<?php echo esc_attr( $args['widget_id'] ); ?> js-bg-parallax"
		id="wpaw-showcase-<?php echo esc_attr( $args['widget_id'] ); ?>"
		>

		<div class="wpaw-showcase__bgimage js-bg-parallax__bgimage">
			<img src="<?php echo esc_url( $bgimage ); ?>" alt="">
		</div>

		<div class="wpaw-showcase__mask"
			style="background-color: <?php echo esc_attr( sanitize_hex_color( $instance['mask-color'] ) ); ?>; opacity: <?php echo esc_attr( $instance['mask-opacity'] ); ?>"
		></div>

		<div class="c-container js-bg-parallax__content">
			<div class="wpaw-showcase__inner">

				<div class="wpaw-showcase__body">
					<?php if ( ! empty( $instance['title'] ) ) : ?>
						<h2 class="wpaw-showcase__title"><?php echo esc_html( $instance['title'] ); ?></h2>
					<?php endif; ?>

					<?php if ( ! empty( $instance['lead'] ) ) : ?>
						<div class="wpaw-showcase__lead">
							<?php echo wp_kses_post( wpautop( $instance['lead'] ) ); ?>
						</div>
					<?php endif; ?>

					<?php if ( ! $is_block_link && ! empty( $instance['link-url'] ) && ! empty( $instance['link-text'] ) ) : ?>
						<div class="wpaw-showcase__action">
							<a class="wpaw-showcase__more" href="<?php echo esc_url( $instance['link-url'] ); ?>">
								<?php echo esc_html( $instance['link-text'] ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $instance['thumbnail'] ) ) : ?>
					<div class="wpaw-showcase__figure">
						<?php
						$thumbnail_size = apply_filters( 'inc2734_wp_awesome_widgets_showcase_image_size', 'large', wp_is_mobile(), $args['widget_id'] );
						$thumbnail      = wp_get_attachment_image_url( $instance['thumbnail'], $thumbnail_size );
						?>
						<?php if ( ! $is_block_link && ! empty( $instance['link-url'] ) ) : ?>
							<a href="<?php echo esc_url( $instance['link-url'] ); ?>">
								<img src="<?php echo esc_url( $thumbnail ); ?>" alt="">
							</a>
						<?php else : ?>
							<img src="<?php echo esc_url( $thumbnail ); ?>" alt="">
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</div>
		</div>

	</<?php echo esc_attr( $wrapper_tag ); ?>>

<?php echo wp_kses_post( $args['after_widget'] ); ?>
