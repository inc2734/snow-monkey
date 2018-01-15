<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<header class="l-header l-header--<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>" role="banner">
	<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header" data-has-global-nav="<?php echo esc_attr( has_nav_menu( 'global-nav' ) ? 'true' : 'false' ); ?>">
		<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header__row">
			<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header__branding">
				<?php get_template_part( 'template-parts/site-branding' ); ?>
			</div>

			<?php if ( has_nav_menu( 'drawer-nav' ) ) : ?>
				<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header__for-narrow">
					<?php get_template_part( 'template-parts/hamburger-btn' ); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( has_nav_menu( 'global-nav' ) ) : ?>
			<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header__row">
				<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header__for-wide">
					<?php get_template_part( 'template-parts/global-nav' ); ?>
				</div>
			</div>

			<div class="l-header__drop-nav" aria-hidden="true">
				<div class="c-container">
					<?php get_template_part( 'template-parts/global-nav' ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</header>
