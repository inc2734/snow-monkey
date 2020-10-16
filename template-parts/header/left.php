<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.6.0
 */

use Framework\Helper;

$header_content         = get_theme_mod( 'header-content' );
$header_type            = get_theme_mod( 'header-layout' ) . '-header';
$has_global_nav         = has_nav_menu( 'global-nav' );
$has_drawer_nav         = has_nav_menu( 'drawer-nav' ) || has_nav_menu( 'drawer-sub-nav' );
$has_header_sub_nav     = has_nav_menu( 'header-sub-nav' );
$data_has_global_nav    = $has_global_nav ? 'true' : 'false';
$hamburger_btn_position = get_theme_mod( 'hamburger-btn-position' );
?>

<div class="l-<?php echo esc_attr( $header_type ); ?>" data-has-global-nav="<?php echo esc_attr( $data_has_global_nav ); ?>">
	<div class="c-container">
		<div class="c-row c-row--middle c-row--margin-s">
			<?php if ( $has_drawer_nav && 'left' === $hamburger_btn_position ) : ?>
				<div class="c-row__col c-row__col--fit u-invisible-lg-up">
					<?php
					Helper::get_template_part(
						'template-parts/header/hamburger-btn',
						null,
						[
							'_id' => false,
						]
					);
					?>
				</div>
			<?php endif; ?>

			<?php do_action( 'snow_monkey_before_header_site_branding_column' ); ?>

			<div class="c-row__col c-row__col--auto c-row__col--lg-1-1">
				<?php Helper::get_template_part( 'template-parts/header/site-branding' ); ?>
			</div>

			<?php do_action( 'snow_monkey_after_header_site_branding_column' ); ?>

			<?php if ( $has_drawer_nav && 'right' === $hamburger_btn_position ) : ?>
				<div class="c-row__col c-row__col--fit u-invisible-lg-up">
					<?php
					Helper::get_template_part(
						'template-parts/header/hamburger-btn',
						null,
						[
							'_id' => false,
						]
					);
					?>
				</div>
			<?php endif; ?>

			<?php if ( $has_global_nav ) : ?>
				<div class="c-row__col c-row__col--1-1 u-invisible-md-down">
					<?php
					Helper::get_template_part(
						'template-parts/nav/global',
						null,
						[
							'_vertical'          => false,
							'_gnav-hover-effect' => get_theme_mod( 'gnav-hover-effect' ),
						]
					);
					?>
				</div>
			<?php endif; ?>

			<?php if ( $has_header_sub_nav ) : ?>
				<div class="c-row__col c-row__col--1-1 u-invisible-md-down">
					<?php Helper::get_template_part( 'template-parts/nav/header-sub' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $header_content ) : ?>
				<div class="c-row__col c-row__col--1-1 u-invisible-md-down">
					<?php Helper::get_template_part( 'template-parts/header/content', 'lg' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
