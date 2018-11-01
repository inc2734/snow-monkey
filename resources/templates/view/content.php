<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<article <?php post_class(); ?>>
	<header class="c-entry__header">
		<h1 class="c-entry__title"><?php the_title(); ?></h1>
	</header>

	<?php do_action( 'snow_monkey_before_entry_content' ); ?>

	<div class="c-entry__content p-entry-content">
		<?php the_content(); ?>
	</div>

	<?php get_template_part( 'template-parts/link-pages' ); ?>
	<?php do_action( 'snow_monkey_after_entry_content' ); ?>
</article>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
