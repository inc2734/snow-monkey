<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$has_drawer_nav     = has_nav_menu( 'drawer-nav' );
$has_header_sub_nav = has_nav_menu( 'header-sub-nav' );
$has_footer_sub_nav = has_nav_menu( 'footer-sub-nav' );

if ( ! $has_drawer_nav && ! $has_header_sub_nav && ! $has_footer_sub_nav ) {
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
	if ( $has_drawer_nav ) {
		wp_nav_menu( [
			'theme_location' => 'drawer-nav',
			'container'      => false,
			'menu_class'     => 'c-drawer__menu',
			'depth'          => 0,
			'walker'         => new \Inc2734\WP_Basis\App\Walker\Drawer(),
		] );
	}
	?>

	<?php if ( $has_header_sub_nav ) : ?>
		<div class="c-drawer__sub-nav">
			<?php
			wp_nav_menu( [
				'theme_location' => 'header-sub-nav',
				'container'      => false,
				'menu_class'     => 'c-drawer__menu',
				'depth'          => 1,
				'walker'         => new \Inc2734\WP_Basis\App\Walker\Drawer(),
			] );
			?>
		</div>
	<?php endif; ?>

	<?php if ( $has_footer_sub_nav ) : ?>
		<div class="c-drawer__sub-nav">
			<?php
			wp_nav_menu( [
				'theme_location' => 'footer-sub-nav',
				'container'      => false,
				'menu_class'     => 'c-drawer__menu',
				'depth'          => 1,
				'walker'         => new \Inc2734\WP_Basis\App\Walker\Drawer(),
			] );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'snow_monkey_append_drawer_nav' ); ?>
</nav>
