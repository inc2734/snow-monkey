<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 *
 * renamed: template-parts/child-pages.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_context'             => 'snow-monkey/child-pages',
		'_parent_id'           => get_the_ID(),
		'_title'               => __( 'Child pages', 'snow-monkey' ),
		'_entries_layout'      => 'rich-media',
		'_force_sm_1col'       => false,
		'_item_thumbnail_size' => 'medium_large',
		'_item_title_tag'      => 'h3',
		'_arrows'              => false,
		'_dots'                => true,
		'_interval'            => 0,
	]
);

$query = Helper::get_child_pages_query( $args['_parent_id'] );
if ( ! $query->have_posts() ) {
	return;
}
?>

<div class="p-child-pages c-entry-aside">
	<?php if ( $args['_title'] ) : ?>
		<h2 class="p-child-pages__title c-entry-aside__title">
			<span>
				<?php
				$child_pages_title = apply_filters( 'snow_monkey_child_pages_title', $args['_title'] );
				echo esc_html( $child_pages_title );
				?>
			</span>
		</h2>
	<?php endif; ?>

	<?php
	Helper::get_template_part(
		'template-parts/common/entries/entries',
		'page',
		[
			'_context'             => $args['_context'],
			'_entries_layout'      => $args['_entries_layout'],
			'_force_sm_1col'       => $args['_force_sm_1col'],
			'_infeed_ads'          => false,
			'_item_thumbnail_size' => $args['_item_thumbnail_size'],
			'_item_title_tag'      => $args['_item_title_tag'],
			'_posts_query'         => $query,
			'_arrows'              => $args['_arrows'],
			'_dots'                => $args['_dots'],
			'_interval'            => $args['_interval'],
		]
	);
	?>
</div>
