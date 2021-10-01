<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.9.0
 */

use Framework\Helper;

if ( ! Helper::has_drop_nav() ) {
	return;
}
?>

<div class="p-drop-nav">
	<div class="c-container">
		<?php
		Helper::get_template_part(
			'template-parts/nav/global',
			null,
			[
				'_context'             => 'snow-monkey/nav/drop',
				'_vertical'            => false,
				'_gnav-hover-effect'   => get_theme_mod( 'gnav-hover-effect' ),
				'_gnav-current-effect' => get_theme_mod( 'gnav-current-effect' ),
			]
		);
		?>
	</div>
</div>
