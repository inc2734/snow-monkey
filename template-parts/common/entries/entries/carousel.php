<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
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
		'_item_thumbnail_size' => 'medium_large',
		'_item_title_tag'      => 'h3',
		'_display_item_meta'   => 'post' === $args['_name'] ? true : false,
		'_display_item_terms'  => 'post' === $args['_name'] ? true : false,
		'_posts_query'         => false,
		'_arrows'              => false,
		'_dots'                => true,
		'_interval'            => 0,
	]
);

if ( ! $args['_posts_query'] ) {
	return;
}
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
						$_terms = $args['_display_item_terms'] ? Helper::get_the_public_terms( get_the_ID() ) : [];

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
