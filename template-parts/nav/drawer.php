<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.5.0
 *
 * renamed: template-parts/drawer-nav.php
 */

use Framework\Helper;


$has_drawer_sub_nav           = has_nav_menu( 'drawer-sub-nav' );
$hamburger_btn_position       = get_theme_mod( 'hamburger-btn-position' );
$drawer_nav_type              = get_theme_mod( 'drawer-nav-type' );
$drawer_nav_direction         = get_theme_mod( 'drawer-nav-direction' );
$inverse                      = ( 'left' === $hamburger_btn_position && 'left' !== $drawer_nav_direction ) || ( 'right' === $drawer_nav_direction );
$display_drawer_hamburger_btn = ( 'overall' === $drawer_nav_type ) || ( $drawer_nav_direction === $hamburger_btn_position );

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_theme-location'                => 'drawer-nav',
		'_inverse'                       => $inverse,
		'_display-hamburger-btn'         => $display_drawer_hamburger_btn,
		'_display-drawer-sub-nav'        => $has_drawer_sub_nav,
		'_display-drawer-nav-search-box' => get_theme_mod( 'display-drawer-nav-search-box' ),
		'_hamburger-btn-id'              => 'hamburger-btn',
	)
);

if ( $args['_display-hamburger-btn'] ) {
	$args = wp_parse_args(
		$args,
		array(
			'_hamburger-btn-position' => $hamburger_btn_position,
		)
	);
}

if ( $args['_display-drawer-nav-search-box'] ) {
	$args = wp_parse_args(
		$args,
		array(
			'_search-box-position' => get_theme_mod( 'drawer-nav-search-box-position' ),
		)
	);
}

$has_drawer_nav = has_nav_menu( $args['_theme-location'] );

if ( ! $has_drawer_nav && ! $has_drawer_sub_nav ) {
	return;
}

$drawer_nav_highlight_type = get_theme_mod( 'drawer-nav-highlight-type' );
$classes                   = array_filter(
	array(
		'c-drawer',
		'c-drawer--fixed',
		$args['_inverse'] ? 'c-drawer--inverse' : '',
		$drawer_nav_type ? 'c-drawer--' . $drawer_nav_type : '',
		$drawer_nav_highlight_type ? 'c-drawer--highlight-type-' . $drawer_nav_highlight_type : '',
	),
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
				array(
					'c-drawer__controls',
					! empty( $args['_hamburger-btn-position'] ) ? 'c-drawer__controls--' . $args['_hamburger-btn-position'] : '',
				),
				'strlen'
			);
			?>
			<div class="<?php echo esc_attr( join( ' ', $classes ) ); ?>">
				<div class="c-drawer__control">
					<?php
					Helper::get_template_part(
						'template-parts/header/hamburger-btn',
						null,
						array(
							'_id'       => $args['_hamburger-btn-id'],
							'_controls' => $args['_theme-location'],
						)
					);
					?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $args['_display-drawer-nav-search-box'] && 'top' === $args['_search-box-position'] ) : ?>
			<ul class="c-drawer__menu">
				<li class="c-drawer__item">
					<?php Helper::get_template_part( 'template-parts/common/search-form', 'drawer' ); ?>
				</li>
			</ul>
		<?php endif; ?>

		<?php
		if ( $has_drawer_nav ) {
			wp_nav_menu(
				array(
					'theme_location' => $args['_theme-location'],
					'container'      => false,
					'menu_class'     => 'c-drawer__menu',
					'depth'          => 0,
					'walker'         => new \Inc2734\WP_Basis\App\Walker\Drawer(),
				)
			);
		}

		if ( $args['_display-drawer-sub-nav'] ) {
			Helper::get_template_part( 'template-parts/nav/drawer-sub' );
		}
		?>

		<?php if ( $args['_display-drawer-nav-search-box'] && 'bottom' === $args['_search-box-position'] ) : ?>
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
