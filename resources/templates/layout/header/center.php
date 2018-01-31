<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$header_content = get_theme_mod( 'header-content' );

$header_layout    = get_theme_mod( 'header-layout' );
$header_type      = $header_layout . '-header';
$has_global_nav   = has_nav_menu( 'global-nav' ) ? 'true' : 'false';

$class_for_site_branding_col[] = ( has_nav_menu( 'drawer-nav' ) ) ? 'c-row__col--2-4' : 'c-row__col--1-1';
$class_for_site_branding_col[] = ( $header_content ) ? 'c-row__col--lg-2-4' : 'c-row__col--lg-1-1';
$class_for_site_branding_col   = implode( ' ', $class_for_site_branding_col );
?>
<header class="l-header l-header--<?php echo esc_attr( $header_layout ); ?>" role="banner">
	<div class="l-<?php echo esc_attr( $header_type ); ?>" data-has-global-nav="<?php echo esc_attr( $has_global_nav ); ?>">
		<div class="c-container">
			<div class="l-<?php echo esc_attr( $header_type ); ?>__row">
				<div class="c-row c-row--margin-s c-row--middle c-row--between c-row--nowrap">
					<?php if ( has_nav_menu( 'drawer-nav' ) ) : ?>
						<div class="c-row__col c-row__col--1-4 u-hidden-lg-up"></div>
					<?php endif; ?>

					<?php if ( $header_content ) : ?>
						<div class="c-row__col c-row__col--1-4 u-hidden u-visible-lg-up"></div>
					<?php endif; ?>

					<div class="c-row__col <?php echo esc_attr( $class_for_site_branding_col ); ?> u-text-center">
						<?php get_template_part( 'template-parts/site-branding' ); ?>
					</div>

					<?php if ( has_nav_menu( 'drawer-nav' ) ) : ?>
						<div class="c-row__col c-row__col--1-4 u-hidden-lg-up">
							<div class="u-pull-right">
								<?php get_template_part( 'template-parts/hamburger-btn' ); ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $header_content ) : ?>
						<div class="c-row__col c-row__col--1-4 u-hidden u-visible-lg-up">
							<div class="u-pull-right">
								<?php echo wp_kses_post( $header_content ); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( has_nav_menu( 'global-nav' ) ) : ?>
				<div class="l-<?php echo esc_attr( $header_type ); ?>__row u-hidden u-visible-lg-up">
					<?php get_template_part( 'template-parts/global-nav' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( has_nav_menu( 'global-nav' ) ) : ?>
		<div class="l-header__drop-nav" aria-hidden="true">
			<div class="c-container">
				<?php get_template_part( 'template-parts/global-nav' ); ?>
			</div>
		</div>
	<?php endif; ?>
</header>
