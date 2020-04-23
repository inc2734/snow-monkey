<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.0
 */

use Framework\Helper;

$eyecatch_position = 'post' === get_post_type() ? get_theme_mod( 'archive-eyecatch' ) : false;
?>

<?php
if ( Helper::is_active_sidebar( 'archive-top-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/archive-top' );
}
?>

<div class="c-entry">
	<?php
	if ( 'title-on-page-header' !== $eyecatch_position ) {
		Helper::get_template_part( 'template-parts/archive/entry/header/header', 'post' );
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( 'content-top' === $eyecatch_position ) {
			Helper::get_template_part( 'template-parts/archive/eyecatch' );
		}
		?>

		<?php if ( ! is_paged() && term_description() ) : ?>
			<div class="p-term-description p-entry-content">
				<?php echo wp_kses_post( term_description() ); ?>
			</div>
		<?php endif; ?>

		<?php Helper::get_template_part( 'template-parts/archive/entry/content/content', 'post' ); ?>
	</div>
</div>
