<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_title_top_widget_area' => false,
		'_display_entry_meta'            => false,
	]
);
?>

<header class="c-entry__header">
	<?php
	if ( $args['_display_title_top_widget_area'] ) {
		if ( Helper::is_active_sidebar( 'title-top-widget-area' ) ) {
			Helper::get_template_part(
				'template-parts/widget-area/title-top',
				$args['_name']
			);
		}
	}
	?>

	<h1 class="c-entry__title"><?php the_title(); ?></h1>

	<?php if ( $args['_display_entry_meta'] ) : ?>
		<div class="c-entry__meta">
			<?php
			Helper::get_template_part(
				'template-parts/content/entry-meta',
				$args['_name']
			);
			?>
		</div>
	<?php endif; ?>
</header>
