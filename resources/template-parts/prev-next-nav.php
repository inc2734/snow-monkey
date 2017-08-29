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
?>

<div class="c-prev-next-nav">
	<div class="c-prev-next-nav__item c-prev-next-nav__item--next">
		<?php if ( $next_post ) : ?>
			<?php $post = $next_post; ?>
			<?php setup_postdata( $post ); ?>
			<div class="c-prev-next-nav__item-figure"
				style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), 'medium' ) ); ?>)"
			></div>
			<a href="<?php the_permalink(); ?>">
				<div class="c-prev-next-nav__item-label">
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<?php esc_html_e( 'New post', 'snow-monkey' ); ?>
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
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</div>

	<div class="c-prev-next-nav__item c-prev-next-nav__item--prev">
		<?php if ( $prev_post ) : ?>
			<?php $post = $prev_post; ?>
			<?php setup_postdata( $post ); ?>
			<div class="c-prev-next-nav__item-figure"
				style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), 'medium' ) ); ?>)"
			></div>
			<a href="<?php the_permalink(); ?>">
				<div class="c-prev-next-nav__item-label">
					<?php esc_html_e( 'Old post', 'snow-monkey' ); ?>
					<i class="fa fa-angle-right" aria-hidden="true"></i>
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
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</div>
</div>
