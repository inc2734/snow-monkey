<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.7.1
 */

use Framework\Helper;

$_post_type        = get_post_type() ? get_post_type() : 'post';
$eyecatch_position = 'post' === $_post_type ? get_theme_mod( 'archive-eyecatch' ) : false;
?>

<div class="c-entry">
	<?php
	if ( 'title-on-page-header' !== $eyecatch_position ) {
		Helper::get_template_part( 'template-parts/archive/entry/header/header', $_post_type );
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( 'content-top' === $eyecatch_position ) {
			Helper::get_template_part( 'template-parts/archive/eyecatch' );
		}

		Helper::get_template_part(
			'template-parts/archive/entry/content/content',
			$_post_type,
			[
				'_entries_layout' => get_theme_mod( $_post_type . '-entries-layout' ),
				'_force_sm_1col'  => get_theme_mod( $_post_type . '-entries-layout-sm-1col' ),
			]
		);
		?>
	</div>
</div>
