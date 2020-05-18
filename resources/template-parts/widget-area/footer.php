<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.5.0
 *
 * renamed: template-parts/footer-widget-area.php
 */

use Framework\Helper;

if ( ! Helper::is_active_sidebar( 'footer-widget-area' ) ) {
	return;
}

$footer_alignfull = get_theme_mod( 'footer-alignfull' );
$container_class  = $footer_alignfull ? 'c-fluid-container' : 'c-container';
?>

<div class="l-footer-widget-area"
	data-is-slim-widget-area="true"
	data-is-content-widget-area="false"
	>

	<div class="<?php echo esc_attr( $container_class ); ?>">
		<div class="c-row c-row--margin c-row--lg-margin-l">
			<?php dynamic_sidebar( 'footer-widget-area' ); ?>
		</div>
	</div>
</div>
