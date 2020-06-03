<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.1
 */

use Framework\Helper;

$_post_type = get_post_type() ? get_post_type() : 'post';
?>

<div class="c-entry">
	<?php Helper::get_template_part( 'template-parts/archive/entry/header/header', 'search' ); ?>

	<div class="c-entry__body">
		<?php
		Helper::get_template_part(
			'template-parts/archive/entry/content/content',
			'search',
			[
				'_entries_layout' => get_theme_mod( $_post_type . '-entries-layout' ),
				'_force_sm_1col'  => get_theme_mod( $_post_type . '-entries-layout-sm-1col' ),
			]
		);
		?>
	</div>
</div>
