<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$google_adsense = apply_filters( 'snow_monkey_google_adsense', get_option( 'mwt-google-adsense' ), $position );

if ( ! $google_adsense ) {
	return;
}

if ( ! preg_match( '/<ins /s', $google_adsense ) ) {
	return;
}
?>

<div class="c-google-adsense">
	<?php \Inc2734\WP_Awesome_Widgets\inc2734_wpaw_display_adsense_code( $google_adsense ); ?>
</div>
