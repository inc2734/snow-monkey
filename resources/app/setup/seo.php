<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_SEO\SEO;

new SEO();

/**
 * Google Tag Manager ID
 *
 * @param string $tag_manager_id
 * @return string
 */
add_filter( 'inc2734_wp_seo_google_tag_manager_id', function( $tag_manager_id ) {
	$for_loggedin = get_option( 'mwt-google-tag-manager-for-loggedin' );
	if ( $for_loggedin ) {
		$output = apply_filters( 'snow_monkey_output_google_tag_manager', ! current_user_can( 'manage_options' ) );
		if ( ! $output ) {
			return;
		}
	}
	return get_option( 'mwt-google-tag-manager-id' );
} );

/**
 * Google Analytics Tracking ID
 *
 * @param string $tracking_id
 * @return string
 */
add_filter( 'inc2734_wp_seo_google_analytics_tracking_id', function( $tracking_id ) {
	$for_loggedin = get_option( 'mwt-google-analytics-for-loggedin' );
	if ( $for_loggedin ) {
		$output = apply_filters( 'snow_monkey_output_google_analytics', ! current_user_can( 'manage_options' ) );
		if ( ! $output ) {
			return;
		}
	}
	return get_option( 'mwt-google-analytics-tracking-id' );
} );

/**
 * Google Site Verification
 *
 * @param string $google_site_verification
 * @return string
 */
add_filter( 'inc2734_wp_seo_google_site_verification', function( $google_site_verification ) {
	return get_option( 'mwt-google-site-verification' );
} );

/**
 * Default og:image
 *
 * @param string $default_ogp_image_url
 * @return string
 */
add_filter( 'inc2734_wp_seo_defult_ogp_image_url', function( $default_ogp_image_url ) {
	return get_option( 'mwt-default-og-image' );
} );

/**
 * When you want to print ogp meta tags, return true
 *
 * @param bool false
 * @return bool
 */
add_filter( 'inc2734_wp_seo_ogp', function( $bool ) {
	return get_option( 'mwt-ogp' );
} );

/**
 * twitter:card
 *
 * @param string $twitter_card
 * @return string
 */
add_filter( 'inc2734_wp_seo_twitter_card', function( $twitter_card ) {
	return get_option( 'mwt-twitter-card' );
} );

/**
 * twitter:site
 *
 * @param string $twitter_site
 * @return string
 */
add_filter( 'inc2734_wp_seo_twitter_site', function( $twitter_site ) {
	return get_option( 'mwt-twitter-site' );
} );

/**
 * When you want to print JSON+LD, return true
 *
 * @param bool false
 * @return bool
 */
add_filter( 'inc2734_wp_seo_use_json_ld', function( $bool ) {
	return get_option( 'mwt-json-ld' );
} );

/**
 * Print Google Tag Manager script in body
 *
 * @return void
 */
remove_action( 'wp_footer', 'inc2734_wp_seo_googletagmanager_noscript_tag_install' );
add_action( 'snow_monkey_prepend_body', 'inc2734_wp_seo_googletagmanager_noscript_tag_install' );
