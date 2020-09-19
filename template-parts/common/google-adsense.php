<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 *
 * renamed: template-parts/google-adsense.php
 */

use Inc2734\WP_Adsense;
use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_code'     => get_option( 'mwt-google-adsense' ),
		'_position' => null,
	]
);

$args['_code'] = apply_filters( 'snow_monkey_google_adsense', $args['_code'], $args['_position'] );

if ( ! $args['_code'] ) {
	return;
}

if ( ! preg_match( '/<ins /s', $args['_code'] ) ) {
	return;
}
?>

<div class="c-google-adsense">
	<?php WP_Adsense\Helper::the_adsense_code( $args['_code'] ); ?>
</div>
