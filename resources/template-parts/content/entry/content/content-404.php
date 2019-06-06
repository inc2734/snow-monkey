<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

use Framework\Helper;
?>

<?php do_action( 'snow_monkey_before_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<p>
		<?php esc_html_e( 'Woops! Page not found.', 'snow-monkey' ); ?><br>
		<?php esc_html_e( 'The page you are looking for may be moved or deleted.', 'snow-monkey' ); ?><br>
		<?php esc_html_e( 'Please search this search box.', 'snow-monkey' ); ?>
	</p>

	<?php Helper::get_template_part( 'template-parts/common/search-form', '404' ); ?>
</div>

<?php do_action( 'snow_monkey_after_entry_content' ); ?>
