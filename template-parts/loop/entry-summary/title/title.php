<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_context'   => null,
		'_title_tag' => 'h2',
	]
);

$layout    = get_theme_mod( get_post_type() . '-entries-layout' );
$title_tag = $args['_title_tag'];
?>

<<?php echo esc_html( $title_tag ); ?> class="c-entry-summary__title">
	<?php
	if ( 'rich-media' !== $layout ) {
		the_title();
	} else {
		Helper::the_title_trimed();
	}
	?>
</<?php echo esc_html( $title_tag ); ?>>
