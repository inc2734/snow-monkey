<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 11.5.0
 *
 * renamed: template-parts/simple-header.php
 */

use Framework\Helper;

$header_content   = get_theme_mod( 'header-content' );
$header_type      = get_theme_mod( 'header-layout' ) . '-header';
$header_alignfull = get_theme_mod( 'header-alignfull' );
$has_drawer_nav   = has_nav_menu( 'drawer-nav' ) || has_nav_menu( 'drawer-sub-nav' );
$container_class  = $header_alignfull ? 'c-fluid-container' : 'c-container';
?>

<div class="l-<?php echo esc_attr( $header_type ); ?>">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<div class="l-<?php echo esc_attr( $header_type ); ?>__row">
			<div class="c-row c-row--margin-s c-row--lg-margin c-row--middle c-row--between c-row--nowrap">
				<?php do_action( 'snow_monkey_before_header_site_branding_column' ); ?>

				<div class="c-row__col c-row__col--fit">
					<?php Helper::get_template_part( 'template-parts/header/site-branding' ); ?>
				</div>

				<?php do_action( 'snow_monkey_after_header_site_branding_column' ); ?>

				<?php if ( $header_content || $has_drawer_nav ) : ?>
					<div class="c-row__col c-row__col--fit">
						<div class="c-row c-row--margin-s c-row--lg-margin c-row--middle c-row--between c-row--nowrap">
							<?php if ( $header_content ) : ?>
								<div class="c-row__col c-row__col--fit u-invisible-md-down">
									<?php Helper::get_template_part( 'template-parts/header/content', 'lg' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $has_drawer_nav ) : ?>
								<div class="c-row__col c-row__col--fit">
									<?php Helper::get_template_part( 'template-parts/header/hamburger-btn' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
