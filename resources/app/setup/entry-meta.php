<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'snow_monkey_entry_meta_items', function( $entry_meta ) {
	global $post;

	unset( $entry_meta['tags'] );

	$entry_meta['author'] = sprintf(
		'<span class="screen-reader-text">著者</span>%1$s%2$s',
		get_avatar( $post->post_author ),
		get_the_author()
	);

	return $entry_meta;
} );
