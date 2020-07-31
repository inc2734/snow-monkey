<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 */

add_filter(
	'walker_nav_menu_start_el',
	function( $item_output, $item, $depth, $args ) {
		if ( 'social-nav' !== $args->theme_location ) {
			return $item_output;
		}

		$get_brand_icon = function( $path ) {
			if ( file_exists( $path ) ) {
				$icon = file_get_contents( $path );
				$icon = str_replace( '<svg ', '<svg class="svg-inline--fa fa-w-14" ', $icon );
				return $icon;
			}
		};

		$new_item_output = '';

		if ( preg_match( '|^https?://([^\.]+?\.)*?amazon\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-amazon"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?bitbucket\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-bitbucket"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?paypal\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-paypal"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?stripe\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-stripe"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?codepen\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-codepen"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?digg\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-digg"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?dribbble\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-dribbble"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?dropbox\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-dropbox"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?facebook\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-facebook"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?flickr\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-flickr"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?getpocket\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-get-pocket"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?github\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-github"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?gitlab\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-gitlab"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://play\.google\.com|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-google-play"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?google\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-google"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?instagram\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-instagram"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?linkedin\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-linkedin"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?medium\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-medium"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?pinterest\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-pinterest"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?reddit\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-reddit"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?skype\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-skype"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?slack\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-slack"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?slideshare\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-slideshare"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?snapchat\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-snapchat"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?stackoverflow\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-stack-overflow"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?tumblr\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-tumblr"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?vimeo\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-vimeo"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?twitter\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-twitter"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?weibo\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-weibo"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?wordpress\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-wordpress"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?youtube\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-youtube"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?behance\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-behance"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?500px\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-500px"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?blogger\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-blogger"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?blogspot\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-blogger"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?soundcloud\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-soundcloud"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?spotify\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-spotify"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?foursquare\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-foursquare"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?line\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-line"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?lineblog\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-line"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?lin\.ee|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-line"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?note\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, $get_brand_icon( get_template_directory() . '/assets/img/note.svg' ) . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://apps\.apple\.com|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-app-store"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?twitch\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-twitch"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://([^\.]+?\.)*?discord\.([^\./]+?)(\.[^\./]+?.)?|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-discord"></i>' . $args->link_before, $item_output );
		} elseif ( preg_match( '|^https?://music\.apple\.com|', $item->url ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-apple"></i>' . $args->link_before, $item_output );
		} else {
			$new_item_output = str_replace( $args->link_before, '<i class="fas fa-globe"></i>' . $args->link_before, $item_output );
		}

		return apply_filters( 'snow_monkey_social_nav_item', $new_item_output, $item_output, $args );
	},
	10,
	4
);
