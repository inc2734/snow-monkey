<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 8.0.0
 *
 * renamed: template-parts/footer-sticky-nav.php
 */

if ( ! has_nav_menu( 'footer-sticky-nav' ) ) {
	return;
}
?>

<nav class="p-footer-sticky-nav" id="footer-sticky-nav" role="navigation" aria-hidden="false">
	<?php
	wp_nav_menu(
		[
			'theme_location' => 'footer-sticky-nav',
			'container'      => false,
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'menu_class'     => 'c-navbar',
			'depth'          => 1,
			'walker'         => new \Inc2734\WP_Basis\App\Walker\Navbar(),
		]
	);
	?>
</nav>
