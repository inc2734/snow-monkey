<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$tax_query = [];

$category_ids = [];
$categories = get_the_category();
if ( is_array( $categories ) ) {
	foreach ( $categories as $category ) {
		$category_ids[] = $category->term_id;
	}
}
if ( $category_ids ) {
	$tax_query[] = [
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => $category_ids,
		'operator' => 'IN',
	];
}

$tag_ids = [];
$tags = get_the_tags();
if ( is_array( $tags ) ) {
	foreach ( $tags as $tag ) {
		$tag_ids[] = $tag->term_id;
	}
}
if ( $tag_ids ) {
	$tax_query[] = [
		'taxonomy' => 'post_tag',
		'field'    => 'term_id',
		'terms'    => $tag_ids,
		'operator' => 'IN',
	];
}
if ( ! $tax_query ) {
	return;
}

$related_posts_args = [
	'post_type'      => get_post_type( $post->ID ),
	'posts_per_page' => 4,
	'orderby'        => 'rand',
	'post__not_in'   => [ $post->ID ],
	'tax_query'      => array_merge(
		[
			'relation' => 'OR',
		],
		$tax_query
	),
];
$related_posts = get_posts( $related_posts_args );

if ( ! $related_posts ) {
	return;
}
?>

<aside class="p-related-posts c-entry-aside">
	<h2 class="p-related-posts__title c-entry-aside__title"><span><?php esc_html_e( 'Related posts', 'snow-monkey' ); ?></span></h2>
	<ul class="c-entries c-entries--<?php echo esc_attr( get_theme_mod( 'archive-layout' ) ); ?>">
		<?php foreach ( $related_posts as $post ) : ?>
			<?php setup_postdata( $post ); ?>
			<li class="c-entries__item">
				<?php get_template_part( 'template-parts/entry-summary' ); ?>
			</li>
		<?php endforeach; ?>
		<?php wp_reset_postdata( $post ); ?>
	</ul>
</aside>
