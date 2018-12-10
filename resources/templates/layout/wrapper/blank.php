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

<body <?php body_class( [ 'l-body--blank' ] ); ?> id="body"
	data-has-sidebar="false"
	data-is-full-template="true"
	data-is-slim-width="false"
	>

	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<?php $_view_controller->view(); ?>

<?php wp_footer(); ?>
</body>
</html>
