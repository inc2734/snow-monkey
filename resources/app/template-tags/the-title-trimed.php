<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Return trimed title
 *
 * @return void
 */
function snow_monkey_the_title_trimed() {
	$num_words = apply_filters( 'snow_monkey_entry_summary_title_num_words', class_exists( 'multibyte_patch' ) ? 40 : 80 );
	if ( $num_words ) {
		ob_start();
		the_title();
		$title = wp_trim_words( ob_get_clean(), $num_words );
		echo esc_html( $title );
	} else {
		the_title();
	}
}
