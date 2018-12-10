<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Snow_Monkey\App\Helper;
?>

<article <?php post_class(); ?>>
	<div class="c-entry__body">
		<?php do_action( 'snow_monkey_before_entry_content' ); ?>

		<div class="c-entry__content p-entry-content">
			<?php the_content(); ?>
			<?php Helper::get_template_part( 'template-parts/content/link-pages' ); ?>
		</div>

		<?php do_action( 'snow_monkey_after_entry_content' ); ?>
	</div>
</article>
