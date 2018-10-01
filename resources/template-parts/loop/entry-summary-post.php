<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$terms = get_the_terms( get_the_ID(), 'category' );
$_term = null;
if ( $terms && ! is_wp_error( $terms ) ) {
	$_term  = $terms[0];
}

// When loaded by widget, $widget_layout is exist.
if ( isset( $widget_layout ) ) {
	$layout = $widget_layout;
} else {
	$layout = get_theme_mod( 'archive-layout' );
}
?>
<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--category-<?php echo esc_attr( $_term ? $_term->term_id : 0 ); ?>">
		<div class="c-entry-summary__figure">
			<?php
			$background_image_size = ! wp_is_mobile() || get_option( 'mwt-google-infeed-ads' ) ? 'large' : 'medium';
			the_post_thumbnail( $background_image_size );
			?>
			<?php if ( ! empty( $_term ) ) : ?>
				<span class="c-entry-summary__term"><?php echo esc_html( $_term->name ); ?></span>
			<?php endif; ?>
		</div>
		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<h2 class="c-entry-summary__title">
					<?php
					if ( 'rich-media' === $layout ) {
						snow_monkey_the_title_trimed();
					} else {
						the_title();
					}
					?>
				</h2>
			</header>
			<div class="c-entry-summary__content">
				<?php
				ob_start();
				the_excerpt();
				echo esc_html( wp_strip_all_tags( ob_get_clean() ) );
				?>
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
