<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.0
 */

$template_args = [
	'thumbnail_size' => Helper::get_var( $_thumbnail_size, 'medium_large' ),
];
?>

<div class="c-entry-summary__figure">
	<?php the_post_thumbnail( $template_args['thumbnail_size'] ); ?>
</div>
