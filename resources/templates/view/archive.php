<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.0
 */

use Framework\Helper;

$eyecatch_position = 'post' === get_post_type() ? get_theme_mod( 'archive-eyecatch' ) : false;
?>

<div class="c-entry">
	<?php
	if ( 'title-on-page-header' !== $eyecatch_position ) {
		Helper::get_template_part( 'template-parts/archive/entry/header/header', get_post_type() );
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( 'content-top' === $eyecatch_position ) {
			Helper::get_template_part( 'template-parts/archive/eyecatch' );
		}

		Helper::get_template_part( 'template-parts/archive/entry/content/content', get_post_type() );
		?>
	</div>
</div>
