<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

$template_args = [
	'title_tag' => Helper::get_var( $args['_title_tag'], 'h2' ),
	'item'      => Helper::get_var( $args['_item'], false ),
];

if ( ! $template_args['item'] || ! is_a( $template_args['item'], 'SimplePie_Item' ) ) {
	return;
}

$layout    = get_theme_mod( 'post-entries-layout' );
$_title    = $template_args['item']->get_title();
$title_tag = $template_args['title_tag'];
?>

<<?php echo esc_html( $title_tag ); ?> class="c-entry-summary__title">
	<?php
	if ( 'rich-media' !== $layout ) {
		echo esc_html( $_title );
	} else {
		Helper::the_title_trimed( $_title );
	}
	?>
</<?php echo esc_html( $title_tag ); ?>>
