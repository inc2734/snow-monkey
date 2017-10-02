<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
	<section class="c-page-summary">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<div class="c-page-summary__figure">
					<?php
					$background_image_size = 'medium';
					if ( ! wp_is_mobile() ) {
						$background_image_size = 'large';
					}
					$background_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), $background_image_size );
					?>
					<span style="background-image: url(<?php echo esc_url( $background_image_url ); ?>)"></span>
				</div>
			</a>
		<?php endif; ?>

		<header class="c-page-summary__header">
			<h2 class="c-page-summary__title">
				<?php the_title(); ?>
			</h2>
		</header>
		<div class="c-page-summary__content">
			<?php the_excerpt(); ?>
		</div>
		<div class="c-page-summary__action">
			<a class="c-page-summary__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'More', 'snow-monkey' ); ?></a>
		</div>
	</section>
</a>
