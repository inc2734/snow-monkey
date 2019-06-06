<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

use Framework\Helper;
?>

<article <?php post_class(); ?>>
	<div class="c-entry__body">
		<?php Helper::get_template_part( 'template-parts/archive/entry/content/woocommerce' ); ?>
	</div>
</article>
