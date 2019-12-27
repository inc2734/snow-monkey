<?php
/**
 * Name: Landing page ( slim width )
 *
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 9.0.0
 */

use Framework\Helper;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-sticky-footer="true">
<?php Helper::get_template_part( 'template-parts/common/head' ); ?>

<body <?php body_class( [ 'l-body--blank' ] ); ?> id="body"
	data-has-sidebar="false"
	data-is-full-template="false"
	data-is-slim-width="true"
	>

	<?php wp_body_open(); ?>
	<?php do_action( 'snow_monkey_prepend_body' ); ?>

	<div class="l-container">
		<div class="l-contents" role="document">
			<div class="u-slim-width">
				<?php $_view_controller->view(); ?>
			</div>
		</div>
	</div>

<?php wp_footer(); ?>
</body>
</html>
