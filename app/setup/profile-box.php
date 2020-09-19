<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Inc2734\WP_Profile_Box\Bootstrap;

new Bootstrap();

add_filter(
	'inc2734_wp_profile_box_sns_accounts',
	function( $accounts ) {
		foreach ( $accounts as $service => $label ) {
			switch ( $service ) {
				case 'url':
					$label = '<i class="fas fa-globe"></i>' . $label;
					break;
				case 'twitter':
					$label = '<i class="fab fa-twitter"></i>' . $label;
					break;
				case 'facebook':
					$label = '<i class="fab fa-facebook"></i>' . $label;
					break;
				case 'instagram':
					$label = '<i class="fab fa-instagram"></i>' . $label;
					break;
				case 'pinterest':
					$label = '<i class="fab fa-pinterest"></i>' . $label;
					break;
				case 'youtube':
					$label = '<i class="fab fa-youtube"></i>' . $label;
					break;
				case 'linkedin':
					$label = '<i class="fab fa-linkedin"></i>' . $label;
					break;
				case 'wordpress':
					$label = '<i class="fab fa-wordpress"></i>' . $label;
					break;
				case 'tumblr':
					$label = '<i class="fab fa-tumblr"></i>' . $label;
					break;
				case 'amazon':
					$label = '<i class="fab fa-amazon"></i>' . $label;
					break;
				case 'line':
					$label = '<i class="fab fa-line"></i>' . $label;
					break;
			}
			$accounts[ $service ] = $label;
		}
		return $accounts;
	}
);
