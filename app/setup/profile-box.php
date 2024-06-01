<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.4.6
 */

use Inc2734\WP_Profile_Box\Bootstrap;

new Bootstrap();

add_filter(
	'inc2734_wp_profile_box_sns_accounts',
	function ( $accounts ) {
		foreach ( $accounts as $service => $label ) {
			switch ( $service ) {
				case 'url':
					$label = '<i class="fa-solid fa-globe"></i>' . $label;
					break;
				case 'twitter':
					$label = '<i class="fa-brands fa-twitter"></i>' . $label;
					break;
				case 'x':
					$label = '<i class="fa-brands fa-x-twitter"></i>' . $label;
					break;
				case 'facebook':
					$label = '<i class="fa-brands fa-facebook"></i>' . $label;
					break;
				case 'instagram':
					$label = '<i class="fa-brands fa-instagram"></i>' . $label;
					break;
				case 'pinterest':
					$label = '<i class="fa-brands fa-pinterest"></i>' . $label;
					break;
				case 'youtube':
					$label = '<i class="fa-brands fa-youtube"></i>' . $label;
					break;
				case 'linkedin':
					$label = '<i class="fa-brands fa-linkedin"></i>' . $label;
					break;
				case 'WordPress':
					$label = '<i class="fa-brands fa-wordpress"></i>' . $label;
					break;
				case 'tumblr':
					$label = '<i class="fa-brands fa-tumblr"></i>' . $label;
					break;
				case 'amazon':
					$label = '<i class="fa-brands fa-amazon"></i>' . $label;
					break;
				case 'line':
					$label = '<i class="fa-brands fa-line"></i>' . $label;
					break;
			}
			$accounts[ $service ] = $label;
		}
		return $accounts;
	}
);
