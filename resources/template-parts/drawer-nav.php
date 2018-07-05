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
	<?php do_action( 'snow_monkey_prepend_drawer_nav' ); ?>

	<?php if ( get_theme_mod( 'display-drawer-nav-search-box' ) ) : ?>
		<ul class="c-drawer__menu">
			<li class="c-drawer__item">
				<?php get_search_form( true ); ?>
			</li>
		</ul>
	<?php endif; ?>

	<?php
	wp_nav_menu( [
		'theme_location' => 'drawer-nav',
		'container'      => false,
		'menu_class'     => 'c-drawer__menu',
		'depth'          => 0,
	] );
	?>

	<?php do_action( 'snow_monkey_append_drawer_nav' ); ?>
</nav>
