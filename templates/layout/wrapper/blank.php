<?php
/**
 * Name: Landing page
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

<body <?php body_class( array( 'l-body--blank' ) ); ?> id="body"
	data-has-sidebar="false"
	data-is-full-template="true"
	data-is-slim-width="false"
	ontouchstart=""
	>

	<?php wp_body_open(); ?>
	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<div class="l-container">
		<div class="l-contents" role="document">
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
