<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-sticky-footer="true" data-scrolled="false">
<?php Helper::get_template_part( 'vendor/inc2734/mimizuku-core/src/view/template-parts/head' ); ?>

<body <?php body_class( [ 'l-body--left-sidebar' ] ); ?> id="body"
	data-has-sidebar="true"
	data-is-full-template="false"
	data-is-slim-width="true"
	>

	<?php wp_body_open(); ?>
	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<?php Helper::get_template_part( 'template-parts/nav/drawer' ); ?>
	<div class="l-container">
		<?php Helper::get_header(); ?>

		<div class="l-contents" role="document">
			<?php do_action( 'snow_monkey_prepend_contents' ); ?>

			<?php Helper::get_template_part( 'template-parts/header/content', 'sm' ); ?>

			<?php
			if ( get_theme_mod( 'infobar-content' ) ) {
				Helper::get_template_part( 'template-parts/common/infobar' );
			}
			?>

			<?php
			if ( Helper::is_output_page_header() ) {
				$vars = [
					'_display_entry_meta' => is_singular( 'post' ),
				];
				Helper::get_template_part( 'template-parts/common/page-header', null, $vars );
			}
			?>

			<div class="c-container">
				<?php
				if ( ! is_front_page() && in_array( get_theme_mod( 'breadcrumbs-position' ), [ 'default', 'content-width' ] ) ) {
					Helper::get_template_part( 'template-parts/common/breadcrumbs' );
				}
				?>

				<?php do_action( 'snow_monkey_before_contents_inner' ); ?>

				<div class="l-contents__inner">
					<main class="l-contents__main" role="main">
						<?php do_action( 'snow_monkey_prepend_main' ); ?>

						<?php $_view_controller->view(); ?>

						<?php do_action( 'snow_monkey_append_main' ); ?>
					</main>

					<aside class="l-contents__sidebar" role="complementary">
						<?php do_action( 'snow_monkey_prepend_sidebar' ); ?>

						<?php Helper::get_sidebar(); ?>

						<?php do_action( 'snow_monkey_append_sidebar' ); ?>
					</aside>
				</div>

				<?php do_action( 'snow_monkey_after_contents_inner' ); ?>

				<?php
				if ( ! is_front_page() && in_array( get_theme_mod( 'breadcrumbs-position' ), [ 'bottom', 'bottom-content-width' ] ) ) {
					Helper::get_template_part( 'template-parts/common/breadcrumbs' );
				}
				?>
			</div>

			<?php do_action( 'snow_monkey_append_contents' ); ?>
		</div>

		<?php Helper::get_footer(); ?>
	</div>

<?php wp_footer(); ?>
</body>
</html>
