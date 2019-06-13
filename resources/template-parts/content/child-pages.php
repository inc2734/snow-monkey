<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 *
 * renamed: template-parts/child-pages.php
 */

use Framework\Helper;

$template_args['parent_id'] = Helper::get_var( $_parent_id, get_the_ID() );
$template_args['query']     = Helper::get_child_pages_query( $template_args['parent_id'] );

if ( ! $template_args['query']->have_posts() ) {
	return;
}
?>

<div class="p-child-pages c-entry-aside">
	<h2 class="p-child-pages__title c-entry-aside__title">
		<span>
			<?php
			$child_pages_title = __( 'Child pages', 'snow-monkey' );
			$child_pages_title = apply_filters( 'snow_monkey_child_pages_title', $child_pages_title );
			echo esc_html( $child_pages_title );
			?>
		</span>
	</h2>
	<ul class="c-entries c-entries--rich-media">
		<?php while ( $template_args['query']->have_posts() ) : ?>
			<?php $template_args['query']->the_post(); ?>
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
