<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.0
 */

if ( ! class_exists( 'Inc2734_WP_Awesome_Widgets_Abstract_Widget' ) ) {
	return;
}

/**
 * Snow_Monkey_RSS_Widget
 */
class Snow_Monkey_RSS_Widget extends Inc2734_WP_Awesome_Widgets_Abstract_Widget {

	/**
	 * @var array
	 */
	protected $_defaults = [
		'feed-url'       => null,
		'title'          => '',
		'posts-per-page' => 12,
		'layout'         => 'rich-media',
		'item-title-tag' => 'h3',
		'link-text'      => null,
		'link-url'       => null,
	];

	public function __construct() {
		parent::__construct(
			false,
			__( 'Snow Monkey: RSS', 'snow-monkey' ),
			[
				'customize_selective_refresh' => true,
			]
		);

		$this->_defaults['title'] = __( 'RSS', 'snow-monkey' );
	}

	public function update( $new_instance, $old_instance ) {
		$new_instance = shortcode_atts( $this->_defaults, $new_instance );
		return $new_instance;
	}
}

add_action(
	'widgets_init',
	function() {
		register_widget( 'Snow_Monkey_RSS_Widget' );
	}
);
