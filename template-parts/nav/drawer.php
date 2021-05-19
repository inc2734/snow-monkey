<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.3.1
 *
 * renamed: template-parts/drawer-nav.php
 */

use Framework\Helper;

$has_drawer_nav     = has_nav_menu( 'drawer-nav' );
$has_drawer_sub_nav = has_nav_menu( 'drawer-sub-nav' );

if ( ! $has_drawer_nav && ! $has_drawer_sub_nav ) {
	return;
}

$hamburger_btn_position    = get_theme_mod( 'hamburger-btn-position' );
$drawer_nav_type           = get_theme_mod( 'drawer-nav-type' );
$drawer_nav_highlight_type = get_theme_mod( 'drawer-nav-highlight-type' );
$classes                   = array_filter(
	[
		'c-drawer',
		'c-drawer--fixed',
		'left' === $hamburger_btn_position ? 'c-drawer--inverse' : '',
		$drawer_nav_type ? 'c-drawer--' . $drawer_nav_type : '',
		$drawer_nav_highlight_type ? 'c-drawer--highlight-type-' . $drawer_nav_highlight_type : '',
	],
	'strlen'
);
?>

<nav
	id="drawer-nav"
	class="<?php echo esc_attr( join( ' ', $classes ) ); ?>"
	role="navigation"
	aria-hidden="true"
	aria-labelledby="hamburger-btn"
>
	<div class="c-drawer__inner">
		<div class="c-drawer__focus-point" tabindex="-1"></div>
		<?php do_action( 'snow_monkey_prepend_drawer_nav' ); ?>

		<?php if ( 'overall' === $drawer_nav_type ) : ?>
			<?php
			$classes = array_filter(
				[
					'c-drawer__controls',
					'left' === $hamburger_btn_position ? 'c-drawer__controls--left' : '',
				],
				'strlen'
			);
			?>
			<div class="<?php echo esc_attr( join( ' ', $classes ) ); ?>">
				<div class="c-drawer__control">
					<?php Helper::get_template_part( 'template-parts/header/hamburger-btn' ); ?>
				</div>
			</div>
		<?php endif; ?>

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
	</div>
</nav>
<div class="c-drawer-close-zone" aria-hidden="true" aria-controls="drawer-nav"></div>
