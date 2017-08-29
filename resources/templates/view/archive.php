<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<ul class="c-entries">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<li class="c-entries__item">
			<?php get_template_part( 'template-parts/entry-summary' ); ?>
		</li>
	<?php endwhile; ?>
</ul>

<?php get_template_part( 'template-parts/pagination' ); ?>
