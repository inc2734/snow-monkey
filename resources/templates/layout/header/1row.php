<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<header class="l-header" role="banner">
	<?php get_template_part( 'template-parts/1row-header' ); ?>

	<?php if ( has_nav_menu( 'global-nav' ) ) : ?>
		<div class="l-header__drop-nav" aria-hidden="true">
			<div class="c-container">
				<?php get_template_part( 'template-parts/global-nav' ); ?>
			</div>
		</div>
	<?php endif; ?>
</header>
