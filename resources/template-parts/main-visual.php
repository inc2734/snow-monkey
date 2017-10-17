<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$pickup_posts = get_posts( [
	'post_type'      => 'post',
	'posts_per_page' => -1,
	'tax_query'      => [
		[
			'taxonomy' => 'post_tag',
			'terms'    => [ 'pickup' ],
			'field'    => 'slug',
		],
	],
] );

if ( ! $pickup_posts ) {
	return;
}
?>

<div class="p-main-visual">
	<?php foreach ( $pickup_posts as $post ) : ?>
		<?php setup_postdata( $post ); ?>
		<?php $thumbnail_size = wp_is_mobile() ? 'large' : 'full'; ?>
		<div class="slick-slide">
			<div class="p-main-visual__figure" style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( get_post_thumbnail_id(), $thumbnail_size ) ); ?>);"></div>
			<div class="p-main-visual__item-body">
				<div class="p-main-visual__item-title">
					<?php the_title(); ?>
				</div>
				<ul class="p-main-visual__item-meta c-meta">
					<li class="c-meta__item c-meta__item--author"><?php echo get_avatar( $post->post_author ); ?><?php echo esc_html( get_the_author() ); ?></li>
					<li class="c-meta__item"><?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?></li>
				</ul>

				<a class="p-main-visual__item-more" href="<?php the_permalink(); ?>">READ MORE</a>
			</div>
		</div>
	<?php endforeach; ?>
	<?php wp_reset_postdata(); ?>
</div>
