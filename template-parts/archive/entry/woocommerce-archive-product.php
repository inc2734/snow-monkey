<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.1.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_archive_top_widget_area' => false,
	]
);
?>

<?php
if ( $args['_display_archive_top_widget_area'] ) {
	Helper::get_template_part( 'template-parts/widget-area/archive-top' );
}
?>

<article <?php post_class(); ?>>
	<div class="c-entry__body">
		<?php Helper::get_template_part( 'template-parts/archive/entry/content/woocommerce-archive-product' ); ?>
	</div>
</article>
