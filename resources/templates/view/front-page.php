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
	$wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
	?>
	<?php if ( $content ) : ?>
		<div class="c-section">
			<?php if ( 'default' === $wp_page_template || false !== strpos( $wp_page_template, 'one-column-full.php' ) ) : ?>
				<div class="c-container">
					<div class="c-entry__content">
						<?php the_content(); ?>
					</div>
				</div>
			<?php else : ?>
				<div class="c-entry__content">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/front-page-widget-area-bottom' ); ?>
</article>
