<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<?php get_template_part( 'template-parts/title-top-widget-area' ); ?>

<article <?php post_class(); ?>>
	<?php if ( 'title-on-page-header' !== get_theme_mod( 'post-eyecatch' ) ) : ?>
		<header class="c-entry__header">
			<h1 class="c-entry__title"><?php the_title(); ?></h1>
			<div class="c-entry__meta">
				<?php get_template_part( 'template-parts/entry-meta' ); ?>
			</div>
		</header>
	<?php endif; ?>

	<?php do_action( 'snow_monkey_before_entry_content' ); ?>

	<?php
	if ( in_array( get_option( 'mwt-share-buttons-display-position' ), [ 'top', 'both' ] ) ) {
		get_template_part( 'template-parts/share-buttons' );
	}
	?>

	<?php
	wpvc_get_template_part(
		'template-parts/google-adsense',
		null,
		[
			'position' => 'content-top',
		]
	);
	?>

	<?php
	if ( 'content-top' === get_theme_mod( 'post-eyecatch' ) ) {
		get_template_part( 'template-parts/eyecatch' );
	}
	?>

	<?php get_template_part( 'template-parts/article-top-widget-area' ); ?>

	<div class="c-entry__content">
		<?php
		if ( get_option( 'mwt-display-contents-outline' ) ) {
			get_template_part( 'template-parts/contents-outline' );
		}
		?>

		<?php the_content(); ?>
	</div>

	<?php get_template_part( 'template-parts/link-pages' ); ?>
	<?php get_template_part( 'template-parts/article-bottom-widget-area' ); ?>
	<?php do_action( 'snow_monkey_after_entry_content' ); ?>

	<footer class="c-entry__footer">
		<?php
		if ( in_array( get_option( 'mwt-share-buttons-display-position' ), [ 'bottom', 'both' ] ) ) {
			get_template_part( 'template-parts/share-buttons' );
		}
		?>

		<?php get_template_part( 'template-parts/entry-tags' ); ?>

		<?php
		if ( get_option( 'mwt-display-profile-box' ) ) {
			get_template_part( 'template-parts/profile-box' );
		}
		?>

		<?php
		wpvc_get_template_part(
			'template-parts/google-adsense',
			null,
			[
				'position' => 'content-bottom',
			]
		);
		?>

		<?php get_template_part( 'template-parts/like-me-box' ); ?>
	</footer>
</article>

<?php get_template_part( 'template-parts/prev-next-nav' ); ?>

<?php get_template_part( 'template-parts/contents-bottom-widget-area' ); ?>

<?php
if ( get_option( 'mwt-display-related-posts' ) ) {
	get_template_part( 'template-parts/related-posts' );
}
?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
