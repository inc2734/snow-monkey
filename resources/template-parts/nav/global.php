<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.0.0
 *
 * renamed: template-parts/global-nav.php
 */

use Framework\Helper;

if ( ! has_nav_menu( 'global-nav' ) ) {
	return;
}

$args = wp_parse_args(
	$args,
	[
		'_vertical' => false,
	]
);

$classes[] = 'p-global-nav';
if ( $args['_vertical'] ) {
	$classes[] = 'p-global-nav--vertical';
}
?>

<nav class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" role="navigation">
	<?php
	wp_nav_menu(
		[
			'theme_location' => 'global-nav',
			'container'      => false,
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'menu_class'     => 'c-navbar',
			'depth'          => 0,
			'walker'         => new \Inc2734\WP_Basis\App\Walker\Navbar(),
		]
	);
	?>
</nav>
