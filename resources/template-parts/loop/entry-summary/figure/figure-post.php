<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

use Framework\Helper;

$public_taxonomies = Helper::get_the_public_taxonomy( get_the_ID() );
$public_terms = [];

foreach ( $public_taxonomies as $public_taxonomy ) {
	$_terms = get_the_terms( get_the_ID(), $public_taxonomy->name );
	if ( ! empty( $_terms ) && is_array( $_terms ) && ! is_wp_error( $_terms ) ) {
		$public_terms = $_terms;
		break;
	}
}
?>

<div class="c-entry-summary__figure">
	<?php the_post_thumbnail( 'medium_large' ); ?>

	<?php
	if ( $public_terms ) {
		Helper::get_template_part(
			'template-parts/loop/entry-summary/term/term',
			get_post_type(),
			[
				'_terms' => [ $public_terms[0] ],
			]
		);
	}
	?>
</div>
