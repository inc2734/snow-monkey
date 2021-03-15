<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 *
 * renamed: template-parts/loop/entry-summary/figure/figure-rss.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_item' => false,
	]
);

if ( ! $args['_item'] || ! is_a( $args['_item'], 'SimplePie_Item' ) ) {
	return;
}

$thumbnail = false;

// note
$simplepie_thumbnail = $args['_item']->get_item_tags( SIMPLEPIE_NAMESPACE_MEDIARSS, 'thumbnail' );
$thumbnail_src       = ! empty( $simplepie_thumbnail[0]['data'] ) ? $simplepie_thumbnail[0]['data'] : false;
if ( $thumbnail_src ) {
	$thumbnail = sprintf( '<img src="%1$s" alt="">', esc_url( $thumbnail_src ) );
}

// はてなブログ
if ( ! $thumbnail ) {
	$thumbnail_src = $args['_item']->get_enclosure()->get_link();
	if ( $thumbnail_src ) {
		$thumbnail = sprintf( '<img src="%1$s" alt="">', esc_url( $thumbnail_src ) );
	}
}

// first img
if ( ! $thumbnail ) {
	$description = $args['_item']->get_description();
	if ( preg_match( '|^(?:<a [^>]+?>)?(<img [^>]+?>)|ims', $description, $match ) ) {
		$thumbnail = $match[1];
		$thumbnail = preg_replace( '|style="[^"]*?"|', '', $thumbnail );
		$thumbnail = preg_replace( '|class="[^"]*?"|', '', $thumbnail );
	}
}
?>

<div class="c-entry-summary__figure">
	<?php echo wp_kses_post( $thumbnail ); ?>
</div>
