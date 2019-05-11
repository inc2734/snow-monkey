<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$code = Helper::get_var( $_code, get_option( 'mwt-google-matched-content' ) );

$related_posts_query = Helper::get_related_posts_query( get_the_ID() );

if ( ! $code && ! $related_posts_query->have_posts() ) {
	return;
}
?>

<aside class="p-related-posts c-entry-aside">
	<h2 class="p-related-posts__title c-entry-aside__title">
		<span>
			<?php esc_html_e( 'Related posts', 'snow-monkey' ); ?>
			<?php if ( $code ) : ?>
				<?php esc_html_e( '(Including some ads)', 'snow-monkey' ); ?>
			<?php endif; ?>
		</span>
	</h2>

	<?php if ( $code ) : ?>

		<?php Helper::display_adsense_code( $code ); ?>

	<?php else : ?>

		<ul class="c-entries c-entries--<?php echo esc_attr( get_theme_mod( get_post_type() . '-entries-layout' ) ); ?>">
			<?php while ( $related_posts_query->have_posts() ) : ?>
				<?php $related_posts_query->the_post(); ?>
				<li class="c-entries__item">
					<?php Helper::get_template_part( 'template-parts/loop/entry-summary', get_post_type() ); ?>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>

	<?php endif; ?>
</aside>
