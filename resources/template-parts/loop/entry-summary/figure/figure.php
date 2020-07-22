<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

$template_args = [
	'thumbnail_size' => Helper::get_var( $args['_thumbnail_size'], 'medium_large' ),
];
?>

<div class="c-entry-summary__figure">
	<?php the_post_thumbnail( $template_args['thumbnail_size'] ); ?>
</div>
