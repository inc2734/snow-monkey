<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 19.0.0-beta1
 */

use Framework\Helper;

if ( ! Helper::has_drop_nav() ) {
	return;
}

$classes   = array();
$classes[] = 'p-drop-nav';
$display_site_branding = get_theme_mod( 'display-site-branding-in-drop-nav' );
if ( $display_site_branding ) {
	$classes[] = 'p-drop-nav--has-site-branding';
}
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="c-container">
		<?php
		Helper::get_template_part(
			'template-parts/nav/global',
			null,
			array(
				'_context'             => 'snow-monkey/nav/drop',
				'_vertical'            => false,
				'_gnav-hover-effect'   => get_theme_mod( 'gnav-hover-effect' ),
				'_gnav-current-effect' => get_theme_mod( 'gnav-current-effect' ),
			)
		);
		?>
	</div>
</div>
