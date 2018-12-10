<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\App\Helper;

$header_content      = get_theme_mod( 'header-content' );
$header_type         = get_theme_mod( 'header-layout' ) . '-header';
$has_global_nav      = has_nav_menu( 'global-nav' );
$has_drawer_nav      = has_nav_menu( 'drawer-nav' );
$has_header_sub_nav  = has_nav_menu( 'header-sub-nav' );
$data_has_global_nav = $has_global_nav ? 'true' : 'false';

$class_for_site_branding_col[] = ( $has_drawer_nav ) ? 'c-row__col--4-6' : 'c-row__col--1-1';
$class_for_site_branding_col[] = ( $header_content ) ? 'c-row__col--lg-2-4' : 'c-row__col--lg-1-1';
$class_for_site_branding_col   = implode( ' ', $class_for_site_branding_col );
?>

<div class="l-<?php echo esc_attr( $header_type ); ?>" data-has-global-nav="<?php echo esc_attr( $data_has_global_nav ); ?>">
	<div class="c-container">
		<?php if ( $has_header_sub_nav ) : ?>
			<div class="u-hidden u-visible-lg-up">
				<?php Helper::get_template_part( 'template-parts/nav/header-sub' ); ?>
			</div>
		<?php endif; ?>

		<div class="l-<?php echo esc_attr( $header_type ); ?>__row">
			<div class="c-row c-row--margin-s c-row--middle c-row--between c-row--nowrap">
				<?php if ( $has_drawer_nav ) : ?>
					<div class="c-row__col c-row__col--1-6 u-hidden-lg-up"></div>
				<?php endif; ?>

				<?php if ( $header_content ) : ?>
					<div class="c-row__col c-row__col--1-4 u-hidden u-visible-lg-up"></div>
				<?php endif; ?>

				<div class="c-row__col <?php echo esc_attr( $class_for_site_branding_col ); ?> u-text-center">
					<?php Helper::get_template_part( 'template-parts/header/site-branding' ); ?>
				</div>

				<?php if ( $has_drawer_nav ) : ?>
					<div class="c-row__col c-row__col--1-6 u-hidden-lg-up">
						<div class="u-pull-right">
							<?php Helper::get_template_part( 'template-parts/header/hamburger-btn' ); ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $header_content ) : ?>
					<div class="c-row__col c-row__col--1-4 u-hidden u-visible-lg-up">
						<div class="u-pull-right">
							<?php Helper::get_template_part( 'template-parts/header/content', 'lg' ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( $has_global_nav ) : ?>
			<div class="l-<?php echo esc_attr( $header_type ); ?>__row u-hidden u-visible-lg-up">
				<?php Helper::get_template_part( 'template-parts/nav/global' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
