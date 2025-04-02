<?php
/**
 * Name: One column ( slim width )
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 28.0.8
 */

use Framework\Helper;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-sticky-footer="true" data-scrolled="false">
<?php Helper::get_template_part( 'template-parts/common/head' ); ?>

<body <?php body_class( array( 'l-body--one-column-slim' ) ); ?> id="body"
	data-has-sidebar="false"
	data-is-full-template="false"
	data-is-slim-width="true"
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
			<?php do_action( 'snow_monkey_prepend_contents' ); ?>

			<?php
			if ( get_theme_mod( 'header-content' ) ) {
				Helper::get_template_part( 'template-parts/header/content', 'sm' );
			}
			?>

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

			<?php
			if ( Helper::display_page_header() ) {
				$vars = array(
					'_display_entry_meta' => is_singular( 'post' ),
				);
				Helper::get_template_part( 'template-parts/common/page-header', null, $vars );
			}
			?>

			<div class="l-contents__body">
				<div class="l-contents__container c-fluid-container">
					<?php
					if ( ! is_front_page() && 'default' === get_theme_mod( 'breadcrumbs-position' ) ) {
						Helper::get_template_part( 'template-parts/common/breadcrumbs' );
					}
					?>

					<?php if ( ! is_front_page() && 'content-width' === get_theme_mod( 'breadcrumbs-position' ) ) : ?>
						<div class="u-slim-width">
							<?php Helper::get_template_part( 'template-parts/common/breadcrumbs' ); ?>
						</div>
					<?php endif; ?>

					<?php do_action( 'snow_monkey_before_contents_inner' ); ?>

					<div class="l-contents__inner">
						<main class="l-contents__main" role="main" id="primary">
							<?php do_action( 'snow_monkey_prepend_main' ); ?>

							<?php
							// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
							$args['_view_controller']->view();
							// phpcs:enable
							?>

							<?php do_action( 'snow_monkey_append_main' ); ?>
						</main>
					</div>

					<?php do_action( 'snow_monkey_after_contents_inner' ); ?>

					<?php if ( ! is_front_page() && 'bottom-content-width' === get_theme_mod( 'breadcrumbs-position' ) ) : ?>
						<div class="u-slim-width">
							<?php Helper::get_template_part( 'template-parts/common/breadcrumbs' ); ?>
						</div>
					<?php endif; ?>

					<?php
					if ( ! is_front_page() && 'bottom' === get_theme_mod( 'breadcrumbs-position' ) ) {
						Helper::get_template_part( 'template-parts/common/breadcrumbs' );
					}
					?>
				</div>
			</div>

			<?php do_action( 'snow_monkey_append_contents' ); ?>
		</div>

		<?php Helper::get_footer(); ?>

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
	</div>

<?php wp_footer(); ?>
</body>
</html>
