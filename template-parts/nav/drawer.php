<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.14.4
 *
 * renamed: template-parts/drawer-nav.php
 */

use Framework\Helper;


$has_drawer_sub_nav = has_nav_menu( 'drawer-sub-nav' );
$drawer_nav_type    = get_theme_mod( 'drawer-nav-type' );

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_theme-location'                => 'drawer-nav',
		'_inverse'                       => 'left' === get_theme_mod( 'hamburger-btn-position' ),
		'_display-hamburger-btn'         => 'overall' === $drawer_nav_type,
		'_display-drawer-sub-nav'        => $has_drawer_sub_nav,
		'_display-drawer-nav-search-box' => get_theme_mod( 'display-drawer-nav-search-box' ),
		'_hamburger-btn-id'              => 'hamburger-btn',
	]
);

$has_drawer_nav = has_nav_menu( $args['_theme-location'] );

if ( ! $has_drawer_nav && ! $has_drawer_sub_nav ) {
	return;
}

$drawer_nav_highlight_type = get_theme_mod( 'drawer-nav-highlight-type' );
$classes                   = array_filter(
	[
		'c-drawer',
		'c-drawer--fixed',
		$args['_inverse'] ? 'c-drawer--inverse' : '',
		$drawer_nav_type ? 'c-drawer--' . $drawer_nav_type : '',
		$drawer_nav_highlight_type ? 'c-drawer--highlight-type-' . $drawer_nav_highlight_type : '',
	],
	'strlen'
);
?>

<nav
	id="<?php echo esc_attr( $args['_theme-location'] ); ?>"
	class="<?php echo esc_attr( join( ' ', $classes ) ); ?>"
	role="navigation"
	aria-hidden="true"
	aria-labelledby="<?php echo esc_attr( $args['_hamburger-btn-id'] ); ?>"
>
	<div class="c-drawer__inner">
		<div class="c-drawer__focus-point" tabindex="-1"></div>
		<?php do_action( 'snow_monkey_prepend_drawer_nav' ); ?>

		<?php if ( $args['_display-hamburger-btn'] ) : ?>
			<?php
			$classes = array_filter(
				[
					'c-drawer__controls',
					$args['_inverse'] ? 'c-drawer__controls--left' : '',
				],
				'strlen'
			);
			?>
			<div class="<?php echo esc_attr( join( ' ', $classes ) ); ?>">
				<div class="c-drawer__control">
					<?php
					Helper::get_template_part(
						'template-parts/header/hamburger-btn',
						null,
						[
							'_id'       => $args['_hamburger-btn-id'],
							'_controls' => $args['_theme-location'],
						]
					);
					?>
				</div>
			</div>
		<?php endif; ?>

		<?php
		if ( $has_drawer_nav ) {
			wp_nav_menu(
				[
					'theme_location' => $args['_theme-location'],
					'container'      => false,
					'menu_class'     => 'c-drawer__menu',
					'depth'          => 0,
					'walker'         => new \Inc2734\WP_Basis\App\Walker\Drawer(),
				]
			);
		}

		if ( $args['_display-drawer-sub-nav'] ) {
			Helper::get_template_part( 'template-parts/nav/drawer-sub' );
		}
		?>

		<?php if ( $args['_display-drawer-nav-search-box'] ) : ?>
			<ul class="c-drawer__menu">
				<li class="c-drawer__item">
					<?php Helper::get_template_part( 'template-parts/common/search-form', 'drawer' ); ?>
				</li>
			</ul>
		<?php endif; ?>

		<?php do_action( 'snow_monkey_append_drawer_nav' ); ?>
	</div>
</nav>
<div class="c-drawer-close-zone" aria-hidden="true" aria-controls="<?php echo esc_attr( $args['_theme-location'] ); ?>"></div>
