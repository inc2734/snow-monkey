<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary">
		<div class="c-entry-summary__figure">
			<span style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), 'medium' ) ); ?>)"></span>
			<?php
			$terms = get_the_terms( get_the_ID(), 'category' );
			if ( is_array( $terms ) ) {
				foreach ( $terms as $term ) {
					printf(
						'<span class="c-entry-summary__term">%1$s</span>',
						esc_html( $term->name )
					);
					break;
				}
			}
			?>
		</div>
		<header class="c-entry-summary__header">
			<h2 class="c-entry-summary__title">
				<?php
				ob_start();
				the_title();
				$title = wp_trim_words( ob_get_clean(), class_exists( 'multibyte_patch' ) ? 40 : 80 );
				echo esc_html( $title );
				?>
			</h2>
		</header>
		<div class="c-entry-summary__content">
			<?php the_excerpt(); ?>
		</div>
		<div class="c-entry-summary__meta">
			<ul class="c-meta">
				<li class="c-meta__item c-meta__item--author"><?php echo get_avatar( $post->post_author ); ?><?php echo esc_html( get_the_author() ); ?></li>
				<li class="c-meta__item"><?php the_time( get_option( 'date_format' ) ); ?></li>
			</ul>
		</div>
	</section>
</a>
