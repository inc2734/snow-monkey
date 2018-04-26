<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter( 'walker_nav_menu_start_el', function( $item_output, $item, $depth, $args ) {
	if ( 'social-nav' !== $args->theme_location ) {
		return $item_output;
	}

	if ( false !== strpos( $item->url, 'amazon.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-amazon"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'bitbucket.org' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-bitbucket"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'paypal.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-paypal"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'stripe.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-stripe"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'codepen.io' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-codepen"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'digg.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-digg"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'dribbble.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-dribbble"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'dropbox.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-dropbox"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'facebook.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-facebook"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'flickr.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-flickr"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'getpocket.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-get-pocket"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'github.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-github"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'gitlab.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-gitlab"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'plus.google.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-google-plus"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'google.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-google"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'instagram.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-instagram"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'linkedin.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-linkedin"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'medium.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-medium"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'pinterest.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-pinterest"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'pinterest.jp' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-pinterest"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'reddit.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-reddit"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'skype.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-skype"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'slack.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-slack"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'slideshare.net' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-slideshare"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'snapchat.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-snapchat"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'stackoverflow.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-stack-overflow"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'tumblr.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-tumblr"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'vimeo.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-vimeo"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'twitter.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-twitter"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'weibo.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-weibo"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'wordpress.org' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-wordpress"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'wordpress.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-wordpress"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'youtube.com' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-youtube"></i>' . $args->link_before, $item_output );
	} elseif ( false !== strpos( $item->url, 'behance.net' ) ) {
		return str_replace( $args->link_before, '<i class="fab fa-behance"></i>' . $args->link_before, $item_output );
	}

	return str_replace( $args->link_before, '<i class="fas fa-globe"></i>' . $args->link_before, $item_output );
}, 10, 4 );
