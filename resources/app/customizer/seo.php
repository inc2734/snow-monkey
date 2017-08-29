<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Customizer_Framework;

$customizer = Customizer_Framework::init();

$customizer->panel( 'seo', array(
	'title' => __( 'SEO', 'snow-monkey' ),
) );

$customizer->section( 'google-analytics', array(
	'title' => __( 'Google Analytics', 'snow-monkey' ),
) );

$customizer->section( 'google-search-console', array(
	'title' => __( 'Google Search Console', 'snow-monkey' ),
) );

$customizer->section( 'ogp', array(
	'title' => __( 'OGP', 'snow-monkey' ),
) );

$customizer->section( 'twitter-cards', array(
	'title'       => __( 'Twitter Cards', 'snow-monkey' ),
	'description' => sprintf(
		__( 'Application of URL is necessary for using Twitter Cards. %1$s', 'snow-monkey' ),
		'<a href="https://cards-dev.twitter.com/validator" target="_blank">Card validator</a>'
	),
) );

$customizer->control( 'text', 'inc2734-theme-option-google-analytics-tracking-id', array(
	'label'       => __( 'Tracking ID', 'snow-monkey' ),
	'description' => __( 'e.g. UA-1111111-11', 'snow-monkey' ),
	'type'        => 'option',
) );

$customizer->control( 'text', 'inc2734-theme-option-google-site-verification', array(
	'label'       => __( 'Google site verification', 'snow-monkey' ),
	'description' => sprintf(
		__( 'Please enter part %1$s of %2$s', 'snow-monkey' ),
		'<code>xxxx</code>',
		'<code>&lt;meta name="google-site-verification" content="xxxxx" /&gt;</code>'
	),
	'type' => 'option',
) );

$customizer->control( 'image', 'inc2734-theme-option-default-og-image', array(
	'label'       => __( 'Default OGP image', 'snow-monkey' ),
	'description' => __( 'If a featured image is set in an article, that the featured image is used, if not set, this image will be used.', 'snow-monkey' ),
	'type'        => 'option',
) );

$customizer->control( 'select', 'inc2734-theme-option-twitter-card', array(
	'label'       => __( 'twitter:card', 'snow-monkey' ),
	'description' => __( 'Twitter Cards format', 'snow-monkey' ),
	'default'     => 'summary',
	'type'        => 'option',
	'choices'     => array(
		'summary'             => 'Summary Card',
		'summary_large_image' => 'Summary Card with Large Image',
	),
) );

$customizer->control( 'text', 'inc2734-theme-option-twitter-site', array(
	'label'       => __( 'twitter:site', 'snow-monkey' ),
	'description' => sprintf(
		__( 'The Twitter account name of the site. Please enter in the form %1$s.', 'snow-monkey' ),
		'<code>@username</code>'
	),
	'default' => '@',
	'type'    => 'option',
) );

$panel   = $customizer->get_panel( 'seo' );
$section = $customizer->get_section( 'google-analytics' );
$control = $customizer->get_control( 'inc2734-theme-option-google-analytics-tracking-id' );
$control->join( $section )->join( $panel );

$section = $customizer->get_section( 'google-search-console' );
$control = $customizer->get_control( 'inc2734-theme-option-google-site-verification' );
$control->join( $section )->join( $panel );

$section = $customizer->get_section( 'ogp' );
$control = $customizer->get_control( 'inc2734-theme-option-default-og-image' );
$control->join( $section )->join( $panel );

$section = $customizer->get_section( 'twitter-cards' );
$control = $customizer->get_control( 'inc2734-theme-option-twitter-card' );
$control->join( $section )->join( $panel );
$control = $customizer->get_control( 'inc2734-theme-option-twitter-site' );
$control->join( $section )->join( $panel );
