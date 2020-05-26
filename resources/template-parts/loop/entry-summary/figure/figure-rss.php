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

// note
$thumbnail = $template_args['item']->get_item_tags( SIMPLEPIE_NAMESPACE_MEDIARSS, 'thumbnail' );
$thumbnail = ! empty( $thumbnail[0]['data'] ) ? $thumbnail[0]['data'] : false;
if ( ! $thumbnail ) {
	return;
}
?>

<div class="c-entry-summary__figure">
	<img src="<?php echo esc_url( $thumbnail ); ?>" alt="">
</div>
