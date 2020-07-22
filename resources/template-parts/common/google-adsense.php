<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/google-adsense.php
 */

use Inc2734\WP_Adsense;
use Framework\Helper;

$template_args = [
	'code'     => Helper::get_var( $args['_code'], get_option( 'mwt-google-adsense' ) ),
	'position' => Helper::get_var( $args['_position'], null ),
];

$template_args['code'] = apply_filters( 'snow_monkey_google_adsense', $template_args['code'], $template_args['position'] );

if ( ! $template_args['code'] ) {
	return;
}

if ( ! preg_match( '/<ins /s', $template_args['code'] ) ) {
	return;
}
?>

<div class="c-google-adsense">
	<?php WP_Adsense\Helper::the_adsense_code( $template_args['code'] ); ?>
</div>
