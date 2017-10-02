<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<article <?php post_class(); ?>>
	<header class="c-entry__header">
		<h1 class="c-entry__title"><?php the_title(); ?></h1>
	</header>

	<div class="c-entry__content">
		<?php the_content(); ?>
		<?php get_template_part( 'template-parts/link-pages' ); ?>

		<?php
		$pages = get_children( [
			'post_parent'    => get_the_ID(),
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'post_status'    => 'publish'
		] );
		?>
		<?php if ( $pages ) : ?>
			<ul class="c-entries">
				<?php foreach ( $pages as $post ) : ?>
					<?php setup_postdata( $post ); ?>
					<li class="c-entries__item">
						<?php get_template_part( 'template-parts/page-summary' ); ?>
					</li>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		<?php endif; ?>
	</div>
</article>

<?php get_template_part( 'template-parts/contents-bottom-widget-area' ); ?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
