<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$tax_query = array();

$category_ids = array();
$categories = get_the_category();
if ( is_array( $categories ) ) {
	foreach ( $categories as $category ) {
		$category_ids[] = $category->term_id;
	}
}
if ( $category_ids ) {
	$tax_query[] = array(
		'taxonomy' => 'category',
		'field'    => 'id',
		'terms'    => $category_ids,
		'operator' => 'OR',
	);
}

$tag_ids = array();
$tags = get_the_tags();
if ( is_array( $tags ) ) {
	foreach ( $tags as $tag ) {
		$tag_ids[] = $tag->term_id;
	}
}
if ( $tag_ids ) {
	$tax_query[] = array(
		'taxonomy' => 'post_tag',
		'field'    => 'id',
		'terms'    => $tag_ids,
		'operator' => 'OR',
	);
}
if ( ! $tax_query ) {
	return;
}

$related_posts_args = array(
	'post_type'      => get_post_type( $post->ID ),
	'posts_per_page' => 4,
	'orderby'        => 'rand',
	'post__not_in'   => array( $post->ID ),
	'tax_query'      => array_merge(
		array(
			'relation' => 'OR',
		),
		$tax_query
	),
);
$related_posts = get_posts( $related_posts_args );

if ( ! $related_posts ) {
	return;
}
?>
<aside class="p-related-posts c-entry-aside">
	<h2 class="p-related-posts__title c-entry-aside__title"><span><?php esc_html_e( 'Related posts', 'snow-monkey' ); ?></span></h2>
	<ul class="c-entries">
		<?php foreach ( $related_posts as $post ) : ?>
			<?php setup_postdata( $post ); ?>
			<li class="c-entries__item">
				<?php get_template_part( 'template-parts/entry-summary' ); ?>
			</li>
		<?php endforeach; ?>
		<?php wp_reset_postdata( $post ); ?>
	</ul>
</aside>
