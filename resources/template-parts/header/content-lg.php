<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

use Framework\Helper;

$content = Helper::get_var( $_content, get_theme_mod( 'header-content' ) );

if ( ! $content ) {
	return;
}
?>

<div class="p-header-content p-header-content--lg">
	<?php
	$vars = [
		'_content' => $content,
	];
	Helper::get_template_part( 'template-parts/header/content', null, $vars );
	?>
</div>
