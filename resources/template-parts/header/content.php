<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/header-content.php
 */

use Framework\Helper;

$args = wp_parse_args(
	$args,
	[
		'_content' => get_theme_mod( 'header-content' ),
	]
);

if ( ! $args['_content'] ) {
	return;
}
?>

<div class="c-header-content">
	<?php echo do_shortcode( wp_kses_post( $args['_content'] ) ); ?>
</div>
