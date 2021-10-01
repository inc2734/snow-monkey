<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.8.2
 *
 * renamed: template-parts/site-branding.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_title_tag' => 'div',
	]
);

$classes = [ 'c-site-branding' ];
if ( has_custom_logo() ) {
	$classes[] = 'c-site-branding--has-logo';
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<<?php echo esc_attr( $args['_title_tag'] ); ?> class="c-site-branding__title">
		<?php Helper::the_site_branding(); ?>
	</<?php echo esc_attr( $args['_title_tag'] ); ?>>

	<?php if ( get_theme_mod( 'display-site-branding-description' ) && get_bloginfo( 'description' ) ) : ?>
		<div class="c-site-branding__description">
			<?php bloginfo( 'description' ); ?>
		</div>
	<?php endif; ?>
</div>
