<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 *
 * renamed: template-parts/related-posts.php
 */

use Inc2734\WP_Adsense;
use Framework\Helper;

$_post_type             = get_post_type() ? get_post_type() : 'post';
$default_entries_layout = get_theme_mod( 'related-posts-layout' )
	? get_theme_mod( 'related-posts-layout' )
	: get_theme_mod( $_post_type . '-entries-layout' );

$default_entries_gap = get_theme_mod( 'related-posts-gap' )
	? get_theme_mod( 'related-posts-gap' )
	: get_theme_mod( $_post_type . '-entries-gap' );

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_code'           => null,
		'_context'        => 'snow-monkey/related-posts',
		'_entries_layout' => $default_entries_layout,
		'_entries_gap'    => $default_entries_gap,
		'_item_title_tag' => 'h3',
		'_post_id'        => get_the_ID(),
		'_posts_query'    => null,
		'_title'          => __( 'Related posts', 'snow-monkey' ),
	)
);

$query = $args['_posts_query']
	? $args['_posts_query']
	: Helper::get_related_posts_query( $args['_post_id'] );

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
			'template-parts/common/entries/entries',
			$args['_name'],
			array(
				'_context'        => $args['_context'],
				'_entries_layout' => $args['_entries_layout'],
				'_entries_gap'    => $args['_entries_gap'],
				'_force_sm_1col'  => false,
				'_infeed_ads'     => false,
				'_item_title_tag' => $args['_item_title_tag'],
				'_posts_query'    => $query,
			)
		);
		?>

	<?php endif; ?>
</aside>
