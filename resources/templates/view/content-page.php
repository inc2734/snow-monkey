<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\App\Helper;
?>
<?php Helper::get_template_part( 'template-parts/widget-area/title-top' ); ?>

<article <?php post_class(); ?>>
	<?php if ( 'title-on-page-header' !== get_theme_mod( 'page-eyecatch' ) ) : ?>
		<header class="c-entry__header">
			<h1 class="c-entry__title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>

	<div class="c-entry__body">
		<?php
		if ( 'content-top' === get_theme_mod( 'page-eyecatch' ) ) {
			Helper::get_template_part( 'template-parts/content/eyecatch' );
		}
		?>

		<?php Helper::get_template_part( 'template-parts/widget-area/article-top' ); ?>
		<?php do_action( 'snow_monkey_before_entry_content' ); ?>

		<div class="c-entry__content p-entry-content">
			<?php the_content(); ?>
			<?php Helper::get_template_part( 'template-parts/content/link-pages' ); ?>
		</div>

		<?php do_action( 'snow_monkey_after_entry_content' ); ?>
		<?php Helper::get_template_part( 'template-parts/widget-area/article-bottom' ); ?>
	</div>
</article>

<?php
if ( get_option( 'mwt-display-child-pages' ) ) {
	Helper::get_template_part( 'template-parts/content/child-pages' );
}
?>

<?php Helper::get_template_part( 'template-parts/widget-area/contents-bottom' ); ?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
