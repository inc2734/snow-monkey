<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->panel( 'seo-sns', array(
	'title'    => __( 'SEO/SNS', 'snow-monkey' ),
	'priority' => 1000,
) );

$panel = $customizer->get_panel( 'seo-sns' );

/**
 * Google Tag Manager
 */
$customizer->section( 'google-tag-manager', array(
	'title' => __( 'Google Tag Manager', 'snow-monkey' ),
) );

$section = $customizer->get_section( 'google-tag-manager' );

$customizer->control( 'text', 'mwt-google-tag-manager-id', array(
	'label'       => __( 'Tag Manager ID', 'snow-monkey' ),
	'description' => __( 'e.g. GTM-X11X1XX', 'snow-monkey' ),
	'type'        => 'option',
) );

$control = $customizer->get_control( 'mwt-google-tag-manager-id' );
$control->join( $section )->join( $panel );

/**
 * Google Analytics
 */
$customizer->section( 'google-analytics', array(
	'title' => __( 'Google Analytics', 'snow-monkey' ),
) );

$section = $customizer->get_section( 'google-analytics' );

$customizer->control( 'text', 'mwt-google-analytics-tracking-id', array(
	'label'       => __( 'Tracking ID', 'snow-monkey' ),
	'description' => __( 'e.g. UA-1111111-11', 'snow-monkey' ),
	'type'        => 'option',
) );

$control = $customizer->get_control( 'mwt-google-analytics-tracking-id' );
$control->join( $section )->join( $panel );

/**
 * Google Search Console
 */
$customizer->section( 'google-search-console', array(
	'title' => __( 'Google Search Console', 'snow-monkey' ),
) );

$section = $customizer->get_section( 'google-search-console' );

$customizer->control( 'text', 'mwt-google-site-verification', array(
	'type'        => 'option',
	'label'       => __( 'Google site verification', 'snow-monkey' ),
	'description' => sprintf(
		__( 'Please enter part %1$s of %2$s', 'snow-monkey' ),
		'<code>xxxx</code>',
		'<code>&lt;meta name="google-site-verification" content="xxxxx" /&gt;</code>'
	),
) );

$control = $customizer->get_control( 'mwt-google-site-verification' );
$control->join( $section )->join( $panel );

/**
 * OGP
 */
$customizer->section( 'ogp', array(
	'title' => __( 'OGP', 'snow-monkey' ),
) );

$section = $customizer->get_section( 'ogp' );

$customizer->control( 'checkbox', 'mwt-ogp', array(
	'label'   => __( 'Output OGP meta tag', 'snow-monkey' ),
	'type'    => 'option',
	'default' => true,
) );

$control = $customizer->get_control( 'mwt-ogp' );
$control->join( $section )->join( $panel );

$customizer->control( 'image', 'mwt-default-og-image', array(
	'label'       => __( 'Default OGP image', 'snow-monkey' ),
	'description' => __( 'If a featured image is set in an article, that the featured image is used, if not set, this image will be used.', 'snow-monkey' ),
	'type'        => 'option',
) );

$control = $customizer->get_control( 'mwt-default-og-image' );
$control->join( $section )->join( $panel );

/**
 * Structured data
 */
$customizer->section( 'json-ld', array(
	'title' => __( 'Structured data', 'snow-monkey' ),
) );

$section = $customizer->get_section( 'json-ld' );

$customizer->control( 'checkbox', 'mwt-json-ld', array(
	'label'   => __( 'Output structred data (JSON+LD)', 'snow-monkey' ),
	'type'    => 'option',
	'default' => true,
) );

$control = $customizer->get_control( 'mwt-json-ld' );
$control->join( $section )->join( $panel );

$customizer->control( 'radio', 'post-date', [
	'label'       => __( 'Date for the search engine', 'snow-monkey' ),
	'description' => __( 'This feature is a beta version.', 'snow-monkey' ),
	'default'     => 'published-date',
	'choices'     => [
		'published-date' => __( 'Published date', 'snow-monkey' ) . __( '(Display published date and modifiled date)', 'snow-monkey' ),
		'modified-date'  => __( 'Modified date', 'snow-monkey' ) . __( '(Only modified date displayed when updating post)', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'post-date' );
$control->join( $section )->join( $panel );

/**
 * Twitter Cards
 */
$customizer->section( 'twitter-cards', array(
	'title'       => __( 'Twitter Cards', 'snow-monkey' ),
	'description' => sprintf(
		__( 'Application of URL is necessary for using Twitter Cards. %1$s', 'snow-monkey' ),
		'<a href="https://cards-dev.twitter.com/validator" target="_blank">Card validator</a>'
	),
) );

$section = $customizer->get_section( 'twitter-cards' );

$customizer->control( 'select', 'mwt-twitter-card', array(
	'label'       => __( 'twitter:card', 'snow-monkey' ),
	'description' => __( 'Twitter Cards format', 'snow-monkey' ),
	'default'     => 'summary',
	'type'        => 'option',
	'choices'     => array(
		''                    => __( 'Do not use', 'snow-monkey' ),
		'summary'             => 'Summary Card',
		'summary_large_image' => 'Summary Card with Large Image',
	),
) );

$control = $customizer->get_control( 'mwt-twitter-card' );
$control->join( $section )->join( $panel );

$customizer->control( 'text', 'mwt-twitter-site', array(
	'label'       => __( 'twitter:site', 'snow-monkey' ),
	'description' => sprintf(
		__( 'The Twitter account name of the site. Please enter in the form %1$s.', 'snow-monkey' ),
		'<code>@username</code>'
	),
	'default' => '@',
	'type'    => 'option',
) );

$control = $customizer->get_control( 'mwt-twitter-site' );
$control->join( $section )->join( $panel );

/**
 * Like Me Box
 */
$customizer->section( 'like-me-box', [
	'title' => __( 'Like me box', 'snow-monkey' ),
] );

$section = $customizer->get_section( 'like-me-box' );

$customizer->control( 'text', 'mwt-facebook-page-name', [
	'transport'   => 'postMessage',
	'type'        => 'option',
	'label'       => __( 'Facebook page name', 'snow-monkey' ),
	'description' => sprintf(
		_x( 'Please enter %1$s of %2$s', 'facebook-page-name', 'snow-monkey' ),
		'<code>xxxxx</code>',
		'<code>https://www.facebook.com/xxxxx</code>'
	),
] );

$control = $customizer->get_control( 'mwt-facebook-page-name' );
$control->join( $section )->join( $panel );
$control->partial( [
	'selector'            => '.wp-like-me-box',
	'container_inclusive' => true,
	'render_callback'     => function() {
		get_template_part( 'template-parts/like-me-box' );
	},
] );

/**
 * Share Buttons
 */
$customizer->section( 'share-buttons', [
	'title' => __( 'Share buttons', 'snow-monkey' ),
	'description' => sprintf(
		__( 'If you want to count of tweet then needs to register to %1$s.', 'snow-monkey' ),
		'<a href="https://opensharecount.com/" target="_blank">OpenShareCount</a>'
	),
] );

$section = $customizer->get_section( 'share-buttons' );

$customizer->control( 'multiple-checkbox', 'mwt-share-buttons-buttons', [
	'type'    => 'option',
	'label'   => __( 'Display buttons', 'snow-monkey' ),
	'default' => '',
	'choices' => [
		'facebook' => __( 'Facebook', 'snow-monkey' ),
		'twitter'  => __( 'Twitter', 'snow-monkey' ),
		'hatena'   => __( 'Hatena Bookmark', 'snow-monkey' ),
		'feedly'   => __( 'Feedly', 'snow-monkey' ),
		'line'     => __( 'LINE', 'snow-monkey' ),
		'pocket'   => __( 'Pocket', 'snow-monkey' ),
		'feed'     => __( 'Feed', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'mwt-share-buttons-buttons' );
$control->join( $section )->join( $panel );

$customizer->control( 'select', 'mwt-share-buttons-type', [
	'transport' => 'postMessage',
	'type'      => 'option',
	'label'     => __( 'Type', 'snow-monkey' ),
	'default'   => 'balloon',
	'choices'   => [
		'balloon'    => __( 'Balloon', 'snow-monkey' ),
		'horizontal' => __( 'Horizontal', 'snow-monkey' ),
		'icon'       => __( 'Icon', 'snow-monkey' ),
		'block'      => __( 'Block', 'snow-monkey' ),
		'official'   => __( 'Official', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'mwt-share-buttons-type' );
$control->join( $section )->join( $panel );
$control->partial( [
	'selector' => '.wp-share-buttons',
	'render_callback'     => function() {
		get_template_part( 'template-parts/share-buttons' );
	},
] );

$customizer->control( 'select', 'mwt-share-buttons-display-position', [
	'type'    => 'option',
	'label'   => __( 'Display position', 'snow-monkey' ),
	'default' => 'top',
	'choices' => [
		'top'    => __( 'Top of contents', 'snow-monkey' ),
		'bottom' => __( 'Bottom of contents', 'snow-monkey' ),
		'both'   => __( 'Both', 'snow-monkey' ),
	],
] );

$control = $customizer->get_control( 'mwt-share-buttons-display-position' );
$control->join( $section );

$customizer->control( 'text', 'mwt-share-buttons-cache-seconds', [
	'label'   => __( 'Share counts cache time (seconds)', 'snow-monkey' ),
	'default' => 300,
	'type'    => 'option',
] );

$control = $customizer->get_control( 'mwt-share-buttons-cache-seconds' );
$control->join( $section )->join( $panel );
