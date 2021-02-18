<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.1.2
 */

use Framework\Helper;

$_terms = Helper::get_the_public_terms( get_the_ID() );

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_meta'   => true,
		'_entries_layout' => 'rich-media',
		'_excerpt_length' => null,
		'_thumbnail_size' => 'medium_large',
		'_terms'          => $_terms ? [ $_terms[0] ] : [],
		'_title_tag'      => 'h2',
	]
);
?>

<a href="<?php the_permalink(); ?>">
	<section class="c-entry-summary c-entry-summary--<?php echo esc_attr( $args['_name'] ); ?> c-entry-summary--type-<?php echo esc_attr( get_post_type() ); ?>">
		<?php
		Helper::get_template_part(
			'template-parts/loop/entry-summary/figure/figure',
			$args['_name'],
			[
				'_context'        => $args['_context'],
				'_thumbnail_size' => $args['_thumbnail_size'],
				'_terms'          => $args['_terms'],
			]
		);
		?>

		<div class="c-entry-summary__body">
			<header class="c-entry-summary__header">
				<?php
				Helper::get_template_part(
					'template-parts/loop/entry-summary/title/title',
					$args['_name'],
					[
						'_context'        => $args['_context'],
						'_entries_layout' => $args['_entries_layout'],
						'_title_tag'      => $args['_title_tag'],
					]
				);
				?>
			</header>

			<?php
			Helper::get_template_part(
				'template-parts/loop/entry-summary/content/content',
				$args['_name'],
				[
					'_context'        => $args['_context'],
					'_entries_layout' => $args['_entries_layout'],
					'_excerpt_length' => $args['_excerpt_length'],
				]
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
						[
							'_context' => $args['_context'],
							'_terms'   => $args['_terms'],
						]
					);
				}
			}
			?>
		</div>
	</section>
</a>
