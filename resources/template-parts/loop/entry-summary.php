<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

// When loaded by widget, $widget_layout is exist.
if ( isset( $widget_layout ) ) {
	$layout = $widget_layout;
} else {
	$layout = get_theme_mod( get_post_type() . '-entries-layout' );
}
?>
<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary">
		<div class="c-entry-summary__figure">
			<?php the_post_thumbnail( 'xlarge' ); ?>
		</div>
		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<h2 class="c-entry-summary__title">
					<?php
					if ( 'rich-media' === $layout ) {
						Helper::the_title_trimed();
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
