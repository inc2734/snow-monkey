<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

$google_adsense = apply_filters( 'snow_monkey_google_adsense', get_option( 'mwt-google-adsense' ), $position );

if ( ! $google_adsense ) {
	return;
}

if ( ! preg_match( '/<ins /s', $google_adsense ) ) {
	return;
}
?>

<div class="c-google-adsense">
	<?php Helper\display_adsense_code( $google_adsense ); ?>
</div>
