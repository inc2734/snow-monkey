<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.1
 */

use Framework\Helper;

$eyecatch_position = get_theme_mod( 'archive-eyecatch' );
?>

<?php
if ( ! is_paged() && Helper::is_active_sidebar( 'posts-page-top-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/posts-page-top' );
}
?>

<div class="c-entry">
	<?php
	if ( ! is_front_page() && get_theme_mod( 'posts-page-display-title' ) && 'title-on-page-header' !== $eyecatch_position ) {
		Helper::get_template_part( 'template-parts/archive/entry/header/header', 'post' );
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( 'content-top' === $eyecatch_position ) {
			Helper::get_template_part( 'template-parts/archive/eyecatch' );
		}

		Helper::get_template_part(
			'template-parts/archive/entry/content/content',
			'post',
			[
				'_entries_layout' => get_theme_mod( 'post-entries-layout' ),
				'_force_sm_1col'  => get_theme_mod( 'post-entries-layout-sm-1col' ),
			]
		);
		?>
	</div>
</div>

<?php
if ( ! is_paged() && Helper::is_active_sidebar( 'posts-page-bottom-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/posts-page-bottom' );
}
