<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 *
 * renamed: template-parts/content/entry/content/woocommerce.php
 * renamed: template-parts/content/entry/content/woocommerce-product.php
 */
?>

<?php do_action( 'snow_monkey_before_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<?php do_action( 'snow_monkey_prepend_entry_content' ); ?>

	<?php wc_get_template_part( 'content', 'single-product' ); ?>

	<?php do_action( 'snow_monkey_append_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_entry_content' ); ?>
