<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Add sidebar widget area
 *
 * @return void
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Sidebar', 'snow-monkey' ),
		'id'            => 'sidebar-widget-area',
		'description'   => __( 'This widgets are displayed in the sidebar of singular pages.', 'snow-monkey' ),
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="c-widget__title"><span>',
		'after_title'   => '</span></h2>',
	] );
} );

/**
* Add sidebar widget area
*
* @return void
*/
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Archive sidebar', 'snow-monkey' ),
		'id'            => 'archive-sidebar-widget-area',
		'description'   => __( 'This widgets are displayed in the sidebar of archive pages.', 'snow-monkey' ),
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="c-widget__title"><span>',
		'after_title'   => '</span></h2>',
	] );
} );

/**
 * Add footer widget area
 *
 * @return void
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Footer', 'snow-monkey' ),
		'id'            => 'footer-widget-area',
		'description'   => __( 'This widgets are displayed in the footer of all pages.', 'snow-monkey' ),
		'before_widget' => '<div class="l-footer-widget-area__item c-row__col c-row__col--1-1 c-row__col--lg-' . esc_attr( get_theme_mod( 'footer-widget-area-column-size' ) ) . '"><div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="c-widget__title">',
		'after_title'   => '</h2>',
	] );
} );

/**
 * Add front page widget area
 *
 * @return void
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Front page (Top of page)', 'snow-monkey' ),
		'id'            => 'front-page-widget-area-top',
		'description'   => __( 'This widgets are displayed in the static front page.', 'snow-monkey' ),
		'before_widget' => '<div class="l-front-page-widget-area__item"><div id="%1$s" class="c-section %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="c-section__title">',
		'after_title'   => '</h2>',
	] );
} );

/**
 * Add front page widget area
 *
 * @return void
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Front page (Bottom of page)', 'snow-monkey' ),
		'id'            => 'front-page-widget-area-bottom',
		'description'   => __( 'This widgets are displayed in the static front page.', 'snow-monkey' ),
		'before_widget' => '<div class="l-front-page-widget-area__item"><div id="%1$s" class="c-section %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="c-section__title">',
		'after_title'   => '</h2>',
	] );
} );
