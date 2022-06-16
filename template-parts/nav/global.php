<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 17.1.0
 *
 * renamed: template-parts/global-nav.php
 */

use Inc2734\WP_Basis\App\Walker\Navbar;
use Framework\Helper;

if ( ! has_nav_menu( 'global-nav' ) ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_popup-mode'          => 'hover',
		'_vertical'            => false,
		'_gnav-hover-effect'   => get_theme_mod( 'gnav-hover-effect' ),
		'_gnav-current-effect' => get_theme_mod( 'gnav-current-effect' ),
	]
);

$classes   = [];
$classes[] = 'p-global-nav';
if ( $args['_vertical'] ) {
	$classes[] = 'p-global-nav--vertical';
}
if ( $args['_gnav-hover-effect'] ) {
	$classes[] = 'p-global-nav--hover-' . $args['_gnav-hover-effect'];
}
if ( $args['_gnav-current-effect'] ) {
	$classes[] = 'p-global-nav--current-' . $args['_gnav-current-effect'];
}

$items_wrap = 'click' === $args['_popup-mode']
	? '<ul id="%1$s" class="%2$s" data-popup-mode="click">%3$s</ul>'
	: '<ul id="%1$s" class="%2$s">%3$s</ul>';

$navbar_args = 'click' === $args['_popup-mode']
	? [ 'popup-mode' => 'click' ]
	: [];

$theme_location = ! empty( $args['_context'] ) && 'snow-monkey/nav/drop' === $args['_context'] && has_nav_menu( 'drop-nav' )
	? 'drop-nav'
	: 'global-nav';
?>

<nav class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" role="navigation">
	<?php
	wp_nav_menu(
		[
			'theme_location' => $theme_location,
			'container'      => false,
			'items_wrap'     => $items_wrap,
			'menu_class'     => 'c-navbar',
			'depth'          => 0,
			'walker'         => new Navbar( $navbar_args ),
		]
	);
	?>
</nav>
