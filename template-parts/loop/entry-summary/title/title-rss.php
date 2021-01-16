<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title_tag' => 'h2',
		'_item'      => false,
	]
);

if ( ! $args['_item'] || ! is_a( $args['_item'], 'SimplePie_Item' ) ) {
	return;
}

$layout    = get_theme_mod( 'post-entries-layout' );
$_title    = $args['_item']->get_title();
$title_tag = $args['_title_tag'];
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
