<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 */

use Framework\Helper;

global $wp_query;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_post_type' => get_post_type() ? get_post_type() : 'post',
	]
);

$default_entries_layout = $args['_post_type']
	? get_theme_mod( $args['_post_type'] . '-entries-layout' )
	: 'rich-media';

$default_force_sm_1col = $args['_post_type']
	? get_theme_mod( $args['_post_type'] . '-entries-layout-sm-1col' )
	: false;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout'      => $default_entries_layout,
		'_excerpt_length'      => null,
		'_force_sm_1col'       => $default_force_sm_1col,
		'_infeed_ads'          => false,
		'_item_thumbnail_size' => 'medium_large',
		'_item_title_tag'      => 'h3',
		'_items'               => false,
	]
);

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_posts_query' => false === $args['_items'] ? $wp_query : null,
	]
);

if ( ! $args['_items'] && ! $args['_posts_query'] ) {
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
	<?php if ( $args['_items'] ) : ?>

		<?php foreach ( $args['_items'] as $item ) : ?>
			<li class="c-entries__item">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary',
					$args['_post_type'],
					[
						'_entries_layout' => $args['_entries_layout'],
						'_excerpt_length' => $args['_excerpt_length'],
						'_item'           => $item,
						'_title_tag'      => $args['_item_title_tag'],
					]
				);
				?>
			</li>
		<?php endforeach; ?>

	<?php else : ?>

		<?php while ( $args['_posts_query']->have_posts() ) : ?>
			<?php $args['_posts_query']->the_post(); ?>
			<li class="c-entries__item">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary',
					$args['_post_type'],
					[
						'_entries_layout' => $args['_entries_layout'],
						'_excerpt_length' => $args['_excerpt_length'],
						'_thumbnail_size' => $args['_item_thumbnail_size'],
						'_title_tag'      => $args['_item_title_tag'],
					]
				);
				?>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

	<?php endif; ?>
</ul>
