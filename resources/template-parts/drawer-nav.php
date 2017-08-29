<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! has_nav_menu( 'drawer-nav' ) ) {
	return;
}
?>

<nav id="drawer-nav" class="c-drawer c-drawer--fixed" role="navigation" aria-hidden="true" aria-labelledby="hamburger-btn">
	<?php
	wp_nav_menu( [
		'theme_location' => 'drawer-nav',
		'container'      => false,
		'menu_class'     => 'c-drawer__menu',
		'depth'          => 0,
	] );
	?>
</nav>
