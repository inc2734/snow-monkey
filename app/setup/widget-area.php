<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.2.0
 */

use Framework\Helper;

/**
 * Add sidebar widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Sidebar', 'snow-monkey' ),
				'description'   => __( 'These widgets are displayed in the sidebar on posts and pages.', 'snow-monkey' ),
				'id'            => 'sidebar-widget-area',
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
 * Add sidebar sticky widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Sticky sidebar', 'snow-monkey' ),
				'description'   => __( 'These widgets are displayed in the sidebar on posts and pages.', 'snow-monkey' ),
				'id'            => 'sidebar-sticky-widget-area',
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
* Add top of page title widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Top of the page title', 'snow-monkey' ),
				'description'   => __( 'These widgets are displayed on the page title on the posts and pages.', 'snow-monkey' ),
				'id'            => 'title-top-widget-area',
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
* Add top of archive page widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Top of the archive page', 'snow-monkey' ),
				'description'   => __( 'These widgets are displayed top of the contents on archive page.', 'snow-monkey' ),
				'id'            => 'archive-top-widget-area',
				'before_widget' => '<div class="l-archive-top-widget-area__item"><div id="%1$s" class="c-section %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="c-section__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
* Add bottom of contents widget area
*
* @return void
*/
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Bottom of contents', 'snow-monkey' ),
				'description'   => __( 'These widgets are displayed bottom of the contents on posts and pages.', 'snow-monkey' ),
				'id'            => 'contents-bottom-widget-area',
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
* Add sidebar widget area
*
* @return void
*/
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Archive sidebar', 'snow-monkey' ),
				'id'            => 'archive-sidebar-widget-area',
				'description'   => __( 'These widgets are displayed in the sidebar on archive page.', 'snow-monkey' ),
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
 * Add front page widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Homepage (Top of page)', 'snow-monkey' ),
				'id'            => 'front-page-top-widget-area',
				'description'   => __( 'These widgets are displayed in the homepage.', 'snow-monkey' ),
				'before_widget' => '<div class="l-front-page-widget-area__item"><div id="%1$s" class="c-section %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="c-section__title">',
				'after_title'   => '</h2>',
			]
		);

		add_filter(
			'dynamic_sidebar_params',
			function( $params ) {
				if ( 'front-page-top-widget-area' !== $params[0]['id'] ) {
					return $params;
				}

				$wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
				if ( ! $wp_page_template || 'default' === $wp_page_template || false !== strpos( $wp_page_template, 'one-column-full.php' ) ) {
					$params[0]['before_widget'] .= '<div class="c-container">';
					$params[0]['after_widget']  .= '</div>';
				}

				return $params;
			}
		);
	}
);

/**
 * Add front page widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Homepage (Bottom of page)', 'snow-monkey' ),
				'id'            => 'front-page-bottom-widget-area',
				'description'   => __( 'These widgets are displayed in the homepage.', 'snow-monkey' ),
				'before_widget' => '<div class="l-front-page-widget-area__item"><div id="%1$s" class="c-section %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="c-section__title">',
				'after_title'   => '</h2>',
			]
		);

		add_filter(
			'dynamic_sidebar_params',
			function( $params ) {
				if ( 'front-page-bottom-widget-area' !== $params[0]['id'] ) {
					return $params;
				}

				$wp_page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
				if ( ! $wp_page_template || 'default' === $wp_page_template || false !== strpos( $wp_page_template, 'one-column-full.php' ) ) {
					$params[0]['before_widget'] .= '<div class="c-container">';
					$params[0]['after_widget']  .= '</div>';
				}

				return $params;
			}
		);
	}
);

/**
 * Add home page widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Posts page (Top of page)', 'snow-monkey' ),
				'id'            => 'posts-page-top-widget-area',
				'description'   => __( 'These widgets are displayed in the posts page.', 'snow-monkey' ),
				'before_widget' => '<div class="l-posts-page-widget-area__item"><div id="%1$s" class="c-section %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="c-section__title">',
				'after_title'   => '</h2>',
			]
		);

		add_filter(
			'dynamic_sidebar_params',
			function( $params ) {
				if ( 'posts-page-top-widget-area' !== $params[0]['id'] ) {
					return $params;
				}

				$wp_page_template = get_theme_mod( 'archive-post-layout' );
				if ( ! $wp_page_template || 'default' === $wp_page_template || false !== strpos( $wp_page_template, 'one-column-full.php' ) ) {
					$params[0]['before_widget'] .= '<div class="c-container">';
					$params[0]['after_widget']  .= '</div>';
				}

				return $params;
			}
		);
	}
);

/**
 * Add home page widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Posts page (Bottom of page)', 'snow-monkey' ),
				'id'            => 'posts-page-bottom-widget-area',
				'description'   => __( 'These widgets are displayed in the posts page.', 'snow-monkey' ),
				'before_widget' => '<div class="l-posts-page-widget-area__item"><div id="%1$s" class="c-section %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="c-section__title">',
				'after_title'   => '</h2>',
			]
		);

		add_filter(
			'dynamic_sidebar_params',
			function( $params ) {
				if ( 'posts-page-bottom-widget-area' !== $params[0]['id'] ) {
					return $params;
				}

				$wp_page_template = get_theme_mod( 'archive-post-layout' );
				if ( ! $wp_page_template || 'default' === $wp_page_template || false !== strpos( $wp_page_template, 'one-column-full.php' ) ) {
					$params[0]['before_widget'] .= '<div class="c-container">';
					$params[0]['after_widget']  .= '</div>';
				}

				return $params;
			}
		);
	}
);

/**
 * Add footer widget area
 *
 * @return void
 */
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Footer', 'snow-monkey' ),
				'id'            => 'footer-widget-area',
				'description'   => __( 'These widgets are displayed in the footer.', 'snow-monkey' ),
				'before_widget' => '<div class="l-footer-widget-area__item c-row__col c-row__col--1-1 c-row__col--md-1-1 c-row__col--lg-1-1"><div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
* Add overlay widget area
*
* @return void
*/
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Overlay', 'snow-monkey' ),
				'id'            => 'overlay-widget-area',
				'description'   => __( 'These widgets are displayed in the overlay that opens with clicking #sm-overlay-widget-area.', 'snow-monkey' ),
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
* Add top of article widget area
*
* @return void
*/
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Top of the article', 'snow-monkey' ),
				'description'   => __( 'These widgets are displayed top of the article on posts and pages.', 'snow-monkey' ),
				'id'            => 'article-top-widget-area',
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
* Add bottom of article widget area
*
* @return void
*/
add_action(
	'widgets_init',
	function() {
		register_sidebar(
			[
				'name'          => __( 'Bottom of the article', 'snow-monkey' ),
				'description'   => __( 'These widgets are displayed bottom of the article on posts and pages.', 'snow-monkey' ),
				'id'            => 'article-bottom-widget-area',
				'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="c-widget__title">',
				'after_title'   => '</h2>',
			]
		);
	}
);

/**
 * Enqueue scripts
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_script(
			Helper::get_main_script_handle() . '-widgets',
			get_theme_file_uri( '/assets/js/widgets.js' ),
			[],
			filemtime( get_theme_file_path( '/assets/js/widgets.js' ) ),
			true
		);

		if ( Helper::is_active_sidebar( 'sidebar-sticky-widget-area' ) ) {
			wp_enqueue_script(
				Helper::get_main_script_handle() . '-sidebar-sticky-widget-area',
				get_theme_file_uri( '/assets/js/sidebar-sticky-widget-area.js' ),
				[],
				filemtime( get_theme_file_path( '/assets/js/sidebar-sticky-widget-area.js' ) ),
				true
			);
		}
	}
);
