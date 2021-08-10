<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
 */

namespace Framework\Contract\Helper;

class Trait_Helper {

	/**
	 * Tries to convert an attachment URL into a post ID.
	 *
	 * @param string $url The URL to resolve.
	 * @return int
	 */
	public static function attachment_url_to_postid( $url ) {
		$url = preg_replace( '|\?.*$|', '', $url );

		if ( preg_match( '|-scaled\.[0-9A-Za-z]+$|', $url ) ) {
			return attachment_url_to_postid( $url );
		}

		$wp_upload_dir = wp_upload_dir();

		if ( preg_match( '|-\d+x\d+\.[0-9A-Za-z]+$|', $url ) ) {
			$new_url = preg_replace( '|-\d+x\d+(\.[0-9A-Za-z]+)$|', '$1', $url );
			$path    = str_replace( $wp_upload_dir['baseurl'], $wp_upload_dir['basedir'], $new_url );
			if ( file_exists( $path ) ) {
				$id = attachment_url_to_postid( $new_url );
				if ( 0 !== $id ) {
					return $id;
				}
			}

			$new_url = preg_replace( '|(\.[0-9A-Za-z]+)$|', '-scaled$1', $new_url );
			$path    = str_replace( $wp_upload_dir['baseurl'], $wp_upload_dir['basedir'], $new_url );
			if ( file_exists( $path ) ) {
				return attachment_url_to_postid( $new_url );
			}
		}

		$new_url = preg_replace( '|(\.[0-9A-Za-z]+)$|', '-scaled$1', $url );
		$path    = str_replace( $wp_upload_dir['baseurl'], $wp_upload_dir['basedir'], $new_url );
		if ( file_exists( $path ) ) {
			return attachment_url_to_postid( $new_url );
		}

		return attachment_url_to_postid( $url );
	}
}
