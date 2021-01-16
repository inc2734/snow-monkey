<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[]
);
?>

<header class="c-entry__header">
	<?php
	if ( Helper::is_active_sidebar( 'title-top-widget-area' ) ) {
		Helper::get_template_part(
			'template-parts/widget-area/title-top',
			$args['_name']
		);
	}
	?>

	<h1 class="c-entry__title"><?php the_title(); ?></h1>
</header>
