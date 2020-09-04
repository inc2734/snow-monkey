<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.6
 *
 * renamed: template-parts/related-posts.php
 */

use Inc2734\WP_Adsense;
use Framework\Helper;

$args = wp_parse_args(
	$args,
	[
		'_title'          => __( 'Related posts', 'snow-monkey' ),
		'_code'           => get_option( 'mwt-google-matched-content' ),
		'_post_id'        => get_the_ID(),
		'_entries_layout' => get_theme_mod( 'related-posts-layout' ),
	]
);

if ( ! $args['_entries_layout'] ) {
	$args['_entries_layout'] = get_theme_mod( get_post_type() . '-entries-layout' );
}

$query = Helper::get_related_posts_query( $args['_post_id'] );

if ( ! $args['_code'] && ! $query->have_posts() ) {
	return;
}
?>

<aside class="p-related-posts c-entry-aside">
	<?php if ( $args['_title'] ) : ?>
		<h2 class="p-related-posts__title c-entry-aside__title">
			<span>
				<?php echo esc_html( $args['_title'] ); ?>
				<?php if ( $args['_code'] ) : ?>
					<?php esc_html_e( '(Including some ads)', 'snow-monkey' ); ?>
				<?php endif; ?>
			</span>
		</h2>
	<?php endif; ?>

	<?php if ( $args['_code'] ) : ?>

		<?php WP_Adsense\Helper::the_adsense_code( $args['_code'] ); ?>

	<?php else : ?>

		<ul class="c-entries c-entries--<?php echo esc_attr( $args['_entries_layout'] ); ?>">
			<?php while ( $query->have_posts() ) : ?>
				<?php $query->the_post(); ?>
				<li class="c-entries__item">
					<?php
					Helper::get_template_part(
						'template-parts/loop/entry-summary',
						get_post_type(),
						[
							'_entries_layout' => $args['_entries_layout'],
						]
					);
					?>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>

	<?php endif; ?>
</aside>
