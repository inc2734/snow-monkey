<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<header class="l-header l-header--<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>" role="banner" data-l-header-type="sticky">
	<div class="c-container">
		<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header">
			<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header__row">
				<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header__branding">
					<?php get_template_part( 'template-parts/site-branding' ); ?>
				</div>
				<div class="l-<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>-header__nav">
					<?php get_template_part( 'template-parts/hamburger-btn' ); ?>
				</div>
			</div>
		</div>
	</div>
</header>
