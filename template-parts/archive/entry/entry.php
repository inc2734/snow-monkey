<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 20.1.1
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_display_archive_top_widget_area' => false,
		'_display_description'             => false,
		'_display_entry_header'            => false,
		'_display_eyecatch'                => false,
		'_entries_layout'                  => 'rich-media',
		'_entries_gap'                     => null,
		'_force_sm_1col'                   => false,
		'_infeed_ads'                      => false,
	)
);
?>

<?php
if ( $args['_display_archive_top_widget_area'] ) {
	Helper::get_template_part( 'template-parts/widget-area/archive-top' );
}
?>

<div class="c-entry">
	<?php
	if ( $args['_display_entry_header'] ) {
		Helper::get_template_part( 'template-parts/archive/entry/header/header', $args['_name'] );
	}
	?>

	<div class="c-entry__body">
		<?php
		if ( $args['_display_eyecatch'] ) {
			Helper::get_template_part( 'template-parts/archive/eyecatch' );
		}
		?>

		<?php if ( $args['_display_description'] ) : ?>
			<div class="p-term-description p-entry-content">
				<?php echo wp_kses_post( term_description() ); ?>
			</div>
		<?php endif; ?>

		<?php
		Helper::get_template_part(
			'template-parts/archive/entry/content/content',
			$args['_name'],
			array(
				'_entries_layout' => $args['_entries_layout'],
				'_entries_gap'    => $args['_entries_gap'],
				'_force_sm_1col'  => $args['_force_sm_1col'],
				'_infeed_ads'     => $args['_infeed_ads'],
			)
		);
		?>
	</div>
</div>

