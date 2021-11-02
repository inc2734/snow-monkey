<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.13.0
 *
 * renamed: template-parts/footer-sub-nav.php
 */

if ( ! has_nav_menu( 'footer-sub-nav' ) ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_container'             => true,
		'_content-justification' => 'right',
	]
);

if ( $args['_container'] ) {
	$args = wp_parse_args(
		$args,
		[
			'_container-fluid' => false,
		]
	);
}

$sub_nav_classes = [ 'p-footer-sub-nav', 'c-sub-nav' ];
if ( $args['_content-justification'] ) {
	$sub_nav_classes[] = 'c-sub-nav--' . $args['_content-justification'];
}

$container       = false;
$container_class = false;
if ( $args['_container'] ) {
	$container       = 'div';
	$container_class = $args['_container-fluid'] ? 'c-fluid-container' : 'c-container';
}
?>

<div class="<?php echo esc_attr( implode( ' ', $sub_nav_classes ) ); ?>" role="navigation">
	<?php
	wp_nav_menu(
		[
			'theme_location'  => 'footer-sub-nav',
			'container'       => $container,
			'container_class' => $container_class,
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'menu_class'      => 'c-navbar',
			'depth'           => 1,
			'walker'          => new \Inc2734\WP_Basis\App\Walker\Navbar(),
		]
	);
	?>
</div>
