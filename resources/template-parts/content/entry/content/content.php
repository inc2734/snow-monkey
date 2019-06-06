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
	<?php the_content(); ?>
	<?php Helper::get_template_part( 'template-parts/content/link-pages' ); ?>
</div>

<?php do_action( 'snow_monkey_after_entry_content' ); ?>
