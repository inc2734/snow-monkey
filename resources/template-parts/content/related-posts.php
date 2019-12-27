<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 *
 * renamed: template-parts/related-posts.php
 */

use Inc2734\WP_Adsense;
use Framework\Helper;

$template_args = [
	'code'           => Helper::get_var( $_code, get_option( 'mwt-google-matched-content' ) ),
	'post_id'        => Helper::get_var( $_post_id, get_the_ID() ),
	'entries_layout' => Helper::get_var( $_entries_layout, get_theme_mod( 'related-posts-layout' ) ),
];

if ( ! $template_args['entries_layout'] ) {
	$template_args['entries_layout'] = get_theme_mod( get_post_type() . '-entries-layout' );
}

$query = Helper::get_related_posts_query( $template_args['post_id'] );

if ( ! $template_args['code'] && ! $query->have_posts() ) {
	return;
}
?>

<aside class="p-related-posts c-entry-aside">
	<h2 class="p-related-posts__title c-entry-aside__title">
		<span>
			<?php esc_html_e( 'Related posts', 'snow-monkey' ); ?>
			<?php if ( $template_args['code'] ) : ?>
				<?php esc_html_e( '(Including some ads)', 'snow-monkey' ); ?>
			<?php endif; ?>
		</span>
	</h2>

	<?php if ( $template_args['code'] ) : ?>

		<?php WP_Adsense\Helper::the_adsense_code( $template_args['code'] ); ?>

	<?php else : ?>

		<ul class="c-entries c-entries--<?php echo esc_attr( $template_args['entries_layout'] ); ?>">
			<?php while ( $query->have_posts() ) : ?>
				<?php $query->the_post(); ?>
				<li class="c-entries__item">
					<?php
					Helper::get_template_part(
						'template-parts/loop/entry-summary',
						get_post_type(),
						[
							'_entries_layout' => $template_args['entries_layout'],
						]
					);
					?>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>

	<?php endif; ?>
</aside>
