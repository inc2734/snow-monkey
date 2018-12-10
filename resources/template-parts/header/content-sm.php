<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\app\Helper;

if ( ! get_theme_mod( 'header-content' ) || ! get_theme_mod( 'display-header-content-on-mobile' ) ) {
	return;
}
?>

<div class="p-header-content p-header-content--sm">
	<div class="c-container">
		<?php Helper::get_template_part( 'template-parts/header/content' ); ?>
	</div>
</div>
