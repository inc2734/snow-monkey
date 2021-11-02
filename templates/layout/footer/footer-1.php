<?php
/**
 * Name: Footer 1
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.13.0
 */

use Framework\Helper;

$footer_alignfull = get_theme_mod( 'footer-alignfull' );
?>

<footer class="l-footer l-footer--footer-1" role="contentinfo">
	<?php do_action( 'snow_monkey_prepend_footer' ); ?>

	<?php if ( has_nav_menu( 'social-nav' ) ) : ?>
		<div class="l-footer__body">
			<?php if ( has_nav_menu( 'social-nav' ) ) : ?>
				<div class="l-footer__social-nav">
					<?php
					Helper::get_template_part(
						'template-parts/nav/social',
						null,
						[
							'_container-fluid' => $footer_alignfull,
						]
					);
					?>
				</div>
			<?php endif; ?>

			<?php if ( Helper::is_active_sidebar( 'footer-widget-area' ) ) : ?>
				<div class="l-footer__widget-area">
					<?php
					Helper::get_template_part(
						'template-parts/widget-area/footer',
						null,
						[
							'_container-fluid' => $footer_alignfull,
						]
					);
					?>
				</div>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'footer-sub-nav' ) ) : ?>
				<div class="l-footer__sub-nav">
					<?php
					Helper::get_template_part(
						'template-parts/nav/footer-sub',
						null,
						[
							'_container-fluid'       => $footer_alignfull,
							'_content-justification' => 'center',
						]
					);
					?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( Helper::get_copyright() ) : ?>
		<div class="l-footer__footer">
			<?php
			Helper::get_template_part(
				'template-parts/footer/copyright',
				null,
				[
					'_container-fluid' => $footer_alignfull,
					'_inverse'         => false,
				]
			);
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'snow_monkey_append_footer' ); ?>
</footer>
