<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$translation_dir = __DIR__ . '/../translation';
$wrappers_dir    = __DIR__ . '/../templates/layout/wrapper';
$headers_dir     = __DIR__ . '/../templates/layout/header';

$bundle_file = $translation_dir . '/bundle-template-header.php';
if ( file_exists( $bundle_file ) ) {
	unlink( $bundle_file );
}
file_put_contents( $bundle_file, "<?php\n", FILE_APPEND | LOCK_EX );

$wrappers = glob( $wrappers_dir . '/*.php' );
foreach ( $wrappers as $wrapper ) {
	$data = file_get_contents( $wrapper );
	if ( ! preg_match( '|Name:(.*)$|mi', $data, $matches ) ) {
		continue;
	}
	$name = trim( $matches[1] );

	file_put_contents( $bundle_file, "__( '{$name}', 'snow-monkey' );\n", FILE_APPEND | LOCK_EX );
}

$headers = glob( $headers_dir . '/*.php' );
foreach ( $headers as $header ) {
	$data = file_get_contents( $header );
	if ( ! preg_match( '|Name:(.*)$|mi', $data, $matches ) ) {
		continue;
	}
	$name = trim( $matches[1] );

	file_put_contents( $bundle_file, "__( '{$name}', 'snow-monkey' );\n", FILE_APPEND | LOCK_EX );
}
