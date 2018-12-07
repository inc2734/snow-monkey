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
				<?php the_post_thumbnail( 'xlarge' ); ?>
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
