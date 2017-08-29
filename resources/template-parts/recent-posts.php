<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$recent_posts_query = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => 12,
] );

if ( ! $recent_posts_query->found_posts ) {
	return;
}
?>

<section class="p-recent-posts c-section">
	<div class="c-container">
		<h2 class="p-recent-posts__title c-section__title"><?php esc_html_e( 'Recent Posts', 'snow-monkey' ); ?></h2>
		<ul class="p-recent-posts__list c-entries">
			<?php while ( $recent_posts_query->have_posts() ) : ?>
				<?php $recent_posts_query->the_post(); ?>
				<li class="c-entries__item">
					<?php get_template_part( 'template-parts/entry-summary' ); ?>
				</li>
			<?php endwhile; ?>
		</ul>

		<?php if ( $recent_posts_query->found_posts - $recent_posts_query->get( 'posts_per_page' ) ) : ?>
			<div class="u-text-center">
				<?php
				if ( get_option( 'permalink_structure' ) ) {
					$paged_link = untrailingslashit( get_post_type_archive_link( 'post' ) ) . '/page/2/';
				} else {
					$paged_link = get_permalink( get_option( 'page_for_posts' ) ) . '&paged=2';
				}
				?>
				<a class="p-recent-posts__more-btn c-btn" href="<?php echo esc_url( $paged_link ); ?>">MORE</a>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php wp_reset_postdata(); ?>
