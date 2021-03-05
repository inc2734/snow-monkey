<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.0.0
 */

use Framework\Helper;

if ( is_category() || is_tag() || is_tax() ) {
	if ( ! Helper::has_term_thumbnail() ) {
		return;
	}
	?>
	<div class="c-eyecatch">
		<?php Helper::the_term_thumbnail(); ?>
	</div>
	<?php
	return;
}

if ( is_post_type_archive() ) {
	if ( ! Helper::has_post_type_archive_thumbnail() ) {
		return;
	}
	?>
	<div class="c-eyecatch">
		<?php Helper::the_post_type_archive_thumbnail(); ?>
	</div>
	<?php
	return;
}

if ( is_home() || is_archive() ) {
	if ( ! Helper::has_homepage_thumbnail() ) {
		return;
	}
	?>
	<div class="c-eyecatch">
		<?php Helper::the_homepage_thumbnail( 'large' ); ?>
	</div>
	<?php
}
