<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$terms = get_the_terms( get_the_ID(), 'category' );
if ( ! is_wp_error( $terms ) ) {
	$term  = $terms[0];
}

// When loaded by widget, $widget_layout is exist.
if ( isset( $widget_layout ) ) {
	$layout = $widget_layout;
} else {
	$layout = get_theme_mod( 'archive-layout' );
}
?>
<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--category-<?php echo esc_attr( $term->term_id ); ?>">
		<div class="c-entry-summary__figure">
			<?php
			$background_image_size = 'medium';
			if ( ! wp_is_mobile() ) {
				$background_image_size = 'large';
			}
			$background_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), $background_image_size );
			?>
			<span style="background-image: url(<?php echo esc_url( $background_image_url ); ?>)"></span>
			<?php if ( ! empty( $term ) ) : ?>
				<span class="c-entry-summary__term"><?php echo esc_html( $term->name ); ?></span>
			<?php endif; ?>
		</div>
		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<h2 class="c-entry-summary__title">
					<?php
					if ( 'rich-media' === $layout ) {
						$num_words = apply_filters( 'snow_monkey_entry_summary_title_num_words', class_exists( 'multibyte_patch' ) ? 40 : 80 );
						if ( $num_words ) {
							ob_start();
							the_title();
							$title = wp_trim_words( ob_get_clean(), $num_words );
							echo esc_html( $title );
						} else {
							the_title();
						}
					} else {
						the_title();
					}
					?>
				</h2>
			</header>
			<div class="c-entry-summary__content">
				<?php the_excerpt(); ?>
			</div>
			<div class="c-entry-summary__meta">
				<ul class="c-meta">
					<li class="c-meta__item c-meta__item--author">
						<?php echo get_avatar( $post->post_author ); ?><?php echo esc_html( get_the_author() ); ?>
					</li>
					<li class="c-meta__item">
						<?php the_time( get_option( 'date_format' ) ); ?>
					</li>
				</ul>
			</div>
		</div>
	</section>
</a>
