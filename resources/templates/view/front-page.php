<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<article <?php post_class(); ?>>
	<?php get_template_part( 'template-parts/main-visual' ); ?>

	<?php if ( get_the_content() ) : ?>
		<div class="p-front-page-content">
			<div class="c-entry">
				<div class="c-entry__content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/front-page-widget-area-top' ); ?>

	<?php get_template_part( 'template-parts/recent-posts' ); ?>

	<?php get_template_part( 'template-parts/front-page-widget-area-bottom' ); ?>
</article>
