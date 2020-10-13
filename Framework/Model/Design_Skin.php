<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 */

namespace Framework\Model;

use Framework\Helper;

class Design_Skin {

	/**
	 * Design skin main file path
	 *
	 * @var string
	 */
	protected $file;

	/**
	 * Options
	 *
	 * @var array
	 *   string style
	 *   string editor-style
	 *   string customize-control-script
	 */
	protected $options;

	/**
	 * Plugin data
	 *
	 * @var array
	 *   string label
	 *   string slug
	 */
	protected $plugin;

	/**
	 * Constructor.
	 *
	 * @param string $file Design skin main file path.
	 * @param array  $options Options.
	 */
	public function __construct( $file, $options = [] ) {
		$this->file = $file;

		$this->options = shortcode_atts(
			[
				'style'                    => 'design-skin.css',
				'editor-style'             => 'editor-style.css',
				'gutenberg-style'          => 'gutenberg.css',
				'customize-control-script' => 'customize-control.js',
			],
			$options
		);

		$this->plugin = $this->_get_plugin_data();

		add_action( 'wp_loaded', [ $this, '_load_bootstrap' ] );
		add_action( 'wp_enqueue_scripts', [ $this, '_load_style' ], 100 );
		add_filter( 'mce_css', [ $this, '_load_editor_style' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, '_load_gutenberg_style' ] );
		add_action( 'customize_controls_enqueue_scripts', [ $this, '_load_customize_script' ] );
	}

	/**
	 * Load design skin bootstrap
	 *
	 * @return void
	 */
	public function _load_bootstrap() {
		if ( ! $this->_is_active() ) {
			return;
		}

		$bootstrap_path = dirname( $this->file ) . '/bootstrap.php';
		if ( ! file_exists( $bootstrap_path ) ) {
			return;
		}

		include( $bootstrap_path );
	}

	/**
	 * Load design skin style
	 *
	 * @return void
	 */
	public function _load_style() {
		if ( ! $this->_is_active() ) {
			return;
		}

		$relative_path = $this->options['style'];
		$file_path     = trailingslashit( dirname( $this->file ) ) . $relative_path;

		if ( ! file_exists( $file_path ) ) {
			return;
		}

		$file_url = plugins_url( $relative_path, $this->file );

		$handles = [];
		$queue   = wp_styles()->queue;
		foreach ( $queue as $handle ) {
			if ( 0 === strpos( $handle, 'snow-monkey' ) ) {
				$handles[ $handle ] = $handle;
			}
		}
		$dependencies = Helper::generate_style_dependencies( $handles );

		wp_enqueue_style(
			$this->plugin['slug'],
			$file_url,
			$dependencies,
			filemtime( $file_path )
		);
	}

	/**
	 * Load editor style
	 *
	 * @param string $mce_css Comma-delimited list of stylesheets.
	 * @return string
	 */
	public function _load_editor_style( $mce_css ) {
		if ( ! $this->_is_active() ) {
			return $mce_css;
		}

		$relative_path = $this->options['editor-style'];
		$file_path     = trailingslashit( dirname( $this->file ) ) . $relative_path;

		if ( ! file_exists( $file_path ) ) {
			return $mce_css;
		}

		if ( empty( $mce_css ) ) {
			return $mce_css;
		}

		$file_url = plugins_url( $relative_path, $this->file );
		$mce_css .= ',';
		$mce_css .= $file_url;

		return $mce_css;
	}

	/**
	 * Load design skin style
	 *
	 * @return void
	 */
	public function _load_gutenberg_style() {
		if ( ! $this->_is_active() ) {
			return;
		}

		$relative_path = $this->options['gutenberg-style'];
		$file_path     = trailingslashit( dirname( $this->file ) ) . $relative_path;
		if ( ! file_exists( $file_path ) ) {
			return;
		}

		$file_url = plugins_url( $relative_path, $this->file );

		$handles = [];
		$queue   = wp_styles()->queue;
		foreach ( $queue as $handle ) {
			if ( 0 === strpos( $handle, 'snow-monkey' ) ) {
				$handles[ $handle ] = $handle;
			}
		}
		$dependencies = Helper::generate_style_dependencies( $handles );

		wp_enqueue_style(
			$this->plugin['slug'],
			$file_url,
			$dependencies,
			filemtime( $file_path )
		);
	}

	/**
	 * Load customize script
	 *
	 * @return void
	 */
	public function _load_customize_script() {
		if ( ! $this->_is_active() ) {
			return;
		}

		$relative_path = $this->options['customize-control-script'];
		$file_path     = trailingslashit( dirname( $this->file ) ) . $relative_path;
		if ( ! file_exists( $file_path ) ) {
			return;
		}

		$file_url = plugins_url( $relative_path, $this->file );

		wp_enqueue_script(
			$this->plugin['slug'] . '-customize-preview',
			$file_url,
			[ 'jquery' ],
			filemtime( $file_path ),
			true
		);
	}

	/**
	 * Return plugin data
	 *
	 * @return array
	 */
	protected function _get_plugin_data() {
		$plugin_data = get_file_data(
			$this->file,
			[
				'label' => 'Plugin Name',
			],
			'plugin'
		);

		$plugin_data = array_merge(
			$plugin_data,
			[
				'slug' => basename( $this->file, '.php' ),
			]
		);

		return $plugin_data;
	}

	/**
	 * Return true when the design skin is active
	 *
	 * @return boolean
	 */
	protected function _is_active() {
		if ( is_user_logged_in() && current_user_can( 'manage_options' ) && ! is_admin() ) {
			if ( ! empty( $_GET['snow-monkey-design-skin'] ) && $this->plugin['slug'] === $_GET['snow-monkey-design-skin'] ) {
				$design_skin = sanitize_text_field( wp_unslash( $_GET['snow-monkey-design-skin'] ) );

				add_filter(
					'theme_mod_design-skin',
					function() use ( $design_skin ) {
						return $design_skin;
					}
				);

				return true;
			}
		}

		if ( get_theme_mod( 'design-skin' ) === $this->plugin['slug'] ) {
			return true;
		}

		return false;
	}
}
