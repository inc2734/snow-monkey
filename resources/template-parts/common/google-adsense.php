<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

use Framework\Helper;

$code     = Helper::get_var( $_code, get_option( 'mwt-google-adsense' ) );
$position = Helper::get_var( $_position, null );

$code = apply_filters( 'snow_monkey_google_adsense', $code, $position );

if ( ! $code ) {
	return;
}

if ( ! preg_match( '/<ins /s', $code ) ) {
	return;
}
?>

<div class="c-google-adsense">
	<?php Helper::display_adsense_code( $code ); ?>
</div>
