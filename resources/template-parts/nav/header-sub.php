<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.0.0
 *
 * renamed: template-parts/header-sub-nav.php
 */

if ( ! has_nav_menu( 'header-sub-nav' ) ) {
	return;
}
?>

<div class="p-header-sub-nav c-sub-nav" role="navigation">
	<?php
	wp_nav_menu(
		[
			'theme_location' => 'header-sub-nav',
			'container'      => false,
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'menu_class'     => 'c-navbar c-navbar--right',
			'depth'          => 1,
			'walker'         => new \Inc2734\WP_Basis\App\Walker\Navbar(),
		]
	);
	?>
</div>
