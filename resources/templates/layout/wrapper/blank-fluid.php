<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-sticky-footer="true">
<?php get_template_part( 'vendor/inc2734/mimizuku-core/src/view/template-parts/head' ); ?>

<body <?php body_class( [ 'l-body--blank-fluid' ] ); ?> id="body"
	data-has-sidebar="false"
	data-is-fluid-template="true"
	data-is-slim-width="false"
	data-is-fixed-width="false"
	>

	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<div class="c-fluid-container">
		<?php $_view_controller->view(); ?>
	</div>

<?php wp_footer(); ?>
</body>
</html>
