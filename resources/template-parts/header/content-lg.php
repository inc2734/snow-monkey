<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

if ( ! get_theme_mod( 'header-content' ) ) {
	return;
}
?>

<div class="p-header-content p-header-content--lg">
	<?php Helper\get_template_part( 'template-parts/header/content' ); ?>
</div>
