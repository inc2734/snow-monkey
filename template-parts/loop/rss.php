<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 25.1.1
 *
 * renamed: template-parts/loop/entry-summary-rss.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_title_tag'      => 'h2',
		'_item'           => false,
		'_entries_id'     => null,
		'_entries_layout' => 'rich-media',
		'_excerpt_length' => null,
	)
);

if ( ! $args['_item'] || ! is_a( $args['_item'], 'SimplePie_Item' ) ) {
	return;
}
?>

<a href="<?php echo esc_url( $args['_item']->get_permalink() ); ?>" target="_blank" rel="noopener">
	<section class="c-entry-summary c-entry-summary--rss c-entry-summary--type-rss">
		<?php
		Helper::get_template_part(
			'template-parts/loop/entry-summary/figure/rss',
			null,
			array(
				'_context'    => $args['_context'],
				'_entries_id' => $args['_entries_id'],
				'_item'       => $args['_item'],
			)
		);
		?>

		<div class="c-entry-summary__body">
			<div class="c-entry-summary__header">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/title/rss',
					null,
					array(
						'_context'        => $args['_context'],
						'_entries_id'     => $args['_entries_id'],
						'_entries_layout' => $args['_entries_layout'],
						'_title_tag'      => $args['_title_tag'],
						'_item'           => $args['_item'],
					)
				);
				?>
			</div>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/rss',
				null,
				array(
					'_context'        => $args['_context'],
					'_item'           => $args['_item'],
					'_entries_id'     => $args['_entries_id'],
					'_entries_layout' => $args['_entries_layout'],
					'_excerpt_length' => $args['_excerpt_length'],
				)
			);
			?>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/meta/rss',
				null,
				array(
					'_context'    => $args['_context'],
					'_entries_id' => $args['_entries_id'],
					'_item'       => $args['_item'],
				)
			);
			?>
		</div>
	</section>
</a>
