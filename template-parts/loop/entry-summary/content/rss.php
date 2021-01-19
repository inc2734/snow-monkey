<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 12.2.3
 *
 * renamed: template-parts/loop/entry-summary/content/content-rss.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_item'           => false,
		'_entries_layout' => 'rich-media',
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
 * @global array $args The template part args.
 * @param int $number The maximum number of words. Default 55.
 * @return int
 */
$entry_summary_content_excerpt_length = function( $number = null ) use ( $args ) {
	if ( null !== $args['_excerpt_length'] ) {
		return $args['_excerpt_length'];
	}

	if ( is_null( $number ) ) {
		// phpcs:disable WordPress.WP.I18n.MissingArgDomain
		$number = _x( '55', 'excerpt_length' );
		// phpcs:enable
	}

	if ( 'rich-media' === $args['_entries_layout'] ) {
		$num_words            = 25;
		$excerpt_length_ratio = 55 / $number;
		return $num_words / $excerpt_length_ratio;
	}

	return $number;
};

$excerpt_length = $entry_summary_content_excerpt_length();
$excerpt_more   = apply_filters( 'excerpt_more', ' [&hellip;]' );
$description    = wp_strip_all_tags( wp_trim_words( $description, $excerpt_length, $excerpt_more ) );
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $description ); ?>
</div>
