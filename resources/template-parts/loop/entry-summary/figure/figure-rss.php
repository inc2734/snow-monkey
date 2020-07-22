<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

use Framework\Helper;

$template_args = [
	'item' => Helper::get_var( $args['_item'], false ),
];

if ( ! $template_args['item'] || ! is_a( $template_args['item'], 'SimplePie_Item' ) ) {
	return;
}

$thumbnail = false;

// note
$simplepie_thumbnail = $template_args['item']->get_item_tags( SIMPLEPIE_NAMESPACE_MEDIARSS, 'thumbnail' );
$thumbnail_src = ! empty( $simplepie_thumbnail[0]['data'] ) ? $simplepie_thumbnail[0]['data'] : false;
if ( $thumbnail_src ) {
	$thumbnail = sprintf( '<img src="%1$s" alt="">', esc_url( $thumbnail_src ) );
}

// first img
if ( ! $thumbnail ) {
	$description = $template_args['item']->get_description();
	if ( preg_match( '|^(?:<a [^>]+?>)?(<img [^>]+?>)|ims', $description, $match ) ) {
		$thumbnail = $match[1];
		$thumbnail = preg_replace( '|style="[^"]*?"|', '', $thumbnail );
		$thumbnail = preg_replace( '|class="[^"]*?"|', '', $thumbnail );
	}
}

if ( ! $thumbnail ) {
	return;
}
?>

<div class="c-entry-summary__figure">
	<?php echo wp_kses_post( $thumbnail ); ?>
</div>
