<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div class="c-prev-next-nav">
	<?php foreach ( [ 'next', 'prev' ] as $key ) : ?>
		<div class="c-prev-next-nav__item c-prev-next-nav__item--<?php echo esc_attr( $key ); ?>">
			<?php
			if ( 'next' === $key ) {
				$_post = get_previous_post();
			} elseif ( 'prev' === $key ) {
				$_post = get_next_post();
			}
			?>

			<?php if ( ! empty( $_post->ID ) ) : ?>
				<?php
				$background_image_size = wp_is_mobile() ? 'large' : 'medium';
				$background_image_url = wp_get_attachment_image_url( get_post_thumbnail_id( $_post->ID ), $background_image_size );

				ob_start();
				?>
				<div class="c-prev-next-nav__item-figure"
					style="background-image: url(<?php echo esc_url( $background_image_url ); ?>)"
				></div>
				<div class="c-prev-next-nav__item-label">
					<?php if ( 'next' === $key ) : ?>
						<i class="fas fa-angle-left" aria-hidden="true"></i>
						<?php esc_html_e( 'Old post', 'snow-monkey' ); ?>
					<?php else : ?>
						<?php esc_html_e( 'New post', 'snow-monkey' ); ?>
						<i class="fas fa-angle-right" aria-hidden="true"></i>
					<?php endif; ?>
				</div>
				<div class="c-prev-next-nav__item-title">
					%title
				</div>
				<?php
				$format = ob_get_clean();

				if ( ! function_exists( 'snow_monkey_prev_next_nav_title' ) ) {
					function snow_monkey_prev_next_nav_title( $nav_title ) {
						return wp_trim_words( $nav_title, class_exists( 'multibyte_patch' ) ? 30 : 60 );
					}
				}
				add_filter( 'the_title', 'snow_monkey_prev_next_nav_title' );

				if ( 'next' === $key ) {
					previous_post_link(
						'%link',
						$format
					);
				} elseif ( 'prev' === $key ) {
					next_post_link(
						'%link',
						$format
					);
				}

				remove_filter( 'the_title', 'snow_monkey_prev_next_nav_title' );
				?>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>
<?php
