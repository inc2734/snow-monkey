<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'thumbnail_size' => 'medium_large',
	]
);
?>

<div class="c-entry-summary__figure">
	<?php the_post_thumbnail( $args['_thumbnail_size'] ); ?>
</div>
