<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Returns array of page templates for layout selector in customizer
 *
 * @return array
 *           @var string Template slug  e.g. right-sidebar
 *           @var string Template name  e.g. Right Sidebar
 */
function snow_monkey_get_page_templates() {
	static $wrappers = [];
	if ( $wrappers ) {
		return $wrappers;
	}

	$page_templates = new Snow_Monkey_Page_Templates();
	$wrappers = $page_templates->get();
	return $wrappers;
}

class Snow_Monkey_Page_Templates {
	/**
	 * Available wrapper templates
	 *
	 * @var array
	 */
	protected $wrappers = [];

	/**
	 * Wrapper templates
	 *
	 * @var array
	 */
	protected $wrapper_files = [];

	/**
	 * Page templates
	 *
	 * @var array
	 */
	protected $page_template_files = [];

	public function __construct() {
		$this->wrapper_files = $this->_get_wrapper_files();
		$this->page_template_files = $this->_get_page_template_files();
	}

	/**
	 * Return available wrapper templates name
	 *
	 * @return array
	 */
	public function get() {
		foreach ( $this->page_template_files as $name => $page_template_path ) {
			if ( isset( $this->wrappers[ $name ] ) ) {
				continue;
			}

			if ( ! isset( $this->wrapper_files[ $name ] ) ) {
				continue;
			}

			$label = $this->_get_template_label( $page_template_path );
			if ( ! $label ) {
				continue;
			}

			// @codingStandardsIgnoreStart
			$this->wrappers[ $name ] = __( $label, 'snow-monkey' );
			// @codingStandardsIgnoreEnd
		}

		return $this->wrappers;
	}

	/**
	 * Return page template label
	 *
	 * @param string $path Page template path
	 * @return string
	 */
	protected function _get_template_label( $path ) {
		$page_template_data = get_file_data(
			$path,
			[
				'template-name' => 'Template Name',
			]
		);

		if ( empty( $page_template_data['template-name'] ) ) {
			return;
		}

		return $page_template_data['template-name'];
	}

	/**
	 * Return wrapper templates path
	 *
	 * @return array
	 */
	protected function _get_wrapper_files() {
		$wrapper_files = [];

		foreach ( wpvc_config( 'layout' ) as $wrapper_dir ) {
			foreach ( glob( get_theme_file_path( $wrapper_dir . '/*' ) ) as $wrapper_path ) {
				$name = basename( $wrapper_path, '.php' );
				if ( 'blank' === $name || 'blank-fluid' === $name ) {
					continue;
				}
				if ( isset( $wrapper_files[ $name ] ) ) {
					continue;
				}
				$wrapper_files[ $name ] = $wrapper_path;
			}
		}

		return $wrapper_files;
	}

	/**
	 * Return page templates path
	 *
	 * @return array
	 */
	protected function _get_page_template_files() {
		$page_template_files = [];

		foreach ( wpvc_config( 'page-templates' ) as $page_template_dir ) {
			foreach ( glob( get_theme_file_path( $page_template_dir . '/*' ) ) as $page_template_path ) {
				$name = basename( $page_template_path, '.php' );
				if ( 'blank' === $name || 'blank-fluid' === $name ) {
					continue;
				}
				if ( isset( $page_template_files[ $name ] ) ) {
					continue;
				}
				$page_template_files[ $name ] = $page_template_path;
			}
		}

		return $page_template_files;
	}
}
