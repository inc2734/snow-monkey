<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$matched_content     = get_option( 'mwt-google-matched-content' );
$use_matched_content = (bool) $matched_content;
?>

<aside class="p-related-posts c-entry-aside">
	<h2 class="p-related-posts__title c-entry-aside__title">
		<span>
			<?php esc_html_e( 'Related posts', 'snow-monkey' ); ?>
			<?php if ( $use_matched_content ) : ?>
				<?php esc_html_e( '(Including some ads)', 'snow-monkey' ); ?>
			<?php endif; ?>
		</span>
	</h2>

	<?php if ( $use_matched_content ) : ?>

		<?php \Inc2734\WP_Awesome_Widgets\inc2734_wpaw_display_adsense_code( $matched_content ); ?>

	<?php else : ?>

		<ul class="c-entries c-entries--<?php echo esc_attr( get_theme_mod( 'archive-layout' ) ); ?>">
			<?php $related_posts = snow_monkey_get_related_posts( get_the_ID() ); ?>
			<?php foreach ( $related_posts as $post ) : ?>
				<?php setup_postdata( $post ); ?>
				<li class="c-entries__item">
					<?php get_template_part( 'template-parts/entry-summary' ); ?>
				</li>
			<?php endforeach; ?>
			<?php wp_reset_postdata( $post ); ?>
		</ul>

	<?php endif; ?>
</aside>
