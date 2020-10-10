<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 *
 * renamed: template-parts/child-pages.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title'     => __( 'Child pages', 'snow-monkey' ),
		'_parent_id' => get_the_ID(),
	]
);

$child_pages_query = Helper::get_child_pages_query( $args['_parent_id'] );

if ( ! $child_pages_query->have_posts() ) {
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
		'template-parts/common/entries',
		'page',
		[
			'_posts_query'    => $child_pages_query,
			'_post_type'      => 'page',
			'_entries_layout' => 'rich-media',
			'_infeed_ads'     => false,
			'_force_sm_1col'  => false,
		]
	);
	?>
</div>
