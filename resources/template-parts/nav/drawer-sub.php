<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 */

if ( ! has_nav_menu( 'drawer-sub-nav' ) ) {
	return;
}
?>

<div class="p-drawer-sub-nav c-drawer__sub-nav">
	<?php
	wp_nav_menu(
		[
			'theme_location' => 'drawer-sub-nav',
			'container'      => false,
			'menu_class'     => 'c-drawer__menu',
			'depth'          => 1,
			'walker'         => new \Inc2734\WP_Basis\App\Walker\Drawer(),
		]
	);
	?>
</div>
