<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$pages = get_children( [
	'post_parent'    => get_the_ID(),
	'post_type'      => 'page',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
] );

if ( ! $pages ) {
	return;
}
?>

<div class="p-child-pages c-entry-aside">
	<h2 class="p-child-pages__title c-entry-aside__title"><span><?php esc_html_e( 'Child pages', 'snow-monkey' ); ?></span></h2>
	<ul class="c-entries c-entries--rich-media">
		<?php foreach ( $pages as $post ) : ?>
			<?php setup_postdata( $post ); ?>
			<li class="c-entries__item">
				<?php get_template_part( 'template-parts/page-summary' ); ?>
			</li>
		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>
	</ul>
</div>
