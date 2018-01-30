<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<article <?php post_class(); ?>>
	<?php get_template_part( 'template-parts/front-page-widget-area-top' ); ?>

	<?php
	ob_start();
	the_content();
	$content = ob_get_clean();
	?>
	<?php if ( $content ) : ?>
		<div class="c-section">
			<div class="c-container">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/front-page-widget-area-bottom' ); ?>
</article>
