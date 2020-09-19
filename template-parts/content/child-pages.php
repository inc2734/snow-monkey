<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
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

	<ul class="c-entries c-entries--rich-media">
		<?php while ( $child_pages_query->have_posts() ) : ?>
			<?php $child_pages_query->the_post(); ?>
			<li class="c-entries__item">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary',
					'page',
					[
						'_entries_layout' => 'rich-media',
					]
				);
				?>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul>
</div>
