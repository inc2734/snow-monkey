<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

namespace Framework\Controller;

use Inc2734\WP_View_Controller;

/**
 * Add filter hook to WP_View_Controller\Bootstrap
 */
class Controller extends WP_View_Controller\Bootstrap {

	/**
	 * constructor
	 */
	public function __construct() {
		parent::__construct();

		add_filter(
			'inc2734_wp_view_controller_layout',
			function( $layout ) {
				return apply_filters( 'snow_monkey_layout', $layout );
			}
		);

		add_filter(
			'inc2734_wp_view_controller_view',
			function( $view ) {
				return apply_filters( 'snow_monkey_view', $view );
			}
		);
	}
}
