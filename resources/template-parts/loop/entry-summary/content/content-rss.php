<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.6.0
 */

use Framework\Helper;

$template_args = [
	'item'           => Helper::get_var( $_item, false ),
	'entries_layout' => Helper::get_var( $_entries_layout, get_theme_mod( get_post_type() . '-entries-layout' ) ),
	'excerpt_length' => Helper::get_var( $_excerpt_length, null ),
];

if ( ! $template_args['item'] || ! is_a( $template_args['item'], 'SimplePie_Item' ) ) {
	return;
}

$description = $template_args['item']->get_description();

/**
 * Callback for excerpt_length
 *
 * @global array $template_args
 * @return int
 */
$entry_summary_content_excerpt_length = function() use ( $template_args ) {
	if ( null !== $template_args['excerpt_length'] ) {
		return $template_args['excerpt_length'];
	}

	// phpcs:disable WordPress.WP.I18n.MissingArgDomain
	$default_excerpt_length = _x( '55', 'excerpt_length' );
	// phpcs:enable

	if ( 'rich-media' === $template_args['entries_layout'] ) {
		$num_words = 25;
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
