<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;
?>
<?php Helper\get_template_part( 'template-parts/title-top-widget-area' ); ?>

<article <?php post_class(); ?>>
	<?php if ( 'title-on-page-header' !== get_theme_mod( 'post-eyecatch' ) ) : ?>
		<header class="c-entry__header">
			<h1 class="c-entry__title"><?php the_title(); ?></h1>
			<div class="c-entry__meta">
				<?php Helper\get_template_part( 'template-parts/entry-meta' ); ?>
			</div>
		</header>
	<?php endif; ?>

	<div class="c-entry__body">
		<?php
		if ( in_array( get_option( 'mwt-share-buttons-display-position' ), [ 'top', 'both' ] ) ) {
			Helper\get_template_part( 'template-parts/share-buttons' );
		}
		?>

		<?php
		Helper\get_template_part(
			'template-parts/google-adsense',
			null,
			[
				'position' => 'content-top',
			]
		);
		?>

		<?php
		if ( 'content-top' === get_theme_mod( 'post-eyecatch' ) ) {
			Helper\get_template_part( 'template-parts/eyecatch' );
		}
		?>

		<?php Helper\get_template_part( 'template-parts/article-top-widget-area' ); ?>
		<?php do_action( 'snow_monkey_before_entry_content' ); ?>

		<div class="c-entry__content p-entry-content">
			<?php
			if ( get_option( 'mwt-display-contents-outline' ) ) {
				Helper\get_template_part( 'template-parts/contents-outline' );
			}
			?>

			<?php the_content(); ?>
			<?php Helper\get_template_part( 'template-parts/link-pages' ); ?>
		</div>

		<?php do_action( 'snow_monkey_after_entry_content' ); ?>
		<?php Helper\get_template_part( 'template-parts/article-bottom-widget-area' ); ?>
	</div>

	<footer class="c-entry__footer">
		<?php
		if ( in_array( get_option( 'mwt-share-buttons-display-position' ), [ 'bottom', 'both' ] ) ) {
			Helper\get_template_part( 'template-parts/share-buttons' );
		}
		?>

		<?php Helper\get_template_part( 'template-parts/entry-tags' ); ?>

		<?php
		if ( get_option( 'mwt-display-profile-box' ) ) {
			Helper\get_template_part( 'template-parts/profile-box' );
		}
		?>

		<?php
		Helper\get_template_part(
			'template-parts/google-adsense',
			null,
			[
				'position' => 'content-bottom',
			]
		);
		?>

		<?php Helper\get_template_part( 'template-parts/like-me-box' ); ?>
	</footer>
</article>

<?php Helper\get_template_part( 'template-parts/prev-next-nav' ); ?>

<?php Helper\get_template_part( 'template-parts/contents-bottom-widget-area' ); ?>

<?php
if ( get_option( 'mwt-display-related-posts' ) ) {
	Helper\get_template_part( 'template-parts/related-posts' );
}
?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
