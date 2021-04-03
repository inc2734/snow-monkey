<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

require_once( './wp-load.php' );

switch_theme( 'snow-monkey' );

$theme = wp_get_theme( get_template() );
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	throw new Exception( 'generate-load-files-target: This is not the snow monkey theme. The currently enabled theme is ' . get_stylesheet() . '.' );
}

/**
 * Generate json file for Helper::load_files().
 *
 * @param string  $directory_slug     The directory slug.
 * @param boolean $exclude_underscore Return true if exclude underscore.
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

	$bundle_file = $save_dir . DIRECTORY_SEPARATOR . sha1( $directory_slug ) . '.json';
	if ( file_exists( $bundle_file ) ) {
		unlink( $bundle_file );
	}

	if ( ! $files ) {
		return false;
	}

	$byte = file_put_contents( $bundle_file, json_encode( $files ), FILE_APPEND | LOCK_EX );
	if ( false === $byte ) {
		throw new Exception( 'generate-load-files-target: Failed to write.' );
	}
}

generate_load_files_target( 'app/setup', true );
generate_load_files_target( 'app/widget', true );
generate_load_files_target( 'app/customizer', true );
generate_load_files_target( 'assets/css/foundation' );
generate_load_files_target( 'assets/css/layout' );
generate_load_files_target( 'assets/css/object/component' );
generate_load_files_target( 'assets/css/object/project' );
generate_load_files_target( 'assets/css/custom-widgets' );
generate_load_files_target( 'assets/css/dependency/contact-form-7' );
generate_load_files_target( 'assets/css/dependency/snow-monkey-blocks' );
generate_load_files_target( 'assets/css/dependency/snow-monkey-forms' );
generate_load_files_target( 'assets/css/dependency/woocommerce' );
