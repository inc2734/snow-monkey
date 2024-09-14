<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 27.1.0
 *
 * renamed: template-parts/entry-summary.php
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_display_meta'         => false,
		'_display_item_excerpt' => false,
		'_entries_id'           => null,
		'_entries_layout'       => 'rich-media',
		'_excerpt_length'       => null,
		'_thumbnail_size'       => 'medium_large',
		'_terms'                => array(),
		'_title_tag'            => 'h2',
	)
);

$args = wp_parse_args(
	$args,
	array(
		'_display_author'    => $args['_display_meta'],
		'_display_published' => $args['_display_meta'],
		'_display_modified'  => false,
	)
);
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--<?php echo esc_attr( $args['_name'] ); ?> c-entry-summary--type-<?php echo esc_attr( get_post_type() ); ?>">
		<?php
		Helper::get_template_part(
			'template-parts/loop/entry-summary/figure/figure',
			$args['_name'],
			array(
				'_context'        => $args['_context'],
				'_entries_id'     => $args['_entries_id'],
				'_thumbnail_size' => $args['_thumbnail_size'],
				'_terms'          => $args['_terms'],
			)
		);
		?>

		<div class="c-entry-summary__body">
			<div class="c-entry-summary__header">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/title/title',
					$args['_name'],
					array(
						'_context'        => $args['_context'],
						'_entries_id'     => $args['_entries_id'],
						'_entries_layout' => $args['_entries_layout'],
						'_title_tag'      => $args['_title_tag'],
					)
				);
				?>
			</div>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				$args['_name'],
				array(
					'_context'         => $args['_context'],
					'_entries_id'      => $args['_entries_id'],
					'_entries_layout'  => $args['_entries_layout'],
					'_excerpt_length'  => $args['_excerpt_length'],
					'_display_excerpt' => $args['_display_item_excerpt'],
				)
			);
			?>

			<?php
			if ( $args['_display_meta'] ) {
				$_post_type        = get_post_type() ? get_post_type() : 'post';
				$_post_type_object = get_post_type_object( $_post_type );
				if ( $_post_type_object && ! $_post_type_object->hierarchical ) {
					Helper::get_template_part(
						'template-parts/loop/entry-summary/meta/meta',
						$args['_name'],
						array(
							'_context'           => $args['_context'],
							'_entries_id'        => $args['_entries_id'],
							'_display_author'    => $args['_display_author'],
							'_display_published' => $args['_display_published'],
							'_display_modified'  => $args['_display_modified'],
							'_terms'             => $args['_terms'],
						)
					);
				}
			}
			?>
		</div>
	</section>
</a>
