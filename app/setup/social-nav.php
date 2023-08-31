<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.1.1
 */

use Framework\Model\Filesystem;

add_filter(
	'walker_nav_menu_start_el',
	function( $item_output, $item, $depth, $args ) {
		if ( ! in_array( $args->theme_location, array( 'social-nav', 'follow-box' ), true ) ) {
			return $item_output;
		}

		$get_brand_icon = function( $path ) {
			if ( file_exists( $path ) ) {
				$icon = Filesystem::get_contents( $path );
				return $icon
					? str_replace( '<svg ', '<svg class="svg-inline--fa fa-w-14" ', $icon )
					: '';
			}
		};

		$new_item_output = '';

		if (
			preg_match( '|^https?://([^\.]+?\.)*?amazon\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-amazon"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="amazon" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?bitbucket\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-bitbucket"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="bitbucket" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?paypal\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-paypal"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="paypal" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?stripe\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-stripe"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="stripe" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?codepen\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-codepen"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="codepen" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?dribbble\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-dribbble"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="dribbble" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?dropbox\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-dropbox"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="dropbox" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?facebook\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-facebook"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="facebook" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?flickr\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-flickr"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="flickr" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?github\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-github"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="github" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?gitlab\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-gitlab"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="gitlab" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://play\.google\.com|', $item->url ) ) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-google-play"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="google-play" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?google\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-google"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="google" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?instagram\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-instagram"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="instagram" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?linkedin\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-linkedin"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="linkedin" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?medium\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-medium"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="medium" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?pinterest\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-pinterest"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="pinterest" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?reddit\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-reddit"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="reddit" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?skype\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-skype"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="skype" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?slack\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-slack"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="slack" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?slideshare\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-slideshare"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="slideshare" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?snapchat\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-snapchat"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="snapchat" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?stackoverflow\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-stack-overflow"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="stack-overflow" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?tumblr\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-tumblr"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="tumblr" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?vimeo\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-vimeo"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="vimeo" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?twitter\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-x-twitter"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="x" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?WordPress\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-wordpress"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="wordpress" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?youtube\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-youtube"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="youtube" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?spotify\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-spotify"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="spotify" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?foursquare\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-foursquare"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="foursquare" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?line\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-line"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="line" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?lineblog\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-line"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="line" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?lin\.ee|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-line"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="line" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?note\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'follow-box' === $args->theme_location
					? $get_brand_icon( get_template_directory() . '/assets/img/note-white.svg' ) . $args->link_before
					: $get_brand_icon( get_template_directory() . '/assets/img/note.svg' ) . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="note" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://apps\.apple\.com|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-app-store"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="app-store" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?twitch\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-twitch"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="twitch" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?discord\.([^\./]+?)(\.[^\./]+?.)?|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-discord"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="discord" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://music\.apple\.com|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-apple"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="apple" ', $new_item_output );
		} elseif (
			preg_match( '|^https?://([^\.]+?\.)*?tiktok\.com|', $item->url )
		) {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-brands fa-tiktok"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="tiktok" ', $new_item_output );
		} else {
			$new_item_output = str_replace(
				$args->link_before,
				'<i class="fa-solid fa-globe"></i>' . $args->link_before,
				$item_output
			);
			$new_item_output = str_replace( '<a ', '<a data-icon="globe" ', $new_item_output );
		}

		return apply_filters( 'snow_monkey_social_nav_item', $new_item_output, $item_output, $args, $item );
	},
	10,
	4
);
