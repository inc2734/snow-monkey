<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_content' => get_theme_mod( 'header-content' ),
	)
);

if ( ! $args['_content'] || ! get_theme_mod( 'display-header-content-on-mobile' ) ) {
	return;
}
?>

<div class="p-header-content p-header-content--sm">
	<div class="c-container">
		<?php
		$vars = array(
			'_content' => $args['_content'],
		);
		Helper::get_template_part( 'template-parts/header/content', null, $vars );
		?>
	</div>
</div>
