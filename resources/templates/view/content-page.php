<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$eyecatch_position = get_theme_mod( get_post_type() . '-eyecatch' );
?>

<article <?php post_class(); ?>>
	<?php Helper::get_template_part( 'template-parts/content/entry/header/header', get_post_type() ); ?>

	<div class="c-entry__body">
		<?php
		if ( 'content-top' === $eyecatch_position && has_post_thumbnail() ) {
			Helper::get_template_part( 'template-parts/content/eyecatch' );
		}

		if ( Helper::is_active_sidebar( 'article-top-widget-area' ) ) {
			Helper::get_template_part( 'template-parts/widget-area/article-top' );
		}

		Helper::get_template_part( 'template-parts/content/entry/content/content', get_post_type() );

		if ( Helper::is_active_sidebar( 'article-bottom-widget-area' ) ) {
			Helper::get_template_part( 'template-parts/widget-area/article-bottom' );
		}
		?>
	</div>
</article>

<?php
if ( Helper::is_active_sidebar( 'contents-bottom-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/contents-bottom' );
}

if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
