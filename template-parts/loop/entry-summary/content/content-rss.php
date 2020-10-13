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
		'_context'        => null,
		'_item'           => false,
		'_entries_layout' => get_theme_mod( get_post_type() . '-entries-layout' ),
		'_excerpt_length' => null,
	]
);

if ( ! $args['_item'] || ! is_a( $args['_item'], 'SimplePie_Item' ) ) {
	return;
}

$description = $args['_item']->get_description();

/**
 * Callback for excerpt_length
 *
 * @global array $template_args
 * @return int
 */
$entry_summary_content_excerpt_length = function() use ( $args ) {
	if ( null !== $args['_excerpt_length'] ) {
		return $args['_excerpt_length'];
	}

	// phpcs:disable WordPress.WP.I18n.MissingArgDomain
	$default_excerpt_length = _x( '55', 'excerpt_length' );
	// phpcs:enable

	if ( 'rich-media' === $args['_entries_layout'] ) {
		$num_words            = 25;
		$excerpt_length_ratio = 55 / $default_excerpt_length;
		return $num_words / $excerpt_length_ratio;
	}

	return $default_excerpt_length;
};

$excerpt_length = $entry_summary_content_excerpt_length();
$excerpt_more   = apply_filters( 'excerpt_more', ' [&hellip;]' );
$description    = wp_strip_all_tags( wp_trim_words( $description, $excerpt_length, $excerpt_more ) );
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $description ); ?>
</div>
