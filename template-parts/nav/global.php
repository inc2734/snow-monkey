<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 28.0.0
 *
 * renamed: template-parts/global-nav.php
 */

use Inc2734\WP_Basis\App\Walker\Navbar;
use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_popup-mode'          => 'hover',
		'_vertical'            => false,
		'_gnav-hover-effect'   => get_theme_mod( 'gnav-hover-effect' ),
		'_gnav-current-effect' => get_theme_mod( 'gnav-current-effect' ),
	)
);

if ( ! has_nav_menu( 'global-nav' ) && 'snow-monkey/nav/drop' !== $args['_context'] ) {
	return;
}

$classes   = array();
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
	? array( 'popup-mode' => 'click' )
	: array();

$theme_location = ! empty( $args['_context'] ) && 'snow-monkey/nav/drop' === $args['_context'] && has_nav_menu( 'drop-nav' )
	? 'drop-nav'
	: 'global-nav';

$display_site_branding = ! empty( $args['_context'] ) && 'snow-monkey/nav/drop' === $args['_context'] && get_theme_mod( 'display-site-branding-in-drop-nav' );
?>

<nav class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" role="navigation">
	<?php
	if ( $display_site_branding ) {
		Helper::get_template_part(
			'template-parts/header/site-branding',
			null,
			array(
				'_title_tag' => 'div',
			)
		);
	}

	wp_nav_menu(
		array(
			'theme_location' => $theme_location,
			'container'      => false,
			'items_wrap'     => $items_wrap,
			'menu_class'     => 'c-navbar',
			'depth'          => 0,
			'walker'         => new Navbar( $navbar_args ),
		)
	);
	?>
</nav>
