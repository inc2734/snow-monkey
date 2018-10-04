<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<?php get_template_part( 'template-parts/title-top-widget-area' ); ?>

<article <?php post_class(); ?>>
	<?php if ( 'title-on-page-header' !== get_theme_mod( 'page-eyecatch' ) ) : ?>
		<header class="c-entry__header">
			<h1 class="c-entry__title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>

	<?php do_action( 'snow_monkey_before_entry_content' ); ?>

	<div class="c-entry__content">
		<?php
		if ( 'content-top' === get_theme_mod( 'page-eyecatch' ) ) {
			get_template_part( 'template-parts/eyecatch' );
		}
		?>

		<?php get_template_part( 'template-parts/article-top-widget-area' ); ?>
		<?php the_content(); ?>
		<?php get_template_part( 'template-parts/link-pages' ); ?>
		<?php get_template_part( 'template-parts/article-bottom-widget-area' ); ?>
	</div>

	<?php do_action( 'snow_monkey_after_entry_content' ); ?>
</article>

<?php
if ( get_option( 'mwt-display-child-pages' ) ) {
	get_template_part( 'template-parts/child-pages' );
}
?>

<?php get_template_part( 'template-parts/contents-bottom-widget-area' ); ?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
