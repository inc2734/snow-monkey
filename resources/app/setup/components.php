<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

/*
use Inc2734\WP_Awesome_Components\Awesome_Components;

if ( class_exists( 'Awesome_Components' ) ) {
	return;
}

new Awesome_Components();
*/

include_once( get_theme_file_path( '/../vendor/inc2734/wp-awesome-components/src/wp-awesome-components.php' ) );
new Inc2734_WP_Awesome_Components();
