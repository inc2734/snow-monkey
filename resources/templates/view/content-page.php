<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$eyecatch_position = get_theme_mod( get_post_type() . '-eyecatch' );
?>
<?php Helper::get_template_part( 'template-parts/widget-area/title-top' ); ?>

<article <?php post_class(); ?>>
	<?php if ( 'title-on-page-header' !== $eyecatch_position ) : ?>
		<header class="c-entry__header">
			<h1 class="c-entry__title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>

	<div class="c-entry__body">
		<?php
		if ( 'content-top' === $eyecatch_position && has_post_thumbnail() ) {
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

<?php Helper::get_template_part( 'template-parts/widget-area/contents-bottom' ); ?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
