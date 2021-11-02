<?php
/**
 * Name: Default
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.13.0
 */

use Framework\Helper;

$footer_alignfull = get_theme_mod( 'footer-alignfull' );
?>

<footer class="l-footer l-footer--default" role="contentinfo">
	<?php do_action( 'snow_monkey_prepend_footer' ); ?>

	<?php
	if ( has_nav_menu( 'social-nav' ) ) {
		Helper::get_template_part(
			'template-parts/nav/social',
			null,
			[
				'_container-fluid' => $footer_alignfull,
			]
		);
	}
	?>

	<?php
	if ( Helper::is_active_sidebar( 'footer-widget-area' ) ) {
		Helper::get_template_part(
			'template-parts/widget-area/footer',
			null,
			[
				'_container-fluid' => $footer_alignfull,
			]
		);
	}
	?>

	<?php
	if ( has_nav_menu( 'footer-sub-nav' ) ) {
		Helper::get_template_part(
			'template-parts/nav/footer-sub',
			null,
			[
				'_container-fluid'       => $footer_alignfull,
				'_content-justification' => 'center',
			]
		);
	}
	?>

	<?php
	if ( Helper::get_copyright() ) {
		Helper::get_template_part(
			'template-parts/footer/copyright',
			null,
			[
				'_container-fluid' => $footer_alignfull,
			]
		);
	}
	?>

	<?php do_action( 'snow_monkey_append_footer' ); ?>
</footer>
