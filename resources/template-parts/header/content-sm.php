<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

$template_args = [
	'content' => Helper::get_var( $args['_content'], get_theme_mod( 'header-content' ) ),
];

if ( ! $template_args['content'] || ! get_theme_mod( 'display-header-content-on-mobile' ) ) {
	return;
}
?>

<div class="p-header-content p-header-content--sm">
	<div class="c-container">
		<?php
		$vars = [
			'_content' => $template_args['content'],
		];
		Helper::get_template_part( 'template-parts/header/content', null, $vars );
		?>
	</div>
</div>
