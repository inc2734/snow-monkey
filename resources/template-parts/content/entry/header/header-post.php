<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;
?>

<header class="c-entry__header">
	<?php
	if ( Helper::is_active_sidebar( 'title-top-widget-area' ) ) {
		Helper::get_template_part( 'template-parts/widget-area/title-top' );
	}
	?>

	<h1 class="c-entry__title"><?php the_title(); ?></h1>

	<div class="c-entry__meta">
		<?php Helper::get_template_part( 'template-parts/content/entry-meta' ); ?>
	</div>
</header>
