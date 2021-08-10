<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.1.3
 */

use Inc2734\WP_SEO\Bootstrap;

new Bootstrap();

/**
 * Google Tag Manager ID.
 *
 * @return string
 */
add_filter(
	'inc2734_wp_seo_google_tag_manager_id',
	function() {
		$for_loggedin = get_option( 'mwt-google-tag-manager-for-loggedin' );
		if ( $for_loggedin ) {
			$output = apply_filters( 'snow_monkey_output_google_tag_manager', ! current_user_can( 'manage_options' ) );
			if ( ! $output ) {
				return;
			}
		}
		return get_option( 'mwt-google-tag-manager-id' );
	}
);

/**
 * Google Analytics Tracking ID.
 *
 * @return string
 */
add_filter(
	'inc2734_wp_seo_google_analytics_tracking_id',
	function() {
		$for_loggedin = get_option( 'mwt-google-analytics-for-loggedin' );
		if ( $for_loggedin ) {
			$output = apply_filters( 'snow_monkey_output_google_analytics', ! current_user_can( 'manage_options' ) );
			if ( ! $output ) {
				return;
			}
		}
		return get_option( 'mwt-google-analytics-tracking-id' );
	}
);

/**
 * Google Site Verification.
 *
 * @return string
 */
add_filter(
	'inc2734_wp_seo_google_site_verification',
	function() {
		return get_option( 'mwt-google-site-verification' );
	}
);

/**
 * Default og:image.
 *
 * @return string
 */
add_filter(
	'inc2734_wp_seo_defult_ogp_image_url',
	function() {
		$default_ogp_image = get_option( 'mwt-default-og-image' );
		if ( $default_ogp_image ) {
			$default_ogp_image = preg_match( '|^\d+$|', $default_ogp_image )
				? wp_get_attachment_image_url( $default_ogp_image, 'full' )
				: $default_ogp_image;
		}
		return $default_ogp_image;
	}
);

/**
 * When you want to print ogp meta tags, return true.
 *
 * @return bool
 */
add_filter(
	'inc2734_wp_seo_ogp',
	function() {
		return get_option( 'mwt-ogp' );
	}
);

/**
 * fb:app_id.
 *
 * @return bool
 */
add_filter(
	'inc2734_wp_ogp_app_id',
	function() {
		return get_option( 'mwt-fb-app-id' );
	}
);

/**
 * twitter:card.
 *
 * @return string
 */
add_filter(
	'inc2734_wp_seo_twitter_card',
	function() {
		return get_option( 'mwt-twitter-card' );
	}
);

/**
 * twitter:site.
 *
 * @return string
 */
add_filter(
	'inc2734_wp_seo_twitter_site',
	function() {
		return get_option( 'mwt-twitter-site' );
	}
);

/**
 * When you want to print JSON+LD, return true.
 *
 * @return boolean
 */
add_filter(
	'inc2734_wp_seo_use_json_ld',
	function() {
		return get_option( 'mwt-json-ld' );
	}
);

/**
 * meta robots.
 *
 * @param array $robots Array of robots conig.
 * @return array
 */
add_filter(
	'wp_robots',
	function( $robots ) {
		$robots_noindex = get_option( 'mwt-robots-noindex' );
		if ( ! $robots_noindex ) {
			return $robots;
		}

		$robots_noindex = explode( ',', $robots_noindex );
		$flipped        = array_flip( $robots_noindex );

		if ( is_category() && isset( $flipped['category'] )
			|| is_tag() && isset( $flipped['post_tag'] )
			|| is_author() && isset( $flipped['author'] )
			|| is_year() && isset( $flipped['year'] )
			|| is_month() && isset( $flipped['month'] )
			|| is_day() && isset( $flipped['day'] )
		) {
			$robots['noindex'] = true;
		}

		return $robots;
	}
);

/**
 * meta description.
 *
 * @see https://github.com/inc2734/snow-monkey/issues/675
 *
 * @param string $description The page description.
 * @return string
 */
add_filter(
	'inc2734_wp_seo_description',
	function( $description ) {
		if ( ! get_option( 'mwt-auto-description' ) ) {
			return $description;
		}

		if ( $description ) {
			return $description;
		}

		if ( is_front_page() ) {
			return get_bloginfo( 'description' );
		} elseif ( is_page() ) {
			$ogp = new \Inc2734\WP_OGP\App\Controller\Page();
			return wp_strip_all_tags( $ogp->get_description() );
		} elseif ( is_single() ) {
			$ogp = new \Inc2734\WP_OGP\App\Controller\Single();
			return wp_strip_all_tags( $ogp->get_description() );
		}

		return $description;
	}
);

/**
 * meta thumbnail.
 *
 * @param string $thumbnail The thumbnail URL.
 * @return string
 */
add_filter(
	'inc2734_wp_seo_thumbnail',
	function( $thumbnail ) {
		if ( ! $thumbnail && is_singular() ) {
			$thumbnail = get_theme_mod( 'default-thumbnail' );
			return $thumbnail && preg_match( '|^\d+$|', $thumbnail )
				? wp_get_attachment_image_url( $thumbnail, 'full' )
				: $thumbnail;
		}
		return $thumbnail;
	}
);

/**
 * Print Google Tag Manager script in body.
 *
 * @return void
 */
remove_action( 'wp_footer', 'inc2734_wp_seo_googletagmanager_noscript_tag_install' );
add_action( 'snow_monkey_prepend_body', 'inc2734_wp_seo_googletagmanager_noscript_tag_install' );

add_action(
	'snow_monkey_entry_meta_items',
	function() {
		if ( 'modified-date' === get_theme_mod( 'post-date' ) ) {
			ob_start();
			snow_monkey_entry_meta_items_modified();
			$modified = ob_get_clean();

			if ( $modified ) {
				remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published', 10 );
			}
		} elseif ( 'modified-date-high' === get_theme_mod( 'post-date' ) ) {
			remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published', 10 );
			remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_modified', 20 );
			add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_modified', 10 );
			add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published_no_time', 20 );
		}
	},
	9
);
