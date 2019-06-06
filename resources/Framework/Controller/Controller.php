<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

namespace Framework\Controller;

use Inc2734\Mimizuku_Core;

/**
 * Add filter hook to WP_View_Controller\Bootstrap
 */
class Controller extends Mimizuku_Core\App\Controller\Controller {

	/**
	 * Rendering the page
	 *
	 * @param string $view view template path
	 * @param string $view_suffix view template suffix
	 * @return void
	 */
	public static function render( $view, $view_suffix = '' ) {
		add_filter(
			'mimizuku_view',
			function( $view ) {
				return apply_filters( 'snow_monkey_view', $view );
			}
		);

		parent::render( $view, $view_suffix );
	}

	/**
	 * Sets the layout template
	 *
	 * @param string $layout layout template path
	 * @return void
	 */
	public static function layout( $layout ) {
		add_filter(
			'mimizuku_layout',
			function( $layout ) {
				return apply_filters( 'snow_monkey_layout', $layout );
			}
		);

		parent::layout( $layout );
	}
}
