<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Add sidebar widget area
 *
 * @deprecated
 * @return void
 */
add_action( 'init', function() {
	if ( ! apply_filters( 'snow_monkey_use_post_type_widget_area', false ) ) {
		return;
	}

	$post_types = snow_monkey_get_public_post_types();
	foreach ( $post_types as $post_type => $post_type_object ) {
		register_sidebar( [
			// @codingStandardsIgnoreStart
			'name'          => sprintf( __( '%1$s sidebar', 'snow-monkey' ), __( $post_type_object->label ) ),
			'description'   => sprintf( __( 'This widgets are displayed in the %1$s page sidebar.', 'snow-monkey' ), __( $post_type_object->label ) ),
			// @codingStandardsIgnoreEnd
			'id'            => $post_type_object->name . '-post-type-sidebar-widget-area',
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="c-widget__title">',
			'after_title'   => '</h2>',
		] );

		register_sidebar( [
			// @codingStandardsIgnoreStart
			'name'          => sprintf( __( '%1$s sticky sidebar', 'snow-monkey' ), __( $post_type_object->label ) ),
			'description'   => sprintf( __( 'This widgets are displayed in the %1$s page sidebar.', 'snow-monkey' ), __( $post_type_object->label ) ),
			// @codingStandardsIgnoreEnd
			'id'            => $post_type_object->name . '-post-type-sidebar-sticky-widget-area',
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="c-widget__title">',
			'after_title'   => '</h2>',
		] );
	}
}, 11 );

/**
 * Add sidebar widget area
 *
 * @return void
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Sidebar', 'snow-monkey' ),
		'description'   => __( 'This widgets are displayed in the sidebar of singular post.', 'snow-monkey' ),
		'id'            => 'sidebar-widget-area',
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="c-widget__title">',
		'after_title'   => '</h2>',
	] );

	register_sidebar( [
		'name'          => __( 'Sticky sidebar', 'snow-monkey' ),
		'description'   => __( 'This widgets are displayed in the sidebar of singular post.', 'snow-monkey' ),
		'id'            => 'sidebar-sticky-widget-area',
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="c-widget__title">',
		'after_title'   => '</h2>',
	] );
} );

/**
* Add top of title widget area
*
* @deprecated
* @return void
*/
add_action( 'init', function() {
	if ( ! apply_filters( 'snow_monkey_use_post_type_widget_area', false ) ) {
		return;
	}

	$post_types = snow_monkey_get_public_post_types();
	foreach ( $post_types as $post_type => $post_type_object ) {
		register_sidebar( [
			// @codingStandardsIgnoreStart
			'name'          => sprintf( __( '%1$s top of title', 'snow-monkey' ), __( $post_type_object->label ) ),
			'description'   => sprintf( __( 'This widgets are displayed on the title of %1$s.', 'snow-monkey' ), __( $post_type_object->label ) ),
			// @codingStandardsIgnoreEnd
			'id'            => $post_type_object->name . '-post-type-title-top-widget-area',
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="c-widget__title">',
			'after_title'   => '</h2>',
		] );
	}
}, 11 );

/**
* Add top of page title widget area
 *
 * @return void
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Top of the page title', 'snow-monkey' ),
		'description'   => __( 'This widgets are displayed on the title of the singular post.', 'snow-monkey' ),
		'id'            => 'title-top-widget-area',
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="c-widget__title">',
		'after_title'   => '</h2>',
	] );
} );

/**
* Add top of archive page widget area
 *
 * @return void
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Top of the archive page', 'snow-monkey' ),
		'description'   => __( 'This widgets are displayed top of the archive page.', 'snow-monkey' ),
		'id'            => 'archive-top-widget-area',
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="c-widget__title">',
		'after_title'   => '</h2>',
	] );
} );

/**
* Add bottom of contents widget area
*
* @deprecated
* @return void
*/
add_action( 'init', function() {
	if ( ! apply_filters( 'snow_monkey_use_post_type_widget_area', false ) ) {
		return;
	}

	$post_types = snow_monkey_get_public_post_types();
	foreach ( $post_types as $post_type => $post_type_object ) {
		register_sidebar( [
			// @codingStandardsIgnoreStart
			'name'          => sprintf( __( '%1$s bottom of contents', 'snow-monkey' ), __( $post_type_object->label ) ),
			'description'   => sprintf( __( 'This widgets are displayed under the contents of %1$s.', 'snow-monkey' ), __( $post_type_object->label ) ),
			// @codingStandardsIgnoreEnd
			'id'            => $post_type_object->name . '-post-type-contents-bottom-widget-area',
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="c-widget__title">',
			'after_title'   => '</h2>',
		] );
	}
}, 11 );

/**
* Add bottom of contents widget area
*
* @deprecated
* @return void
*/
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Bottom of contents', 'snow-monkey' ),
		'description'   => __( 'This widgets are displayed under the contents of singular post.', 'snow-monkey' ),
		'id'            => 'contents-bottom-widget-area',
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="c-widget__title">',
		'after_title'   => '</h2>',
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
		'description'   => __( 'This widgets are displayed in the sidebar of archive page .', 'snow-monkey' ),
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
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
		'id'            => 'front-page-top-widget-area',
		'description'   => __( 'This widgets are displayed in the static front page.', 'snow-monkey' ),
		'before_widget' => '<div class="l-front-page-widget-area__item"><div id="%1$s" class="c-section %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="c-section__title">',
		'after_title'   => '</h2>',
	] );

	add_filter( 'dynamic_sidebar_params', function( $params ) {
		if ( 'front-page-top-widget-area' !== $params[0]['id'] ) {
			return $params;
		}

		$wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
		if ( 'default' === $wp_page_template || false !== strpos( $wp_page_template, 'one-column-full.php' ) || false !== strpos( $wp_page_template, 'one-column-fluid.php' ) ) {
			$params[0]['before_widget'] .= '<div class="c-container">';
			$params[0]['after_widget']  .= '</div">';
		}

		return $params;
	} );
} );

/**
 * Add front page widget area
 *
 * @return void
 */
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name'          => __( 'Front page (Bottom of page)', 'snow-monkey' ),
		'id'            => 'front-page-bottom-widget-area',
		'description'   => __( 'This widgets are displayed in the static front page.', 'snow-monkey' ),
		'before_widget' => '<div class="l-front-page-widget-area__item"><div id="%1$s" class="c-section %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="c-section__title">',
		'after_title'   => '</h2>',
	] );

	add_filter( 'dynamic_sidebar_params', function( $params ) {
		if ( 'front-page-bottom-widget-area' !== $params[0]['id'] ) {
			return $params;
		}

		$wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
		if ( 'default' === $wp_page_template || false !== strpos( $wp_page_template, 'one-column-full.php' ) || false !== strpos( $wp_page_template, 'one-column-fluid.php' ) ) {
			$params[0]['before_widget'] .= '<div class="c-container">';
			$params[0]['after_widget']  .= '</div">';
		}

		return $params;
	} );
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
		'description'   => __( 'This widgets are displayed in the footer.', 'snow-monkey' ),
		'before_widget' => '<div class="l-footer-widget-area__item c-row__col c-row__col--1-1 c-row__col--lg-1-1"><div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="c-widget__title">',
		'after_title'   => '</h2>',
	] );
} );
