<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.13.0
 *
 * renamed: template-parts/header-sub-nav.php
 */

if ( ! has_nav_menu( 'header-sub-nav' ) ) {
	return;
}

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_content-justification' => 'right',
	]
);

$sub_nav_classes = [ 'p-header-sub-nav', 'c-sub-nav' ];
if ( $args['_content-justification'] ) {
	$sub_nav_classes[] = 'c-sub-nav--' . $args['_content-justification'];
}
?>

<div class="<?php echo esc_attr( implode( ' ', $sub_nav_classes ) ); ?>" role="navigation">
	<?php
	wp_nav_menu(
		[
			'theme_location' => 'header-sub-nav',
			'container'      => false,
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'menu_class'     => 'c-navbar',
			'depth'          => 1,
			'walker'         => new \Inc2734\WP_Basis\App\Walker\Navbar(),
		]
	);
	?>
</div>
