<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

require_once( './wp-load.php' );

$theme = wp_get_theme( get_template() );
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	throw new Exception( 'generate-load-files-target: This is not the snow monkey theme. The currently enabled theme is ' . get_stylesheet() . '.' );
}

/**
 * Generate php file for Helper::load_files().
 *
 * @param string  $directory_slug     The directory slug.
 * @param boolean $exclude_underscore Return true if exclude underscore.
 * @throws Exception If the write operation fails.
 */
function generate_load_files_target( $directory_slug, $exclude_underscore = false ) {
	if ( ! $directory_slug ) {
		return false;
	}

	$template_directory = get_template_directory();
	$directory_slug     = ltrim( $directory_slug, DIRECTORY_SEPARATOR );
	$directory          = $template_directory . DIRECTORY_SEPARATOR . $directory_slug;
	$files              = Helper::get_files( $directory, $exclude_underscore );

	$save_dir = $template_directory . '/assets/load-files-target';
	if ( ! file_exists( $save_dir ) ) {
		wp_mkdir_p( $save_dir );
	}
	if ( ! is_writable( $save_dir ) ) {
		throw new Exception( 'generate-load-files-target: The directory isn\'t writable. ' . print_r( stat( $save_dir ), true ) );
	}

	$bundle_file = $save_dir . DIRECTORY_SEPARATOR . sha1( $directory_slug ) . '.php';
	if ( file_exists( $bundle_file ) ) {
		unlink( $bundle_file );
	}

	if ( ! $files ) {
		return false;
	}

	$files = array_map(
		function( $file ) use ( $template_directory ) {
			return str_replace( $template_directory, '', $file );
		},
		$files
	);

	file_put_contents(
		$bundle_file,
		"<?php\n\$template_directory = get_template_directory();\nreturn [\n",
		FILE_APPEND | LOCK_EX
	);
	foreach ( $files as $file ) {
		file_put_contents(
			$bundle_file,
			"\$template_directory . '" . $file . "',\n",
			FILE_APPEND | LOCK_EX
		);
	}
	file_put_contents(
		$bundle_file,
		"];\n",
		FILE_APPEND | LOCK_EX
	);

	if ( ! file_exists( $bundle_file ) || ! file_get_contents( $bundle_file ) ) {
		throw new Exception( 'generate-load-files-target: Failed to write. ' . print_r( stat( $bundle_file ), true ) );
	}
	error_log( 'Wrote ' . $bundle_file . PHP_EOL );
}

generate_load_files_target( 'app/setup', true );
generate_load_files_target( 'app/widget', true );
generate_load_files_target( 'app/customizer', true );
generate_load_files_target( 'assets/css/app/foundation' );
generate_load_files_target( 'assets/css/app/layout' );
generate_load_files_target( 'assets/css/app/object/component' );
generate_load_files_target( 'assets/css/app/object/project' );
generate_load_files_target( 'assets/css/custom-widgets' );
generate_load_files_target( 'assets/css/dependency/contact-form-7' );
generate_load_files_target( 'assets/css/dependency/snow-monkey-blocks' );
generate_load_files_target( 'assets/css/dependency/snow-monkey-forms' );
generate_load_files_target( 'assets/css/dependency/woocommerce' );
