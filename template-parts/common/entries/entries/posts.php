<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.2.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_id'              => null,
		'_entries_layout'          => 'rich-media',
		'_entries_gap'             => null,
		'_excerpt_length'          => null,
		'_force_sm_1col'           => false,
		'_infeed_ads'              => false,
		'_item_thumbnail_size'     => 'medium_large',
		'_item_title_tag'          => 'h3',
		'_display_item_meta'       => true,
		'_display_item_terms'      => 'post' === $args['_name'] ? true : false,
		'_display_item_excerpt'    => false,
		'_category_label_taxonomy' => null,
		'_use_own_category_label'  => null,
		'_posts_query'             => false,
	)
);

if ( ! $args['_posts_query'] ) {
	return;
}

$args = wp_parse_args(
	$args,
	array(
		'_display_item_author'    => $args['_display_item_meta'],
		'_display_item_published' => $args['_display_item_meta'],
		'_display_item_modified'  => false,
		'_display_item_date_icon' => false,
	)
);

$data_infeed_ads = $args['_infeed_ads'] ? 'true' : 'false';
$force_sm_1col   = $args['_force_sm_1col'] ? 'true' : 'false';

$queried_object                 = $args['_posts_query']->get_queried_object();
$is_term_query                  = is_a( $queried_object, '\WP_Term' ) && 1 === count( $args['_posts_query']->tax_query->queried_terms ) && 1 === count( array_values( $args['_posts_query']->tax_query->queried_terms )[0]['terms'] );
$is_hierarchical_taxonomy_query = $is_term_query && is_taxonomy_hierarchical( $queried_object->taxonomy );

$classes   = array();
$classes[] = 'c-entries';
if ( $args['_entries_layout'] ) {
	$classes[] = 'c-entries--' . $args['_entries_layout'];
}
if ( $args['_entries_gap'] ) {
	$classes[] = 'c-entries--gap-' . $args['_entries_gap'];
}
?>

<ul
	class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
	data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>"
	data-force-sm-1col="<?php echo esc_attr( $force_sm_1col ); ?>"
>
	<?php while ( $args['_posts_query']->have_posts() ) : ?>
		<?php $args['_posts_query']->the_post(); ?>
		<li class="c-entries__item">
			<?php
			$_terms = array();

			if ( $args['_display_item_terms'] ) {
				$public_terms = Helper::get_the_public_terms( get_the_ID() );

				// Taxonomy specified.
				if ( $args['_posts_query']->is_tax() || $args['_posts_query']->is_category() || $args['_posts_query']->is_tag() ) {
					// If the term to be used for the category label is specified.
					if ( $args['_category_label_taxonomy'] ) {
						foreach ( $public_terms as $public_term ) {
							if ( $args['_category_label_taxonomy'] === $public_term->taxonomy ) {
								$_terms = array( $public_term );
								break;
							}
						}
					} elseif ( $is_hierarchical_taxonomy_query ) {
						// If the term to be used for the category label is not specified.
						// If the return value of `get_queried_object()` is `WP_Term`, use it.
						$_use_own_category_label = is_null( $args['_use_own_category_label'] )
							? get_theme_mod( $queried_object->taxonomy . '-' . $queried_object->term_id . '-use-own-category-label' )
							: $args['_use_own_category_label'];

						$_terms = ! $_use_own_category_label
							? array( $queried_object )
							: $public_terms;
					} else {
						$_terms = $public_terms;
					}
					// Post type, etc. specified.
				} else {
					// Use the terms that the post has that have a hierarchy of terms.
					$_terms = $public_terms;
				}
			}

			Helper::get_template_part(
				'template-parts/loop/entry-summary',
				$args['_name'],
				array(
					'_context'              => $args['_context'],
					'_entries_id'           => $args['_entries_id'],
					'_entries_layout'       => $args['_entries_layout'],
					'_excerpt_length'       => $args['_excerpt_length'],
					'_thumbnail_size'       => $args['_item_thumbnail_size'],
					'_display_author'       => $args['_display_item_author'],
					'_display_published'    => $args['_display_item_published'],
					'_display_modified'     => $args['_display_item_modified'],
					'_display_date_icon'    => $args['_display_item_date_icon'],
					'_display_item_excerpt' => $args['_display_item_excerpt'],
					'_terms'                => $_terms ? array( $_terms[0] ) : array(),
					'_title_tag'            => $args['_item_title_tag'],
					'_display_meta'         => $args['_display_item_meta'],
				)
			);
			?>
		</li>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</ul>
