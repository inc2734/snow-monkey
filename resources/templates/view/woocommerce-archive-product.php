<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.0.4
 */

use Framework\Helper;
?>

<article <?php post_class(); ?>>
	<div class="c-entry__body">
		<?php Helper::get_template_part( 'template-parts/archive/entry/content/content', 'woocommerce-product' ); ?>
	</div>
</article>
