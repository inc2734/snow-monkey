<?php
/**
 * @package inc2734/snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>

<?php echo wp_kses_post( $args['before_widget'] ); ?>
	<style>
	.wpaw-pr-box--<?php echo esc_html( $args['widget_id'] ); ?> .c-widget__title span {
		background-color: <?php echo esc_attr( $instance['bg-color'] ); ?> !important;
	}
	</style>

	<div
		class="wpaw-pr-box wpaw-pr-box--<?php echo esc_attr( $args['widget_id'] ); ?>"
		id="wpaw-pr-box-<?php echo esc_attr( $args['widget_id'] ); ?>"
		style="background-color: <?php echo esc_attr( $instance['bg-color'] ); ?>"
		>

		<div class="wpaw-pr-box__inner">

			<?php if ( ! empty( $instance['title'] ) ) : ?>
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
					$title_class = 'wpaw-pr-box__title';
				}
				?>
				<h2 class="<?php echo esc_attr( $title_class ); ?>">
					<?php echo esc_html( $instance['title'] ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( ! empty( $instance['lead'] ) ) : ?>
				<div class="wpaw-pr-box__lead">
					<?php echo wp_kses_post( wpautop( $instance['lead'] ) ); ?>
				</div>
			<?php endif; ?>

			<div class="wpaw-pr-box__row c-row c-row--margin">
				<?php foreach ( $instance['items'] as $item ) : ?>
					<div class="wpaw-pr-box__item c-row__col c-row__col--1-<?php echo esc_attr( $instance['sm-columns'] ); ?> c-row__col--md-1-<?php echo esc_attr( $instance['md-columns'] ); ?> c-row__col--lg-1-<?php echo esc_attr( $instance['lg-columns'] ); ?>">
						<?php if ( ! empty( $item['src'] ) ) : ?>
							<?php
							$thumbnail    = wp_get_attachment_image_url( $item['src'], $instance['thumbnail-size'] );
							$aspect_ratio = $instance['thumbnail-aspect-ratio'];
							?>
							<?php if ( ! empty( $item['link-url'] ) ) : ?>
								<a href="<?php echo esc_html( $item['link-url'] ); ?>">
									<div class="wpaw-pr-box__item-figure wpaw-pr-box__item-figure--<?php echo esc_attr( $aspect_ratio ); ?>"
										style="background-image: url( <?php echo esc_url( $thumbnail ); ?> );"
									></div>
								</a>
							<?php else : ?>
								<div class="wpaw-pr-box__item-figure wpaw-pr-box__item-figure--<?php echo esc_attr( $aspect_ratio ); ?>"
									style="background-image: url( <?php echo esc_url( $thumbnail ); ?> );"
								></div>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( ! empty( $item['title'] ) ) : ?>
							<div class="wpaw-pr-box__item-title"><?php echo esc_html( $item['title'] ); ?></div>
						<?php endif; ?>

						<?php if ( ! empty( $item['summary'] ) ) : ?>
							<div class="wpaw-pr-box__item-summary">
								<?php echo wp_kses_post( wpautop( $item['summary'] ) ); ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $item['link-url'] ) && ! empty( $item['link-text'] ) ) : ?>
							<div class="wpaw-pr-box__item-action">
								<a class="c-btn" href="<?php echo esc_url( $item['link-url'] ); ?>">
									<?php echo esc_html( $item['link-text'] ); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( ! empty( $instance['link-url'] ) && ! empty( $instance['link-text'] ) ) : ?>
				<div class="wpaw-pr-box__action">
					<a class="c-btn" href="<?php echo esc_url( $instance['link-url'] ); ?>">
						<?php echo esc_html( $instance['link-text'] ); ?>
					</a>
				</div>
			<?php endif; ?>

		</div>
	</div>

<?php echo wp_kses_post( $args['after_widget'] ); ?>
