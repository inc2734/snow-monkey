<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.0
 */

use Framework\Helper;

if ( is_category() ) {
	if ( ! Helper::has_category_thumbnail() ) {
		return;
	}
	?>
	<div class="c-eyecatch">
		<?php Helper::the_category_thumbnail(); ?>
	</div>
	<?php
} elseif ( is_home() || ( is_archive() && ! is_post_type_archive() && ! is_tax() ) ) {
	if ( ! Helper::has_homepage_thumbnail() ) {
		return;
	}
	?>
	<div class="c-eyecatch">
		<?php Helper::the_homepage_thumbnail( 'large' ); ?>
	</div>
	<?php
}
