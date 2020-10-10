<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 *
 * renamed: template-parts/related-posts.php
 */

use Inc2734\WP_Adsense;
use Framework\Helper;

$_post_type = get_post_type();

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title'          => __( 'Related posts', 'snow-monkey' ),
		'_code'           => get_option( 'mwt-google-matched-content' ),
		'_post_id'        => get_the_ID(),
		'_entries_layout' => get_theme_mod( 'related-posts-layout' ),
	]
);

if ( ! $args['_entries_layout'] ) {
	$args['_entries_layout'] = get_theme_mod( $_post_type . '-entries-layout' );
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

		<?php
		Helper::get_template_part(
			'template-parts/common/entries',
			$_post_type,
			[
				'_posts_query'    => $query,
				'_post_type'      => $_post_type,
				'_entries_layout' => $args['_entries_layout'],
				'_infeed_ads'     => false,
				'_force_sm_1col'  => false,
			]
		);
		?>

	<?php endif; ?>
</aside>
