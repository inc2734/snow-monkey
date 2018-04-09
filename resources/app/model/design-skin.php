<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\app\model;

class Design_Skin {

	/**
	 * Prefix of design skin slug
	 *
	 * @var string
	 */
	protected $design_skin_prefix = 'snow-monkey-design-skin-';

	public function __construct() {
		$this->_set_design_skin_selector_choices();

		add_action( 'customize_controls_enqueue_scripts', [ $this, '_load_customize_control_script' ] );
		add_action( 'wp_loaded', [ $this, '_load_bootstrap' ] );
	}

	/**
	 * Set design skin selector choices in customizer
	 *
	 * @return void
	 */
	protected function _set_design_skin_selector_choices() {
		$active_plugins = get_option( 'active_plugins' );
		foreach ( $active_plugins as $plugin ) {
			if ( 0 !== strpos( $plugin, $this->design_skin_prefix ) ) {
				continue;
			}

			$plugin_data = $this->_get_plugin_data( $plugin );

			add_filter( 'snow_monkey_design_skin_choices', function( $choices ) use ( $plugin_data ) {
				$choices[ dirname( $plugin_data['path'] ) ] = $plugin_data['label'];
				return $choices;
			} );
		}
	}

	/**
	 * Load script for customizer
	 *
	 * @return void
	 */
	public function _load_customize_control_script() {
		$relative_path = '/assets/js/customize-control.min.js';
		$src  = get_theme_file_uri( $relative_path );
		$path = get_theme_file_path( $relative_path );

		if ( ! file_exists( $path ) ) {
			return;
		}

		wp_enqueue_script( get_template() . '-customize-preview', $src, [], filemtime( $path ), true );
	}

	/**
	 * Load design skin bootstrap
	 *
	 * @return void
	 */
	public function _load_bootstrap() {
		$design_skin    = get_theme_mod( 'design-skin' );
		$bootstrap_path = trailingslashit( WP_PLUGIN_DIR ) . $design_skin . '/bootstrap.php';
		if ( file_exists( $bootstrap_path ) ) {
			include( $bootstrap_path );
		}
	}

	/**
	 * Return plugin data
	 *
	 * @param  string $plugin plugin slug
	 * @return array
	 */
	protected function _get_plugin_data( $plugin ) {
		$plugin_data = get_file_data(
			trailingslashit( WP_PLUGIN_DIR ) . $plugin,
			[
				'label' => 'Plugin Name',
			],
			'plugin'
		);

		$plugin_data = array_merge( $plugin_data, [
			'path'  => $plugin,
		] );

		return $plugin_data;
	}
}
