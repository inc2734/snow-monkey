<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

global $wp_query;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => 'rich-media',
		'_force_sm_1col'  => false,
		'_infeed_ads'     => false,
	]
);
?>

<?php do_action( 'snow_monkey_before_archive_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<?php do_action( 'snow_monkey_prepend_archive_entry_content' ); ?>

	<?php
	Helper::get_template_part(
		'template-parts/archive/archive',
		$args['_name'],
		[
			'_entries_layout' => $args['_entries_layout'],
			'_force_sm_1col'  => $args['_force_sm_1col'],
			'_infeed_ads'     => $args['_infeed_ads'],
			'_posts_query'    => $wp_query,
		]
	);
	?>

	<?php
	if ( ! empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages >= 2 ) {
		Helper::get_template_part( 'template-parts/archive/pagination' );
	}
	?>

	<?php do_action( 'snow_monkey_append_archive_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_archive_entry_content' ); ?>
