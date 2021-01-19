<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'thumbnail_size' => 'medium_large',
		'_terms'         => [],
	]
);
?>

<div class="c-entry-summary__figure">
	<?php the_post_thumbnail( $args['_thumbnail_size'] ); ?>

	<?php
	if ( $args['_terms'] ) {
		Helper::get_template_part(
			'template-parts/loop/entry-summary/term/term',
			$args['_name'],
			[
				'_context' => $args['_context'],
				'_terms'   => $args['_terms'],
			]
		);
	}
	?>
</div>
