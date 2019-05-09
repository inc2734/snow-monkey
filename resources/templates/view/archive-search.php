<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$post_type = filter_input( INPUT_GET, 'post_type' );
$post_type = $post_type ? $post_type : 'post';

$entries_layout = get_theme_mod( $post_type . '-entries-layout' );
$entries_layout = false !== $entries_layout ? $entries_layout : get_theme_mod( 'post-entries-layout' );
?>
<div class="c-entry">
	<header class="c-entry__header">
		<h1 class="c-entry__title"><?php echo wp_kses_post( Helper::get_page_title_from_breadcrumbs() ); ?></h1>
	</header>

	<div class="c-entry__body">
		<div class="c-entry__content p-entry-content">
			<div class="p-archive">
				<ul class="c-entries c-entries--<?php echo esc_attr( $entries_layout ); ?>">
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<li class="c-entries__item">
							<?php Helper::get_template_part( 'template-parts/loop/entry-summary', $post_type ); ?>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>

		<?php
		if ( ! empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages > 2 ) {
			Helper::get_template_part( 'template-parts/archive/pagination' );
		}
		?>
	</div>
</div>
