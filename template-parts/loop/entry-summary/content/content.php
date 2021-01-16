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
		'_entries_layout' => get_theme_mod( get_post_type() . '-entries-layout' ),
		'_excerpt_length' => null,
	]
);

/**
 * Callback for excerpt_length
 *
 * @global array $args
 * @param int $default_excerpt_length
 * @return int
 */
$entry_summary_content_excerpt_length = function( $default_excerpt_length ) use ( $args ) {
	if ( null !== $args['_excerpt_length'] ) {
		return $args['_excerpt_length'];
	}

	if ( 'rich-media' === $args['_entries_layout'] ) {
		// phpcs:disable WordPress.WP.I18n.MissingArgDomain
		$num_words            = 25;
		$excerpt_length_ratio = 55 / _x( '55', 'excerpt_length' );
		// phpcs:enable
		return $num_words / $excerpt_length_ratio;
	}

	return $default_excerpt_length;
};

add_filter( 'excerpt_length', $entry_summary_content_excerpt_length, 100 );
ob_start();
the_excerpt();
$content = wp_strip_all_tags( ob_get_clean() );
remove_filter( 'excerpt_length', $entry_summary_content_excerpt_length, 100 );
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $content ); ?>
</div>
