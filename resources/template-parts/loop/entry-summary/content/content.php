<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 */

use Framework\Helper;

$template_args = [
	'entries_layout' => Helper::get_var( $_entries_layout, get_theme_mod( get_post_type() . '-entries-layout' ) ),
];

ob_start();
the_excerpt();
$content = wp_strip_all_tags( ob_get_clean() );

if ( 'rich-media' === $template_args['entries_layout'] ) {
	$excerpt_more = apply_filters( 'excerpt_more', ' [&hellip;]' );
	$content = preg_replace( '|' . preg_quote( $excerpt_more ) . '$|', '', $content );
	$content = wp_trim_words( $content, class_exists( 'multibyte_patch' ) ? 50 : 25, $excerpt_more );
}
?>

<div class="c-entry-summary__content">
	<?php echo esc_html( $content ); ?>
</div>
