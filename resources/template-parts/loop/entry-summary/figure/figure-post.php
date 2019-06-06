<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.2.2
 */

use Framework\Helper;

$taxonomies = get_object_taxonomies( get_post_type(), 'object' );
foreach ( $taxonomies as $taxonomy ) {
	if ( ! $taxonomy->public ) {
		continue;
	}

	$terms = get_the_terms( get_the_ID(), $taxonomy->name );
	$term  = $terms && is_array( $terms ) && ! is_wp_error( $terms ) ? $terms[0] : null;
	break;
}
?>

<div class="c-entry-summary__figure">
	<?php the_post_thumbnail( 'xlarge' ); ?>

	<?php
	if ( ! empty( $term ) ) {
		Helper::get_template_part(
			'template-parts/loop/entry-summary/term/term',
			get_post_type(),
			[
				'_terms' => [ $term ],
			]
		);
	}
	?>
</div>
