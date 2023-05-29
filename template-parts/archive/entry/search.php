<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_entries_layout' => 'rich-media',
		'_entries_gap'    => null,
		'_force_sm_1col'  => false,
	)
);
?>

<div class="c-entry">
	<?php Helper::get_template_part( 'template-parts/archive/entry/header/header', 'search' ); ?>

	<div class="c-entry__body">
		<?php
		Helper::get_template_part(
			'template-parts/archive/entry/content/search',
			$args['_name'],
			array(
				'_entries_layout' => $args['_entries_layout'],
				'_entries_gap'    => $args['_entries_gap'],
				'_force_sm_1col'  => $args['_force_sm_1col'],
			)
		);
		?>
	</div>
</div>
