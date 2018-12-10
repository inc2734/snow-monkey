<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\app\Helper;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-sticky-footer="true">
<?php Helper::get_template_part( 'vendor/inc2734/mimizuku-core/src/view/template-parts/head' ); ?>

<body <?php body_class( [ 'l-body--one-column-full' ] ); ?> id="body"
	data-has-sidebar="false"
	data-is-full-template="true"
	data-is-slim-width="false"
	>

	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<?php Helper::get_template_part( 'template-parts/nav/drawer' ); ?>
	<div class="l-container">
		<?php Helper::get_header(); ?>

		<div class="l-contents" role="document">
			<?php Helper::get_template_part( 'template-parts/header/content', 'sm' ); ?>
			<?php Helper::get_template_part( 'template-parts/infobar' ); ?>

			<div class="c-full-container">
				<?php do_action( 'snow_monkey_before_contents_inner' ); ?>

				<div class="l-contents__inner">
					<main class="l-contents__main" role="main">
						<?php $_view_controller->view(); ?>
					</main>
				</div>

				<?php do_action( 'snow_monkey_after_contents_inner' ); ?>
			</div>
		</div>

		<?php Helper::get_footer(); ?>
	</div>

<?php wp_footer(); ?>
</body>
</html>
