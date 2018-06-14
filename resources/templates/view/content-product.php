<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<?php get_template_part( 'template-parts/title-top-widget-area' ); ?>

<article <?php post_class(); ?>>

	<?php if ( ! class_exists( 'WooCommerce' ) ) : ?>

		<header class="c-entry__header">
			<h1 class="c-entry__title"><?php the_title(); ?></h1>
		</header>

		<div class="c-entry__content">
			<?php the_content(); ?>
			<?php get_template_part( 'template-parts/link-pages' ); ?>
		</div>

	<?php else : ?>

		<div class="c-entry__content">
			<?php wc_get_template_part( 'content', 'single-product' ); ?>
		</div>

	<?php endif; ?>

</article>

<?php get_template_part( 'template-parts/contents-bottom-widget-area' ); ?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
