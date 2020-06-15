<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.9.0
 *
 * renamed: template-parts/site-branding.php
 */

use Framework\Helper;

$classes = [ 'c-site-branding' ];
if ( has_custom_logo() ) {
	$classes[] = 'c-site-branding--has-logo';
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php if ( is_front_page() ) : ?>

		<h1 class="c-site-branding__title">
			<?php Helper::the_site_branding(); ?>
		</h1>

	<?php else : ?>

		<div class="c-site-branding__title">
			<?php Helper::the_site_branding(); ?>
		</div>

	<?php endif; ?>

	<?php if ( get_theme_mod( 'display-site-branding-description' ) && get_bloginfo( 'description' ) ) : ?>
		<div class="c-site-branding__description">
			<?php bloginfo( 'description' ); ?>
		</div>
	<?php endif; ?>
</div>
