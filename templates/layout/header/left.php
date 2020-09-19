<?php
/**
 * Name: Left
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.3.3
 */

use Framework\Helper;

$classes            = Helper::get_header_classes();
$header_position_lg = get_theme_mod( 'header-position-lg' );
if ( $header_position_lg ) {
	$classes = array_diff( $classes, [ 'l-header--' . $header_position_lg . '-lg' ] );
}
?>

<header class="<?php echo esc_attr( join( ' ', $classes ) ); ?>" role="banner">
	<div class="l-header__content">
		<?php Helper::get_template_part( 'template-parts/header/left' ); ?>
	</div>
</header>
