<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.3
 *
 * renamed: template-parts/footer-sub-nav.php
 */

if ( ! has_nav_menu( 'footer-sub-nav' ) ) {
	return;
}

$footer_alignfull = get_theme_mod( 'footer-alignfull' );
$container_class  = $footer_alignfull ? 'c-fluid-container' : 'c-container';
?>

<div class="p-footer-sub-nav c-sub-nav" role="navigation">
	<?php
	wp_nav_menu(
		[
			'theme_location'  => 'footer-sub-nav',
			'container'       => 'div',
			'container_class' => $container_class,
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'menu_class'      => 'c-navbar',
			'depth'           => 1,
			'walker'          => new \Inc2734\WP_Basis\App\Walker\Navbar(),
		]
	);
	?>
</div>
