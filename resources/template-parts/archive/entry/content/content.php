<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

use Framework\Helper;
?>

<div class="c-entry__content p-entry-content">
	<div class="p-archive">
		<ul class="c-entries c-entries--<?php echo esc_attr( get_theme_mod( get_post_type() . '-entries-layout' ) ); ?>">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<li class="c-entries__item">
					<?php Helper::get_template_part( 'template-parts/loop/entry-summary', get_post_type() ); ?>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>

	<?php
	if ( ! empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages >= 2 ) {
		Helper::get_template_part( 'template-parts/archive/pagination' );
	}
	?>
</div>
