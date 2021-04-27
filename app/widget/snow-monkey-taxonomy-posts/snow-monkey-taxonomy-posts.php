<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 */

use Inc2734\WP_Awesome_Widgets\App\Contract\Widget as Abstract_Widget;

if ( ! class_exists( '\Inc2734\WP_Awesome_Widgets\App\Contract\Widget' ) ) {
	return;
}

class Snow_Monkey_Taxonomy_Posts_Widget extends Abstract_Widget {

	/**
	 * @var array
	 */
	protected $_defaults = [
		'title'               => '',
		'taxonomy'            => null,
		'posts-per-page'      => 12,
		'layout'              => 'rich-media',
		'item-title-tag'      => 'h3',
		'item-thumbnail-size' => 'medium_large',
		'display-item-meta'   => null,
		'display-item-terms'  => null,
		'link-text'           => null,
		'link-url'            => null,
		'ignore-sticky-posts' => 1,
		'force-sm-1col'       => 0,
		'arrows'              => false,
		'dots'                => true,
		'interval'            => 0,
	];

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			false,
			__( 'Snow Monkey: Taxonomy posts', 'snow-monkey' ),
			[
				'customize_selective_refresh' => true,
			]
		);

		$this->_defaults['title'] = __( 'Taxonomy posts', 'snow-monkey' );
	}

	/**
	 * This function should check that $new_instance is set correctly.
	 * The newly-calculated value of $instance should be returned. If false is returned, the instance won’t be saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array
	 */
	public function update(
		$new_instance,
		// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		$old_instance
		// phpcs:enable
	) {
		$new_instance = shortcode_atts( $this->_defaults, $new_instance );
		return $new_instance;
	}
}

add_action(
	'widgets_init',
	function() {
		register_widget( 'Snow_Monkey_Taxonomy_Posts_Widget' );
	}
);
