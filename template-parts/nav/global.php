<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.7.0
 *
 * renamed: template-parts/global-nav.php
 */

use Framework\Helper;

if ( ! has_nav_menu( 'global-nav' ) ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_gnav-hover-effect' => get_theme_mod( 'gnav-hover-effect' ),
		'_popup-mode'        => 'hover',
		'_vertical'          => false,
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

$items_wrap = 'click' === $args['_popup-mode']
	? '<ul id="%1$s" class="%2$s" data-popup-mode="click">%3$s</ul>'
	: '<ul id="%1$s" class="%2$s">%3$s</ul>';

$navbar_args = 'click' === $args['_popup-mode']
	? [ 'popup-mode' => 'click' ]
	: [];
?>

<nav class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" role="navigation">
	<?php
	wp_nav_menu(
		[
			'theme_location' => 'global-nav',
			'container'      => false,
			'items_wrap'     => $items_wrap,
			'menu_class'     => 'c-navbar',
			'depth'          => 0,
			'walker'         => new \Inc2734\WP_Basis\App\Walker\Navbar( $navbar_args ),
		]
	);
	?>
</nav>
