<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

if ( ! has_nav_menu( 'footer-sub-nav' ) ) {
	return;
}
?>

<div class="p-footer-sub-nav c-sub-nav" role="navigation">
	<?php
	wp_nav_menu(
		[
			'theme_location'  => 'footer-sub-nav',
			'container'       => 'div',
			'container_class' => 'c-container',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'menu_class'      => 'c-navbar c-navbar--center',
			'depth'           => 1,
			'walker'          => new \Inc2734\WP_Basis\App\Walker\Navbar(),
		]
	);
	?>
</div>
