<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.2.0
 *
 * renamed: template-parts/archive/entry/content/woocommerce.php
 * renamed: template-parts/archive/entry/content/content-woocommerce-product.php
 */
?>

<?php do_action( 'snow_monkey_before_archive_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<?php do_action( 'snow_monkey_prepend_archive_entry_content' ); ?>

	<div>
		<?php
		if ( woocommerce_product_loop() ) {
			/**
			* Hook: woocommerce_before_shop_loop.
			*
			* @hooked wc_print_notices - 10
			* @hooked woocommerce_result_count - 20
			* @hooked woocommerce_catalog_ordering - 30
			*/
			do_action( 'woocommerce_before_shop_loop' );

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					* Hook: woocommerce_shop_loop.
					*
					* @hooked WC_Structured_Data::generate_product_data() - 10
					*/
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			* Hook: woocommerce_after_shop_loop.
			*
			* @hooked woocommerce_pagination - 10
			*/
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			* Hook: woocommerce_no_products_found.
			*
			* @hooked wc_no_products_found - 10
			*/
			do_action( 'woocommerce_no_products_found' );
		}
		?>
	</div>

	<?php do_action( 'snow_monkey_append_archive_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_archive_entry_content' ); ?>
