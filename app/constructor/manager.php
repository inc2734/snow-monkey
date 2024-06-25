<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.9
 */

use Framework\Controller\Manager;

if ( ! class_exists( '\Inc2734\WP_GitHub_Theme_Updater\Bootstrap' ) ) {
	return;
}

new Manager();

/**
 * Admin notice
 */
add_action(
	'admin_notices',
	function () {
		$screen = get_current_screen();
		if ( ! $screen || 'post' === $screen->id ) {
			return;
		}

		$license_status = Manager::get_license_status( Manager::get_option( 'license-key' ) );
		if ( 'true' === $license_status ) {
			return;
		}

		$xserver_register_status = Manager::get_xserver_register_status( Manager::get_option( 'xserver-register-key' ) );
		if ( 'true' === $xserver_register_status ) {
			return;
		}

		if ( new DateTime( '2024-08-01' ) <= new DateTime( wp_date( 'Y-m-d', null, new DateTimeZone( 'Asia/Tokyo' ) ) ) ) {
			$message = sprintf(
				// translators: %1$s: a start tag, %2$s: a end tag, %3$s: a start tag, %4$s: a end tag.
				__( 'You have not set a valid license key. Setting a license key will allow you to use patterns registered in %3$the pattern library%4$ and update the Snow Monkey theme. If you do not update your theme, you risk the site not displaying properly or leaving vulnerabilities open. A license key is issued when you subscribe to %1$sSnow Monkey subscription%2$s. The license key can be set %5$shere%6$s.', 'snow-monkey' ),
				'<a href="https://snow-monkey.2inc.org/product/snow-monkey/" target="_blank" rel="noreferrer">',
				'</a>',
				'<a href="https://snow-monkey.2inc.org/snow-monkey-patterns/" target="_blank" rel="noreferrer">',
				'</a>',
				'<a href="' . admin_url( 'options-general.php?page=snow-monkey' ) . '">',
				'</a>',
			);
		} else {
			$message = sprintf(
				// translators: %1$s: a start tag, %2$s: a end tag, %3$s: a start tag, %4$s: a end tag.
				__( 'You have not set a valid license key. Setting a license key will allow you to use patterns registered in %3$the pattern library%4$. A license key is issued when you subscribe to %1$sSnow Monkey subscription%2$s. The license key is set %5$shere%6$s.', 'snow-monkey' ),
				'<a href="https://snow-monkey.2inc.org/product/snow-monkey/" target="_blank" rel="noreferrer">',
				'</a>',
				'<a href="https://snow-monkey.2inc.org/snow-monkey-patterns/" target="_blank" rel="noreferrer">',
				'</a>',
				'<a href="' . admin_url( 'options-general.php?page=snow-monkey' ) . '">',
				'</a>',
			);
		}

		wp_admin_notice(
			$message,
			array(
				'type'        => 'error',
				'dismissible' => false,
			)
		);
	}
);
