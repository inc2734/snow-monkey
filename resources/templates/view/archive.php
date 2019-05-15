<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
?>

<div class="c-entry">
	<?php Helper::get_template_part( 'template-parts/archive/entry/header/header', get_post_type() ); ?>

	<div class="c-entry__body">
		<?php Helper::get_template_part( 'template-parts/archive/entry/content/content', get_post_type() ); ?>
	</div>
</div>
