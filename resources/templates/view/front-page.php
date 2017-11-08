<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<article <?php post_class(); ?>>
	<?php get_template_part( 'template-parts/main-visual' ); ?>

	<?php get_template_part( 'template-parts/front-page-widget-area-top' ); ?>

	<?php
	if ( get_theme_mod( 'display-static-front-page-recent-posts' ) ) {
		get_template_part( 'template-parts/recent-posts' );
	}
	?>

	<?php get_template_part( 'template-parts/front-page-widget-area-bottom' ); ?>
</article>
