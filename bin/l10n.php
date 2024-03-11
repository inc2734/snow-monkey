<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

require_once( './wp-load.php' );

$mo_files = glob( __DIR__ . '/../languages/*.mo' );
foreach ( $mo_files as $mo_file ) {
	$mo = \WP_Translation_File::transform( $mo_file, 'php' );
	if ( $mo ) {
		file_put_contents( path_join( dirname( $mo_file ), basename( $mo_file, '.mo' ) ) . '.l10n.php', $mo );
	}
}
