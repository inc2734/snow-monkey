<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 16.0.1
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout'      => 'rich-media',
		'_excerpt_length'      => null,
		'_force_sm_1col'       => false,
		'_infeed_ads'          => false,
		'_item_thumbnail_size' => 'medium_large',
		'_item_title_tag'      => 'h3',
		'_display_item_meta'   => 'post' === $args['_name'] ? true : false,
		'_display_item_terms'  => 'post' === $args['_name'] ? true : false,
		'_posts_query'         => false,
	]
);

if ( ! $args['_posts_query'] ) {
	return;
}

$data_infeed_ads = $args['_infeed_ads'] ? 'true' : 'false';
$force_sm_1col   = $args['_force_sm_1col'] ? 'true' : 'false';
?>

<ul
	class="c-entries c-entries--<?php echo esc_attr( $args['_entries_layout'] ); ?>"
	data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>"
	data-force-sm-1col="<?php echo esc_attr( $force_sm_1col ); ?>"
>
	<?php while ( $args['_posts_query']->have_posts() ) : ?>
		<?php $args['_posts_query']->the_post(); ?>
		<li class="c-entries__item">
			<?php
			$_terms = [];
			if ( $args['_display_item_terms'] ) {
				$_terms              = Helper::get_the_public_terms( get_the_ID() );
				$_hierarchical_terms = array_filter(
					$_terms,
					function( $_term ) {
						return get_taxonomy( $_term->taxonomy )->hierarchical;
					}
				);
				if ( $args['_posts_query']->is_tax() || $args['_posts_query']->is_category() || $args['_posts_query']->is_tag() ) {
					$tax_query = $args['_posts_query']->get( 'tax_query' );
					$term      = $tax_query
						? get_term( $tax_query[0]['terms'][0], $tax_query[0]['taxonomy'] )
						: $args['_posts_query']->get_queried_object();

					$is_term             = ! is_wp_error( $term ) && ! is_null( $term );
					$is_the_public_therm = false;
					foreach ( $_hierarchical_terms as $_term ) {
						if ( $term->term_taxonomy_id === $_term->term_taxonomy_id ) {
							$is_the_public_therm = true;
							break;
						}
					}

					$_terms = $is_term && $is_the_public_therm ? [ $term ] : $_terms;
				}
			}

			Helper::get_template_part(
				'template-parts/loop/entry-summary',
				$args['_name'],
				[
					'_context'        => $args['_context'],
					'_entries_layout' => $args['_entries_layout'],
					'_excerpt_length' => $args['_excerpt_length'],
					'_thumbnail_size' => $args['_item_thumbnail_size'],
					'_terms'          => $_terms ? [ $_terms[0] ] : [],
					'_title_tag'      => $args['_item_title_tag'],
					'_display_meta'   => $args['_display_item_meta'],
				]
			);
			?>
		</li>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</ul>
