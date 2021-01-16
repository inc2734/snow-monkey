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
	[
		'_thumbnail_size' => 'medium_large',
	]
);

$public_terms = Helper::get_the_public_terms( get_the_ID() );
?>

<div class="c-entry-summary__figure">
	<?php the_post_thumbnail( $args['_thumbnail_size'] ); ?>

	<?php
	if ( $public_terms ) {
		Helper::get_template_part(
			'template-parts/loop/entry-summary/term/term',
			get_post_type(),
			[
				'_context' => $args['_context'],
				'_terms'   => [ $public_terms[0] ],
			]
		);
	}
	?>
</div>
