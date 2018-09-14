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
	$wrappers = [];

	foreach ( wpvc_config( 'layout' ) as $wrapper_dirs ) {
		foreach ( glob( get_theme_file_path( $wrapper_dirs . '/*' ) ) as $file ) {
			$name = rtrim( basename( $file ), '.php' );
			if ( 'blank' === $name || 'blank-fluid' === $name || 'wrapper' === $name ) {
				continue;
			}

			$page_template_path = null;
			$template_name = wpvc_locate_template( (array) wpvc_config( 'page-templates' ), $name );
			if ( $template_name ) {
				$page_template_path = get_theme_file_path( $template_name . '.php' );

				$page_template_data = get_file_data(
					$page_template_path,
					[
						'template-name' => 'Template Name',
					]
				);
			}

			$template_name = $name;
			if ( ! empty( $page_template_data ) && ! empty( $page_template_data['template-name'] ) ) {
				$template_name = $page_template_data['template-name'];
			}

			// @codingStandardsIgnoreStart
			$wrappers[ $name ] = __( $template_name, 'snow-monkey' );
			// @codingStandardsIgnoreEnd
		}
	}

	return $wrappers;
}
