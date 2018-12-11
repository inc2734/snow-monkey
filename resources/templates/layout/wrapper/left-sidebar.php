<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-sticky-footer="true">
<?php Helper::get_template_part( 'vendor/inc2734/mimizuku-core/src/view/template-parts/head' ); ?>

<body <?php body_class( [ 'l-body--left-sidebar' ] ); ?> id="body"
	data-has-sidebar="true"
	data-is-full-template="false"
	data-is-slim-width="true"
	>

	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<?php Helper::get_template_part( 'template-parts/nav/drawer' ); ?>
	<div class="l-container">
		<?php Helper::get_header(); ?>

		<div class="l-contents" role="document">
			<?php Helper::get_template_part( 'template-parts/header/content', 'sm' ); ?>
			<?php Helper::get_template_part( 'template-parts/infobar' ); ?>

			<?php
			if ( Helper::is_output_page_header() ) {
				Helper::get_template_part( 'template-parts/page-header' );
			}
			?>

			<div class="c-container">
				<?php
				if ( in_array( get_theme_mod( 'breadcrumbs-position' ), [ 'default', 'content-width' ] ) ) {
					Helper::get_template_part( 'template-parts/breadcrumbs' );
				}
				?>

				<?php do_action( 'snow_monkey_before_contents_inner' ); ?>

				<div class="l-contents__inner">
					<main class="l-contents__main" role="main">
						<?php $_view_controller->view(); ?>
					</main>

					<aside class="l-contents__sidebar" role="complementary">
						<?php Helper::get_sidebar(); ?>
					</aside>
				</div>

				<?php do_action( 'snow_monkey_after_contents_inner' ); ?>

				<?php
				if ( in_array( get_theme_mod( 'breadcrumbs-position' ), [ 'bottom', 'bottom-content-width' ] ) ) {
					Helper::get_template_part( 'template-parts/breadcrumbs' );
				}
				?>
			</div>
		</div>

		<?php Helper::get_footer(); ?>
	</div>

<?php wp_footer(); ?>
</body>
</html>
