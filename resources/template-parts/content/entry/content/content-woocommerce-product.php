<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.4
 *
 * renamed: template-parts/content/entry/content/woocommerce.php
 */
?>

<?php do_action( 'snow_monkey_before_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<?php wc_get_template_part( 'content', 'single-product' ); ?>
</div>

<?php do_action( 'snow_monkey_after_entry_content' ); ?>
