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
			<div class="c-entry__meta">
				<?php Helper::get_template_part( 'template-parts/content/entry-meta' ); ?>
			</div>
		</header>
	<?php endif; ?>

	<div class="c-entry__body">
		<?php
		if ( in_array( get_option( 'mwt-share-buttons-display-position' ), [ 'top', 'both' ] ) ) {
			Helper::get_template_part( 'template-parts/content/share-buttons' );
		}
		?>

		<?php
		if ( get_option( 'mwt-google-adsense' ) ) {
			$vars = [
				'_position' => 'content-top',
			];
			Helper::get_template_part( 'template-parts/common/google-adsense', null, $vars );
		}
		?>

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

	<footer class="c-entry__footer">
		<?php
		if ( in_array( get_option( 'mwt-share-buttons-display-position' ), [ 'bottom', 'both' ] ) ) {
			Helper::get_template_part( 'template-parts/content/share-buttons' );
		}
		?>

		<?php
		if ( get_the_terms( get_the_ID(), 'post_tag' ) ) {
			Helper::get_template_part( 'template-parts/content/entry-tags' );
		}
		?>

		<?php
		if ( get_option( 'mwt-display-profile-box' ) ) {
			Helper::get_template_part( 'template-parts/common/profile-box' );
		}
		?>

		<?php
		if ( get_option( 'mwt-google-adsense' ) ) {
			$vars = [
				'_position' => 'content-bottom',
			];
			Helper::get_template_part( 'template-parts/common/google-adsense', null, $vars );
		}
		?>

		<?php
		if ( get_option( 'mwt-facebook-page-name' ) ) {
			Helper::get_template_part( 'template-parts/common/like-me-box' );
		}
		?>
	</footer>
</article>

<?php Helper::get_template_part( 'template-parts/content/prev-next-nav' ); ?>

<?php Helper::get_template_part( 'template-parts/widget-area/contents-bottom' ); ?>

<?php
if ( get_option( 'mwt-display-related-posts' ) ) {
	$related_posts_query = Helper::get_related_posts_query( get_the_ID() );
	if ( get_option( 'mwt-google-matched-content' ) || $related_posts_query->have_posts() ) {
		Helper::get_template_part( 'template-parts/content/related-posts' );
	}
}
?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
