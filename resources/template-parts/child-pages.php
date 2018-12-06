<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

$pages_query = Helper\get_child_pages_query( get_the_ID() );
if ( ! $pages_query->have_posts() ) {
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
		<?php while ( $pages_query->have_posts() ) : ?>
			<?php $pages_query->the_post(); ?>
			<li class="c-entries__item">
				<?php Helper\get_template_part( 'template-parts/page-summary' ); ?>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul>
</div>
