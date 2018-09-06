<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$prev_post = get_previous_post();
$next_post = get_next_post();

if ( ! $prev_post && ! $next_post ) {
	return;
}

$prev_next_posts = [
	'next' => $prev_post,
	'prev' => $next_post,
];
?>

<div class="c-prev-next-nav">
	<?php foreach ( $prev_next_posts as $key => $post ) : ?>
		<div class="c-prev-next-nav__item c-prev-next-nav__item--<?php echo esc_attr( $key ); ?>">
			<?php if ( $post ) : ?>
				<?php
				setup_postdata( $post );

				$background_image_size = 'medium';
				if ( ! wp_is_mobile() ) {
					$background_image_size = 'large';
				}
				$background_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), $background_image_size );
				?>
				<a href="<?php the_permalink(); ?>">
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
						<?php
						ob_start();
						the_title();
						$title = wp_trim_words( ob_get_clean(), class_exists( 'multibyte_patch' ) ? 30 : 60 );
						echo esc_html( $title );
						?>
					</div>
				</a>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
	<?php wp_reset_postdata(); ?>
</div>
