<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 5.7.1
 *
 * renamed: template-parts/drawer-nav.php
 */

use Framework\Helper;

$has_drawer_nav     = has_nav_menu( 'drawer-nav' );
$has_drawer_sub_nav = has_nav_menu( 'drawer-sub-nav' );

if ( ! $has_drawer_nav && ! $has_drawer_sub_nav ) {
	return;
}
?>

<nav id="drawer-nav" class="c-drawer c-drawer--fixed" role="navigation" aria-hidden="true" aria-labelledby="hamburger-btn">
	<?php do_action( 'snow_monkey_prepend_drawer_nav' ); ?>

	<?php
	if ( $has_drawer_nav ) {
		wp_nav_menu(
			[
				'theme_location' => 'drawer-nav',
				'container'      => false,
				'menu_class'     => 'c-drawer__menu',
				'depth'          => 0,
				'walker'         => new \Inc2734\WP_Basis\App\Walker\Drawer(),
			]
		);
	}

	if ( $has_drawer_sub_nav ) {
		Helper::get_template_part( 'template-parts/nav/drawer-sub' );
	}
	?>

	<?php if ( get_theme_mod( 'display-drawer-nav-search-box' ) ) : ?>
		<ul class="c-drawer__menu">
			<li class="c-drawer__item">
				<?php Helper::get_template_part( 'template-parts/common/search-form', 'drawer' ); ?>
			</li>
		</ul>
	<?php endif; ?>

	<?php do_action( 'snow_monkey_append_drawer_nav' ); ?>
</nav>
