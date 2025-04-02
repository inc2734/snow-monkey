<?php
/**
 * Name: Landing page ( with header/footer )
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 28.0.8
 */

use Framework\Helper;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-sticky-footer="true">
<?php Helper::get_template_part( 'template-parts/common/head' ); ?>

<body <?php body_class( array( 'l-body--blank-content' ) ); ?> id="body"
	data-has-sidebar="false"
	data-is-full-template="true"
	data-is-slim-width="false"
	data-header-layout="<?php echo esc_attr( get_theme_mod( 'header-layout' ) ); ?>"
	<?php if ( get_theme_mod( 'infobar-content' ) ) : ?>
		data-infobar-position="<?php echo esc_attr( get_theme_mod( 'infobar-position' ) ); ?>"
	<?php endif; ?>
	ontouchstart=""
	>

	<?php wp_body_open(); ?>
	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<?php
	if ( has_nav_menu( 'drawer-nav' ) || has_nav_menu( 'drawer-sub-nav' ) ) {
		Helper::get_template_part( 'template-parts/nav/drawer' );
	}
	?>

	<div class="l-container">
		<?php Helper::get_header(); ?>

		<div class="l-contents" role="document">
			<?php if ( get_theme_mod( 'infobar-content' ) ) : ?>
				<div class="p-infobar-wrapper p-infobar-wrapper--header-bottom">
					<?php
					Helper::get_template_part(
						'template-parts/common/infobar',
						null,
						array(
							'_content' => get_theme_mod( 'infobar-content' ),
							'_url'     => get_theme_mod( 'infobar-url' ),
							'_target'  => get_theme_mod( 'infobar-link-target' ),
							'_align'   => get_theme_mod( 'infobar-align' ),
						)
					);
					?>
				</div>
			<?php endif; ?>

			<div class="l-contents__body">
				<div class="l-contents__full-container c-full-container">
					<div class="l-contents__inner">
						<main role="main" id="primary">
							<?php
							// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
							$args['_view_controller']->view();
							// phpcs:enable
							?>
						</main>
					</div>
				</div>
			</div>
		</div>

		<?php Helper::get_footer(); ?>
	</div>

<?php wp_footer(); ?>

<?php
if ( get_theme_mod( 'display-page-top' ) ) {
	Helper::get_template_part( 'template-parts/common/page-top' );
}
?>

<?php
if ( has_nav_menu( 'footer-sticky-nav' ) ) {
	Helper::get_template_part( 'template-parts/nav/footer-sticky' );
}
?>
</body>
</html>
