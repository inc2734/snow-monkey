<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

add_filter(
	'walker_nav_menu_start_el',
	function( $item_output, $item, $depth, $args ) {
		if ( 'social-nav' !== $args->theme_location ) {
			return $item_output;
		}

		$new_item_output = '';

		if ( false !== strpos( $item->url, 'amazon.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-amazon"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'bitbucket.org' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-bitbucket"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'paypal.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-paypal"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'stripe.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-stripe"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'codepen.io' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-codepen"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'digg.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-digg"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'dribbble.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-dribbble"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'dropbox.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-dropbox"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'facebook.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-facebook"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'flickr.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-flickr"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'getpocket.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-get-pocket"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'github.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-github"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'gitlab.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-gitlab"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'plus.google.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-google-plus"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'google.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-google"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'instagram.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-instagram"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'linkedin.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-linkedin"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'medium.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-medium"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'pinterest.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-pinterest"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'pinterest.jp' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-pinterest"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'reddit.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-reddit"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'skype.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-skype"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'slack.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-slack"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'slideshare.net' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-slideshare"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'snapchat.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-snapchat"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'stackoverflow.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-stack-overflow"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'tumblr.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-tumblr"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'vimeo.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-vimeo"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'twitter.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-twitter"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'weibo.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-weibo"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'wordpress.org' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-wordpress"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'wordpress.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-wordpress"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'youtube.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-youtube"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'behance.net' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-behance"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, '500px.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-500px"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'blogger.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-blogger"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'blogspot.jp' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-blogger"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'blogspot.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-blogger"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'soundcloud.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-soundcloud"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'spotify.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-spotify"></i>' . $args->link_before, $item_output );
		} elseif ( false !== strpos( $item->url, 'foursquare.com' ) ) {
			$new_item_output = str_replace( $args->link_before, '<i class="fab fa-foursquare"></i>' . $args->link_before, $item_output );
		} else {
			$new_item_output = str_replace( $args->link_before, '<i class="fas fa-globe"></i>' . $args->link_before, $item_output );
		}

		return apply_filters( 'snow_monkey_social_nav_item', $new_item_output, $item_output, $args );
	},
	10,
	4
);
