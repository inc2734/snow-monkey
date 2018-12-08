<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;
?>
<div class="c-site-branding">
	<?php if ( is_front_page() || is_home() ) : ?>

		<h1 class="c-site-branding__title">
			<?php Helper\the_site_branding(); ?>
		</h1>

	<?php else : ?>

		<div class="c-site-branding__title">
			<?php Helper\the_site_branding(); ?>
		</div>

	<?php endif; ?>

	<?php if ( get_theme_mod( 'display-site-branding-description' ) && get_bloginfo( 'description' ) ) : ?>
		<div class="c-site-branding__description">
			<?php bloginfo( 'description' ); ?>
		</div>
	<?php endif; ?>
</div>
