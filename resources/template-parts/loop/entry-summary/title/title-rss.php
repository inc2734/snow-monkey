<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.6.0
 */

use Framework\Helper;

$template_args = [
	'item' => Helper::get_var( $_item, false ),
];

if ( ! $template_args['item'] || ! is_a( $template_args['item'], 'SimplePie_Item' ) ) {
	return;
}

$layout = get_theme_mod( 'post-entries-layout' );
$_title = $template_args['item']->get_title();
?>

<h2 class="c-entry-summary__title">
	<?php
	if ( 'rich-media' !== $layout ) {
		echo esc_html( $_title );
	} else {
		Helper::the_title_trimed( $_title );
	}
	?>
</h2>
