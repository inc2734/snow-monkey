<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_id'              => null,
		'_entries_layout'          => 'rich-media',
		'_excerpt_length'          => null,
		'_force_sm_1col'           => false,
		'_item_thumbnail_size'     => 'medium_large',
		'_item_title_tag'          => 'h3',
		'_display_item_meta'       => 'post' === $args['_name'] ? true : false,
		'_display_item_terms'      => 'post' === $args['_name'] ? true : false,
		'_category_label_taxonomy' => null,
		'_posts_query'             => false,
		'_arrows'                  => false,
		'_dots'                    => true,
		'_interval'                => 0,
	)
);

if ( ! $args['_posts_query'] ) {
	return;
}

$queried_object                 = $args['_posts_query']->get_queried_object();
$is_term_query                  = is_a( $queried_object, '\WP_Term' ) && 1 === count( $args['_posts_query']->tax_query->queried_terms ) && 1 === count( array_values( $args['_posts_query']->tax_query->queried_terms )[0]['terms'] );
$is_hierarchical_taxonomy_query = $is_term_query && is_taxonomy_hierarchical( $queried_object->taxonomy );
?>

<div class="c-entries-carousel" data-interval="<?php echo esc_attr( $args['_interval'] * 1000 ); ?>">
	<div class="spider">
		<div class="spider__canvas">
			<?php $i = 0; ?>
			<?php while ( $args['_posts_query']->have_posts() ) : ?>
				<?php $args['_posts_query']->the_post(); ?>
				<div class="spider__slide" data-id="<?php echo esc_attr( $i ); ?>">
					<div class="c-entries-carousel__item">
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
									// If the term to be used for the category label is not specified.
								} else {
									// If the return value of `get_queried_object()` is `WP_Term`, use it.
									if ( $is_hierarchical_taxonomy_query ) {
										$_terms = array( $queried_object );
									} else {
										$_terms = $public_terms;
									}
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
								'_context'        => $args['_context'],
								'_entries_id'     => $args['_entries_id'],
								'_entries_layout' => $args['_entries_layout'],
								'_excerpt_length' => $args['_excerpt_length'],
								'_thumbnail_size' => $args['_item_thumbnail_size'],
								'_terms'          => $_terms ? array( $_terms[0] ) : array(),
								'_title_tag'      => $args['_item_title_tag'],
								'_display_meta'   => $args['_display_item_meta'],
							)
						);
						?>
					</div>
				</div>
				<?php $i ++; ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<?php if ( $args['_arrows'] ) : ?>
			<button class="spider__arrow" data-direction="prev">Prev</button>
			<button class="spider__arrow" data-direction="next">Next</button>
		<?php endif; ?>
	</div>

	<?php if ( $args['_dots'] ) : ?>
		<div class="spider__dots" data-thumbnails="false">
			<?php for ( $j = 0; $j < $i; $j ++ ) : ?>
				<button class="spider__dot" data-id="<?php echo esc_attr( $j ); ?>"><?php echo esc_html( $j ); ?></button>
			<?php endfor; ?>
		</div>
	<?php endif; ?>
</div>
