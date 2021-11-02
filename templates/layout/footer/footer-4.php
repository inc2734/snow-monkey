<?php
/**
 * Name: Footer 4
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.13.0
 */

use Framework\Helper;

$footer_alignfull = get_theme_mod( 'footer-alignfull' );
$container_class  = $footer_alignfull ? 'c-fluid-container' : 'c-container';
?>

<footer class="l-footer l-footer--footer-4" role="contentinfo">
	<?php do_action( 'snow_monkey_prepend_footer' ); ?>

	<div class="l-footer__body">
		<div class="<?php echo esc_attr( $container_class ); ?>">
			<div class="c-row c-row--margin-s c-row--lg-margin-l">
				<div class="c-row__col c-row__col--1-1 c-row__col--lg-fit">
					<div class="l-footer__branding">
						<?php
						Helper::get_template_part(
							'template-parts/header/site-branding',
							null,
							[
								'_title_tag' => 'div',
							]
						);
						?>
					</div>

					<?php if ( has_nav_menu( 'social-nav' ) ) : ?>
						<div class="l-footer__social-nav">
							<?php
							Helper::get_template_part(
								'template-parts/nav/social',
								null,
								[
									'_container' => false,
								]
							);
							?>
						</div>
					<?php endif; ?>
				</div>
				<div class="c-row__col c-row__col--1-1 c-row__col--lg-auto">
					<?php if ( Helper::is_active_sidebar( 'footer-widget-area' ) ) : ?>
						<div class="l-footer__widget-area">
							<?php
							Helper::get_template_part(
								'template-parts/widget-area/footer',
								null,
								[
									'_container' => false,
								]
							);
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<?php if ( Helper::get_copyright() || has_nav_menu( 'footer-sub-nav' ) ) : ?>
		<div class="l-footer__footer">
			<div class="<?php echo esc_attr( $container_class ); ?>">
				<div class="c-row c-row--margin-s c-row--middle c-row--between">
					<?php if ( Helper::get_copyright() ) : ?>
						<div class="c-row__col c-row__col--1-1 c-row__col--lg-fit">
							<div class="l-footer__copyright">
								<?php
								Helper::get_template_part(
									'template-parts/footer/copyright',
									null,
									[
										'_container' => false,
										'_inverse'   => false,
									]
								);
								?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( has_nav_menu( 'footer-sub-nav' ) ) : ?>
						<div class="c-row__col c-row__col--1-1 c-row__col--lg-fit">
							<div class="l-footer__sub-nav">
								<?php
								Helper::get_template_part(
									'template-parts/nav/footer-sub',
									null,
									[
										'_container' => false,
										'_content-justification' => 'left',
									]
								);
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php do_action( 'snow_monkey_append_footer' ); ?>
</footer>
