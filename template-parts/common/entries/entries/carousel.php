<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.1.0
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
		'_item_thumbnail_size'     => 'medium_large',
		'_item_title_tag'          => 'h3',
		'_display_item_meta'       => true,
		'_display_item_terms'      => 'post' === $args['_name'] ? true : false,
		'_display_item_excerpt'    => false,
		'_category_label_taxonomy' => null,
		'_use_own_category_label'  => null,
		'_posts_query'             => false,
		'_arrows'                  => false,
		'_dots'                    => true,
		'_interval'                => 0,
		'_autoplayButton'          => false,
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
	)
);

$queried_object                 = $args['_posts_query']->get_queried_object();
$is_term_query                  = is_a( $queried_object, '\WP_Term' ) && 1 === count( $args['_posts_query']->tax_query->queried_terms ) && 1 === count( array_values( $args['_posts_query']->tax_query->queried_terms )[0]['terms'] );
$is_hierarchical_taxonomy_query = $is_term_query && is_taxonomy_hierarchical( $queried_object->taxonomy );

$classes   = array();
$classes[] = 'c-entries-carousel';
if ( $args['_entries_gap'] ) {
	$classes[] = 'c-entries-carousel--gap-' . $args['_entries_gap'];
}
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-interval="<?php echo esc_attr( $args['_interval'] * 1000 ); ?>">
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
								'_display_meta'         => $args['_display_item_meta'],
								'_display_author'       => $args['_display_item_author'],
								'_display_published'    => $args['_display_item_published'],
								'_display_modified'     => $args['_display_item_modified'],
								'_display_item_excerpt' => $args['_display_item_excerpt'],
								'_terms'                => $_terms ? array( $_terms[0] ) : array(),
								'_title_tag'            => $args['_item_title_tag'],
							)
						);
						?>
					</div>
				</div>
				<?php ++$i; ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<?php if ( $args['_arrows'] ) : ?>
			<button class="spider__arrow" data-direction="prev">Prev</button>
			<button class="spider__arrow" data-direction="next">Next</button>
		<?php endif; ?>
	</div>

	<?php if ( ( 0 < $args['_interval'] && $args['_autoplayButton'] ) || $args['_dots'] ) : ?>
		<div class="spider__dots" data-thumbnails="false">
			<?php if ( $args['_autoplayButton'] ) : ?>
				<button class="spider__stop">
					<svg
						width="12"
						height="16"
						viewBox="0 0 12 16"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
						title="<?php esc_html_e( 'Pause autoplay', 'snow-monkey' ); ?>"
					>
						<rect
							width="5"
							height="16"
							fill="currentColor"
						></rect>
						<rect
							x="7"
							width="5"
							height="16"
							fill="currentColor"
						></rect>
					</svg>
				</button>
				<button class="spider__start">
					<svg
						width="12"
						height="16"
						viewBox="0 0 12 16"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
						title="<?php esc_html_e( 'Start autoplay', 'snow-monkey' ); ?>"
					>
						<path
							d="M12 8L-2.29967e-06 16L-2.29967e-06 0L12 8Z"
							fill="currentColor"
						></path>
					</svg>
				</button>
			<?php endif; ?>

			<?php if ( $args['_dots'] ) : ?>
				<?php for ( $j = 0; $j < $i; $j++ ) : ?>
					<button class="spider__dot" data-id="<?php echo esc_attr( $j ); ?>"><?php echo esc_html( $j ); ?></button>
				<?php endfor; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
