<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 14.2.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => 'rich-media',
		'_excerpt_length' => null,
		'_force_sm_1col'  => false,
		'_infeed_ads'     => false,
		'_item_title_tag' => 'h3',
		'_items'          => [],
	]
);

if ( ! $args['_items'] ) {
	return;
}

$data_infeed_ads = $args['_infeed_ads'] ? 'true' : 'false';
$force_sm_1col   = $args['_force_sm_1col'] ? 'true' : 'false';
?>

<ul
	class="c-entries c-entries--<?php echo esc_attr( $args['_entries_layout'] ); ?>"
	data-has-infeed-ads="<?php echo esc_attr( $data_infeed_ads ); ?>"
	data-force-sm-1col="<?php echo esc_attr( $force_sm_1col ); ?>"
>
	<?php foreach ( $args['_items'] as $item ) : ?>
		<li class="c-entries__item">
			<?php
			Helper::get_template_part(
				'template-parts/loop/rss',
				null,
				[
					'_context'        => $args['_context'],
					'_entries_layout' => $args['_entries_layout'],
					'_excerpt_length' => $args['_excerpt_length'],
					'_item'           => $item,
					'_title_tag'      => $args['_item_title_tag'],
				]
			);
			?>
		</li>
	<?php endforeach; ?>
</ul>
