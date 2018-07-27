<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

$header_content      = get_theme_mod( 'header-content' );
$header_type         = get_theme_mod( 'header-layout' ) . '-header';
$has_global_nav      = has_nav_menu( 'global-nav' );
$has_drawer_nav      = has_nav_menu( 'drawer-nav' );
$has_header_sub_nav  = has_nav_menu( 'header-sub-nav' );
$data_has_global_nav = $has_global_nav ? 'true' : 'false';
?>

<div class="l-<?php echo esc_attr( $header_type ); ?>" data-has-global-nav="<?php echo esc_attr( $data_has_global_nav ); ?>">
	<div class="c-container">
		<?php if ( $has_header_sub_nav ) : ?>
			<div class="u-hidden u-visible-lg-up">
				<?php get_template_part( 'template-parts/header-sub-nav' ); ?>
			</div>
		<?php endif; ?>

		<div class="l-<?php echo esc_attr( $header_type ); ?>__row">
			<div class="c-row c-row--margin c-row--middle c-row--nowrap">
				<div class="c-row__col c-row__col--auto">
					<?php get_template_part( 'template-parts/site-branding' ); ?>
				</div>

				<?php if ( $header_content ) : ?>
					<div class="c-row__col c-row__col--fit u-hidden u-visible-lg-up">
						<div class="c-row c-row--right">
							<div class="c-row__col c-row__col--fit">
								<?php get_template_part( 'template-parts/header-content' ); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $has_drawer_nav ) : ?>
					<div class="c-row__col c-row__col--fit u-hidden-lg-up">
						<?php get_template_part( 'template-parts/hamburger-btn' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( $has_global_nav ) : ?>
			<div class="l-<?php echo esc_attr( $header_type ); ?>__row u-hidden u-visible-lg-up">
				<?php get_template_part( 'template-parts/global-nav' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
