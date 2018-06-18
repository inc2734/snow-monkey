<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>

<article <?php post_class(); ?>>
	<?php do_action( 'snow_monkey_before_entry_content' ); ?>

	<div class="c-entry__content">
		<?php the_content(); ?>
		<?php get_template_part( 'template-parts/link-pages' ); ?>
	</div>

	<?php do_action( 'snow_monkey_after_entry_content' ); ?>
</article>
