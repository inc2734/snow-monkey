<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 */

use Framework\Helper;
?>

<?php
if ( ! is_paged() && Helper::is_active_sidebar( 'posts-page-top-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/posts-page-top' );
}
?>

<div class="c-entry">
	<?php
	if ( ! is_front_page() ) {
		Helper::get_template_part( 'template-parts/archive/entry/header/header', 'post' );
	}
	?>

	<div class="c-entry__body">
		<?php Helper::get_template_part( 'template-parts/archive/entry/content/content', 'post' ); ?>
	</div>
</div>

<?php
if ( ! is_paged() && Helper::is_active_sidebar( 'posts-page-bottom-widget-area' ) ) {
	Helper::get_template_part( 'template-parts/widget-area/posts-page-bottom' );
}
